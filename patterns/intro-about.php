<?php
/**
 * Title: Intro / About Section
 * Slug: q9/intro-about
 * Categories: q9
 * Keywords: about, intro, introduction, company, two column
 * Description: Two-column section with heading and paragraph on the left, optional image on the right.
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xlarge","bottom":"var:preset|spacing|xlarge"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xlarge);padding-bottom:var(--wp--preset--spacing--xlarge)">

	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">

		<!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%">

			<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|small","letterSpacing":"0.08em","textTransform":"uppercase"},"color":{"text":"var:preset|color|primary"}}} -->
			<p style="color:var(--wp--preset--color--primary);font-size:var(--wp--preset--font-size--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase">About us</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":2,"style":{"typography":{"fontWeight":"700","lineHeight":"1.2"}}} -->
			<h2 class="wp-block-heading" style="font-weight:700;line-height:1.2">We help businesses grow with clarity and purpose</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"},"typography":{"fontSize":"var:preset|font-size|large"}}} -->
			<p style="color:var(--wp--preset--color--neutral-dark);font-size:var(--wp--preset--font-size--large)">A paragraph or two about your company, your approach, and what makes you different. Keep it honest, warm, and focused on the client's perspective.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium"}}}} -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-outline","style":{"border":{"radius":"var:custom|radius|button","color":"var:preset|color|primary","width":"2px"}}} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#">Learn more about us</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->

		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">

			<!-- wp:image {"sizeSlug":"large","aspectRatio":"4/3","scale":"cover","style":{"border":{"radius":"var:custom|radius|card"}}} -->
			<figure class="wp-block-image size-large" style="border-radius:var(--wp--custom--radius--card)"><img src="" alt="About our company" style="aspect-ratio:4/3;object-fit:cover"/></figure>
			<!-- /wp:image -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
