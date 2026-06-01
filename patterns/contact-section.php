<?php
/**
 * Title: Contact Section
 * Slug: q9/contact-section
 * Categories: q9
 * Keywords: contact, address, form, get in touch, location
 * Description: Contact section with heading, address/details on the left and a form embed placeholder on the right.
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xlarge","bottom":"var:preset|spacing|xlarge"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xlarge);padding-bottom:var(--wp--preset--spacing--xlarge)">

	<!-- wp:group {"layout":{"type":"constrained","contentSize":"560px"},"style":{"spacing":{"blockGap":"var:preset|spacing|small","margin":{"bottom":"var:preset|spacing|large"}}}} -->
	<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--large)">
		<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|small","letterSpacing":"0.08em","textTransform":"uppercase"},"color":{"text":"var:preset|color|primary"}}} -->
		<p class="has-text-align-center" style="color:var(--wp--preset--color--primary);font-size:var(--wp--preset--font-size--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase">Get in touch</p>
		<!-- /wp:paragraph -->
		<!-- wp:heading {"level":2,"textAlign":"center","style":{"typography":{"fontWeight":"700"}}} -->
		<h2 class="wp-block-heading has-text-align-center" style="font-weight:700">Let's talk</h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"align":"center","style":{"color":{"text":"var:preset|color|neutral-dark"}}} -->
		<p class="has-text-align-center" style="color:var(--wp--preset--color--neutral-dark)">We'd love to hear from you. Fill in the form or reach us directly using the details below.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|large","left":"var:preset|spacing|xlarge"}}}} -->
	<div class="wp-block-columns">

		<!-- wp:column {"width":"40%"} -->
		<div class="wp-block-column" style="flex-basis:40%">

			<!-- wp:group {"layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"var:preset|spacing|large"}}} -->
			<div class="wp-block-group">

				<!-- wp:group {"layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"var:preset|spacing|small"}}} -->
				<div class="wp-block-group">
					<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|medium"}}} -->
					<h3 class="wp-block-heading" style="font-size:var(--wp--preset--font-size--medium);font-weight:600">Address</h3>
					<!-- /wp:heading -->
					<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"}}} -->
					<p style="color:var(--wp--preset--color--neutral-dark)">123 Business Street<br>Valletta, VLT 1234<br>Malta</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->

				<!-- wp:group {"layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"var:preset|spacing|small"}}} -->
				<div class="wp-block-group">
					<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|medium"}}} -->
					<h3 class="wp-block-heading" style="font-size:var(--wp--preset--font-size--medium);font-weight:600">Email</h3>
					<!-- /wp:heading -->
					<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"}}} -->
					<p style="color:var(--wp--preset--color--neutral-dark)"><a href="mailto:hello@example.com">hello@example.com</a></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->

				<!-- wp:group {"layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"var:preset|spacing|small"}}} -->
				<div class="wp-block-group">
					<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|medium"}}} -->
					<h3 class="wp-block-heading" style="font-size:var(--wp--preset--font-size--medium);font-weight:600">Phone</h3>
					<!-- /wp:heading -->
					<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"}}} -->
					<p style="color:var(--wp--preset--color--neutral-dark)"><a href="tel:+35621000000">+356 21 000 000</a></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->

			</div>
			<!-- /wp:group -->

		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"60%"} -->
		<div class="wp-block-column" style="flex-basis:60%">

			<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large","right":"var:preset|spacing|large"}},"border":{"radius":"var:custom|radius|card"},"color":{"background":"var:preset|color|neutral-light"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group" style="background-color:var(--wp--preset--color--neutral-light);border-radius:var(--wp--custom--radius--card);padding:var(--wp--preset--spacing--large)">
				<!-- wp:html -->
				<!-- Contact form embed — replace with your Fluent Forms shortcode, e.g. [fluentform id="1"] -->
				<p style="color:var(--wp--preset--color--neutral-dark);text-align:center;padding:2rem 0;">[Contact form embed]</p>
				<!-- /wp:html -->
			</div>
			<!-- /wp:group -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
