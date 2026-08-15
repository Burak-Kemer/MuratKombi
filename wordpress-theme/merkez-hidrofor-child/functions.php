<?php
/**
 * Merkez Isı Teknik Servis child theme functions (folder/text-domain/function
 * prefix stay "merkez-hidrofor-child" / merkez_hidrofor_* for codebase
 * continuity — see style.css header for the user-visible brand name note).
 *
 * Parent theme: Avril (untouched — this file only adds child-theme behavior on top).
 * PHP 7.4 compatible: no union types, no arrow-fn-only patterns beyond 7.4, no named args.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MERKEZ_HIDROFOR_VERSION', '1.0.0' );
define( 'MERKEZ_HIDROFOR_DIR', get_stylesheet_directory() );
define( 'MERKEZ_HIDROFOR_URI', get_stylesheet_directory_uri() );
define( 'MERKEZ_HIDROFOR_MENU_LOCATION', 'primary_menu' );

require_once MERKEZ_HIDROFOR_DIR . '/inc/icons.php';
require_once MERKEZ_HIDROFOR_DIR . '/inc/customizer.php';
require_once MERKEZ_HIDROFOR_DIR . '/inc/tracking.php';
require_once MERKEZ_HIDROFOR_DIR . '/inc/seo.php';

/**
 * Central business/contact data: the static catalog (services/brands/districts/
 * core_service_pages/google_rating — see inc/business-data.php) merged with the
 * Customizer-backed contact fields (name/phones/address/hours/founded/experience/
 * service_area — see inc/customizer.php's merkez_hidrofor_customizer_data()).
 * Loaded once and cached in a static var for the rest of the request.
 *
 * @return array
 */
function merkez_hidrofor_business() {
	static $data = null;
	if ( null === $data ) {
		$static  = require MERKEZ_HIDROFOR_DIR . '/inc/business-data.php';
		$dynamic = merkez_hidrofor_customizer_data();
		$data    = array_merge( $static, $dynamic );
	}
	return $data;
}

/**
 * Theme setup. Avril's own after_setup_theme callback (custom-logo, 'primary_menu',
 * html5 support, etc.) still runs for a child theme — WordPress always loads the
 * parent theme's functions.php before the child's. We only add what this child
 * needs on top; nothing here removes or replaces a parent feature.
 */
function merkez_hidrofor_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// Additive only — Avril's own 'primary_menu' location (used for the main nav)
	// stays registered and untouched. This just gives the client an OPTIONAL
	// separate menu for the footer column; if they never assign one, footer.php
	// falls back to reusing the primary menu automatically.
	register_nav_menus(
		array(
			'footer' => __( 'Footer Menu', 'merkez-hidrofor-child' ),
		)
	);
}
add_action( 'after_setup_theme', 'merkez_hidrofor_setup' );

/**
 * wp_nav_menu()'s menu_class argument only sets a class on the outer <ul> — it does
 * NOT add anything to each <a>. The ported nav.css (hover underline, active-page
 * color) all targets .nav__link on the link itself, exactly like the static site's
 * hand-authored <a class="nav__link">. This filter adds that class to every menu
 * item's <a>, and — since WordPress core also doesn't add aria-current, only a
 * 'current-menu-item' class on the <li> — mirrors the static design's
 * aria-current="page" on whichever item is active.
 */
