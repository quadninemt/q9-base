# Lessons Learned — q9-base Theme

Running log of theme-specific discoveries, fixes, and decisions. Read this at the start of any session involving template or pattern changes.

For build-workflow lessons (Executor mistakes, page content issues), see `Website Builder/flows/lessons-learned.md`.

---

## LL-theme-1 — `layout:constrained` on `<main>` silently breaks full-width section breakouts

**Date:** 2026-05-29  
**Symptom:** Hero and CTA sections with `align:"full"` failed to span the full viewport on inner pages. The same sections worked correctly on the front page.  
**Root cause:** `templates/page.html` wrapped `wp:post-content` in a Group with `layout:{"type":"constrained"}` and explicit top/bottom padding. This clamps the outer container, preventing child blocks with `align:"full"` from breaking out.  
**Fix:** Changed the outer Group to `layout:{"type":"default"}` and removed outer padding. Individual sections manage their own padding via the section shell convention.  
**Rule:** Inner page templates (`page.html`, `single.html`, etc.) must use `layout:{"type":"default"}` on the `<main>` Group. Never set `layout:{"type":"constrained"}` on the template's outer wrapper — that is the section's job, not the template's.  
**Commit:** `38b676b`

---

## LL-theme-2 — `wp:post-title` in page templates causes a double H1

**Date:** 2026-05-28  
**Symptom:** Inner pages (Services, About) showed two H1 elements — the WordPress post title rendered by `wp:post-title`, followed immediately by the hero pattern's H1.  
**Root cause:** Page templates included `wp:post-title` at the top. Hero patterns also output an H1.  
**Fix:** Removed `wp:post-title` from all inner page templates. The hero pattern is the sole H1 source on every page. Yoast handles the `<title>` tag independently.  
**Rule:** No template file may include `wp:post-title`. The hero section owns the H1.

---

## LL-theme-3 — `front-page.html` must use `wp:post-content`, not a hardcoded pattern

**Date:** 2026-05-27  
**Symptom:** The front page rendered the generic hero pattern regardless of what content was saved to the Home page in the editor.  
**Root cause:** `templates/front-page.html` contained `<!-- wp:pattern {"slug":"q9/hero-image-bg"} /-->` instead of `<!-- wp:post-content /-->`. This hardcoded a single pattern and discarded the page's actual content.  
**Fix:** Replaced the hardcoded pattern with `wp:post-content`. The front page now renders whatever block content is saved to the page assigned as the front page.  
**Rule:** All templates use `wp:post-content` to render page content. Hardcoding a pattern slug in a template file is never correct — patterns belong in page content, not in templates.  
**Commit:** `b62e875`

---

## LL-theme-4 — Nav template parts must stay self-closing; no client URLs in the repo

**Date:** 2026-05-29  
**Symptom:** `parts/header.html` and `parts/footer.html` were patched live with inline `wp:navigation-link` items containing HRmalta's page URLs and IDs. This created a repo divergence — a `git pull` would have wiped the live fix.  
**Root cause:** The nav block was self-closing and WordPress wasn't resolving the menu correctly without a registered menu location. A quick live fix was applied instead of following the cross-project instruction process.  
**Fix:** Reverted decision — keep nav self-closing in the repo. The build workflow assigns the menu via `set_theme_mod('nav_menu_locations', ...)` through `quadnine-create-nav-menu`. The live HRmalta nav was left as-is (acceptable temporary state).  
**Rule:** Template part files in the repo must never contain client-specific URLs, page IDs, or menu items. The nav block stays self-closing. Any menu content is assigned at build time, not baked into the template.  
**Commit:** N/A (decision not to commit the live change)

---

## LL-theme-5 — WP 7.0 with Redis: `wp_theme_json_data_theme` filter is unreliable for token injection

