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
    "text":          "hex — primary body text"
  },

  "typography": {
    "body-font-family":    "CSS font-family stack for body text",
    "heading-font-family": "CSS font-family stack for headings",
    "line-height-body":    "number string, e.g. '1.6'",
    "line-height-heading": "number string, e.g. '1.2'"
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
| Color values | Must be valid hex (`#rrggbb` or `#rgb`) |
| Font families | Free-form string — no validation required |
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
