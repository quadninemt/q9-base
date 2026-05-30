# Pattern Library Extension — 7 New Patterns

**Date:** 2026-05-30
**Source:** Website Builder project — competitor layout audit (`flows/pattern-library-gap-analysis.md`)
**Goal:** Add seven registered block patterns to close the layout gaps found across HRmalta's competitor set. These extend the strict whitelist (Decision 4); the Executor will be allowed to use them once registered and added to `flows/pattern-library.md`.

## Build checklist (suggested order — small/high-leverage first)

- [x] 1. `q9/team-grid` — `patterns/team-grid.php`
- [x] 2. `q9/key-contact` — `patterns/key-contact.php`
- [x] 3. `q9/logo-wall` — `patterns/logo-wall.php`
- [x] 4. `q9/hero-split` — `patterns/hero-split.php`
- [x] 5. `q9/process-steps` — `patterns/process-steps.php`
- [x] 6. `q9/post-grid` — `patterns/post-grid.php`
- [x] 7. `q9/media-text-row` — `patterns/media-text-row.php`
- [x] 8. `q9/icon-grid` — `patterns/icon-grid.php`

(7 patterns; `team-grid` + `key-contact` split GAP 1 into two files.)

---

## Global rules — apply to every pattern below

These mirror the existing 15 patterns; do not deviate.

1. **File location & registration:** one PHP file per pattern under `patterns/`. The theme auto-registers everything in that directory; category `q9` is already registered in `functions.php`. Use the same docblock header format (`Title` / `Slug` / `Categories: q9` / `Keywords` / `Description` / `Viewport Width: 1280`).
2. **Tokens only — no hardcoded values:**
   - Colours: `var:preset|color|*` → `primary, secondary, accent, neutral-light, neutral-dark, background, text`. The only permitted literal hex is `#ffffff` for text/elements sitting on a dark (`primary`/`neutral-dark`) background, matching existing patterns (`cta-banner`, `stats-row`, `hero-image-bg`).
   - Font sizes: `var:preset|font-size|*` → `small, medium, large, xl, 2xl, 3xl, 4xl`. No `clamp()`, no literal `px`/`rem` font sizes (exception: the `4rem` decorative quote glyph already used in `testimonial-single` — not needed here).
   - Spacing: `var:preset|spacing|*` → `small, medium, large, xlarge`.
   - Radius: `var:custom|radius|*` → `button, card, input`.
3. **Section shell convention:** full-width sections wrap in `<!-- wp:group {"align":"full", … "layout":{"type":"constrained"}} -->` with `padding top/bottom = var:preset|spacing|xlarge` (or `large` for tighter bands). Alternate backgrounds white (default) / `neutral-light` to preserve vertical rhythm. Centred section header = uppercase label paragraph (`small`, `font-weight:600`, `letter-spacing:0.08em`, `text-transform:uppercase`, colour `primary`) + H2 — same as `services-grid-3`.
4. **Mobile-first (P8):** every pattern must stack cleanly on mobile. Use `wp:columns` (which stacks at ≤781px by default) rather than custom flex where possible. Any interactive/tappable element ≥44px touch target. Images use `aspectRatio` + `scale:"cover"` so they don't dictate row height. State the mobile behaviour explicitly in each pattern's comment.
5. **Placeholder content:** ship with neutral placeholder copy and empty `src=""` images (as the existing patterns do) — the Executor swaps real content per client. Do NOT bake in HRmalta-specific content.
6. **Accessibility:** real heading hierarchy (one `h2` per section, `h3` for items), `alt=""` on decorative images and descriptive alt on content images, sufficient contrast (preset palette already AA).
7. **Acceptance:** after building, confirm each appears in the Site Editor inserter under "QuadNine", renders with no console errors, and passes a mobile (≤768px) stack check. Then the Website Builder side adds the slug to `flows/pattern-library.md`.

---

## 1. `q9/team-grid` — Team / people profiles

**Why:** Highest-frequency missing layout (HR Plus, CSB, DFK, IGA). Drives About and Contact pages.

**Docblock:**
```
Title: Team Grid
Slug: q9/team-grid
Categories: q9
Keywords: team, people, staff, profiles, about, bios
Description: Responsive grid of team members — photo, name, role and short bio. 2/3/4-up.
Viewport Width: 1280
```

