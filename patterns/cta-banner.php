<?php
/**
 * Title: CTA Banner
 * Slug: q9/cta-banner
 * Categories: q9
 * Keywords: cta, call to action, banner, full width, conversion
 * Description: Full-width call-to-action banner with heading, supporting text and a prominent button.
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xlarge","bottom":"var:preset|spacing|xlarge"}},"color":{"background":"var:preset|color|primary"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="background-color:var(--wp--preset--color--primary);padding-top:var(--wp--preset--spacing--xlarge);padding-bottom:var(--wp--preset--spacing--xlarge)">

	<!-- wp:group {"layout":{"type":"constrained","contentSize":"640px"},"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}}} -->
	<div class="wp-block-group">

		<!-- wp:heading {"level":2,"textAlign":"center","style":{"typography":{"fontWeight":"700","lineHeight":"1.2"},"color":{"text":"#ffffff"}}} -->
		<h2 class="wp-block-heading has-text-align-center" style="color:#ffffff;font-weight:700;line-height:1.2">Ready to get started?</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","style":{"color":{"text":"rgba(255,255,255,0.85)"},"typography":{"fontSize":"var:preset|font-size|large"}}} -->
		<p class="has-text-align-center" style="color:rgba(255,255,255,0.85);font-size:var(--wp--preset--font-size--large)">Join hundreds of businesses that trust us to help them grow. Get in touch today and let's talk.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium"}}}} -->
		<div class="wp-block-buttons">
			<!-- wp:button {"style":{"border":{"radius":"var:custom|radius|button"},"color":{"background":"#ffffff","text":"var:preset|color|primary"},"spacing":{"padding":{"top":"0.875rem","bottom":"0.875rem","left":"2rem","right":"2rem"}}}} -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#" style="background-color:#ffffff;color:var(--wp--preset--color--primary)">Get in touch</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
