# Theme Fixes Required — 2026-05-29

Source: Website Builder project — HRmalta re-run visual check

---

## Fix A — `page.html` must support full-width section layouts

**Problem:** `page.html` wraps `wp:post-content` in a Group with `layout:{"type":"constrained"}` and explicit top/bottom padding. This prevents inner page hero and CTA sections (Group blocks with `align:"full"`) from breaking out to full viewport width. The home page works correctly because `front-page.html` uses `layout:{"type":"default"}` with no padding.

**Expected behaviour:** Group blocks with `align:"full"` in page content should span the full viewport width, matching the behaviour on the front page.

**Fix:** Update `templates/page.html` to match the structure of `front-page.html` — use `layout:{"type":"default"}` with no outer padding on the main group. Individual page sections are responsible for their own internal padding and max-width constraints.

**Current `page.html`:**
```html
<!-- wp:template-part {"slug":"header","tagName":"header","className":"site-header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group">
    <!-- wp:post-content {"layout":{"type":"constrained"}} /-->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer","className":"site-footer"} /-->
```

**Required `page.html`:**
```html
<!-- wp:template-part {"slug":"header","tagName":"header","className":"site-header"} /-->

<!-- wp:group {"tagName":"main","layout":{"type":"default"}} -->
<main class="wp-block-group">
    <!-- wp:post-content {"layout":{"type":"default"}} /-->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer","className":"site-footer"} /-->
```

This same fix should be applied to any other inner page templates if they exist (`archive.html`, `single.html`, `404.html` — check each).

---

## Fix B — Header and footer nav blocks need inline items committed to repo

**Problem:** On 2026-05-29, `parts/header.html` and `parts/footer.html` were patched **live on test.quadnine.mt** (via `quadnine-write-theme-file`) to add inline navigation links. The repo does NOT reflect these changes. The live server diverges from GitHub — a `git pull` or theme reinstall will wipe the nav fix.

**What was written to the live server:**

`parts/header.html` — the `wp:navigation` block was changed from self-closing to include inline items:
```html
<!-- wp:navigation {"textColor":"text","overlayMenu":"mobile","layout":{"type":"flex","justifyContent":"right","flexWrap":"nowrap"}} -->
<!-- wp:navigation-link {"label":"Services","url":"https://test.quadnine.mt/services/","type":"page","id":133,"isTopLevelLink":true} /-->
<!-- wp:navigation-link {"label":"About","url":"https://test.quadnine.mt/about/","type":"page","id":134,"isTopLevelLink":true} /-->
<!-- wp:navigation-link {"label":"Contact","url":"https://test.quadnine.mt/contact/","type":"page","id":135,"isTopLevelLink":true} /-->
<!-- /wp:navigation -->
```

`parts/footer.html` — same approach with footer items:
```html
<!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","justifyContent":"right","flexWrap":"wrap"},"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"fontSize":"small"} -->
<!-- wp:navigation-link {"label":"Services","url":"https://test.quadnine.mt/services/","type":"page","id":133,"isTopLevelLink":true} /-->
<!-- wp:navigation-link {"label":"About","url":"https://test.quadnine.mt/about/","type":"page","id":134,"isTopLevelLink":true} /-->
<!-- wp:navigation-link {"label":"Contact","url":"https://test.quadnine.mt/contact/","type":"page","id":135,"isTopLevelLink":true} /-->
<!-- wp:navigation-link {"label":"Privacy Policy","url":"https://test.quadnine.mt/privacy-policy/","type":"page","id":3,"isTopLevelLink":true} /-->
<!-- /wp:navigation -->
```

**However:** hardcoding page URLs and IDs in the theme template is wrong for a shared theme — every client site would have HRmalta's URLs. The correct approach is one of:

1. **Keep the nav self-closing in the template** — rely on the build flow to assign a `wp_navigation` post via the WP REST API at build time (the right long-term solution)
2. **OR** keep the inline approach but make the URLs relative (e.g. `/services/`) and document that the build flow must update the nav block `ref` after menu creation

**Recommended approach:** Keep the nav block self-closing in the repo. The inline fix on the live site is acceptable as a temporary workaround for HRmalta but must NOT be committed to the repo as-is. Instead, document the correct build-time nav assignment approach (creating a `wp_navigation` post and referencing it via `ref`) as a future abilities plugin enhancement.

**Action:** Revert `parts/header.html` and `parts/footer.html` in the repo to their original self-closing nav block form if they have not already been changed. The live site fix stands for now.

---

## Outcome

- Fix A (`page.html` layout): ✅ Done 2026-05-29 — changed outer group to `layout:{"type":"default"}`, removed outer padding. `single.html`, `archive.html`, `404.html` left unchanged — they manage their own internal structure and do not use `wp:post-content` with hero breakouts.
- Fix B (nav template revert/decision): ✅ No action needed — repo `header.html` and `footer.html` were already self-closing. The hardcoded HRmalta nav items existed only on the live server and were never committed. Decision documented: keep nav self-closing in repo; build flow assigns menu via `set_theme_mod('nav_menu_locations', ...)` through `quadnine-create-nav-menu` ability.
- Committed as: see commit pushed after this note
- Deployed to test.quadnine.mt: `templates/page.html` via `quadnine-write-theme-file`

`Website Builder/pending.md` and `Website Builder/memory/session.md` updated.