**Structure:** full-width constrained section (white bg) → centred header (label "Our team" + H2) → `wp:columns` of 3 (repeatable to 4). Each column:
- `wp:image` — square, `aspectRatio:"1/1"`, `scale:"cover"`, `border.radius: var:custom|radius|card`, `alt` = member name. (A circular variant via `border.radius:"50%"` is acceptable as an `is-style-` note but default to card radius.)
- `wp:heading {level:3, fontSize:"xl", fontWeight:600}` — name
- `wp:paragraph {fontSize:"small", color:primary, fontWeight:600, textTransform:uppercase, letterSpacing:0.04em}` — role
- `wp:paragraph {color:neutral-dark}` — short bio (2–4 sentences)

**Mobile:** columns stack to 1-up; image stays square; bio full width.

---

## 2. `q9/key-contact` — Key contact(s)

**Why:** Lighter sibling of team-grid for service-detail and contact pages (DFK key contact, CSB "Your Key Contacts"). 1–3 people with contact details rather than bios.

**Docblock:**
```
Title: Key Contact
Slug: q9/key-contact
Categories: q9
Keywords: contact, person, key contact, advisor, get in touch
Description: One to three key contacts with photo, name, title and email/phone. For service and contact pages.
Viewport Width: 1280
```

**Structure:** full-width constrained section (`neutral-light` bg) → optional label + H3 "Your key contact" → `wp:columns` (1–3). Each: small rounded `wp:image` (96px, `aspectRatio 1/1`, `border.radius var:custom|radius|card`) + name (`h3`, `medium`, `600`) + title (`small`, `neutral-dark`) + email/phone paragraphs as `mailto:`/`tel:` links. Card style optional (`background:background`, `radius:card`, `padding:medium`).

**Mobile:** stack 1-up, left-aligned.

---

## 3. `q9/logo-wall` — Client / membership logo strip

**Why:** Universal trust device (HR Plus "Trusted by leading brands", CSB memberships). Tiny, high-leverage.

**Docblock:**
```
Title: Logo Wall
Slug: q9/logo-wall
Categories: q9
Keywords: logos, clients, trusted by, brands, memberships, social proof
Description: A heading and a responsive row of client or membership logos.
Viewport Width: 1280
```

**Structure:** full-width constrained section (white or `neutral-light`) with `large` top/bottom padding (tighter than xlarge) → centred `wp:paragraph` label "Trusted by leading brands" (`small`, `neutral-dark`, uppercase, centred) → `wp:group {layout:{type:"flex", flexWrap:"wrap", justifyContent:"center"}, blockGap:large}` containing 5–8 `wp:image` blocks, each height-constrained (e.g. `height:48`, `width:auto`), `alt` = brand name.
- Optional `is-style-grayscale` note: a CSS class the theme can style to render logos greyscale with colour-on-hover. If added, document the class in `style.css`; otherwise ship plain.

**Mobile:** flex-wrap naturally centres and wraps logos to multiple rows; ensure `blockGap` reduces acceptably (use `large`).

---

## 4. `q9/hero-split` — Hero, text + image side-by-side

**Why:** The most common hero style across the set (Quad, HR Plus, CSB). Fills the gap between `hero-image-bg` (full-bleed cover) and `hero-text-only` (centred).

**Docblock:**
```
Title: Hero — Split (Text + Image)
Slug: q9/hero-split
Categories: q9
Keywords: hero, banner, split, two column, image, above-fold
Description: Above-fold hero with copy and CTAs on the left and an image on the right.
Viewport Width: 1280
```

**Structure:** full-width constrained section (white bg), `xlarge` padding → `wp:columns {verticalAlignment:"center"}`:
- Left column (`width:"55%"`): eyebrow label (`small`, `primary`, uppercase) optional → `wp:heading {level:1, fontSize:"4xl", fontWeight:800, lineHeight:1.1}` → `wp:paragraph {fontSize:"xl", color:neutral-dark}` → `wp:buttons` (primary fill + outline, `radius var:custom|radius|button`, padding `0.875rem 2rem` as in existing heroes).
- Right column (`width:"45%"`): `wp:image {aspectRatio:"4/3", scale:"cover", border.radius var:custom|radius|card}`, `alt` descriptive.

**Mobile:** columns stack — **image must appear BELOW the copy on mobile** (text-first for LCP and reading order). Default WP column order already does text-then-image since left column is first; keep it that way (do not reverse). H1 remains `4xl` preset (fluid via theme).

**Designer note:** add `q9/hero-split` to `flows/designer/hero-patterns.md` as a third hero option (the Website Builder side will do this).

