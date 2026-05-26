<?php
/**
 * Title: Hero — Text Only, Centred
 * Slug: q9/hero-text-only
 * Categories: q9
 * Keywords: hero, banner, text, minimal, above-fold
 * Description: Minimal above-fold hero with centred text and CTA button, no background image.
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xlarge","bottom":"var:preset|spacing|xlarge"}},"color":{"background":"var:preset|color|neutral-light"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="background-color:var(--wp--preset--color--neutral-light);padding-top:var(--wp--preset--spacing--xlarge);padding-bottom:var(--wp--preset--spacing--xlarge)">

	<!-- wp:group {"layout":{"type":"constrained","contentSize":"640px"},"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}}} -->
	<div class="wp-block-group">

		<!-- wp:heading {"level":1,"textAlign":"center","style":{"typography":{"fontWeight":"800","lineHeight":"1.1"},"fontSize":"4xl"}} -->
		<h1 class="wp-block-heading has-text-align-center" style="font-size:var(--wp--preset--font-size--4xl);font-weight:800;line-height:1.1">Your compelling headline goes here</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"var:preset|font-size|xl"},"color":{"text":"var:preset|color|neutral-dark"}}} -->
		<p class="has-text-align-center" style="color:var(--wp--preset--color--neutral-dark);font-size:var(--wp--preset--font-size--xl)">A short supporting sentence that explains your value proposition in one or two lines.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium"}}}} -->
		<div class="wp-block-buttons">
			<!-- wp:button {"style":{"border":{"radius":"var:custom|radius|button"},"spacing":{"padding":{"top":"0.875rem","bottom":"0.875rem","left":"2rem","right":"2rem"}}}} -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Get started</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
