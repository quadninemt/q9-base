# Pattern Authoring Guide — q9-base

Reference for anyone building or modifying block patterns in this theme. All 23 registered patterns follow these rules. Deviating silently breaks token overrides, mobile layout, or visual rhythm across client sites.

---

## File conventions

- **One PHP file per pattern** under `patterns/`. The theme auto-registers everything in that directory — no `functions.php` changes needed.
- **Slug format:** `q9/<name>` (kebab-case, no underscores).
- **Docblock** at the top of every file:

```php
<?php
/**
 * Title: Human-readable name
 * Slug: q9/slug-name
 * Categories: q9
 * Keywords: comma, separated, search, terms
 * Description: One sentence describing when to use this pattern.
 * Viewport Width: 1280
 */
?>
```

- Keep files under 500 lines. If a pattern needs more, split it into two complementary patterns.

---

## Token rules — no hardcoded values

### Colours
Use `var:preset|color|*` in block attributes and `var(--wp--preset--color--*)` in inline styles.

Available slugs: `primary`, `secondary`, `accent`, `neutral-light`, `neutral-dark`, `background`, `text`.

**The only permitted literal hex value is `#ffffff`** — used for text or elements sitting on a dark background (`primary`, `neutral-dark`). This matches the approved exceptions in `cta-banner`, `stats-row`, and `hero-image-bg`. Do not add other literals.

### Font sizes
Use `var:preset|font-size|*`: `small`, `medium`, `large`, `xl`, `2xl`, `3xl`, `4xl`.

No `clamp()`, no `rem`/`px` literals. The only approved exception is the `4rem` decorative quote glyph in `testimonial-single` — do not replicate elsewhere.

### Spacing
Use `var:preset|spacing|*`: `small`, `medium`, `large`, `xlarge`.

### Radius
Use `var:custom|radius|*`: `button`, `card`, `input`.

---

## Section shell convention

Every full-width section uses this outer wrapper:

```html
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xlarge","bottom":"var:preset|spacing|xlarge"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xlarge);padding-bottom:var(--wp--preset--spacing--xlarge)">
  ...content...
</div>
<!-- /wp:group -->
```

- `align:"full"` = full-bleed background (colour or image spans the viewport).
- `layout:{"type":"constrained"}` = inner content is centred and width-capped.
- Use `xlarge` top/bottom padding for standard sections; `large` for tighter bands (e.g. `logo-wall`).
- **Alternate backgrounds** white (default) / `neutral-light` to create vertical rhythm. CTA and hero sections use `primary` or a cover image.

### Centred section header (used in most content sections)

```html
<!-- wp:group {"layout":{"type":"constrained","contentSize":"560px"},"style":{"spacing":{"blockGap":"var:preset|spacing|small","margin":{"bottom":"var:preset|spacing|large"}}}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--large)">
  <!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|small","letterSpacing":"0.08em","textTransform":"uppercase"},"color":{"text":"var:preset|color|primary"}}} -->
  <p class="has-text-align-center" style="color:var(--wp--preset--color--primary);font-size:var(--wp--preset--font-size--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase">Section label</p>
  <!-- /wp:paragraph -->
  <!-- wp:heading {"level":2,"textAlign":"center","style":{"typography":{"fontWeight":"700"}}} -->
  <h2 class="wp-block-heading has-text-align-center" style="font-weight:700">Section heading</h2>
  <!-- /wp:heading -->
</div>
<!-- /wp:group -->
```

---

## Mobile-first rules

Every pattern must stack cleanly at 320px minimum width.

**Use `wp:columns` for multi-column layouts.** WordPress stacks columns to 1-up at ≤781px by default — no custom breakpoint CSS needed. Do not use custom flex containers for layouts that need to stack.

**Source order = mobile order.** Whatever appears first in the HTML is rendered first on mobile. For split layouts (text + image), put the text column first in source so mobile reads text-then-image. For image-top requirements on mobile with reversed desktop layout, use the `is-style-reversed` CSS approach (see below) — never reorder source.

