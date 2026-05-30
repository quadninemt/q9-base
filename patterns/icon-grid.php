<?php
/**
 * Title: Icon Grid
 * Slug: q9/icon-grid
 * Categories: q9
 * Keywords: icons, grid, industries, sectors, logos, links, compact
 * Description: A compact responsive grid of icon-or-image tiles with short labels and optional links. 4 to 8 items.
 * Viewport Width: 1280
 */
?>

<!-- Two rows of 4 columns. Mobile: WP columns stack 1-up per row by default. Touch targets ≥44px per tile (min-height set on inner group). -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xlarge","bottom":"var:preset|spacing|xlarge"}},"color":{"background":"var:preset|color|neutral-light"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="background-color:var(--wp--preset--color--neutral-light);padding-top:var(--wp--preset--spacing--xlarge);padding-bottom:var(--wp--preset--spacing--xlarge)">

	<!-- wp:group {"layout":{"type":"constrained","contentSize":"560px"},"style":{"spacing":{"blockGap":"var:preset|spacing|small","margin":{"bottom":"var:preset|spacing|large"}}}} -->
	<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--large)">
		<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|small","letterSpacing":"0.08em","textTransform":"uppercase"},"color":{"text":"var:preset|color|primary"}}} -->
		<p class="has-text-align-center" style="color:var(--wp--preset--color--primary);font-size:var(--wp--preset--font-size--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase">Industries</p>
		<!-- /wp:paragraph -->
		<!-- wp:heading {"level":2,"textAlign":"center","style":{"typography":{"fontWeight":"700"}}} -->
		<h2 class="wp-block-heading has-text-align-center" style="font-weight:700">Sectors we serve</h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->

	<!-- Row 1 -->
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|medium","left":"var:preset|spacing|medium"}}}} -->
	<div class="wp-block-columns">

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"color":{"background":"var:preset|color|background"},"border":{"radius":"var:custom|radius|card"},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
			<div class="wp-block-group" style="background-color:var(--wp--preset--color--background);border-radius:var(--wp--custom--radius--card);padding:var(--wp--preset--spacing--medium);min-height:44px;align-items:center">
				<!-- wp:image {"width":48,"height":48,"sizeSlug":"thumbnail"} -->
				<figure class="wp-block-image size-thumbnail is-resized"><img src="" alt="Finance sector" width="48" height="48"/></figure>
				<!-- /wp:image -->
				<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|medium"}}} -->
				<p class="has-text-align-center" style="font-size:var(--wp--preset--font-size--medium);font-weight:600">Finance</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"color":{"background":"var:preset|color|background"},"border":{"radius":"var:custom|radius|card"},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
			<div class="wp-block-group" style="background-color:var(--wp--preset--color--background);border-radius:var(--wp--custom--radius--card);padding:var(--wp--preset--spacing--medium);min-height:44px;align-items:center">
				<!-- wp:image {"width":48,"height":48,"sizeSlug":"thumbnail"} -->
				<figure class="wp-block-image size-thumbnail is-resized"><img src="" alt="Technology sector" width="48" height="48"/></figure>
				<!-- /wp:image -->
				<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|medium"}}} -->
				<p class="has-text-align-center" style="font-size:var(--wp--preset--font-size--medium);font-weight:600">Technology</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"color":{"background":"var:preset|color|background"},"border":{"radius":"var:custom|radius|card"},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
			<div class="wp-block-group" style="background-color:var(--wp--preset--color--background);border-radius:var(--wp--custom--radius--card);padding:var(--wp--preset--spacing--medium);min-height:44px;align-items:center">
				<!-- wp:image {"width":48,"height":48,"sizeSlug":"thumbnail"} -->
				<figure class="wp-block-image size-thumbnail is-resized"><img src="" alt="Healthcare sector" width="48" height="48"/></figure>
				<!-- /wp:image -->
				<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|medium"}}} -->
				<p class="has-text-align-center" style="font-size:var(--wp--preset--font-size--medium);font-weight:600">Healthcare</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"color":{"background":"var:preset|color|background"},"border":{"radius":"var:custom|radius|card"},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
			<div class="wp-block-group" style="background-color:var(--wp--preset--color--background);border-radius:var(--wp--custom--radius--card);padding:var(--wp--preset--spacing--medium);min-height:44px;align-items:center">
				<!-- wp:image {"width":48,"height":48,"sizeSlug":"thumbnail"} -->
				<figure class="wp-block-image size-thumbnail is-resized"><img src="" alt="Legal sector" width="48" height="48"/></figure>
				<!-- /wp:image -->
				<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|medium"}}} -->
				<p class="has-text-align-center" style="font-size:var(--wp--preset--font-size--medium);font-weight:600">Legal</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

	<!-- Row 2 -->
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|medium","left":"var:preset|spacing|medium"}}}} -->
	<div class="wp-block-columns">

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"color":{"background":"var:preset|color|background"},"border":{"radius":"var:custom|radius|card"},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
			<div class="wp-block-group" style="background-color:var(--wp--preset--color--background);border-radius:var(--wp--custom--radius--card);padding:var(--wp--preset--spacing--medium);min-height:44px;align-items:center">
				<!-- wp:image {"width":48,"height":48,"sizeSlug":"thumbnail"} -->
				<figure class="wp-block-image size-thumbnail is-resized"><img src="" alt="Hospitality sector" width="48" height="48"/></figure>
				<!-- /wp:image -->
				<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|medium"}}} -->
				<p class="has-text-align-center" style="font-size:var(--wp--preset--font-size--medium);font-weight:600">Hospitality</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"color":{"background":"var:preset|color|background"},"border":{"radius":"var:custom|radius|card"},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
			<div class="wp-block-group" style="background-color:var(--wp--preset--color--background);border-radius:var(--wp--custom--radius--card);padding:var(--wp--preset--spacing--medium);min-height:44px;align-items:center">
				<!-- wp:image {"width":48,"height":48,"sizeSlug":"thumbnail"} -->
				<figure class="wp-block-image size-thumbnail is-resized"><img src="" alt="Retail sector" width="48" height="48"/></figure>
				<!-- /wp:image -->
				<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|medium"}}} -->
				<p class="has-text-align-center" style="font-size:var(--wp--preset--font-size--medium);font-weight:600">Retail</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"color":{"background":"var:preset|color|background"},"border":{"radius":"var:custom|radius|card"},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
			<div class="wp-block-group" style="background-color:var(--wp--preset--color--background);border-radius:var(--wp--custom--radius--card);padding:var(--wp--preset--spacing--medium);min-height:44px;align-items:center">
				<!-- wp:image {"width":48,"height":48,"sizeSlug":"thumbnail"} -->
				<figure class="wp-block-image size-thumbnail is-resized"><img src="" alt="Manufacturing sector" width="48" height="48"/></figure>
				<!-- /wp:image -->
				<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|medium"}}} -->
				<p class="has-text-align-center" style="font-size:var(--wp--preset--font-size--medium);font-weight:600">Manufacturing</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"color":{"background":"var:preset|color|background"},"border":{"radius":"var:custom|radius|card"},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
			<div class="wp-block-group" style="background-color:var(--wp--preset--color--background);border-radius:var(--wp--custom--radius--card);padding:var(--wp--preset--spacing--medium);min-height:44px;align-items:center">
				<!-- wp:image {"width":48,"height":48,"sizeSlug":"thumbnail"} -->
				<figure class="wp-block-image size-thumbnail is-resized"><img src="" alt="Education sector" width="48" height="48"/></figure>
				<!-- /wp:image -->
				<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|medium"}}} -->
				<p class="has-text-align-center" style="font-size:var(--wp--preset--font-size--medium);font-weight:600">Education</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
