<?php
/**
 * Title: Home
 * Slug: resume/hidden-home
 * Inserter: no
 */

?>

<!-- wp:resume/tab-switch /-->

<!-- wp:group {"style":{"shadow":"var:preset|shadow|small","spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|70","right":"var:preset|spacing|70"}}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--70);box-shadow:var(--wp--preset--shadow--small)">
	<!-- wp:columns -->
	<div class="wp-block-columns">
	<!-- wp:column {"width":"67%"} -->
	<div class="wp-block-column" style="flex-basis:67%">

	

		<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group">
			<!-- wp:image {"align":"center","width":120,"height":120,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":{"topLeft":"34px","topRight":"34px","bottomLeft":"34px","bottomRight":"34px"}}}} -->
			<figure class="wp-block-image aligncenter size-full is-resized"><img src="<?php echo get_avatar_url( 'giacomosecchi@gmail.com', array( 'size' => 120 ) ); ?>" alt="<?php echo esc_attr__( 'Giacomo Secchi Photo', 'resume' ); ?>" style="border-top-left-radius:34px;border-top-right-radius:34px;border-bottom-left-radius:34px;border-bottom-right-radius:34px;" width="120" height="120"/></figure>
			<!-- /wp:image -->

		 

			<!-- wp:group {"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group">
				<!-- wp:heading {"level":1} -->
				<h1 class="wp-block-heading">Giacomo Secchi</h1>
				<!-- /wp:heading -->

				<!-- wp:heading {"style":{"typography":{"fontStyle":"normal","fontWeight":"400"}},"fontFamily":"open-sans"} -->
				<h2 class="wp-block-heading has-open-sans-font-family" style="font-style:normal;font-weight:400">Web Developer / <br>Ecommerce Specialist</h2>
				<!-- /wp:heading -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:resume/list-section {"fieldName":"profile_description","sectionIcon":"bootstrap/person-vcard"} /-->
		<!-- wp:resume/resume-section {"postType":"experience","sectionIcon":"bootstrap/briefcase-fill"} /-->
		<!-- wp:resume/resume-section {"postType":"internship","sectionIcon":"bootstrap/person-workspace"} /-->
		<!-- wp:resume/resume-section {"postType":"project","sectionIcon":"bootstrap/kanban"} /-->
		<!-- wp:resume/resume-section {"postType":"education","sectionIcon":"bootstrap/mortarboard-fill"} /-->
		<!-- wp:resume/resume-section {"postType":"event_presentation","sectionIcon":"bootstrap/megaphone"} /-->
		<!-- wp:resume/resume-section {"postType":"publication","sectionIcon":"bootstrap/journal-text"} /-->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"33%"} -->
	<div class="wp-block-column" style="flex-basis:33%">
		<!-- wp:resume/list-section {"fieldName":"personal_information","sectionIcon":"bootstrap/person-lines-fill"} /-->
		<!-- wp:resume/list-section {"fieldName":"skills","sectionIcon":"bootstrap/tools","bulletStyle":"primary-bullet"} /-->
		<!-- wp:resume/list-section {"fieldName":"soft_skills","sectionIcon":"bootstrap/people","bulletStyle":"secondary-bullet"} /-->
		<!-- wp:resume/list-section {"fieldName":"languages","sectionIcon":"bootstrap/translate"} /-->
	</div>
	<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
