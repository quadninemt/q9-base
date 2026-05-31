# q9-base theme bugs — brand token CSS injection + numeric font-size slugs

Date: 2026-05-31
Source: Website Builder — showcase v1.2.0 preview (test.quadnine.mt)
Severity: HIGH — affects every client site (fonts + headings render wrong)

Two genuine theme-code bugs were found while previewing the showcase. Both are in
`q9-base` (the shared theme), so they hit every client. Neither is a content bug.

---

## Bug A — font-family quotes are HTML-escaped in the wp_head token injection

**File:** `functions.php`, the `wp_head` action (priority 99) that prints
`<style id="q9-brand-tokens">`.

**What happens:** font-family values are written with `esc_attr()`:

```php
$vars .= '--wp--preset--font-family--body:' . esc_attr( $tokens['typography']['body-font-family'] ) . ';';
$vars .= '--wp--preset--font-family--heading:' . esc_attr( $tokens['typography']['heading-font-family'] ) . ';';
```

`esc_attr()` HTML-encodes single quotes, so a value like
`'Plus Jakarta Sans', system-ui, sans-serif` becomes
`&#039;Plus Jakarta Sans&#039;, system-ui, sans-serif`.

Inside a `<style>` element this is **not** HTML — `&#039;` is literal text, not a
quote. The font-family declaration is therefore malformed and the quoted family
name is silently ignored. The browser falls back to the next unquoted token
(system-ui / serif).

**Why it went unnoticed:** single-word families (Inter, Georgia) have no quotes,
so they survive `esc_attr()` untouched. Only multi-word families that require
quotes break — i.e. exactly the heading fonts every brand uses
(`'Plus Jakarta Sans'`, `'Playfair Display'`). Verified live: `--…--font-family--heading`
resolved to `&#039;Plus Jakarta Sans&#039;…` and `<h1>` computed to a system serif.

**Fix:** do not use `esc_attr()` for values injected into a CSS `<style>` context.
Use a CSS-safe sanitiser that strips only the characters dangerous in CSS
(`<`, `>`, `{`, `}`, `;`, and stray `"`/`\`), preserving single quotes. Apply the
same fix to every token written into the style block (colours survive only by
luck — hex has no escaped chars). Example:

```php
$css_safe = static function ( string $v ): string {
    return preg_replace( '/[<>{};]/', '', wp_strip_all_tags( $v ) );
};
```

---

## Bug B — font-size presets with numeric-leading slugs (2xl/3xl/4xl) are never emitted

**File:** `theme.json`, `settings.typography.fontSizes`.

**What happens:** WordPress emits `--wp--preset--font-size--{slug}` for
`small`, `medium`, `large`, `xl` — but **not** for `2xl`, `3xl`, `4xl`. Verified
live on :root: xl = `clamp(1.25rem … 1.5rem)`; 2xl / 3xl / 4xl resolve to empty.
The *references* (`var(--wp--preset--font-size--4xl)`) exist in `styles.elements.h1`
etc. and in patterns, but the *definitions* are absent — so they resolve to empty
and every heading collapses to the inherited body size (~20px).

The only structural difference between the slugs that work and the ones that fail
is the **leading digit**. Numeric-leading preset slugs are a known source of
trouble in WP's preset/CSS-var generation.

**Effect:** h1 (4xl), h2 (3xl), h3 (2xl) all render at body size on every page —
heroes look tiny. This is the single biggest visual defect right now.

**Fix (robust, well-supported):** rename the three slugs to non-numeric-leading
and update every reference. Suggested mapping:

- `2xl` → `xxl`
- `3xl` → `xxxl`  (or `display-sm`)
- `4xl` → `display`  (or `xxxxl`)

Update in lockstep:
1. `theme.json` `fontSizes` slugs.
2. `theme.json` `styles.elements.h1..h6` `fontSize` vars.
3. All `/patterns/*.php` using `var:preset|font-size|2xl|3xl|4xl` (hero-image-bg,
   hero-text-only, hero-split, intro-about, cta-banner, stats-row, etc.).
4. `editor-style.css` / `style.css` if they reference the old slugs.

A theme version bump (→ 1.2.1) and redeploy to test.quadnine.mt is required.

---

## Related: deploy overwrote the live brand-guide-tokens.json (operational, not a code bug)

The v1.2.0 deploy shipped the repo's **default Acme sample** `brand-guide-tokens.json`
(primary `#E53E3E` red, Playfair/Georgia) and overwrote HRmalta's applied tokens.
That is why the showcase initially rendered red + serif. Re-applying HRmalta tokens
via `quadnine-apply-client-tokens` fixed the colours immediately (teal `#0D6E6E`
restored, verified live).

**This is LL-build-7 (reinstall/redeploy wipes client state) extended to the token
file.** Recommendation for the deploy flow: either (a) git-ignore / never ship a
populated `brand-guide-tokens.json` in the theme package (ship `.example` only), or
(b) re-run `apply-client-tokens` for every affected client as a mandatory post-deploy
step, with a verification check that `--…--color--primary` matches the client's brand.

---

## Outcome — 2026-05-31

### Bug A — font-family esc_attr() ✅ Fixed
- Replaced all `esc_attr()` calls in the `wp_head` token injection with a `$css_safe` closure: `preg_replace( '/[<>{};]/', '', wp_strip_all_tags( $v ) )`
- Applies to all token types: colours, typography, spacing, radius
- Comment added explaining why `esc_attr()` must not be used in CSS context

### Bug B — numeric font-size slugs ✅ Fixed
- Renamed in `theme.json` fontSizes: `2xl`→`xxl`, `3xl`→`xxxl`, `4xl`→`display`
- Updated `theme.json` `styles.elements` h1/h2/h3 references
- Updated 6 pattern files: `hero-image-bg`, `hero-text-only`, `hero-split`, `testimonial-single`, `stats-row`, `pricing-3tier`
- Verified zero remaining `2xl`/`3xl`/`4xl` references across all `.php` and `theme.json`

### Operational note (brand-guide-tokens.json overwrite)
- Noted as an existing lesson (LL-build-7 extension). Not a code fix — this is a deploy process gap. Recommend shipping an empty/example token file in future releases.

**Committed:** `6ebd3ae` (v1.2.1)  
**Deployed:** test.quadnine.mt — all 9 files via MCP  
**Added to docs/lessons-learned.md:** LL-theme-10 (esc_attr in CSS), LL-theme-11 (numeric slugs)
