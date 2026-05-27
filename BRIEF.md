# q9-gregale — Theme Build Brief

**Project:** q9-wp-theme (q9-gregale)
**Date:** 2026-05-26
**Status:** Pre-build — not started

---

## What we're building

A standalone WordPress Full Site Editing (FSE) block theme — no parent theme, no third-party dependency. It is built once and deployed to every QuadNine-managed client site. All visual differentiation between clients is achieved through a `brand-guide-tokens.json` file, never through per-client PHP or template forks.

This theme is the unblocking dependency for the entire Website Builder workflow. Nothing else can ship to a client until this exists.

---

## Non-negotiables

- **FSE only.** Classic PHP templates are out of scope. All layout lives in `/templates/` and `/parts/` as block markup.
- **No parent theme.** Standalone. No GeneratePress, no Kadence, no Astra.
- **No per-client child themes.** One theme slug, everywhere.
- **WP 6.9+.** Do not accommodate legacy behaviour.
- **`theme.json` is the source of truth** for all design tokens — not hardcoded CSS, not `functions.php`.

---

## Token surface

The theme's `theme.json` must expose a clean, documented token surface. Every key in this surface is a potential override in `brand-guide-tokens.json`. Design it to cover everything an SMB site needs to vary between clients:

| Token group | Keys to expose |
|---|---|
| Colour palette | `primary`, `secondary`, `accent`, `neutral-light`, `neutral-dark`, `background`, `text` |
| Typography | `body-font-family`, `heading-font-family`, `base-font-size`, `line-height` |
| Spacing | `small`, `medium`, `large`, `xlarge` (maps to WP spacing scale) |
| Border radius | `button`, `card`, `input` |
| Shadows | `card`, `button` (optional — can be `none` per client) |

The token surface is finalised during theme build. Once pinned, the schema must be written to `brand-guide-tokens.json` (in this repo) and communicated to q9-abilities-plugin so `quadnine/apply-client-tokens` can validate against it. Use `_linked-instructions/` to do this.

---

## Template architecture

Minimum template set for a QuadNine SMB site:

| Template | File | Purpose |
|---|---|---|
| Front page | `templates/front-page.html` | Static home page |
| Page (default) | `templates/page.html` | Interior pages |
| Single post | `templates/single.html` | Blog posts |
| Blog archive | `templates/archive.html` | Posts list |
| 404 | `templates/404.html` | Not found |

Template parts (shared across templates):

| Part | File |
|---|---|
| Header | `parts/header.html` |
| Footer | `parts/footer.html` |
| Post meta | `parts/post-meta.html` |

Keep templates as thin shells — they compose template parts and leave content regions open for block patterns. The less logic in templates, the easier it is to change layouts without forking.

---

## Pattern library

Block patterns registered under `/patterns/` are the **strict whitelist** the Website Builder Executor selects from. Generating markup outside this library is a Test Runner failure.

Target: 15 patterns. Every pattern must be registered with a slug, title, and category so the Executor can enumerate them.

| # | Pattern | Slug | Notes |
|---|---|---|---|
| 1 | Hero — full width, image bg | `q9/hero-image-bg` | Primary above-fold |
| 2 | Hero — text only, centred | `q9/hero-text-only` | Minimal variant |
| 3 | Intro / about section | `q9/intro-about` | Short paragraph + optional image |
| 4 | Services grid (3-col) | `q9/services-grid-3` | Icon + heading + short text |
| 5 | Services list (2-col) | `q9/services-list-2` | Expanded descriptions |
| 6 | Features row | `q9/features-row` | Horizontal, 3–4 items |
| 7 | Testimonials (single) | `q9/testimonial-single` | Quote, name, role |
| 8 | Testimonials (3-up) | `q9/testimonials-3up` | Grid of cards |
| 9 | Pricing — 3 tiers | `q9/pricing-3tier` | Recommended tier highlighted |
| 10 | CTA banner | `q9/cta-banner` | Full-width, heading + button |
| 11 | CTA — inline | `q9/cta-inline` | Narrower, usable mid-page |
| 12 | Stats row | `q9/stats-row` | 3–4 numbers with labels |
| 13 | FAQ | `q9/faq` | Accordion or open list |
| 14 | Contact section | `q9/contact-section` | Heading + address/form embed placeholder |
| 15 | Image gallery | `q9/gallery` | 3-col responsive grid |

All patterns use `theme.json` tokens for colour and typography — no hardcoded hex values.

---

