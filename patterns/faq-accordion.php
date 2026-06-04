<?php
/**
 * Title: FAQ — Accordion
 * Slug: q9/faq-accordion
 * Categories: q9
 * Keywords: faq, frequently asked questions, accordion, collapsible, details, answers
 * Description: Frequently asked questions as native collapsible accordions (core/details — HTML <details>/<summary>, zero JavaScript). Use where the source FAQ collapses answers.
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xlarge","bottom":"var:preset|spacing|xlarge"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xlarge);padding-bottom:var(--wp--preset--spacing--xlarge)">

	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|large","left":"var:preset|spacing|xlarge"}}}} -->
	<div class="wp-block-columns">

		<!-- wp:column {"width":"35%"} -->
		<div class="wp-block-column" style="flex-basis:35%">
			<!-- wp:group {"layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"var:preset|spacing|small"}}} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|small","letterSpacing":"0.08em","textTransform":"uppercase"},"color":{"text":"var:preset|color|primary"}}} -->
				<p style="color:var(--wp--preset--color--primary);font-size:var(--wp--preset--font-size--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase">FAQ</p>
				<!-- /wp:paragraph -->
				<!-- wp:heading {"level":2,"style":{"typography":{"fontWeight":"700"}}} -->
				<h2 class="wp-block-heading" style="font-weight:700">Frequently asked questions</h2>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"}}} -->
				<p style="color:var(--wp--preset--color--neutral-dark)">Can't find what you're looking for? <a href="#">Get in touch</a> and we'll be happy to help.</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"65%"} -->
		<div class="wp-block-column" style="flex-basis:65%">

			<!-- wp:group {"className":"q9-faq-accordion","style":{"spacing":{"blockGap":"0"},"border":{"top":{"color":"var:preset|color|neutral-light","width":"1px"}}}} -->
			<div class="wp-block-group q9-faq-accordion">

				<!-- wp:details {"style":{"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"}},"border":{"bottom":{"color":"var:preset|color|neutral-light","width":"1px"}}}} -->
				<details class="wp-block-details" style="border-bottom:1px solid var(--wp--preset--color--neutral-light);padding-top:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium)"><summary>How long does a typical project take?</summary>
				<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"},"spacing":{"margin":{"top":"var:preset|spacing|small"}}}} -->
				<p style="margin-top:var(--wp--preset--spacing--small);color:var(--wp--preset--color--neutral-dark)">Most projects are completed within 4–8 weeks, depending on scope and feedback turnaround. We'll give you a realistic timeline during our initial call.</p>
				<!-- /wp:paragraph -->
				</details>
				<!-- /wp:details -->

				<!-- wp:details {"style":{"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"}},"border":{"bottom":{"color":"var:preset|color|neutral-light","width":"1px"}}}} -->
				<details class="wp-block-details" style="border-bottom:1px solid var(--wp--preset--color--neutral-light);padding-top:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium)"><summary>What information do you need to get started?</summary>
				<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"},"spacing":{"margin":{"top":"var:preset|spacing|small"}}}} -->
				<p style="margin-top:var(--wp--preset--spacing--small);color:var(--wp--preset--color--neutral-dark)">We'll ask for a brief overview of your business, your goals, and any examples of work you admire. A short discovery call is usually the fastest way to get aligned.</p>
				<!-- /wp:paragraph -->
				</details>
				<!-- /wp:details -->

				<!-- wp:details {"style":{"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"}},"border":{"bottom":{"color":"var:preset|color|neutral-light","width":"1px"}}}} -->
				<details class="wp-block-details" style="border-bottom:1px solid var(--wp--preset--color--neutral-light);padding-top:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium)"><summary>Do you offer ongoing support after launch?</summary>
				<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"},"spacing":{"margin":{"top":"var:preset|spacing|small"}}}} -->
				<p style="margin-top:var(--wp--preset--spacing--small);color:var(--wp--preset--color--neutral-dark)">Yes. We offer a range of maintenance and support packages to keep your site secure, up to date, and performing well after launch.</p>
				<!-- /wp:paragraph -->
				</details>
				<!-- /wp:details -->

				<!-- wp:details {"style":{"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"}},"border":{"bottom":{"color":"var:preset|color|neutral-light","width":"1px"}}}} -->
				<details class="wp-block-details" style="border-bottom:1px solid var(--wp--preset--color--neutral-light);padding-top:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium)"><summary>How does pricing work?</summary>
				<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"},"spacing":{"margin":{"top":"var:preset|spacing|small"}}}} -->
				<p style="margin-top:var(--wp--preset--spacing--small);color:var(--wp--preset--color--neutral-dark)">We work on a fixed-price basis for most projects. You'll receive a detailed quote before any work begins, so there are no surprises.</p>
				<!-- /wp:paragraph -->
				</details>
				<!-- /wp:details -->

			</div>
			<!-- /wp:group -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
