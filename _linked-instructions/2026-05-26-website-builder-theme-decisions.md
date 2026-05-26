# Website Builder — Theme Decisions (2026-05-26)

This file was dropped by the Website Builder project. Read it before doing any work in q9-wp-theme.

---

## What this theme is

The QuadNine block theme (q9-gregale) is a **standalone Full Site Editing (FSE) theme with no parent**. It is deployed to every QuadNine-managed client site. There are no per-client child themes.

This is Website Builder **Decision 5** (confirmed and finalised 2026-05-26). Two earlier models are fully dropped:
- ~~GeneratePress grandparent → per-client child theme~~ — dropped
- ~~GeneratePress grandparent → QuadNine parent theme~~ — dropped (never built)

---

## Client differentiation model

Clients are differentiated entirely through a `brand-guide-tokens.json` file, one per client. Its keys map 1:1 to the theme's `theme.json` token surface (colour palette, typography, spacing, radius, etc.).

At deploy time (or via a small runtime merge layer) the per-client tokens are merged into the theme's effective `theme.json`. The theme must be designed so that all visual differentiation between clients can be achieved by varying `theme.json` tokens — no PHP or template forks per client.

**Implication for theme development:** the `theme.json` token surface is the product. Design it to cover everything a typical SMB site needs to vary: brand colours, body and heading fonts, button radius, spacing scale. The `brand-guide-tokens.json` schema will mirror this surface 1:1; it is being formalised as part of the block theme build.

---

## Pattern library (Decision 4)

Block patterns registered under `/patterns/` are the **strict whitelist enforcement vehicle** for the Website Builder workflow. The Executor agent selects page sections from this library — it never generates fresh markup. Generating markup not drawn from a registered pattern is a Test Runner failure.

Target: approximately 15 patterns covering hero, testimonial, pricing, CTA, feature grid, gallery, team, FAQ, contact, and similar standard SMB page sections.

**Implication for theme development:** patterns are not optional extras — they are core infrastructure. Every pattern must be production-quality and correctly registered so the Executor can enumerate and select from them programmatically.

---

## Templates and parts

Block templates (`/templates/`) and template parts (`/parts/`) carry the layout. These are shared across all clients — client-specific layout variation is achieved through token differentiation, not template forks.

---

## Deployment model

- The theme is built once and lives in this Git repository (https://github.com/quadninemt/q9-gregale)
- It is deployed to every staging and production site
- Theme version bumps propagate to all client sites
- The `quadnine/activate-theme` ability (in q9-abilities-plugin) activates this theme by its slug — it should always activate the QuadNine block theme, not a per-client slug

---

## Relationship to q9-abilities-plugin — concrete requirements

The q9-abilities-plugin does **not** build this theme. It configures a WordPress site that already has the theme installed. Four concrete requirements flow from the plugin's implementation (verified 2026-05-26 by inspecting plugin source):

**1. Directory slug must be exactly `q9-base`** — hardcoded in the plugin:
```php
private const PARENT_THEME_SLUG = 'q9-base';
```
Write target: `{wp-content/themes}/q9-base/brand-guide-tokens.json`. Any other directory name breaks `apply-client-tokens`.

**2. Theme reads `brand-guide-tokens.json` from its own root** — the plugin writes to `{theme-dir}/brand-guide-tokens.json`. The theme merges these tokens into `theme.json` values at request time. Implementation approach is the theme builder's choice (e.g. `wp_theme_json_data_theme` filter).

**3. Hook into `quadnine_after_apply_client_tokens`** — plugin fires this action after a successful token write. Theme must hook here to invalidate any derived caches (compiled CSS, global styles, transients, object cache).
```php
do_action( 'quadnine_after_apply_client_tokens', $clientSlug, $tokensFile );
```

**4. Pin the token schema and share it back** — plugin currently accepts any well-formed JSON (schema validation pending). Once the token surface is defined, drop a `_linked-instructions/` file in q9-abilities-plugin with the schema so `apply-client-tokens` can validate.

---

## Source of truth

Full architectural context and all 10 Website Builder decisions:
`C:\Users\kevin\OneDrive - QuadNine Ltd\Claude\Website Builder\CLAUDE.md`
