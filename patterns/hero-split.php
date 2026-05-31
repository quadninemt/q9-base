<?php
/**
 * Title: Hero — Split (Text + Image)
 * Slug: q9/hero-split
 * Categories: q9
 * Keywords: hero, banner, split, two column, image, above-fold
 * Description: Above-fold hero with copy and CTAs on the left and an image on the right.
 * Viewport Width: 1280
 */
?>

<!-- Mobile: columns stack — text first (left column = source-first), image below. This preserves LCP and reading order. -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xlarge","bottom":"var:preset|spacing|xlarge"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xlarge);padding-bottom:var(--wp--preset--spacing--xlarge)">

	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|large","left":"var:preset|spacing|xlarge"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">

		<!-- Text column — LEFT in source = first on mobile -->
		<!-- wp:column {"verticalAlignment":"center","width":"55%","style":{"spacing":{"blockGap":"var:preset|spacing|medium"}}} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%">

			<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|small","letterSpacing":"0.08em","textTransform":"uppercase"},"color":{"text":"var:preset|color|primary"}}} -->
			<p style="color:var(--wp--preset--color--primary);font-size:var(--wp--preset--font-size--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase">Leading experts in your field</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":1,"style":{"typography":{"fontWeight":"800","lineHeight":"1.1","fontSize":"var:preset|font-size|display"}}} -->
			<h1 class="wp-block-heading" style="font-size:var(--wp--preset--font-size--display);font-weight:800;line-height:1.1">Your compelling headline goes here</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"},"typography":{"fontSize":"var:preset|font-size|xl"}}} -->
			<p style="color:var(--wp--preset--color--neutral-dark);font-size:var(--wp--preset--font-size--xl)">A short supporting sentence that explains your value proposition in one or two lines.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"layout":{"type":"flex","flexWrap":"wrap"},"style":{"spacing":{"blockGap":"var:preset|spacing|small","margin":{"top":"var:preset|spacing|medium"}}}} -->
			<div class="wp-block-buttons">
				<!-- wp:button {"style":{"border":{"radius":"var:custom|radius|button"},"spacing":{"padding":{"top":"0.875rem","bottom":"0.875rem","left":"2rem","right":"2rem"}}}} -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#" style="border-radius:var(--wp--custom--radius--button)">Get started</a></div>
				<!-- /wp:button -->
				<!-- wp:button {"className":"is-style-outline","style":{"border":{"radius":"var:custom|radius|button"},"spacing":{"padding":{"top":"0.875rem","bottom":"0.875rem","left":"2rem","right":"2rem"}}}} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#" style="border-radius:var(--wp--custom--radius--button)">Learn more</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->

		</div>
		<!-- /wp:column -->

		<!-- Image column — RIGHT on desktop, BELOW on mobile (default WP column stacking) -->
		<!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">
			<!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","style":{"border":{"radius":"var:custom|radius|card"}}} -->
			<figure class="wp-block-image size-large" style="border-radius:var(--wp--custom--radius--card)"><img src="" alt="Hero image description" style="aspect-ratio:4/3;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
