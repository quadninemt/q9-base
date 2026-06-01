# q9-wp-theme

This project contains the standalone QuadNine block theme (FSE) — **q9-gregale** — deployed to every QuadNine-managed client site.

## Repository
https://github.com/quadninemt/q9-base

---

## Completing tasks from linked instructions

Whenever you complete tasks sourced from a `_linked-instructions/` file, update that file with:
1. The completion status of each item (✅ Done / ⚠️ Partial / ❌ Skipped)
2. A brief note on what was done and any decisions made
3. The commit hash and/or date if code was changed

Fill in any `## Outcome` or similar section the file already has. If there is no such section, append one.

---

## Cross-project instructions — read first

This project is part of the QuadNine Website Builder system. The Website Builder project may drop instruction or clarification files into this project's `_linked-instructions/` folder when decisions change that affect the theme.

**At the start of every session:** check whether `_linked-instructions/` exists in this directory. If it does, read every `.md` file in it before doing anything else. Treat those files as amendments to this CLAUDE.md — they take precedence where they conflict with anything here.

**After reading linked instructions, verify the code matches them.** Check these specific things and flag any mismatch to the user before proceeding with other work:

| What to check | Where to look | What to verify |
|---|---|---|
| Repo URL | `style.css` Theme URI, `CLAUDE.md`, `BRIEF.md`, `README.md`, `_linked-instructions/*.md` | All must match the current GitHub repo URL |
| Token merge — `wp_head` injection | `functions.php` | Hook exists at priority 99; injects `--wp--preset--color--*`, `--wp--preset--font-family--*`, `--wp--preset--spacing--*`, `--wp--custom--radius--*` |
| Token merge — `wp_theme_json_data_theme` | `functions.php` | Filter exists and merges colors, typography, spacing, radius, shadows |
| Cache invalidation | `functions.php` | `quadnine_after_apply_client_tokens` hook calls `clean_cached_data()`, `wp_cache_flush_group('theme_json')`, `wp_cache_flush()` |
| Google Fonts | `functions.php` | Reads `typography.google-fonts-url` from token file; falls back to Inter |
| Token schema surface | `theme.json` | Palette has all 7 colors; spacing has 4 sizes; custom radius has button/card/input; shadows has card/button |
| Token schema doc | `_linked-instructions/brand-guide-tokens-schema.md` | Schema doc matches what `functions.php` actually reads and maps |
| Pattern count | `patterns/` | At least 23 patterns covering hero, CTA, testimonial, pricing, FAQ, contact, gallery, team, process, post grid, media-text, icon grid, logo wall |
| Directory slug | Any slug reference in code or docs | Must always be `q9-base`, never `q9-gregale` or anything else |

If any check fails, stop and report the discrepancy with file:line evidence before doing anything else.

The parent project lives at: `C:\dev\Website Builder` (previously `C:\Users\kevin\OneDrive - QuadNine Ltd\Claude\Website Builder`)

---

## Mobile-first requirements

All patterns, templates, and template parts in this theme must be designed and verified mobile-first.

**Breakpoints to design for:** 320px, 768px, 1024px, 1440px.

**Mobile nav requirements:**
- The navigation block must collapse at ≤768px (hamburger / overlay / slide-in pattern)
- `overlayMenu:"mobile"` must be set on the `wp:navigation` block in `parts/header.html`
- Hamburger touch target must be ≥44×44px
- Overlay must trap focus and be dismissible via keyboard (Escape key)
- Nav links must be ≥44px tall on touch devices

**Patterns:**
- All block patterns must be tested at 320px minimum width before committing
- Hero sections: heading font size must scale down gracefully (use `clamp()` or fluid type scale where needed)
- Grid/flex layouts must stack vertically at ≤480px
- CTA buttons must be full-width on mobile

**Do not:**
- Set fixed pixel widths on containers (use `max-width` + `width: 100%`)
- Use absolute positioning that breaks on small viewports
- Omit `align="full"` on hero sections (breaks full-bleed at all widths)

**Verify on the live test site** at mobile viewport before committing any template or pattern change.

---

## Critical constraints — read before touching anything

**Theme directory slug must be `q9-base`** — not q9-gregale, not anything else. The `apply-client-tokens` ability in q9-abilities-plugin has this hardcoded. If the theme installs under a different directory name, the ability writes `brand-guide-tokens.json` to the wrong location and client token application fails. Every reference to the theme slug in code, readme, and configuration must use `q9-base`.

**`brand-guide-tokens.json` is read from `{theme-dir}/brand-guide-tokens.json`** — the plugin writes to this exact path. The theme must pick it up from there and merge it into the active `theme.json` token values.

**Hook into `quadnine_after_apply_client_tokens`** — if the theme caches anything derived from `theme.json` (compiled CSS, global styles, transients), add a hook here to invalidate those caches after a token write.

