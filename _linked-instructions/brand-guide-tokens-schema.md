# brand-guide-tokens.json — Schema Definition

**Produced by:** q9-wp-theme build (2026-05-26)
**For:** q9-abilities-plugin — `quadnine/apply-client-tokens` ability

---

## File location on the server

The theme reads the token file from:

```
{wp-content}/themes/q9-base/brand-guide-tokens.json
```

The `apply-client-tokens` ability must write to this exact path. The theme slug is always `q9-base`.

---

## How the merge works

`functions.php` applies tokens via two complementary mechanisms:

**1 — `wp_head` CSS variable injection (front-end, priority 99)**
On every page load, a `<style id="q9-brand-tokens">` block is output in `<head>` that overrides the `--wp--preset--color--*`, `--wp--preset--font-family--*`, `--wp--preset--spacing--*`, and `--wp--custom--radius--*` CSS custom properties directly from the token file. This is the reliable production path — it requires no cache invalidation and works on WP 7.0+.

**2 — `wp_theme_json_data_theme` filter (block editor / Site Editor)**
The same token values are merged into the theme JSON data so the Site Editor preview reflects client branding. Due to WP 7.0's persistent object cache (Redis/Memcached), this path is less reliable on the front-end but correct for editor context.

**Cache invalidation (`quadnine_after_apply_client_tokens` hook)**
Calling `apply-client-tokens` fires this hook, which calls:
- `WP_Theme_JSON_Resolver::clean_cached_data()` (WP 6.1+)
- `wp_cache_flush_group('theme_json')`
- `wp_cache_flush()` (full flush for Redis hosts)

This means:
- No template files are touched per client
- No child themes are needed
- The live site reflects new tokens **immediately** — the `wp_head` injection path has no cache dependency

---

## Schema

All keys are optional. Omit any key to keep the theme default.

```json
{
  "client_slug": "string — client slug, e.g. acme-co (informational only; written by apply-client-tokens ability)",

  "colors": {
    "primary":       "hex — primary brand colour (buttons, links, highlights)",
    "secondary":     "hex — secondary brand colour (hover states, accents)",
    "accent":        "hex — accent / alert colour",
    "neutral-light": "hex — light neutral (backgrounds, borders)",
    "neutral-dark":  "hex — dark neutral (body text secondary, captions)",
    "background":    "hex — page background",
    "text":          "hex — primary body text",

    "_comment_extended": "OPTIONAL extended colour scale (added 2026-06-04, gap T8). All keys below are optional — supply only the ones a client design uses; omitted keys keep the theme default. functions.php emits a --wp--preset--color--{slug} variable for every key present, and the Site Editor palette exposes them.",
    "primary-50":  "hex", "primary-100": "hex", "primary-200": "hex", "primary-300": "hex", "primary-400": "hex",
    "primary-500": "hex", "primary-600": "hex", "primary-700": "hex", "primary-800": "hex", "primary-900": "hex",
    "accent-dark": "hex — darker accent (hover/active on accent)",
    "accent-50":   "hex — very light accent tint (chips, callout backgrounds)",
    "accent-200":  "hex — light accent",
    "snow":   "hex — near-white neutral",
    "cloud":  "hex — light grey neutral (alternating section backgrounds)",
    "silver": "hex — mid-light neutral (borders, dividers)",
    "pewter": "hex — mid neutral (muted text)",
    "slate":  "hex — dark neutral",
    "ink":    "hex — very dark neutral (footers, dark sections)",
    "success": "hex — success / positive state"
  },

  "typography": {
    "body-font-family":    "CSS font-family stack for body text",
    "heading-font-family": "CSS font-family stack for headings",
    "line-height-body":    "number string, e.g. '1.6'",
    "line-height-heading": "number string, e.g. '1.2'",
    "google-fonts-url":    "Full Google Fonts CSS URL — must begin with https://fonts.googleapis.com/ and include all weights for both body and heading fonts, plus &display=swap. If present, functions.php enqueues this URL instead of the default Inter. Omit to keep Inter."
  },

  "spacing": {
    "small":  "CSS length, e.g. '1rem'",
    "medium": "CSS length, e.g. '2rem'",
    "large":  "CSS length, e.g. '4rem'",
    "xlarge": "CSS length, e.g. '6rem'"
  },

  "radius": {
    "button": "CSS border-radius, e.g. '0.375rem' or '0' for square",
    "card":   "CSS border-radius, e.g. '0.5rem'",
    "input":  "CSS border-radius, e.g. '0.375rem'"
  },

  "shadows": {
    "card":   "CSS box-shadow value, or 'none'",
    "button": "CSS box-shadow value, or 'none'"
  }
}
```

---

## Validation rules for `apply-client-tokens`

| Field | Rule |
|---|---|
| `client` | Alphanumeric + hyphens, lowercase |
| Color keys | Slug must match `^[a-z0-9-]+$` (the 7 semantic colours plus any optional extended-scale slug). **Plugin TODO (gap T8):** `apply-client-tokens` must accept the extended-scale keys in addition to the 7 semantic colours. |
| Color values | Must be valid hex (`#rrggbb` or `#rgb`) — applies to every colour key, semantic or extended |
| Font families | Free-form string — no validation required |
| `google-fonts-url` | Must begin with `https://fonts.googleapis.com/` if present |
| Spacing values | Must include a CSS unit (`rem`, `px`, `em`, `%`) |
| Radius values | Must include a CSS unit, or be `'0'` |
| Shadow values | Free-form string or `'none'` |

---

## Sample — Acme Co

```json
{
  "client_slug": "acme-co",
  "colors": {
    "primary":   "#E53E3E",
    "secondary": "#DD6B20"
  },
  "typography": {
    "body-font-family":    "Georgia, serif",
    "heading-font-family": "'Playfair Display', Georgia, serif"
  },
  "radius": {
    "button": "0",
    "card":   "0.25rem",
    "input":  "0"
  }
}
```

The full sample file with all keys is at `brand-guide-tokens.json` in the theme root.
