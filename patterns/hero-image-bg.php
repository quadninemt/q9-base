<?php
/**
 * Title: Hero — Full Width Image Background
 * Slug: q9/hero-image-bg
 * Categories: q9
 * Keywords: hero, banner, image, cover, above-fold
 * Description: Primary above-fold hero with full-width image background, heading, subheading and CTA button.
 * Viewport Width: 1280
 */
?>

<!-- wp:cover {"dimRatio":50,"overlayColor":"neutral-dark","minHeight":600,"minHeightUnit":"px","isDark":true,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xlarge","bottom":"var:preset|spacing|xlarge"}}}} -->
<div class="wp-block-cover alignfull is-dark" style="min-height:600px;padding-top:var(--wp--preset--spacing--xlarge);padding-bottom:var(--wp--preset--spacing--xlarge)">
<span aria-hidden="true" class="wp-block-cover__background has-neutral-dark-background-color has-background-dim"></span>
<img class="wp-block-cover__image-background" alt="" data-object-fit="cover"/>
<div class="wp-block-cover__inner-container">

	<!-- wp:group {"layout":{"type":"constrained","contentSize":"700px"},"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}}} -->
	<div class="wp-block-group">

		<!-- wp:heading {"level":1,"textAlign":"center","style":{"typography":{"fontWeight":"800","lineHeight":"1.1"},"color":{"text":"#ffffff"},"fontSize":"display"}} -->
		<h1 class="wp-block-heading has-text-align-center" style="color:#ffffff;font-size:var(--wp--preset--font-size--display);font-weight:800;line-height:1.1">Your compelling headline goes here</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","style":{"color":{"text":"rgba(255,255,255,0.85)"},"typography":{"fontSize":"var:preset|font-size|xl"}}} -->
		<p class="has-text-align-center" style="color:rgba(255,255,255,0.85);font-size:var(--wp--preset--font-size--xl)">A short supporting sentence that explains your value proposition in one or two lines.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium"}}}} -->
		<div class="wp-block-buttons">
			<!-- wp:button {"style":{"border":{"radius":"var:custom|radius|button"},"spacing":{"padding":{"top":"0.875rem","bottom":"0.875rem","left":"2rem","right":"2rem"}}}} -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Get started</a></div>
			<!-- /wp:button -->
			<!-- wp:button {"className":"is-style-outline","style":{"border":{"radius":"var:custom|radius|button","color":"rgba(255,255,255,0.8)","width":"2px"},"color":{"text":"#ffffff","background":"transparent"},"spacing":{"padding":{"top":"0.875rem","bottom":"0.875rem","left":"2rem","right":"2rem"}}}} -->
			<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#" style="border-color:rgba(255,255,255,0.8);border-width:2px;color:#ffffff;background-color:transparent">Learn more</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->

	</div>
	<!-- /wp:group -->

</div>
</div>
<!-- /wp:cover -->