## Integration with q9-abilities-plugin

The plugin does not build this theme. It configures a site that already has the theme installed and active. Four concrete requirements flow from the plugin implementation.

### 1. Directory slug must be exactly `q9-base` — critical

The `apply-client-tokens` ability has this hardcoded:

```php
private const PARENT_THEME_SLUG = 'q9-base';
```

The write target resolves to `{wp-content/themes}/q9-base/brand-guide-tokens.json`. If the theme installs under any other directory name, `apply-client-tokens` writes to the wrong location and fails silently. The theme folder name must be exactly `q9-base` — not `q9-gregale`, not anything else.

### 2. Theme must read `brand-guide-tokens.json` from its own root

The plugin writes the file to `{theme-dir}/brand-guide-tokens.json` (i.e. `wp-content/themes/q9-base/brand-guide-tokens.json`). The theme is responsible for picking it up from that location and merging or overriding the relevant `theme.json` token values at request time. How the merge is implemented is the theme builder's decision — a `functions.php` filter on `wp_theme_json_data_theme`, a build step, or a runtime override layer all work — but the file location and name are fixed by the plugin.

### 3. Hook into `quadnine_after_apply_client_tokens` for cache invalidation

After a successful write, the plugin fires:

```php
do_action( 'quadnine_after_apply_client_tokens', $clientSlug, $tokensFile );
```

If the theme caches compiled CSS, global styles, or anything derived from `theme.json` (e.g. via `wp_cache`, object cache, or transients), it must add a hook here to invalidate those caches so the next request sees the updated tokens. The plugin only fires the action — it does not know what the theme caches.

### 4. Pin the `brand-guide-tokens.json` schema and share it back

The plugin currently accepts any well-formed JSON object and logs a notice that schema validation is pending. Once the theme builder has defined the full token key set and valid value formats, the schema must be communicated back to q9-abilities-plugin via `_linked-instructions/` so `apply-client-tokens` can add proper validation. Until that happens, the ability is permissive.

### Other integration points

- `quadnine/activate-theme` — activates the theme by slug (`q9-base`). The ability is hardcoded to this slug.
- `quadnine/write-theme-file` — used during theme development only, not per-client builds. The plugin's path validator must allow `/patterns/`, `/templates/`, `/parts/`, and `theme.json` as in-bounds write targets within the `q9-base` directory.

---

## Acceptance criteria

The theme is ready to use in the Website Builder workflow when:

- [ ] Activates cleanly on WP 6.9+ with no PHP errors or notices
- [ ] All 5 templates render without warnings in the Site Editor
- [ ] All 15 patterns appear in the pattern inserter and render correctly
- [ ] All `theme.json` tokens can be overridden by `brand-guide-tokens.json` without touching template files
- [ ] Lighthouse on a default install: Performance ≥90, Accessibility ≥95, Best Practices ≥95, SEO ≥95
- [ ] axe-core: zero serious or critical violations on default templates
- [ ] Mobile-responsive at 320, 768, 1024, 1440px
- [ ] Theme directory is named exactly `q9-base` (not q9-gregale or any other slug)
- [ ] `brand-guide-tokens.json` is read from `{theme-dir}/brand-guide-tokens.json` and its tokens override `theme.json` values at request time
- [ ] Theme hooks into `quadnine_after_apply_client_tokens` and invalidates any derived caches
- [ ] `brand-guide-tokens.json` schema documented in this repo and communicated to q9-abilities-plugin via `_linked-instructions/`

---

## Build sequence

1. `theme.json` + token surface — do this first; everything else references it
2. `style.css` header (theme name, slug, description — no CSS needed in FSE)
3. Template parts: header + footer
4. Core templates (front-page, page, single, archive, 404)
5. Pattern library (all 15 — can be parallelised once templates are done)
6. `brand-guide-tokens.json` schema + test with a sample client token set
7. Acceptance criteria sweep

---

## Repository

https://github.com/quadninemt/q9-base

Branch strategy: `main` is the deployed branch. Work on feature branches, merge via PR.

---

## References

- Website Builder decisions (all 10): `C:\Users\kevin\OneDrive - QuadNine Ltd\Claude\Website Builder\CLAUDE.md` → Decided section
- Token application ability spec: `C:\Users\kevin\OneDrive - QuadNine Ltd\Claude\q9-abilities-plugin\abilities-plugin-change-brief.md`
- Pattern whitelist enforcement: Website Builder Decision 4
- Theme model decision: Website Builder Decision 5
