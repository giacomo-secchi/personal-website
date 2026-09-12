<?php

/**
 * Extends Yoast SEO's Person schema node (site represented as a Person) with
 * data it doesn't collect natively: job title, contact info, address, and
 * the Experience+Internship/Education/Event Presentation CPTs as hasOccupation/alumniOf/performerIn,
 * and the Skills/Languages repeaters (Profile Informations options page) as skills/knowsLanguage.
 *
 * @see \Yoast\WP\SEO\Generators\Schema\Person::build_person_data()
 */
/**
 * Reads a list-section repeater (Resume Settings options page) into schema values.
 * A row without a `website_url` subfield stays a plain string; a row with one becomes
 * a structured node — schema.org allows a property's array to mix both.
 *
 * @param string $option_field_name Repeater field name, e.g. 'skills' or 'languages'.
 * @param string $type              Schema.org @type for rows that have a URL (e.g. 'DefinedTerm', 'Language').
 */
function resume_schema_list_values( $option_field_name, $type ) {
	$rows   = get_field( $option_field_name, 'option' ) ?: array();
	$values = array();

	foreach ( $rows as $row ) {
		$text = reset( $row );
		$url  = $row['website_url'] ?? '';

		if ( ! $text ) {
			continue;
		}

		$values[] = $url
			? array( '@type' => $type, 'name' => $text, 'url' => $url )
			: $text;
	}

	return $values;
}

add_filter( 'wpseo_schema_person_data', function ( $data ) {
	$occupations = array();
	foreach ( get_posts( array( 'post_type' => array( 'experience', 'internship' ), 'posts_per_page' => -1 ) ) as $experience ) {
		$occupations[] = array_filter( array(
			'@type'     => 'EmployeeRole',
			'roleName'  => get_the_title( $experience ),
			'name'      => get_field( 'company_name', $experience ),
			'startDate' => get_field( 'start_date', $experience ),
			'endDate'   => get_field( 'end_date', $experience ),
		) );
	}

	$alumni_of = array();
	foreach ( get_posts( array( 'post_type' => 'education', 'posts_per_page' => -1 ) ) as $education ) {
		$entry = array(
			'@type' => 'EducationalOrganization',
			'name'  => get_the_title( $education ),
		);

		$address = get_field( 'address', $education );
		if ( $address ) {
			$postal_address = array_filter( array(
				'@type'           => 'PostalAddress',
				'streetAddress'   => $address['street_address'] ?? '',
				'addressLocality' => $address['address_locality'] ?? '',
				'addressRegion'   => $address['address_region'] ?? '',
				'postalCode'      => $address['postal_code'] ?? '',
				'addressCountry'  => $address['address_country'] ?? '',
			) );

			if ( count( $postal_address ) > 1 ) {
				$entry['address'] = $postal_address;
			}
		}

		$alumni_of[] = $entry;
	}

	$performer_in = array();
	foreach ( get_posts( array( 'post_type' => 'event_presentation', 'posts_per_page' => -1 ) ) as $event ) {
		$raw_date  = get_field( 'start_date', $event, false ); // Raw ACF storage format ('Ymd'), for a reliable ISO 8601 conversion.
		$date_time = $raw_date ? DateTime::createFromFormat( 'Ymd', $raw_date ) : false;

		$entry = array_filter( array(
			'@type'     => 'Event',
			'name'      => get_the_title( $event ),
			'startDate' => $date_time ? $date_time->format( 'Y-m-d' ) : null,
			'url'       => get_field( 'website_url', $event ),
		) );

		$organizer_name = get_field( 'company_name', $event );
		if ( $organizer_name ) {
			$entry['organizer'] = array(
				'@type' => 'Organization',
				'name'  => $organizer_name,
			);
		}

		$performer_in[] = $entry;
	}

	$data['jobTitle']  = 'Web Developer / Ecommerce Specialist';
	$data['telephone'] = '+393407119634';
	$data['email']     = 'info@giacomosecchi.com';
	$data['address']   = array(
		'@type'           => 'PostalAddress',
		'addressLocality' => 'Modena',
		'postalCode'      => '41121',
		'addressCountry'  => 'IT',
	);

	if ( $occupations ) {
		$data['hasOccupation'] = $occupations;
	}

	if ( $alumni_of ) {
		$data['alumniOf'] = $alumni_of;
	}

	if ( $performer_in ) {
		$data['performerIn'] = $performer_in;
	}

	$skills = resume_schema_list_values( 'skills', 'DefinedTerm' );
	if ( $skills ) {
		$data['skills'] = $skills;
	}

	$languages = resume_schema_list_values( 'languages', 'Language' );
	if ( $languages ) {
		$data['knowsLanguage'] = $languages;
	}

	// GitHub isn't one of Yoast's built-in social profile fields (SEO > General > Site representation).
	$data['sameAs']   = $data['sameAs'] ?? array();
	$data['sameAs'][] = 'https://github.com/giacomo-secchi';

	return $data;
} );

/**
 * Publications don't map onto any Person property (unlike hasOccupation/alumniOf/performerIn),
 * so each one is added as its own Article node in the graph, linked back to the Person via
 * `author`, instead of being crammed into the Person piece above.
 */
class Resume_Publications_Schema_Piece extends \Yoast\WP\SEO\Generators\Schema\Abstract_Schema_Piece {

	public $identifier = 'resume_publications';

	public function is_needed() {
		return $this->context->site_represents === 'person' && (bool) $this->context->site_user_id;
	}

	public function generate() {
		$person_id = $this->helpers->schema->id->get_user_schema_id( $this->context->site_user_id, $this->context );

		$pieces = array();
		foreach ( get_posts( array( 'post_type' => 'publication', 'posts_per_page' => -1 ) ) as $publication ) {
			$permalink = get_permalink( $publication );
			$raw_date  = get_field( 'start_date', $publication, false ); // Raw ACF storage format ('Ymd'), for a reliable ISO 8601 conversion.
			$date_time = $raw_date ? DateTime::createFromFormat( 'Ymd', $raw_date ) : false;

			$piece = array_filter( array(
				'@type'         => 'Article',
				'@id'           => $permalink . \Yoast\WP\SEO\Config\Schema_IDs::ARTICLE_HASH,
				'headline'      => get_the_title( $publication ),
				'name'          => get_the_title( $publication ),
				'url'           => get_field( 'website_url', $publication ) ?: $permalink,
				'datePublished' => $date_time ? $date_time->format( 'Y-m-d' ) : null,
				'author'        => array( '@id' => $person_id ),
			) );

			$publisher_name = get_field( 'company_name', $publication );
			if ( $publisher_name ) {
				$piece['publisher'] = array(
					'@type' => 'Organization',
					'name'  => $publisher_name,
				);
			}

			$pieces[] = $piece;
		}

		return $pieces;
	}
}

add_filter( 'wpseo_schema_graph_pieces', function ( $pieces ) {
	$pieces[] = new Resume_Publications_Schema_Piece();

	return $pieces;
} );