Full integration spec: `BRIEF.md` → Integration with q9-abilities-plugin

---

## Role in the Website Builder workflow

- One theme, shared across all client sites — no per-client child themes (Website Builder Decision 5)
- `theme.json` is the source of truth for design tokens; per-client `brand-guide-tokens.json` is merged in at deploy time
- Block patterns under `/patterns/` implement the strict whitelist (Decision 4) — the Executor selects from these, never generates fresh markup
- Block templates and template parts under `/templates/` and `/parts/` carry the layout
- Theme version bumps propagate changes to all client sites

Full architectural context: `C:\dev\Website Builder\CLAUDE.md`

---

## Building a release zip (for WordPress admin upload)

When creating a GitHub release or a zip for manual WordPress upload, follow this procedure exactly.

### Rules

- **Filename format:** `q9-base-{version}.zip` — e.g. `q9-base-1.2.0.zip`. The version is read from `style.css` automatically (see command below). WordPress uses the folder name inside the zip (`q9-base/`), not the zip filename, but the versioned filename makes releases traceable.
- **Zip root must be the theme folder:** the zip must contain `q9-base/` as its top-level directory. Installing a zip whose root is the theme files directly (not inside a named folder) will fail or install under the wrong slug.
- **Use Bash, not PowerShell** — `zip` is available in the Git Bash environment. Never use `Compress-Archive` or PowerShell for this.
- **Save the zip one level up** from the project directory — zipping from inside the project would include the zip itself on the next run.

### Command

Run from inside the `q9-base/` project directory using Bash. The Git Bash environment on this machine does not have `zip` installed — use Python's `zipfile` module instead (called from Bash, not PowerShell):

```bash
python -c "
import zipfile, os
version = None
with open('style.css', 'r', encoding='utf-8') as f:
    for line in f:
        if line.startswith('Version:'):
            version = line.split(':', 1)[1].strip()
            break
zip_name = os.path.join('..', 'q9-base-' + version + '.zip')
exclude_prefixes = ['.git/', '_linked-instructions/', 'docs/', 'theme_fix.md', 'BRIEF.md', 'CLAUDE.md', '.gitignore', 'brand-guide-tokens.json']
with zipfile.ZipFile(zip_name, 'w', zipfile.ZIP_DEFLATED) as zf:
    for root, dirs, files in os.walk('.'):
        dirs[:] = [d for d in dirs if d != '.git']
        for fname in files:
            filepath = os.path.join(root, fname)
            arcpath = filepath.replace(chr(92), '/').lstrip('./')
            if any(arcpath == ep or arcpath.startswith(ep) for ep in exclude_prefixes):
                continue
            zf.write(filepath, 'q9-base/' + arcpath)
size = os.path.getsize(zip_name)
print('Created: q9-base-' + version + '.zip (' + str(size//1024) + ' KB)')
"
```

This produces `q9-base-{version}.zip` in the parent directory (e.g. `C:\dev\q9-base-1.2.4.zip`), ready to upload via **WP Admin → Appearance → Themes → Add New → Upload Theme**.

### What is excluded from the zip

| Excluded | Reason |
|---|---|
| `.git/` | Git history — not needed in WP, doubles the file size |
| `_linked-instructions/` | Internal project management files |
| `docs/` | Developer reference docs — not needed at runtime |
| `theme_fix.md`, `BRIEF.md`, `CLAUDE.md` | Development notes — not needed in WP |
| `brand-guide-tokens.json` | Per-client token file — must NOT be in the zip so WordPress auto-updates don't overwrite client tokens |

Everything else (`style.css`, `functions.php`, `theme.json`, `patterns/`, `templates/`, `parts/`, `editor-style.css`) is included.

### Also create a GitHub release

After building the zip, create a GitHub release so there is a permanent versioned download:

```bash
gh release create v{VERSION} \
  --title "v{VERSION} — {short description}" \
  --notes "{changelog}" \
  "../q9-base-${VERSION}.zip"
```

---

## Test WordPress site — live interaction

During development and testing, Claude can interact directly with a live WordPress test site via the **q9-abilities-plugin** (wp-abilities). This means:

- Files (`theme.json`, templates, parts, patterns, `style.css`) can be written to the WordPress installation directly using `quadnine/write-theme-file`
- The theme can be activated using `quadnine/activate-theme`
- Per-client tokens can be applied using `quadnine/apply-client-tokens`
- Acceptance criteria can be verified against the real site (rendered templates, pattern inserter, Lighthouse, axe-core)

Use the plugin for all verification steps — do not treat a file as complete until it has been tested on the live site.

Plugin project: `C:\dev\q9-abilities-plugin` (previously `C:\Users\kevin\OneDrive - QuadNine Ltd\Claude\q9-abilities-plugin`)