**Touch targets ≥ 44px.** Any tappable element (button, card, nav item, icon tile) must have a minimum height of 44px.

**Images use `aspectRatio` + `scale:"cover"`** so they don't break row height on narrow viewports.

### is-style-reversed (for alternating desktop layout)

Used by `q9/media-text-row` to flip image left/right on desktop while keeping image-top on mobile.

**Registration** (already in `functions.php`):
```php
register_block_style( 'core/columns', [
    'name'  => 'reversed',
    'label' => __( 'Reversed (image right)', 'q9-base' ),
] );
```

**CSS** (in `style.css`):
```css
@media (min-width: 782px) {
    .wp-block-columns.is-style-reversed {
        flex-direction: row-reverse;
    }
}
```

`782px` is WordPress's own column-stacking breakpoint. The media query must start at `min-width: 782px` — not `768px` or `769px`. This ensures the CSS only applies when WP has already laid out the columns as a row, so mobile stacking is unaffected.

---

## Heading hierarchy

- One `h2` per section (the section's primary heading).
- `h3` for items within a section (card titles, step titles, team member names).
- Never put an `h1` in a pattern — heroes are the only h1 source and they are page-level patterns, not content library patterns.
- Exception: `q9/hero-split` and `q9/hero-image-bg` use `h1` because they are page-level above-fold heroes.

---

## Accessibility

- Descriptive `alt` text on all content images (leave placeholder text for the Executor to replace).
- `alt=""` on purely decorative images.
- The token palette already passes WCAG AA contrast. Do not swap palette colours in ways that create low-contrast combinations (e.g. `accent` text on `neutral-light` background — verify before using).

---

## Icons — inline SVG preferred, no uploaded SVGs

The SVG Support plugin is **not** in the QuadNine plugin stack. Patterns must not assume clients can upload `.svg` files.

**For icon slots** (`icon-grid`, `logo-wall` icon tiles, feature badges): use **inline SVG** directly in the pattern markup. Inline SVGs are crisp at all sizes, themeable via `currentColor` or preset colour vars, require no upload, and carry no plugin dependency. Example:

```html
<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
  <circle cx="24" cy="24" r="20" stroke="currentColor" stroke-width="2"/>
</svg>
```

**For photographic slots** (team photos, hero images, post thumbnails): `<img src="" alt="…">` with an empty `src` placeholder is correct — the Executor fills these with uploaded PNG/JPG media at build time.

**For client logo slots** (`logo-wall`): prefer `<img src="" alt="Brand name">` with PNG/JPG. If a client supplies an SVG logo, they can upload it directly via the media library (the web server serves SVGs fine without the plugin) — but patterns must not require SVG upload support.

## Contact form embed

The current form plugin is **Fluent Forms** (free tier). Use `[fluentform id="N"]` as the placeholder hint in contact patterns — not `[contact-form-7 id="N"]`.

## Placeholder content

Ship with neutral placeholder copy and empty `src=""` images. The Executor swaps in real client content at build time. Do **not** bake in client-specific content (URLs, names, phone numbers).

---

## Acceptance checklist

Before committing a new pattern:

- [ ] Appears in Site Editor inserter under "QuadNine"
- [ ] Renders without console errors on the live test site
- [ ] Mobile stack check at ≤768px (columns stack, no overflow, no broken layout)
- [ ] All colours use token variables — no hardcoded hex (except permitted `#ffffff`)
- [ ] All font sizes use preset scale — no `clamp()`, `rem`, `px`
- [ ] Heading hierarchy correct (h2 section, h3 items)
- [ ] Touch targets ≥ 44px on interactive elements
- [ ] Slug added to `flows/pattern-library.md` in Website Builder project

---

## Adding a new block style

If a pattern needs a variant (e.g. `is-style-reversed`):

1. Register in `functions.php` using `register_block_style()` on the correct core block type.
2. Add CSS to `style.css` under the "Pattern block styles" section.
3. Scope desktop-only variants to `@media (min-width: 782px)` to avoid breaking mobile.
4. Document the style in this file and in the pattern's PHP comment.