function merkez_hidrofor_nav_menu_link_atts( $atts, $item ) {
	$classes   = isset( $atts['class'] ) ? explode( ' ', $atts['class'] ) : array();
	$classes[] = 'nav__link';
	$atts['class'] = implode( ' ', array_unique( array_filter( $classes ) ) );

	if ( in_array( 'current-menu-item', $item->classes, true ) ) {
		$atts['aria-current'] = 'page';
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'merkez_hidrofor_nav_menu_link_atts', 10, 2 );

/**
 * Enqueue parent + child styles, in the same cascade order the static design used:
 * base -> layout -> components -> page-specific. Avril's own style.css loads first
 * so any markup we don't override still renders sanely.
 */
function merkez_hidrofor_assets() {
	$ver = MERKEZ_HIDROFOR_VERSION;

	wp_enqueue_style( 'avril-parent-style', get_template_directory_uri() . '/style.css', array(), null );

	$prev = 'avril-parent-style';

	$base = array( 'reset', 'tokens', 'typography', 'global' );
	foreach ( $base as $handle ) {
		$h = 'mh-base-' . $handle;
		wp_enqueue_style( $h, MERKEZ_HIDROFOR_URI . '/assets/css/base/' . $handle . '.css', array( $prev ), $ver );
		$prev = $h;
	}

	wp_enqueue_style( 'mh-layout-container', MERKEZ_HIDROFOR_URI . '/assets/css/layout/container.css', array( $prev ), $ver );
	$prev = 'mh-layout-container';

	$components = array( 'button', 'nav', 'page-header', 'service-card', 'trust-bar', 'process-steps', 'cta-band', 'footer', 'sticky-cta', 'entry-content' );
	foreach ( $components as $handle ) {
		$h = 'mh-component-' . $handle;
		wp_enqueue_style( $h, MERKEZ_HIDROFOR_URI . '/assets/css/components/' . $handle . '.css', array( $prev ), $ver );
		$prev = $h;
	}

	if ( is_front_page() ) {
		wp_enqueue_style( 'mh-page-home', MERKEZ_HIDROFOR_URI . '/assets/css/pages/home.css', array( $prev ), $ver );
		$prev = 'mh-page-home';
	} elseif ( is_page_template( 'template-iletisim.php' ) ) {
		wp_enqueue_style( 'mh-page-contact', MERKEZ_HIDROFOR_URI . '/assets/css/pages/contact.css', array( $prev ), $ver );
		$prev = 'mh-page-contact';
	}

	// Required theme identity stylesheet (WP header block) loads last.
	wp_enqueue_style( 'merkez-hidrofor-style', get_stylesheet_uri(), array( $prev ), $ver );

	// Single ES module entry point. nav.js / reveal.js / sticky-cta.js are loaded by
	// main.js itself via import/dynamic import — they are NOT separately enqueued,
	// they just need to exist at the same relative path for the browser to resolve.
	wp_enqueue_script( 'mh-main', MERKEZ_HIDROFOR_URI . '/assets/js/main.js', array(), $ver, true );
}
add_action( 'wp_enqueue_scripts', 'merkez_hidrofor_assets' );

/**
 * Add type="module" to our main script tag. Using the script_loader_tag filter
 * instead of wp_enqueue_script_module() keeps this working on older WP core
 * versions (wp_enqueue_script_module needs WP 6.5+, which this install may predate).
 */
function merkez_hidrofor_module_script_tag( $tag, $handle, $src ) {
	if ( 'mh-main' === $handle ) {
		$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>' . "\n";
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'merkez_hidrofor_module_script_tag', 10, 3 );

/**
 * Start with .no-js on <body>; assets/js/main.js removes it once JS actually runs.
 * Progressive-enhancement hook used by the [data-reveal] scroll-in animation.
 */
function merkez_hidrofor_body_class( $classes ) {
	$classes[] = 'no-js';
	return $classes;
}
add_filter( 'body_class', 'merkez_hidrofor_body_class' );

/**
 * Fallback favicon only if the client hasn't set a Site Icon in Customizer yet.
 * Never overrides a real site icon once one is set.
 */
function merkez_hidrofor_fallback_favicon() {
	if ( ! has_site_icon() ) {
		printf(
			'<link rel="icon" href="%s" type="image/svg+xml" />' . "\n",
			esc_url( MERKEZ_HIDROFOR_URI . '/assets/images/icons/favicon.svg' )
		);
	}
}
add_action( 'wp_head', 'merkez_hidrofor_fallback_favicon', 1 );
