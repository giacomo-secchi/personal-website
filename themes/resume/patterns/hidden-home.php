<?php
/**
 * Title: Home
 * Slug: resume/hidden-home
 * Inserter: no
 */

?>

<!-- wp:resume/tab-switch /-->

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

		<!-- wp:resume/list-section {"fieldName":"profile_description","sectionIcon":"bootstrap/person-vcard"} /-->
		<!-- wp:resume/resume-section {"postType":"experience","sectionIcon":"bootstrap/briefcase-fill"} /-->
		<!-- wp:resume/resume-section {"postType":"internship","sectionIcon":"bootstrap/person-workspace"} /-->
		<!-- wp:resume/resume-section {"postType":"project","sectionIcon":"bootstrap/kanban"} /-->
		<!-- wp:resume/resume-section {"postType":"education","sectionIcon":"bootstrap/mortarboard-fill"} /-->
		<!-- wp:resume/resume-section {"postType":"event_presentation","sectionIcon":"bootstrap/megaphone"} /-->
		<!-- wp:resume/resume-section {"postType":"publication","sectionIcon":"bootstrap/journal-text"} /-->
	</div>
	<!-- /wp:column -->

	<!-- wp:column -->
	<div class="wp-block-column">
		<!-- wp:resume/list-section {"fieldName":"personal_information","sectionIcon":"bootstrap/person-lines-fill"} /-->
		<!-- wp:resume/list-section {"fieldName":"skills","sectionIcon":"bootstrap/tools"} /-->
		<!-- wp:resume/list-section {"fieldName":"soft_skills","sectionIcon":"bootstrap/people"} /-->
		<!-- wp:resume/list-section {"fieldName":"languages","sectionIcon":"bootstrap/translate"} /-->
	</div>
	<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
