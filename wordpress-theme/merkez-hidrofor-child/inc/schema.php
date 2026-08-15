<?php
/**
 * JSON-LD structured data — LocalBusiness/HVACBusiness + Service + BreadcrumbList, built from the
 * same Customizer-backed merkez_isi_get_business_data() the front-end JS uses (inc/customizer.php),
 * so schema can never show different contact info than the visible page. Only verified fields are
 * emitted — see MURAT-KOMBI-SITE-AUDIT.md P0.8; openingHoursSpecification is intentionally omitted
 * unless the saved hours literally say "7/24", rather than guessing a schedule.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * İstanbul Avrupa Yakası districts only (audit P0.6/P0.7) — Anadolu Yakası is out of scope by
 * business decision, not an oversight. Kept as a constant, not auto-generated per-district pages
 * (see audit section 17.5 on doorway-page risk).
 */
function merkez_isi_area_served() {
	$districts = array(
		'Bahçelievler', 'Bakırköy', 'Bağcılar', 'Güngören', 'Esenler', 'Başakşehir',
		'Küçükçekmece', 'Avcılar', 'Beylikdüzü', 'Büyükçekmece', 'Zeytinburnu', 'Bayrampaşa',
		'Fatih', 'Eyüpsultan', 'Kağıthane', 'Şişli', 'Beşiktaş', 'Sarıyer', 'Beyoğlu',
		'Gaziosmanpaşa', 'Sultangazi', 'Arnavutköy', 'Esenyurt',
	);

	return array_map(
		function ( $name ) {
			return array( '@type' => 'City', 'name' => $name );
		},
		$districts
	);
}

/**
 * Explicit Service names (matching the static design reference's copy exactly, e.g. "Kazan
 * Sistemleri" not "Kazan Servisi") rather than mechanically appending "Servisi" to every entry
 * in $data['services'] — that would produce the grammatically awkward "Dalgıç Motorları Servisi".
 */
function merkez_isi_service_offers() {
	$services = array( 'Kombi Servisi', 'Kazan Sistemleri', 'Hidrofor Sistemleri', 'Dalgıç Motorları', 'Otomasyon Servisi' );

	return array_map(
		function ( $name ) {
			return array(
				'@type'       => 'Offer',
				'itemOffered' => array( '@type' => 'Service', 'name' => $name ),
			);
		},
		$services
	);
}

function merkez_isi_output_schema() {
	$data = merkez_isi_get_business_data();

	$schema = array(
		'@context'     => 'https://schema.org',
		'@type'        => 'HVACBusiness',
		'name'         => $data['name'],
		'telephone'    => array(
			$data['phones']['mobile']['href'],
			$data['phones']['landlines'][0]['href'],
			$data['phones']['landlines'][1]['href'],
			$data['phones']['landlines'][2]['href'],
		),
		'foundingDate' => (string) $data['founded'],
		'address'      => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => $data['address']['line'],
			'addressLocality' => $data['address']['district'],
			'addressRegion'   => $data['address']['city'],
			'addressCountry'  => 'TR',
		),
		'areaServed'   => merkez_isi_area_served(),
		'makesOffer'   => merkez_isi_service_offers(),
	);

	// Only claim a 24/7 schedule when the saved hours literally say so — never guess (audit P0.10).
	if ( false !== stripos( (string) $data['hours'], '7/24' ) ) {
		$schema['openingHoursSpecification'] = array(
			'@type'     => 'OpeningHoursSpecification',
			'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' ),
			'opens'     => '00:00',
			'closes'    => '23:59',
		);
	}

	echo '<script type="application/ld+json">' .
		wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) .
		'</script>' . "\n";

	merkez_isi_output_breadcrumb_schema();
}
add_action( 'wp_head', 'merkez_isi_output_schema' );

/**
 * Simple two-to-three level BreadcrumbList: Home, (parent page if any), current page.
 * Skipped on the homepage itself — a single-item breadcrumb has no SEO value.
 */
function merkez_isi_output_breadcrumb_schema() {
	if ( is_front_page() ) {
		return;
	}

	$items    = array();
	$position = 1;

	$items[] = array(
		'@type'    => 'ListItem',
		'position' => $position++,
		'name'     => __( 'Ana Sayfa', 'merkez-isi-child' ),
		'item'     => home_url( '/' ),
	);

	if ( is_page() ) {
		$page = get_post();
		if ( $page && $page->post_parent ) {
			$parent  = get_post( $page->post_parent );
			$items[] = array(
				'@type'    => 'ListItem',
				'position' => $position++,
				'name'     => get_the_title( $parent ),
				'item'     => get_permalink( $parent ),
			);
		}
	}

	$items[] = array(
		'@type'    => 'ListItem',
		'position' => $position,
		'name'     => wp_get_document_title(),
		'item'     => get_permalink(),
	);

	$breadcrumb_schema = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'BreadcrumbList',
		'itemListElement' => $items,
	);

	echo '<script type="application/ld+json">' .
		wp_json_encode( $breadcrumb_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) .
		'</script>' . "\n";
}
