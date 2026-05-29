# q9-wp-theme

This project contains the standalone QuadNine block theme (FSE) — **q9-gregale** — deployed to every QuadNine-managed client site.

## Repository
https://github.com/quadninemt/q9-base

---

## Completing tasks from linked instructions

Whenever you complete tasks sourced from a `_linked-instructions/` file, update that file with:
1. The completion status of each item (✅ Done / ⚠️ Partial / ❌ Skipped)
2. A brief note on what was done and any decisions made
3. The commit hash and/or date if code was changed

Fill in any `## Outcome` or similar section the file already has. If there is no such section, append one.

---

## Cross-project instructions — read first

This project is part of the QuadNine Website Builder system. The Website Builder project may drop instruction or clarification files into this project's `_linked-instructions/` folder when decisions change that affect the theme.

**At the start of every session:** check whether `_linked-instructions/` exists in this directory. If it does, read every `.md` file in it before doing anything else. Treat those files as amendments to this CLAUDE.md — they take precedence where they conflict with anything here.

**After reading linked instructions, verify the code matches them.** Check these specific things and flag any mismatch to the user before proceeding with other work:

| What to check | Where to look | What to verify |
|---|---|---|
| Repo URL | `style.css` Theme URI, `CLAUDE.md`, `BRIEF.md`, `README.md`, `_linked-instructions/*.md` | All must match the current GitHub repo URL |
| Token merge — `wp_head` injection | `functions.php` | Hook exists at priority 99; injects `--wp--preset--color--*`, `--wp--preset--font-family--*`, `--wp--preset--spacing--*`, `--wp--custom--radius--*` |
| Token merge — `wp_theme_json_data_theme` | `functions.php` | Filter exists and merges colors, typography, spacing, radius, shadows |
| Cache invalidation | `functions.php` | `quadnine_after_apply_client_tokens` hook calls `clean_cached_data()`, `wp_cache_flush_group('theme_json')`, `wp_cache_flush()` |
| Google Fonts | `functions.php` | Reads `typography.google-fonts-url` from token file; falls back to Inter |
| Token schema surface | `theme.json` | Palette has all 7 colors; spacing has 4 sizes; custom radius has button/card/input; shadows has card/button |
| Token schema doc | `_linked-instructions/brand-guide-tokens-schema.md` | Schema doc matches what `functions.php` actually reads and maps |
| Pattern count | `patterns/` | At least 15 patterns covering hero, CTA, testimonial, pricing, FAQ, contact, gallery |
| Directory slug | Any slug reference in code or docs | Must always be `q9-base`, never `q9-gregale` or anything else |

If any check fails, stop and report the discrepancy with file:line evidence before doing anything else.

The parent project lives at: `C:\Users\kevin\OneDrive - QuadNine Ltd\Claude\Website Builder`

---

## Critical constraints — read before touching anything

**Theme directory slug must be `q9-base`** — not q9-gregale, not anything else. The `apply-client-tokens` ability in q9-abilities-plugin has this hardcoded. If the theme installs under a different directory name, the ability writes `brand-guide-tokens.json` to the wrong location and client token application fails. Every reference to the theme slug in code, readme, and configuration must use `q9-base`.

**`brand-guide-tokens.json` is read from `{theme-dir}/brand-guide-tokens.json`** — the plugin writes to this exact path. The theme must pick it up from there and merge it into the active `theme.json` token values.

**Hook into `quadnine_after_apply_client_tokens`** — if the theme caches anything derived from `theme.json` (compiled CSS, global styles, transients), add a hook here to invalidate those caches after a token write.

Full integration spec: `BRIEF.md` → Integration with q9-abilities-plugin

---

## Role in the Website Builder workflow

- One theme, shared across all client sites — no per-client child themes (Website Builder Decision 5)
- `theme.json` is the source of truth for design tokens; per-client `brand-guide-tokens.json` is merged in at deploy time
- Block patterns under `/patterns/` implement the strict whitelist (Decision 4) — the Executor selects from these, never generates fresh markup
- Block templates and template parts under `/templates/` and `/parts/` carry the layout
- Theme version bumps propagate changes to all client sites

Full architectural context: `C:\Users\kevin\OneDrive - QuadNine Ltd\Claude\Website Builder\CLAUDE.md`

---

## Test WordPress site — live interaction

During development and testing, Claude can interact directly with a live WordPress test site via the **q9-abilities-plugin** (wp-abilities). This means:

- Files (`theme.json`, templates, parts, patterns, `style.css`) can be written to the WordPress installation directly using `quadnine/write-theme-file`
- The theme can be activated using `quadnine/activate-theme`
- Per-client tokens can be applied using `quadnine/apply-client-tokens`
- Acceptance criteria can be verified against the real site (rendered templates, pattern inserter, Lighthouse, axe-core)

Use the plugin for all verification steps — do not treat a file as complete until it has been tested on the live site.

Plugin project: `C:\Users\kevin\OneDrive - QuadNine Ltd\Claude\q9-abilities-plugin`