---

## 5. `q9/process-steps` — Numbered "how it works"

**Why:** Standard services-page reassurance (HR Plus "Hiring made easy", CSB benefits). We already faked it on HRmalta's Services page using `features-row` with manual number circles — promote it to a first-class pattern.

**Docblock:**
```
Title: Process Steps
Slug: q9/process-steps
Categories: q9
Keywords: process, steps, how it works, numbered, onboarding
Description: Three or four numbered steps describing a process, each with a number badge, heading and short text.
Viewport Width: 1280
```

**Structure:** full-width constrained section (white bg) → centred header (label "The process" + H2 + intro) → `wp:columns` of 3 (extendable to 4). Each column:
- Number badge: `wp:group {layout:{type:"constrained", contentSize:"48px"}, color.background:primary, border.radius:"50%", padding:0.75rem}` containing a centred `wp:paragraph {color:#ffffff, fontWeight:800}` with the digit. (This is the exact construct already proven on HRmalta — reuse it verbatim.)
- `wp:heading {level:3, fontSize:"xl", fontWeight:600}` — step title
- `wp:paragraph {color:neutral-dark}` — step description

**Mobile:** columns stack 1-up; number badge stays left-aligned/top. Optional connector line between steps must be hidden on mobile (document the CSS if added; default ship without).

---

## 6. `q9/post-grid` — Blog / news / insights cards

**Why:** Content-marketing block (Quad blog, HR Plus insights/stories, IGA news, CSB latest news). `gallery` is images-only. Supports QuadNine's own 2–4 articles/month plan and client blogs.

**Docblock:**
```
Title: Post Grid
Slug: q9/post-grid
Categories: q9
Keywords: blog, news, insights, posts, cards, articles
Description: Three-up cards for featured posts — image, category, date, title, excerpt and read-more link.
Viewport Width: 1280
```

**Structure (static-content version — build this now):** full-width constrained section (white or `neutral-light`) → centred header (label "Insights" + H2 + "View all" text link) → `wp:columns` of 3. Each card = `wp:group {color.background:background, border.radius:card, padding:0 (image flush top), layout:flex vertical}`:
- `wp:image {aspectRatio:"16/9", scale:"cover"}` (flush to card top corners)
- inner padded group (`padding:medium`): category/date line (`wp:paragraph {small, primary, fontWeight:600}`), `wp:heading {level:3, xl, 600}` title, `wp:paragraph {neutral-dark}` excerpt, `wp:paragraph` read-more link.

**Also note (do NOT build yet, flag for later):** a dynamic variant using `wp:query` / Query Loop bound to the latest posts, for the blog index template. Out of scope for this brief — static featured-posts version only.

**Mobile:** cards stack 1-up; image keeps 16/9.

---

## 7. `q9/media-text-row` — Alternating media + text row

**Why:** The default in-depth services/industries layout (IGA every service, Quad services, HR Plus industries, CSB). `intro-about` is a single block; this is a repeatable, image-side-alternating row with optional bullet list + per-row CTA.

**Docblock:**
```
Title: Media + Text Row
Slug: q9/media-text-row
Categories: q9
Keywords: media, image, text, two column, feature, service, alternating, zigzag
Description: A two-column row with image on one side and heading, text, optional list and CTA on the other. Reversible.
Viewport Width: 1280
```

**Structure:** full-width constrained section (white bg by default), `xlarge` padding → `wp:columns {verticalAlignment:"center"}`:
- Image column (`width:"45%"`): `wp:image {aspectRatio:"4/3", scale:"cover", border.radius:card}`.
- Text column (`width:"55%"`): optional eyebrow label (`small`, `primary`, uppercase) → `wp:heading {level:2, fontWeight:700, lineHeight:1.2}` → `wp:paragraph {color:neutral-dark, fontSize:large}` → optional `wp:list` (bullet points) → optional `wp:buttons` (outline or fill).

**Reversed variant:** provide a second registration OR an `is-style-reversed` block style that swaps column order (image right). Simplest: ship the pattern with image LEFT, and add a registered block style `is-style-reversed` in `style.css`/`functions.php` that applies `flex-direction: row-reverse` to the columns at desktop. Document whichever approach you choose.

**Mobile:** columns stack; **image always renders above text on mobile regardless of desktop side** (keep image column first in source; for the reversed desktop style use CSS order, not source order, so mobile stays image-top-text-below consistently). Confirm this explicitly.

