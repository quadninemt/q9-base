<?php
/**
 * Title: Media + Text Row
 * Slug: q9/media-text-row
 * Categories: q9
 * Keywords: media, image, text, two column, feature, service, alternating, zigzag
 * Description: A two-column row with image on one side and heading, text, optional list and CTA on the other. Reversible.
 * Viewport Width: 1280
 */
?>

<!-- Image is in the LEFT column (source order first). On mobile, columns stack image-top, text-below (WP default). -->
<!-- For image-RIGHT desktop layout: select the inner wp:columns block in the Site Editor and apply the "Reversed (image right)" block style. The CSS reverses column order at ≥782px only, so mobile always renders image-top regardless of desktop side. -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xlarge","bottom":"var:preset|spacing|xlarge"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xlarge);padding-bottom:var(--wp--preset--spacing--xlarge)">

	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|large","left":"var:preset|spacing|xlarge"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">

		<!-- Image column — LEFT on desktop, TOP on mobile -->
		<!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">
			<!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","style":{"border":{"radius":"var:custom|radius|card"}}} -->
			<figure class="wp-block-image size-large" style="border-radius:var(--wp--custom--radius--card)"><img src="" alt="Section image description" style="aspect-ratio:4/3;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->

		<!-- Text column — RIGHT on desktop, BELOW on mobile -->
		<!-- wp:column {"verticalAlignment":"center","width":"55%","style":{"spacing":{"blockGap":"var:preset|spacing|medium"}}} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%">

			<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|small","letterSpacing":"0.08em","textTransform":"uppercase"},"color":{"text":"var:preset|color|primary"}}} -->
			<p style="color:var(--wp--preset--color--primary);font-size:var(--wp--preset--font-size--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase">Our approach</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":2,"style":{"typography":{"fontWeight":"700","lineHeight":"1.2"}}} -->
			<h2 class="wp-block-heading" style="font-weight:700;line-height:1.2">Section heading that describes this topic</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"},"typography":{"fontSize":"var:preset|font-size|large"}}} -->
			<p style="color:var(--wp--preset--color--neutral-dark);font-size:var(--wp--preset--font-size--large)">An introductory paragraph that gives context and draws the reader into the details below. Keep it to two or three sentences.</p>
			<!-- /wp:paragraph -->

			<!-- wp:list {"style":{"color":{"text":"var:preset|color|neutral-dark"}}} -->
			<ul style="color:var(--wp--preset--color--neutral-dark)">
				<!-- wp:list-item -->
				<li>Key benefit or feature point one</li>
				<!-- /wp:list-item -->
				<!-- wp:list-item -->
				<li>Key benefit or feature point two</li>
				<!-- /wp:list-item -->
				<!-- wp:list-item -->
				<li>Key benefit or feature point three</li>
				<!-- /wp:list-item -->
			</ul>
			<!-- /wp:list -->

			<!-- wp:buttons {"layout":{"type":"flex"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|small"}}}} -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-outline","style":{"border":{"radius":"var:custom|radius|button"},"spacing":{"padding":{"top":"0.875rem","bottom":"0.875rem","left":"2rem","right":"2rem"}}}} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#" style="border-radius:var(--wp--custom--radius--button)">Learn more</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
