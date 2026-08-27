<?php
/**
 * Title: Home
 * Slug: resume/hidden-home
 * Inserter: no
 */

?>

<!-- wp:group {"style":{"shadow":"var:preset|shadow|small","spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--50);box-shadow:var(--wp--preset--shadow--small)">
	<!-- wp:columns -->
	<div class="wp-block-columns">
	<!-- wp:column -->
	<div class="wp-block-column">

		<!-- wp:image {"align":"center","width":160,"height":160,"sizeSlug":"full","linkDestination":"none","className":"is-style-rounded"} -->
		<figure class="wp-block-image aligncenter size-full is-resized is-style-rounded"><img src="<?php echo get_avatar_url( 'giacomosecchi@gmail.com', array( 'size' => 160 ) ); ?>" alt="<?php echo esc_attr__( 'Giacomo Secchi Photo', 'resume' ); ?>" width="160" height="160"/></figure>
		<!-- /wp:image -->

		<!-- wp:heading {"level":1} -->
		<h1 class="wp-block-heading">Giacomo Secchi</h1>
		<!-- /wp:heading -->

		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading">Web Developer / Ecommerce Specialist</h2>
		<!-- /wp:heading -->

		<!-- wp:resume/list-section {"fieldName":"profile_description"} /-->
		<!-- wp:resume/resume-section {"postType":"experience"} /-->
		<!-- wp:resume/resume-section {"postType":"internship"} /-->
		<!-- wp:resume/resume-section {"postType":"project"} /-->
		<!-- wp:resume/resume-section {"postType":"education"} /-->
		<!-- wp:resume/resume-section {"postType":"event_presentation"} /-->
		<!-- wp:resume/resume-section {"postType":"publication"} /-->
	</div>
	<!-- /wp:column -->

	<!-- wp:column -->
	<div class="wp-block-column">
		
		<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group">
			<!-- wp:html -->
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16" aria-hidden="true">
				<path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
			</svg>
			<!-- /wp:html -->

			<!-- wp:paragraph -->
			<p>Modena, IT</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group">
			<!-- wp:html -->
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16" aria-hidden="true">
				<path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
			</svg>
			<!-- /wp:html -->

			<!-- wp:paragraph -->
			<p><a href="tel:+393407119634" title="Call me">+39 340 711 9634</a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group">
			<!-- wp:html -->
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-at" viewBox="0 0 16 16" aria-hidden="true">
				<path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914"/>
			</svg>
			<!-- /wp:html -->

			<!-- wp:paragraph -->
			<p><a href="mailto:info@giacomosecchi.com" title="Write me an email">info@giacomosecchi.com</a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group">
			<!-- wp:html -->
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe2" viewBox="0 0 16 16" aria-hidden="true">
				<path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m7.5-6.923c-.67.204-1.335.82-1.887 1.855q-.215.403-.395.872c.705.157 1.472.257 2.282.287zM4.249 3.539q.214-.577.481-1.078a7 7 0 0 1 .597-.933A7 7 0 0 0 3.051 3.05q.544.277 1.198.49zM3.509 7.5c.036-1.07.188-2.087.436-3.008a9 9 0 0 1-1.565-.667A6.96 6.96 0 0 0 1.018 7.5zm1.4-2.741a12.3 12.3 0 0 0-.4 2.741H7.5V5.091c-.91-.03-1.783-.145-2.591-.332M8.5 5.09V7.5h2.99a12.3 12.3 0 0 0-.399-2.741c-.808.187-1.681.301-2.591.332zM4.51 8.5c.035.987.176 1.914.399 2.741A13.6 13.6 0 0 1 7.5 10.91V8.5zm3.99 0v2.409c.91.03 1.783.145 2.591.332.223-.827.364-1.754.4-2.741zm-3.282 3.696q.18.469.395.872c.552 1.035 1.218 1.65 1.887 1.855V11.91c-.81.03-1.577.13-2.282.287zm.11 2.276a7 7 0 0 1-.598-.933 9 9 0 0 1-.481-1.079 8.4 8.4 0 0 0-1.198.49 7 7 0 0 0 2.276 1.522zm-1.383-2.964A13.4 13.4 0 0 1 3.508 8.5h-2.49a6.96 6.96 0 0 0 1.362 3.675c.47-.258.995-.482 1.565-.667m6.728 2.964a7 7 0 0 0 2.275-1.521 8.4 8.4 0 0 0-1.197-.49 9 9 0 0 1-.481 1.078 7 7 0 0 1-.597.933M8.5 11.909v3.014c.67-.204 1.335-.82 1.887-1.855q.216-.403.395-.872A12.6 12.6 0 0 0 8.5 11.91zm3.555-.401c.57.185 1.095.409 1.565.667A6.96 6.96 0 0 0 14.982 8.5h-2.49a13.4 13.4 0 0 1-.437 3.008M14.982 7.5a6.96 6.96 0 0 0-1.362-3.675c-.47.258-.995.482-1.565.667.248.92.4 1.938.437 3.008zM11.27 2.461q.266.502.482 1.078a8.4 8.4 0 0 0 1.196-.49 7 7 0 0 0-2.275-1.52c.218.283.418.597.597.932m-.488 1.343a8 8 0 0 0-.395-.872C9.835 1.897 9.17 1.282 8.5 1.077V4.09c.81-.03 1.577-.13 2.282-.287z"/>
			</svg>
			<!-- /wp:html -->

			<!-- wp:paragraph -->
			<p><a href="https://giacomosecchi.com" target="_blank" rel="noreferrer noopener" title="Visit my personal website">giacomosecchi.com</a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
			
		<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group">
			<!-- wp:html -->
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase-fill" viewBox="0 0 16 16" aria-hidden="true">
				<path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5"/>
				<path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85z"/>
			</svg>
			<!-- /wp:html -->

			<!-- wp:paragraph -->
			<p><a href="https://giacomosecchi.com/portfolio/" target="_blank" rel="noreferrer noopener" title="Visit my portfolio">Portfolio</a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group">
			<!-- wp:html -->
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16" aria-hidden="true">
				<path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
			</svg>
			<!-- /wp:html -->

			<!-- wp:paragraph -->
			<p><a href="https://github.com/giacomo-secchi" target="_blank" rel="noreferrer noopener" title="Follow Me on GitHub">@giacomo-secchi</a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group">
			<!-- wp:html -->
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16" aria-hidden="true">
			<path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
			</svg>
			<!-- /wp:html -->

			<!-- wp:paragraph -->
			<p><a href="https://linkedin.com/in/giacomosecchi" target="_blank" rel="noreferrer noopener" title="Follow Me on LinkedIn">giacomosecchi</a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:shortcode -->
[acf field="profile_description" post_id="options"]
<!-- /wp:shortcode -->