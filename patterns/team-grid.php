<?php
/**
 * Title: Team Grid
 * Slug: q9/team-grid
 * Categories: q9
 * Keywords: team, people, staff, profiles, about, bios
 * Description: Responsive grid of team members — photo, name, role and short bio. 2/3/4-up.
 * Viewport Width: 1280
 */
?>

<!-- Mobile: columns stack 1-up; square image, name, role, bio all full-width. -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xlarge","bottom":"var:preset|spacing|xlarge"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xlarge);padding-bottom:var(--wp--preset--spacing--xlarge)">

	<!-- wp:group {"layout":{"type":"constrained","contentSize":"560px"},"style":{"spacing":{"blockGap":"var:preset|spacing|small","margin":{"bottom":"var:preset|spacing|large"}}}} -->
	<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--large)">
		<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|small","letterSpacing":"0.08em","textTransform":"uppercase"},"color":{"text":"var:preset|color|primary"}}} -->
		<p class="has-text-align-center" style="color:var(--wp--preset--color--primary);font-size:var(--wp--preset--font-size--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase">Our team</p>
		<!-- /wp:paragraph -->
		<!-- wp:heading {"level":2,"textAlign":"center","style":{"typography":{"fontWeight":"700"}}} -->
		<h2 class="wp-block-heading has-text-align-center" style="font-weight:700">Meet the people behind our work</h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->

	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
	<div class="wp-block-columns">

		<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}}} -->
		<div class="wp-block-column">
			<!-- wp:image {"aspectRatio":"1/1","scale":"cover","sizeSlug":"large","style":{"border":{"radius":"var:custom|radius|card"}}} -->
			<figure class="wp-block-image size-large" style="border-radius:var(--wp--custom--radius--card)"><img src="" alt="Team member name" style="aspect-ratio:1/1;object-fit:cover"/></figure>
			<!-- /wp:image -->
			<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|xl"}}} -->
			<h3 class="wp-block-heading" style="font-size:var(--wp--preset--font-size--xl);font-weight:600">Jane Smith</h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","letterSpacing":"0.04em","textTransform":"uppercase","fontSize":"var:preset|font-size|small"},"color":{"text":"var:preset|color|primary"}}} -->
			<p style="color:var(--wp--preset--color--primary);font-size:var(--wp--preset--font-size--small);font-weight:600;letter-spacing:0.04em;text-transform:uppercase">Job title</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"}}} -->
			<p style="color:var(--wp--preset--color--neutral-dark)">A short bio of two to four sentences describing this person's background, expertise and what they bring to the team.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}}} -->
		<div class="wp-block-column">
			<!-- wp:image {"aspectRatio":"1/1","scale":"cover","sizeSlug":"large","style":{"border":{"radius":"var:custom|radius|card"}}} -->
			<figure class="wp-block-image size-large" style="border-radius:var(--wp--custom--radius--card)"><img src="" alt="Team member name" style="aspect-ratio:1/1;object-fit:cover"/></figure>
			<!-- /wp:image -->
			<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|xl"}}} -->
			<h3 class="wp-block-heading" style="font-size:var(--wp--preset--font-size--xl);font-weight:600">John Doe</h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","letterSpacing":"0.04em","textTransform":"uppercase","fontSize":"var:preset|font-size|small"},"color":{"text":"var:preset|color|primary"}}} -->
			<p style="color:var(--wp--preset--color--primary);font-size:var(--wp--preset--font-size--small);font-weight:600;letter-spacing:0.04em;text-transform:uppercase">Job title</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"}}} -->
			<p style="color:var(--wp--preset--color--neutral-dark)">A short bio of two to four sentences describing this person's background, expertise and what they bring to the team.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}}} -->
		<div class="wp-block-column">
			<!-- wp:image {"aspectRatio":"1/1","scale":"cover","sizeSlug":"large","style":{"border":{"radius":"var:custom|radius|card"}}} -->
			<figure class="wp-block-image size-large" style="border-radius:var(--wp--custom--radius--card)"><img src="" alt="Team member name" style="aspect-ratio:1/1;object-fit:cover"/></figure>
			<!-- /wp:image -->
			<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|xl"}}} -->
			<h3 class="wp-block-heading" style="font-size:var(--wp--preset--font-size--xl);font-weight:600">Sarah Lee</h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","letterSpacing":"0.04em","textTransform":"uppercase","fontSize":"var:preset|font-size|small"},"color":{"text":"var:preset|color|primary"}}} -->
			<p style="color:var(--wp--preset--color--primary);font-size:var(--wp--preset--font-size--small);font-weight:600;letter-spacing:0.04em;text-transform:uppercase">Job title</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"}}} -->
			<p style="color:var(--wp--preset--color--neutral-dark)">A short bio of two to four sentences describing this person's background, expertise and what they bring to the team.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
