# Stack change — Contact Form 7 → Fluent Forms; SVG Support dropped

Date: 2026-05-31
Source: Website Builder — plugin stack reconsideration
Affects: `patterns/contact-section.php`, and any pattern that assumes uploaded SVGs

Plugin-stack decisions made on the Website Builder side (staging already updated):

- **Forms:** moving off Contact Form 7 (now feature-frozen after v6.2) to **Fluent Forms**
  (free tier, block-friendly, built-in entry storage + spam handling, same vendor as
  FluentSMTP already in the stack). Flamingo is dropped too — Fluent Forms stores its
  own entries, so Flamingo (a CF7-only companion) is redundant.
- **SVG Support:** dropped from the stack. Uploaded `.svg` files still *serve* fine
  without it (the web server returns them for plain `<img src>`), but no new SVG uploads
  are possible and we no longer want an SVG-upload plugin on client sites (XSS surface).

## Required theme changes

### 1. `patterns/contact-section.php` — update the form-embed placeholder hint

The pattern uses a placeholder, not a hardcoded shortcode (good). Only the hint comment
references CF7. Update it so future builds reach for Fluent Forms:

Current (around line 83):
```html
<!-- wp:html -->
<!-- Contact form embed — replace with your form shortcode or embed code, e.g. [contact-form-7 id="1"] -->
<p style="...">[Contact form embed]</p>
<!-- /wp:html -->
```

Change the hint to:
```html
<!-- Contact form embed — replace with your Fluent Forms shortcode, e.g. [fluentform id="1"] -->
```

(Pure documentation change; no rendered output changes. Low risk.)

### 2. SVG going forward — inline icons in patterns, do not rely on uploaded SVGs

With SVG Support dropped, patterns must not assume clients can upload `.svg`. For any
pattern that uses small vector marks (e.g. `icon-grid`, `logo-wall`), prefer **inline
SVG** inside the pattern markup (crisp, themeable via `currentColor`/preset vars, no
upload, no plugin) over an `<img src="*.svg">` slot. Raster (`<img>` PNG/JPG) remains
fine for photographic slots.

This is a forward-looking guideline, not an emergency fix — the existing showcase SVGs
already uploaded continue to serve. Consider it when `icon-grid` / `logo-wall` are next
revised.

## Coordination note (handled on the Website Builder side, not the theme)

The two live pages that embed an actual CF7 shortcode — HRmalta contact (post 135) and
showcase-contact (post 218) — will be re-pointed from `[contact-form-7 id="1"]` to the
new `[fluentform id="X"]` via `quadnine-update-page` once the Fluent Form is created in
WP Admin. No theme action needed for that.

---

## Outcome — 2026-05-31

### 1. `patterns/contact-section.php` — CF7 hint updated ✅ Done
- Changed comment on line 83 from `[contact-form-7 id="1"]` to `[fluentform id="1"]`
- Pure documentation change; no rendered output affected

### 2. SVG inline guideline ✅ Added to docs
- Added "Icons — inline SVG preferred, no uploaded SVGs" section to `docs/pattern-authoring.md`
- Added "Contact form embed" section confirming Fluent Forms shortcode
- Forward-looking only — no existing pattern markup changed (existing uploaded SVGs serve fine)

### 3. Live page re-pointing (CF7 → Fluent Forms)
- ⚠️ Handled on Website Builder side — no theme action needed

Committed: see git log on quadninemt/q9-base main, 2026-05-31.
