<?php
/**
 * Title: Image Gallery
 * Slug: q9/gallery
 * Categories: q9
 * Keywords: gallery, images, photos, grid, portfolio
 * Description: Responsive 3-column image gallery grid with optional caption support.
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xlarge","bottom":"var:preset|spacing|xlarge"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xlarge);padding-bottom:var(--wp--preset--spacing--xlarge)">

	<!-- wp:group {"layout":{"type":"constrained","contentSize":"560px"},"style":{"spacing":{"blockGap":"var:preset|spacing|small","margin":{"bottom":"var:preset|spacing|large"}}}} -->
	<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--large)">
		<!-- wp:heading {"level":2,"textAlign":"center","style":{"typography":{"fontWeight":"700"}}} -->
		<h2 class="wp-block-heading has-text-align-center" style="font-weight:700">Our work</h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"align":"center","style":{"color":{"text":"var:preset|color|neutral-dark"}}} -->
		<p class="has-text-align-center" style="color:var(--wp--preset--color--neutral-dark)">A selection of recent projects we're proud of.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:gallery {"columns":3,"imageCrop":true,"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|small","left":"var:preset|spacing|small"}}},"layout":{"type":"default"}} -->
	<figure class="wp-block-gallery has-nested-images columns-3 is-cropped">

		<!-- wp:image {"sizeSlug":"large","aspectRatio":"4/3","scale":"cover","style":{"border":{"radius":"var:custom|radius|card"}}} -->
		<figure class="wp-block-image size-large" style="border-radius:var(--wp--custom--radius--card)"><img src="" alt="Gallery image 1" style="aspect-ratio:4/3;object-fit:cover"/><figcaption class="wp-element-caption">Project title</figcaption></figure>
		<!-- /wp:image -->

		<!-- wp:image {"sizeSlug":"large","aspectRatio":"4/3","scale":"cover","style":{"border":{"radius":"var:custom|radius|card"}}} -->
		<figure class="wp-block-image size-large" style="border-radius:var(--wp--custom--radius--card)"><img src="" alt="Gallery image 2" style="aspect-ratio:4/3;object-fit:cover"/><figcaption class="wp-element-caption">Project title</figcaption></figure>
		<!-- /wp:image -->

		<!-- wp:image {"sizeSlug":"large","aspectRatio":"4/3","scale":"cover","style":{"border":{"radius":"var:custom|radius|card"}}} -->
		<figure class="wp-block-image size-large" style="border-radius:var(--wp--custom--radius--card)"><img src="" alt="Gallery image 3" style="aspect-ratio:4/3;object-fit:cover"/><figcaption class="wp-element-caption">Project title</figcaption></figure>
		<!-- /wp:image -->

		<!-- wp:image {"sizeSlug":"large","aspectRatio":"4/3","scale":"cover","style":{"border":{"radius":"var:custom|radius|card"}}} -->
		<figure class="wp-block-image size-large" style="border-radius:var(--wp--custom--radius--card)"><img src="" alt="Gallery image 4" style="aspect-ratio:4/3;object-fit:cover"/><figcaption class="wp-element-caption">Project title</figcaption></figure>
		<!-- /wp:image -->

		<!-- wp:image {"sizeSlug":"large","aspectRatio":"4/3","scale":"cover","style":{"border":{"radius":"var:custom|radius|card"}}} -->
		<figure class="wp-block-image size-large" style="border-radius:var(--wp--custom--radius--card)"><img src="" alt="Gallery image 5" style="aspect-ratio:4/3;object-fit:cover"/><figcaption class="wp-element-caption">Project title</figcaption></figure>
		<!-- /wp:image -->

		<!-- wp:image {"sizeSlug":"large","aspectRatio":"4/3","scale":"cover","style":{"border":{"radius":"var:custom|radius|card"}}} -->
		<figure class="wp-block-image size-large" style="border-radius:var(--wp--custom--radius--card)"><img src="" alt="Gallery image 6" style="aspect-ratio:4/3;object-fit:cover"/><figcaption class="wp-element-caption">Project title</figcaption></figure>
		<!-- /wp:image -->

	</figure>
	<!-- /wp:gallery -->

</div>
<!-- /wp:group -->
