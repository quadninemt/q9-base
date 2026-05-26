<?php
/**
 * Title: Services Grid (3 columns)
 * Slug: q9/services-grid-3
 * Categories: q9
 * Keywords: services, grid, three column, icon
 * Description: Three-column services grid, each column with icon, heading and short description.
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xlarge","bottom":"var:preset|spacing|xlarge"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xlarge);padding-bottom:var(--wp--preset--spacing--xlarge)">

	<!-- wp:group {"layout":{"type":"constrained","contentSize":"560px"},"style":{"spacing":{"blockGap":"var:preset|spacing|small","margin":{"bottom":"var:preset|spacing|large"}}}} -->
	<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--large)">
		<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|small","letterSpacing":"0.08em","textTransform":"uppercase"},"color":{"text":"var:preset|color|primary"}}} -->
		<p class="has-text-align-center" style="color:var(--wp--preset--color--primary);font-size:var(--wp--preset--font-size--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase">What we offer</p>
		<!-- /wp:paragraph -->
		<!-- wp:heading {"level":2,"textAlign":"center","style":{"typography":{"fontWeight":"700"}}} -->
		<h2 class="wp-block-heading has-text-align-center" style="font-weight:700">Our services</h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->

	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
	<div class="wp-block-columns">

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|small"},"border":{"radius":"var:custom|radius|card"},"color":{"background":"var:preset|color|neutral-light"}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group" style="background-color:var(--wp--preset--color--neutral-light);border-radius:var(--wp--custom--radius--card);padding:var(--wp--preset--spacing--medium)">
				<!-- wp:image {"width":48,"height":48,"sizeSlug":"thumbnail","style":{"color":{"duotone":"unset"}}} -->
				<figure class="wp-block-image size-thumbnail is-resized"><img src="" alt="" width="48" height="48"/></figure>
				<!-- /wp:image -->
				<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|xl"}}} -->
				<h3 class="wp-block-heading" style="font-size:var(--wp--preset--font-size--xl);font-weight:600">Service one</h3>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"}}} -->
				<p style="color:var(--wp--preset--color--neutral-dark)">A short description of this service and the value it delivers to your clients.</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|small"},"border":{"radius":"var:custom|radius|card"},"color":{"background":"var:preset|color|neutral-light"}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group" style="background-color:var(--wp--preset--color--neutral-light);border-radius:var(--wp--custom--radius--card);padding:var(--wp--preset--spacing--medium)">
				<!-- wp:image {"width":48,"height":48,"sizeSlug":"thumbnail"} -->
				<figure class="wp-block-image size-thumbnail is-resized"><img src="" alt="" width="48" height="48"/></figure>
				<!-- /wp:image -->
				<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|xl"}}} -->
				<h3 class="wp-block-heading" style="font-size:var(--wp--preset--font-size--xl);font-weight:600">Service two</h3>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"}}} -->
				<p style="color:var(--wp--preset--color--neutral-dark)">A short description of this service and the value it delivers to your clients.</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|small"},"border":{"radius":"var:custom|radius|card"},"color":{"background":"var:preset|color|neutral-light"}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group" style="background-color:var(--wp--preset--color--neutral-light);border-radius:var(--wp--custom--radius--card);padding:var(--wp--preset--spacing--medium)">
				<!-- wp:image {"width":48,"height":48,"sizeSlug":"thumbnail"} -->
				<figure class="wp-block-image size-thumbnail is-resized"><img src="" alt="" width="48" height="48"/></figure>
				<!-- /wp:image -->
				<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|xl"}}} -->
				<h3 class="wp-block-heading" style="font-size:var(--wp--preset--font-size--xl);font-weight:600">Service three</h3>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"}}} -->
				<p style="color:var(--wp--preset--color--neutral-dark)">A short description of this service and the value it delivers to your clients.</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
