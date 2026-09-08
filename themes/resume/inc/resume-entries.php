<?php
/**
 * Fetching and ordering of résumé entries for the resume/resume-section block.
 */

/**
 * Comparable date for a résumé entry — higher means more recent.
 *
 * Mirrors the field fallbacks the section template displays:
 * start/end date_picker (Experience, Internship, Events, Publications), then
 * start/end year text (Education), then the publish date when nothing is set
 * (e.g. Projects, which have no date fields).
 *
 * @param WP_Post $item Entry post.
 * @return int YYYYMMDD.
 */
function resume_entry_date_key( WP_Post $item ) {
	if ( function_exists( 'get_field' ) ) {
		$ymd = get_field( 'start_date', $item->ID, false )   // date_picker stores 'Ymd'
			?: get_field( 'end_date', $item->ID, false )
			?: get_field( 'event_date', $item->ID, false );

		if ( $ymd ) {
			return (int) $ymd;
		}

		$year = get_field( 'start_year', $item->ID ) ?: get_field( 'end_year', $item->ID );
		if ( $year && ctype_digit( (string) $year ) ) {
			return (int) $year * 10000 + 101; // YYYY0101
		}
	}

	return (int) get_post_time( 'Ymd', false, $item );
}

/**
 * Entries for a résumé section, newest first. A non-zero menu_order still wins
 * (manual pin via Page Attributes → Order); date is the tie-breaker.
 *
 * @param string $post_type Entry post type.
 * @return WP_Post[]
 */
function resume_get_section_entries( $post_type ) {
	$items = get_posts( array(
		'post_type'      => $post_type,
		'posts_per_page' => -1,
	) );

	usort(
		$items,
		static function ( WP_Post $a, WP_Post $b ) {
			return ( $a->menu_order <=> $b->menu_order )
				?: ( resume_entry_date_key( $b ) <=> resume_entry_date_key( $a ) );
		}
	);

	return $items;
}
