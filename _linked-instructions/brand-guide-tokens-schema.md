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

On every page load, `functions.php` hooks into `wp_theme_json_data_theme` and merges the token file over the base `theme.json`. This means:

- No template files are touched per client
- No child themes are needed
- The live site reflects the new tokens immediately after the file is written (the cache-invalidation hook `quadnine_after_apply_client_tokens` clears any stale global styles)

---

## Schema

All keys are optional. Omit any key to keep the theme default.

```json
{
  "client": "string — client slug, e.g. acme-co (informational only)",

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
  "client": "acme-co",
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
