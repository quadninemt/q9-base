# Challenge 1 — Theme Gaps Commission (q9-base)

**Source:** `C:\dev\website-builder\challenge_1\theme-gaps.md`
**Commissioned:** 2026-06-04
**Target theme version:** 1.2.8 → **1.3.0**
**Scope decision:** action everything actionable now; T9 deferred (blocked on plugin GAP P1 + existing post-grid query-loop TODO).

This file is the accepted commission for the gaps identified while replicating quadnine.mt on test.quadnine.mt. It records the decisions taken and tracks completion in the `## Outcome` section.

---

## Decisions taken (confirmed by Kevin, 2026-06-04)

| # | Decision point | Choice |
|---|---|---|
| D1 | T8 colour token surface | **Extend schema** with optional colour-scale slots (backward compatible — the 7 semantic colours are unchanged). Requires a matching plugin change (see Cross-project). |
| D2 | Overall scope | **Everything actionable now** except T9. |
| D3 | T3/T4 fixed counts | **Ship dedicated count variants** — new `q9/pricing-4tier` and `q9/stats-5` patterns alongside the existing 3-tier / 4-stat patterns. No markup surgery by the Executor. |
| D4 | T7 trust strip | **New `q9/trust-strip-text` pattern** (text-only, scales to 12+ names). |
| D5 | T2 header CTA target | CTA href left as `#` placeholder — **the client/Executor sets it**. |
| D6 | Plugin work (Phase 4) | **Plan only this session** — documented below, no plugin code committed. |

---

## Accepted items & approach

| Gap | Severity | Approach | Theme files |
|---|---|---|---|
| T1 | High | New `footer-columns` template part (brand col + 3 nav-menu link columns + social slot). Registered as a selectable `footer` area. | `parts/footer-columns.html`, `theme.json` |
| T2 | High | Add CTA button slot (href `#`) to header; add nav submenu/dropdown styling. Nav `ref` is plugin territory → Cross-project. | `parts/header.html`, `style.css` |
| T3 | Medium | New `q9/pricing-4tier` pattern (highlight on one tier). | `patterns/pricing-4tier.php` |
| T4 | Low | New `q9/stats-5` pattern; correct `stats-row` description. | `patterns/stats-5.php`, `patterns/stats-row.php` |
| T5 | Medium | New `q9/faq-accordion` pattern on `core/details`/`core/summary` (native HTML, zero JS). | `patterns/faq-accordion.php` |
| T6 | Medium | Optional "Learn more →" link paragraph in each `services-grid-3` card (deletable). | `patterns/services-grid-3.php` |
| T7 | Medium | New `q9/trust-strip-text` pattern (text name-chips, 12+). | `patterns/trust-strip-text.php` |
| T8 | Medium | Extend colour token schema with optional scale slots; dynamic colour merge in `functions.php`; extend schema doc. | `theme.json`, `functions.php`, `_linked-instructions/brand-guide-tokens-schema.md` |
| T10 | Low | Register `is-style-flush-top` block style for `core/group` (zeroes top padding for chained sections) + docs. | `functions.php`, `style.css`, `editor-style.css` |
| T9 | Low | **Deferred** — blocked by plugin GAP P1; overlaps existing post-grid query-loop TODO. | — |

---

## T8 — extended colour scale (schema additions)

The 7 existing semantic colours (`primary`, `secondary`, `accent`, `neutral-light`, `neutral-dark`, `background`, `text`) are unchanged and remain the default. The following are **optional** scale slots — present them in `brand-guide-tokens.json` only when a client design uses them:

- Primary scale: `primary-50`, `primary-100`, `primary-200`, `primary-300`, `primary-400`, `primary-500`, `primary-600`, `primary-700`, `primary-800`, `primary-900`
- Accent shades: `accent-dark`, `accent-50`, `accent-200`
- Named neutrals: `snow`, `cloud`, `silver`, `pewter`, `slate`, `ink`
- Status: `success`

`functions.php` merges any of these that appear in the token file; absent keys keep the theme default (or are simply not emitted).

---

## Cross-project commissions (q9-abilities-plugin) — PLAN ONLY this session

These cannot be closed inside the theme. Documented here; **no plugin code committed this session.**

1. **T2 / plugin GAP P3 — navigation `ref`.** The header uses `<!-- wp:navigation /-->` with no `ref`, so without a `wp_navigation` post WordPress falls back to an alphabetical page list. `apply-client-tokens` (or a dedicated nav-seeding ability) must create a `wp_navigation` post and wire its ID into the header's `ref`. Theme provides the CTA + submenu styling; the menu data is the plugin's responsibility.
2. **T8 — colour-key validation.** `apply-client-tokens` validation must accept the new optional colour keys (scale slots above) in addition to the 7 semantic colours, applying the same hex validation rule.

---

## T10 — approved stacking guidance

When chaining repeats of the same full-width section pattern (e.g. three `q9/services-grid-3`
stacked to form a 9-card grid), each instance carries its own `xlarge` top **and** bottom
padding, so the seam between two instances doubles up.

**Approved method:** apply the **"Flush top (no top padding)"** block style (`is-style-flush-top`,
registered for `core/group`) to the **2nd and subsequent** instances in the stack. This zeroes
the top padding on those instances, leaving a single `xlarge` gap at each seam. Do **not** patch
padding inline at build time.

In the editor: select the outer section group → Styles → choose "Flush top". In markup the outer
group gains `"className":"...is-style-flush-top"`.

---

## Outcome

Completed 2026-06-04, shipped in theme **v1.3.0**.

- [x] Phase 0 — schema doc restored, commission doc written
- [x] T1 footer-columns — `parts/footer-columns.html` + scoped CSS + theme.json registration
- [x] T5 faq-accordion — `patterns/faq-accordion.php` (core/details, zero JS)
- [x] T6 service card link — optional "Learn more →" in `services-grid-3`
- [x] T7 trust-strip-text — `patterns/trust-strip-text.php` (12 names)
- [x] T3 pricing-4tier — `patterns/pricing-4tier.php`
- [x] T4 stats-5 + stats-row desc — `patterns/stats-5.php`
- [x] T10 flush-top block style — `is-style-flush-top` on core/group + guidance above
- [x] T2 header CTA + submenu — CTA button (href `#`) + nav dropdown styling
- [x] T8 extended colour scale (theme side) — 22 optional palette slots + dynamic merge in both injection paths + schema doc
- [x] Phase 4 plugin commission documented (this file) — **code not yet written; see Cross-project**
- [x] Phase 5 version bump + zip + release — v1.3.0
- [ ] Phase 6 live verification — **NOT run this session** (q9-abilities-plugin MCP not connected). Verify at 320/768/1024/1440 before relying on visual parity.

**Pattern count:** 23 → 27.
**Still open (deferred):** T9 blog archive (blocked on plugin GAP P1). Plugin commissions T2/P3 nav-ref + T8 colour-key validation (planned, not coded).