**Date:** 2026-05-27  
**Symptom:** After applying `brand-guide-tokens.json`, the block editor picked up new token values but the front-end continued serving old CSS variables from the Redis object cache.  
**Root cause:** On WP 7.0 with Redis object caching enabled, `wp_theme_json_data_theme` filter results are cached aggressively. The filter fires at the right time but the output is served from cache before the new tokens can propagate.  
**Fix:** Added `wp_head` injection at priority 99 as the reliable runtime path. This injects CSS variables directly into `<head>` on every page load, bypassing the cache entirely. The `wp_theme_json_data_theme` filter is retained for the block editor only.  
**Rule:** Always use `wp_head` injection (priority 99) for token CSS variables on the front-end. Do not rely on `wp_theme_json_data_theme` alone when Redis or object caching is active.  
**Reference:** `memory/project_wp7_token_cache.md`

---

## LL-theme-6 — MCP API requires a session handshake before tool calls

**Date:** 2026-05-29  
**Symptom:** Direct calls to `quadnine-write-theme-file` returned HTTP 400 "Missing Mcp-Session-Id header".  
**Root cause:** The WordPress MCP adapter implements the MCP protocol, which requires a session initialization step before any tool call. The session ID must be captured from the `initialize` response headers and included in all subsequent requests.  

**Correct call sequence:**
1. POST to `{endpoint}` with body `{"jsonrpc":"2.0","method":"initialize","params":{...},"id":1}` → capture `Mcp-Session-Id` from response headers.
2. POST `notifications/initialized` (body can be empty JSON) with the session ID header.
3. All subsequent tool calls include `Mcp-Session-Id: <value>` in headers.

**Tool name convention:** Uses **dashes**, not slashes — `quadnine-write-theme-file`, not `quadnine/write-theme-file`. Wrong convention returns 404.  
**Reference:** `memory/project_theme_fixes_2026-05-29.md` — contains a working Python implementation of this pattern.

---

## LL-theme-7 — `is-style-reversed` must be scoped to `min-width: 782px`

**Date:** 2026-05-30  
**Symptom:** If `flex-direction: row-reverse` is applied without a breakpoint guard, it reverses the stacking order on mobile too — putting the image below the text instead of above, which breaks mobile reading order and LCP.  
**Root cause:** `wp:columns` stacks columns vertically at ≤781px (WP's own breakpoint). Without a `min-width` guard, `row-reverse` applies to the stacked (vertical) layout and reverses the top-to-bottom order.  
**Fix:** CSS scoped to `@media (min-width: 782px)` only. Mobile source order (image column first in source) guarantees image-top regardless of which desktop side the image is on.  
**Rule:** Any CSS that reverses or reorders column layout must be wrapped in `@media (min-width: 782px)`. Use `782px` exactly — it matches WP's stacking breakpoint.

---

## LL-theme-8 — Source order determines mobile order; CSS order does not

**Date:** 2026-05-30  
**Context:** Designing `q9/hero-split` (text left, image right) and `q9/media-text-row` (image left, text right; with reversed variant).  
**Principle:** WordPress block rendering outputs HTML in source order. On mobile, columns stack vertically in that same source order. CSS `order` and `flex-direction` only affect visual presentation at desktop widths.  
**Application:**  
- `hero-split`: text column is first in source → on mobile, text renders above image. Correct for LCP (text is the meaningful content) and reading order.  
- `media-text-row`: image column is first in source → on mobile, image renders above text. Correct (visual-first for section comprehension). For the `is-style-reversed` desktop variant, the image stays first in source; CSS reverses the row at desktop only.  
**Rule:** When designing a pattern that needs a different desktop order from its mobile order, keep the mobile-correct order in source and use `@media (min-width: 782px)` CSS to reorder at desktop. Never reorder source to achieve a desktop layout at the cost of mobile reading order.

---

## LL-theme-9 — `className` on `wp:template-part` is required for CSS scoping

**Date:** 2026-05-29  
**Symptom:** CSS rules targeting `.site-header` and `.site-footer` in `style.css` had no effect because the rendered template part had no class attribute.  
**Root cause:** `wp:template-part` does not automatically add a class matching the slug. The `className` attribute must be set explicitly in the block comment.  
**Fix:** Added `"className":"site-header"` and `"className":"site-footer"` to the `wp:template-part` references in `templates/index.html` and all other templates.  
**Rule:** All `wp:template-part` references must include `"className":"site-<slug>"` so CSS selectors can target the rendered wrapper.
