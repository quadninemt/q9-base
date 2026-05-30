<?php
/**
 * Title: Post Grid
 * Slug: q9/post-grid
 * Categories: q9
 * Keywords: blog, news, insights, posts, cards, articles
 * Description: Three-up cards for featured posts — image, category, date, title, excerpt and read-more link.
 * Viewport Width: 1280
 */
?>

<!-- Static featured-posts version. Dynamic query loop variant (wp:query) is out of scope — flag for future enhancement. -->
<!-- Mobile: cards stack 1-up; 16/9 image maintained. -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xlarge","bottom":"var:preset|spacing|xlarge"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xlarge);padding-bottom:var(--wp--preset--spacing--xlarge)">

	<!-- Section header with "View all" link -->
	<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"bottom":"var:preset|spacing|large"}}}} -->
	<div class="wp-block-group" style="flex-wrap:nowrap;justify-content:space-between;align-items:center;margin-bottom:var(--wp--preset--spacing--large)">
		<!-- wp:group {"layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"var:preset|spacing|small"}}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|small","letterSpacing":"0.08em","textTransform":"uppercase"},"color":{"text":"var:preset|color|primary"}}} -->
			<p style="color:var(--wp--preset--color--primary);font-size:var(--wp--preset--font-size--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase">Insights</p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":2,"style":{"typography":{"fontWeight":"700"}}} -->
			<h2 class="wp-block-heading" style="font-weight:700">Latest articles</h2>
			<!-- /wp:heading -->
		</div>
		<!-- /wp:group -->
		<!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|medium"}}} -->
		<p style="font-size:var(--wp--preset--font-size--medium)"><a href="#">View all articles</a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
	<div class="wp-block-columns">

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"color":{"background":"var:preset|color|background"},"border":{"radius":"var:custom|radius|card"},"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group" style="background-color:var(--wp--preset--color--background);border-radius:var(--wp--custom--radius--card);overflow:hidden">
				<!-- wp:image {"aspectRatio":"16/9","scale":"cover","sizeSlug":"large"} -->
				<figure class="wp-block-image size-large"><img src="" alt="Article image" style="aspect-ratio:16/9;object-fit:cover;display:block;width:100%"/></figure>
				<!-- /wp:image -->
				<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|small"}},"layout":{"type":"flex","orientation":"vertical"}} -->
				<div class="wp-block-group" style="padding:var(--wp--preset--spacing--medium)">
					<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|small"},"color":{"text":"var:preset|color|primary"}}} -->
					<p style="color:var(--wp--preset--color--primary);font-size:var(--wp--preset--font-size--small);font-weight:600">HR · 12 May 2026</p>
					<!-- /wp:paragraph -->
					<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|xl"}}} -->
					<h3 class="wp-block-heading" style="font-size:var(--wp--preset--font-size--xl);font-weight:600">Article headline goes here</h3>
					<!-- /wp:heading -->
					<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"}}} -->
					<p style="color:var(--wp--preset--color--neutral-dark)">A short excerpt that gives readers enough context to decide if this article is relevant to them.</p>
					<!-- /wp:paragraph -->
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|small"}}} -->
					<p style="font-size:var(--wp--preset--font-size--small)"><a href="#">Read more →</a></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"color":{"background":"var:preset|color|background"},"border":{"radius":"var:custom|radius|card"},"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group" style="background-color:var(--wp--preset--color--background);border-radius:var(--wp--custom--radius--card);overflow:hidden">
				<!-- wp:image {"aspectRatio":"16/9","scale":"cover","sizeSlug":"large"} -->
				<figure class="wp-block-image size-large"><img src="" alt="Article image" style="aspect-ratio:16/9;object-fit:cover;display:block;width:100%"/></figure>
				<!-- /wp:image -->
				<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|small"}},"layout":{"type":"flex","orientation":"vertical"}} -->
				<div class="wp-block-group" style="padding:var(--wp--preset--spacing--medium)">
					<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|small"},"color":{"text":"var:preset|color|primary"}}} -->
					<p style="color:var(--wp--preset--color--primary);font-size:var(--wp--preset--font-size--small);font-weight:600">Recruitment · 5 May 2026</p>
					<!-- /wp:paragraph -->
					<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|xl"}}} -->
					<h3 class="wp-block-heading" style="font-size:var(--wp--preset--font-size--xl);font-weight:600">Article headline goes here</h3>
					<!-- /wp:heading -->
					<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"}}} -->
					<p style="color:var(--wp--preset--color--neutral-dark)">A short excerpt that gives readers enough context to decide if this article is relevant to them.</p>
					<!-- /wp:paragraph -->
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|small"}}} -->
					<p style="font-size:var(--wp--preset--font-size--small)"><a href="#">Read more →</a></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"color":{"background":"var:preset|color|background"},"border":{"radius":"var:custom|radius|card"},"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group" style="background-color:var(--wp--preset--color--background);border-radius:var(--wp--custom--radius--card);overflow:hidden">
				<!-- wp:image {"aspectRatio":"16/9","scale":"cover","sizeSlug":"large"} -->
				<figure class="wp-block-image size-large"><img src="" alt="Article image" style="aspect-ratio:16/9;object-fit:cover;display:block;width:100%"/></figure>
				<!-- /wp:image -->
				<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|small"}},"layout":{"type":"flex","orientation":"vertical"}} -->
				<div class="wp-block-group" style="padding:var(--wp--preset--spacing--medium)">
					<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|small"},"color":{"text":"var:preset|color|primary"}}} -->
					<p style="color:var(--wp--preset--color--primary);font-size:var(--wp--preset--font-size--small);font-weight:600">Compliance · 28 Apr 2026</p>
					<!-- /wp:paragraph -->
					<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600","fontSize":"var:preset|font-size|xl"}}} -->
					<h3 class="wp-block-heading" style="font-size:var(--wp--preset--font-size--xl);font-weight:600">Article headline goes here</h3>
					<!-- /wp:heading -->
					<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|neutral-dark"}}} -->
					<p style="color:var(--wp--preset--color--neutral-dark)">A short excerpt that gives readers enough context to decide if this article is relevant to them.</p>
					<!-- /wp:paragraph -->
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|small"}}} -->
					<p style="font-size:var(--wp--preset--font-size--small)"><a href="#">Read more →</a></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