---

## 8. `q9/icon-grid` — Multi-item icon / logo grid

**Why:** `services-grid-3` caps at 3. Competitors use compact 4–8 (even 16) item grids for industries/sectors/jurisdictions/certifications (IGA, HR Plus industry pills, People & Co).

**Docblock:**
```
Title: Icon Grid
Slug: q9/icon-grid
Categories: q9
Keywords: icons, grid, industries, sectors, logos, links, compact
Description: A compact responsive grid of icon-or-image tiles with short labels and optional links. 4 to 8 items.
Viewport Width: 1280
```

**Structure:** full-width constrained section (`neutral-light` bg) → centred header (label + H2) → a grid. Prefer `wp:columns` nested in two rows of 4, OR a single `wp:group {layout:{type:"grid", columnCount:4}}` (Grid layout variation, supported in current WP) for cleaner wrapping. Each tile: `wp:group {layout:flex vertical, alignItems:center, padding:medium, background:background, radius:card}` containing a small `wp:image` (48–64px icon, `alt`) + `wp:paragraph {medium, fontWeight:600, textAlign:center}` label. Tiles may be wrapped in links.

**Mobile:** grid drops to 2-up (or 1-up at very small widths). If using `wp:group` Grid layout, set `minimumColumnWidth` (e.g. `12rem`) so it reflows responsively without breakpoints. Touch targets ≥44px.

---

## After build (theme side)

1. Confirm all 7 (8 files) appear in the inserter under "QuadNine" and render without console errors.
2. Mobile stack check at ≤768px for each.
3. Bump theme version and note the additions in the theme changelog/readme.
4. Reply via a `_linked-instructions` file back to the Website Builder project (or note here) so the Website Builder side adds the new slugs to `flows/pattern-library.md` and `flows/designer/hero-patterns.md` (`hero-split`), and updates the Executor whitelist count.

---

## Outcome — 2026-05-30

All 8 PHP pattern files created. ✅

| Pattern | File | Status |
|---|---|---|
| `q9/team-grid` | `patterns/team-grid.php` | ✅ Done |
| `q9/key-contact` | `patterns/key-contact.php` | ✅ Done |
| `q9/logo-wall` | `patterns/logo-wall.php` | ✅ Done |
| `q9/hero-split` | `patterns/hero-split.php` | ✅ Done |
| `q9/process-steps` | `patterns/process-steps.php` | ✅ Done |
| `q9/post-grid` | `patterns/post-grid.php` | ✅ Done |
| `q9/media-text-row` | `patterns/media-text-row.php` | ✅ Done |
| `q9/icon-grid` | `patterns/icon-grid.php` | ✅ Done |

**Additional changes:**
- `functions.php` — added `register_block_style('core/columns', 'reversed')` for `media-text-row` image-right variant
- `style.css` — added `.wp-block-columns.is-style-reversed { flex-direction: row-reverse }` scoped to `@media (min-width: 782px)` so mobile is unaffected
- `style.css` — version bumped 1.1.0 → 1.2.0

**Global rules applied to all patterns:**
- Tokens only: `var:preset|color|*`, `var:preset|font-size|*`, `var:preset|spacing|*`, `var:custom|radius|*`. Only `#ffffff` as literal hex (on dark backgrounds).
- Section shell: `align:full` + `layout:constrained` with `xlarge` padding (or `large` for logo-wall).
- Mobile-first: `wp:columns` stacks at ≤781px by default. Images use `aspectRatio` + `scale:cover`. Touch targets ≥44px.
- Placeholder content: all copy and `src=""` images are generic — no HRmalta content baked in.
- Heading hierarchy: one `h2` per section, `h3` for items (except `key-contact` which uses `h3` as section-level heading because it is designed to appear inside a page that already has a section `h2`).
- `post-grid` note: static featured-posts version only. Dynamic `wp:query` variant flagged as future enhancement (not built).
- `media-text-row` reversed variant: image is LEFT in source (so mobile always renders image-top). Apply "Reversed (image right)" block style on the inner `wp:columns` block in the Site Editor to flip at desktop.

**Website Builder actions needed:**
- Add all 8 slugs to `flows/pattern-library.md` whitelist
- Add `q9/hero-split` to `flows/designer/hero-patterns.md` as a third hero option
- Update Executor whitelist count (was 15, now 23)

Committed: see git log — commit pushed to `quadninemt/q9-base` main on 2026-05-30.
