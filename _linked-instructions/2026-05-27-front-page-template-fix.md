# Fix: front-page.html must use wp:post-content, not a hardcoded pattern

**Date:** 2026-05-27  
**Source:** HRmalta dry run (Website Builder)  
**Priority:** High — commit before next client build

## Problem

During the HRmalta dry run, `templates/front-page.html` contained:

```html
<!-- wp:pattern {"slug":"q9/hero-image-bg"} /-->
```

This caused the front page to render the generic hero pattern rather than the page's saved block content. The home page H1 showed the pattern placeholder text ("Your compelling headline goes here") instead of the client's content, even though the correct content was saved in the database.

## Fix Applied (live on test.quadnine.mt)

`templates/front-page.html` was updated to:

```html
<!-- wp:template-part {"slug":"header","tagName":"header","className":"site-header"} /-->

<!-- wp:group {"tagName":"main","layout":{"type":"default"}} -->
<main class="wp-block-group">
	<!-- wp:post-content {"layout":{"type":"default"}} /-->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer","className":"site-footer"} /-->
```

## Action Required

**Commit this file to the q9-base GitHub repo** (`https://github.com/quadninemt/q9-base`) so the fix persists across theme reinstalls and future deployments.

The pattern reference (`wp:pattern`) is correct to use as a **starting point** when a user first edits the front page in the WordPress block editor — it inserts the hero pattern automatically. But the template itself must use `wp:post-content` so that saved page content is rendered, not a frozen pattern copy.

If you want the pattern to auto-insert on first edit, that's handled by `post_content` defaults at page creation time (which the `quadnine-create-page` ability already does), not by the template.
