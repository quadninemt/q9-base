# Theme Fix Instructions — q9-base (q9-gregale)

> ✅ **ALL FIXES COMPLETE — 2026-05-29**  
> All 5 fixes committed to `quadninemt/q9-base` (commits `a6d46da`, `71087c7`) and deployed to test.quadnine.mt.  
> This file is retained for reference only — no further action required.

**Date:** 2026-05-28 | **Completed:** 2026-05-29  
**Repo:** https://github.com/quadninemt/q9-base

---

## Fix 1 — Commit `front-page.html` ✅ DONE (verified 2026-05-29)

The `templates/front-page.html` was patched live on the server during the HRmalta dry run and is now correctly committed to the repo. Uses `wp:post-content` — no hardcoded pattern.

---

## Fix 2 — Navigation block must reference a custom menu ✅ DONE (verified 2026-05-29)

`functions.php` registers `primary` and `footer` nav menu locations. `class-create-nav-menu.php` in q9-abilities-plugin already calls `set_theme_mod('nav_menu_locations', ...)` after menu creation (lines 180–182 of the ability class — confirmed 2026-05-29).

The build flow must pass `"location": "primary"` when calling `quadnine-create-nav-menu`. That is a Website Builder / build flow concern, not a theme or abilities plugin concern.

---

## Fix 3 — Remove `wp:post-title` from inner page templates ✅ DONE (verified 2026-05-29)

`page.html` has no `wp:post-title`. No `page-*.html` variants exist in the repo. Hero pattern provides the H1.

---

## Fix 4 — Google Fonts enqueue ✅ DONE (verified 2026-05-29)

`functions.php` has `q9_get_google_fonts_url()` with correct fallback to Inter, enqueued on both frontend and block editor. Implementation matches the `brand-guide-tokens.json` schema.

---

## Fix 5 — CSS class names on template parts ✅ DONE (verified 2026-05-29)

All templates use `className:"site-header"` and `className:"site-footer"` on their template-part references. `index.html` was the last missing case — fixed 2026-05-29.

---

## Summary Checklist

| Fix | Status | Action required |
|---|---|---|
| 1. `front-page.html` committed | ✅ Done | — |
| 2. Nav block references custom menu | ✅ Done | Build flow must pass `"location":"primary"` when calling `quadnine-create-nav-menu` |
| 3. Remove `wp:post-title` from page templates | ✅ Done | — |
| 4. Google Fonts enqueue | ✅ Done | — |
| 5. CSS classNames on all template parts | ✅ Done | — |
