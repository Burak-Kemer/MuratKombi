<?php
/**
 * SEO infrastructure: internal linking helpers, breadcrumb wrapper, and Yoast
 * schema graph enrichment (LocalBusiness/Organization data from business-data.php).
 *
 * Nothing in this file duplicates what Yoast SEO already outputs — no <title>,
 * no meta description, no canonical, no competing JSON-LD block. It only feeds
 * verified business data INTO Yoast's own schema filters and template functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Resolve a known page slug to its real permalink, safely. Returns null if the
 * page doesn't exist (e.g. not created yet on a fresh install) instead of ever
 * linking to a guessed/broken URL. Cached per-request — get_page_by_path() is
 * one query per unique slug, not per call.
 *
 * @param string $slug Page slug (no leading/trailing slash).
 * @return string|null Permalink, or null if not found.
 */
function merkez_hidrofor_page_url( $slug ) {
	static $cache = array();

	if ( array_key_exists( $slug, $cache ) ) {
		return $cache[ $slug ];
	}

	$page = get_page_by_path( $slug );
	$cache[ $slug ] = $page ? get_permalink( $page ) : null;

	return $cache[ $slug ];
}

/**
 * "İlgili Hizmetler" internal-linking block — links to the other core service
 * pages (Hidrofor Servisi, Wilo Servisi, Hidrofor Pompa Servisi, Dalgıç Pompa
 * Tamiri). Renders only the ones that actually resolve to a real page, and
 * skips the current page so it never links to itself. Used on page.php,
 * single.php and the purpose-built service templates — this is the main fix
 * for the site's current lack of internal links between service pages.
 *
 * @param string $exclude_slug Slug of the current page, so it isn't listed.
 */
function merkez_hidrofor_related_services( $exclude_slug = '' ) {
	$business = merkez_hidrofor_business();
	$links    = array();

	foreach ( $business['core_service_pages'] as $slug => $label ) {
		if ( $slug === $exclude_slug ) {
			continue;
		}
		$url = merkez_hidrofor_page_url( $slug );
		if ( $url ) {
			$links[] = array(
				'url'   => $url,
				'label' => $label,
			);
		}
	}

	if ( ! $links ) {
		return;
	}
	?>
	<nav class="related-services" aria-label="<?php esc_attr_e( 'İlgili hizmetler', 'merkez-hidrofor-child' ); ?>">
		<p class="related-services__heading"><?php esc_html_e( 'İlgili Hizmetler', 'merkez-hidrofor-child' ); ?></p>
		<ul class="related-services__list">
			<?php foreach ( $links as $link ) : ?>
				<li><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['label'] ); ?></a></li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<?php
}

/**
 * Breadcrumb wrapper. Only outputs anything if Yoast SEO's own breadcrumb
 * feature is installed AND enabled by the site admin (SEO > Search Appearance
 * > Breadcrumbs) — this theme never builds its own breadcrumb trail or
 * competing BreadcrumbList schema; it just gives Yoast a place to render into.
 * Safe no-op if Yoast isn't active or breadcrumbs aren't turned on.
 */
function merkez_hidrofor_breadcrumbs() {
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		yoast_breadcrumb( '<nav class="breadcrumbs container" aria-label="' . esc_attr__( 'Breadcrumb', 'merkez-hidrofor-child' ) . '">', '</nav>' );
	}
}

/**
 * Enrich Yoast's Organization schema graph piece with verified NAP data instead
 * of leaving it empty (the default until an admin fills in SEO > General >
 * Site representation). Runs through Yoast's own `wpseo_schema_organization`
 * filter — this is the sanctioned extension point, not a replacement schema
 * block, so it cannot create a duplicate/competing Organization node.
 *
 * Never invents: no logo unless a real Custom Logo is set, no sameAs unless
 * real profile URLs exist (none yet), no reviews/ratings, no price range.
 */
function merkez_hidrofor_schema_organization( $data ) {
	$business = merkez_hidrofor_business();

	// Broaden the type rather than replace it — Organization stays valid,
	// HomeAndConstructionBusiness is the closest accurate LocalBusiness subtype
	// for hidrofor/pompa/kombi/kazan technical service work.
	$data['@type'] = array( 'Organization', 'HomeAndConstructionBusiness' );

	$data['name']      = $business['legal_name'];
	$data['url']       = home_url( '/' );
	$data['telephone'] = merkez_hidrofor_schema_phone( $business['primary_call']['href'] );

	$data['address'] = array(
		'@type'           => 'PostalAddress',
		'streetAddress'   => $business['address_schema']['streetAddress'],
		'addressLocality' => $business['address_schema']['addressLocality'],
		'addressRegion'   => $business['address_schema']['addressRegion'],
		'addressCountry'  => $business['address_schema']['addressCountry'],
	);

	$data['areaServed'] = array_merge(
		array( $business['service_area'] ),
		$business['service_districts']
	);

	// "7/24" is verified business info, not an assumption — encode as always-open.
	$data['openingHoursSpecification'] = array(
		array(
			'@type'     => 'OpeningHoursSpecification',
			'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' ),
			'opens'     => '00:00',
			'closes'    => '23:59',
		),
	);

	// Real custom logo only — never a fabricated/placeholder logo URL.
	if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
		$logo_id  = get_theme_mod( 'custom_logo' );
		$logo_src = $logo_id ? wp_get_attachment_image_src( $logo_id, 'full' ) : false;
		if ( $logo_src ) {
			$data['logo'] = array(
				'@type' => 'ImageObject',
				'url'   => $logo_src[0],
			);
		}
	}

	// No verified social/profile URLs yet — omit sameAs entirely rather than guess.
	unset( $data['sameAs'] );

	return $data;
}
add_filter( 'wpseo_schema_organization', 'merkez_hidrofor_schema_organization' );

/**
 * "tel:+905398815892" -> "+905398815892". schema.org telephone wants a plain
 * international-format string, not a tel: URI.
 *
 * @param string $tel_href A tel: href from business-data.php.
 * @return string
 */
function merkez_hidrofor_schema_phone( $tel_href ) {
	return str_replace( 'tel:', '', $tel_href );
}
