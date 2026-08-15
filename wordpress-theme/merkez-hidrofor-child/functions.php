<?php
/**
 * Merkez Isı Teknik Servis child theme bootstrap.
 * Parent theme (assumed "avril" — verify, see style.css header) is never edited directly;
 * everything here is additive/child-scoped so parent WordPress updates stay safe.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MERKEZ_ISI_CHILD_VERSION', '1.0.0' );
define( 'MERKEZ_ISI_CHILD_URI', get_stylesheet_directory_uri() );
define( 'MERKEZ_ISI_CHILD_DIR', get_stylesheet_directory() );

require_once MERKEZ_ISI_CHILD_DIR . '/inc/customizer.php';
require_once MERKEZ_ISI_CHILD_DIR . '/inc/schema.php';

/**
 * Theme setup: title-tag support, featured images, nav menu location.
 * Matches what the static design reference already assumes (single primary nav + mobile drawer).
 */
function merkez_isi_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'script', 'style' ) );

	register_nav_menus(
		array(
			'primary' => __( 'Ana Menü', 'merkez-isi-child' ),
		)
	);
}
add_action( 'after_setup_theme', 'merkez_isi_setup' );

/**
 * Enqueue the child theme's CSS (1:1 copy of the static design reference's assets/css/)
 * on top of the parent theme's stylesheet, and the ES-module JS bundle.
 */
function merkez_isi_enqueue_assets() {
	// Parent theme stylesheet first — standard child theme dependency chain.
	wp_enqueue_style(
		'merkez-isi-parent-style',
		get_template_directory_uri() . '/style.css',
		array(),
		MERKEZ_ISI_CHILD_VERSION
	);

	$css_files = array(
		'merkez-isi-reset'         => '/assets/css/base/reset.css',
		'merkez-isi-tokens'        => '/assets/css/base/tokens.css',
		'merkez-isi-typography'    => '/assets/css/base/typography.css',
		'merkez-isi-global'        => '/assets/css/base/global.css',
		'merkez-isi-container'     => '/assets/css/layout/container.css',
		'merkez-isi-button'        => '/assets/css/components/button.css',
		'merkez-isi-nav'           => '/assets/css/components/nav.css',
		'merkez-isi-page-header'   => '/assets/css/components/page-header.css',
		'merkez-isi-service-card'  => '/assets/css/components/service-card.css',
		'merkez-isi-trust-bar'     => '/assets/css/components/trust-bar.css',
		'merkez-isi-process-steps' => '/assets/css/components/process-steps.css',
		'merkez-isi-cta-band'      => '/assets/css/components/cta-band.css',
		'merkez-isi-footer'        => '/assets/css/components/footer.css',
		'merkez-isi-sticky-cta'    => '/assets/css/components/sticky-cta.css',
		'merkez-isi-home'          => '/assets/css/pages/home.css',
		'merkez-isi-services'      => '/assets/css/pages/services.css',
		'merkez-isi-contact'       => '/assets/css/pages/contact.css',
	);

	foreach ( $css_files as $handle => $path ) {
		wp_enqueue_style(
			$handle,
			MERKEZ_ISI_CHILD_URI . $path,
			array( 'merkez-isi-parent-style' ),
			MERKEZ_ISI_CHILD_VERSION
		);
	}

	// Business/contact data as a global the ES module JS reads before running (see inc/customizer.php
	// merkez_isi_get_business_data() and assets/js/modules/contact-bind.js's DATA fallback chain).
	// This is what makes phone/address/hours editable from wp-admin without a code deploy.
	// `false` as the src is the standard WP idiom for "inline-only, no actual file" — see
	// wp_add_inline_script() below, which attaches the real payload to this handle.
	wp_register_script( 'merkez-isi-business-data', false, array(), MERKEZ_ISI_CHILD_VERSION, false );
	wp_enqueue_script( 'merkez-isi-business-data' );
	wp_add_inline_script(
		'merkez-isi-business-data',
		'window.MerkezIsiBusiness = ' . wp_json_encode( merkez_isi_get_business_data(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . ';',
		'before'
	);

	wp_enqueue_script(
		'merkez-isi-main',
		MERKEZ_ISI_CHILD_URI . '/assets/js/main.js',
		array( 'merkez-isi-business-data' ),
		MERKEZ_ISI_CHILD_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'merkez_isi_enqueue_assets' );

/**
 * main.js is an ES module (static `import` statements to ./modules/*.js) — wp_enqueue_script()
 * has no native "module" type until WordPress 6.5's Script Modules API. To stay compatible with
 * older WP installs (unknown here — verify the live site's version before activating), tag this
 * one handle's <script> as type="module" via the standard pre-6.5 filter technique.
 */
function merkez_isi_module_script_tag( $tag, $handle, $src ) {
	if ( 'merkez-isi-main' !== $handle ) {
		return $tag;
	}
	return '<script type="module" src="' . esc_url( $src ) . '"></script>' . "\n";
}
add_filter( 'script_loader_tag', 'merkez_isi_module_script_tag', 10, 3 );

/**
 * Best-effort cleanup of parent-theme/page-builder assets this design doesn't use, so the
 * WordPress port doesn't silently regress the static site's Lighthouse 97-100 performance
 * (see MURAT-KOMBI-SITE-AUDIT.md P0.9 / section 17.9 — Avril + any Elementor-style builder
 * typically loads jQuery, animation and slider bundles this design has no use for).
 *
 * UNVERIFIED handle names below — these are common Avril/Elementor conventions, NOT confirmed
 * against the live site's actual enqueued handles (no server/admin access during this
 * implementation). Before activating: view-source the live homepage, find every enqueued
 * <link>/<script> this design doesn't need, and replace the handle guesses below with the real
 * ones (Query Monitor or the browser Network tab's "Initiator" column will show exact handles).
 */
function merkez_isi_dequeue_unused_parent_assets() {
	$maybe_unused_styles = array( 'avril-style', 'avril-fonts', 'elementor-frontend', 'elementor-icons', 'font-awesome' );
	$maybe_unused_scripts = array( 'avril-slider', 'avril-custom', 'elementor-frontend', 'jquery-migrate' );

	foreach ( $maybe_unused_styles as $handle ) {
		if ( wp_style_is( $handle, 'enqueued' ) ) {
			wp_dequeue_style( $handle );
		}
	}
	foreach ( $maybe_unused_scripts as $handle ) {
		if ( wp_script_is( $handle, 'enqueued' ) ) {
			wp_dequeue_script( $handle );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'merkez_isi_dequeue_unused_parent_assets', 100 );

/**
 * Resolve a page's front-end URL by its slug, with a graceful home_url() fallback so templates
 * never fatal or link to a 404 if a page hasn't been created/migrated yet under that slug.
 */
function merkez_isi_page_url( $slug, $fallback_path = '' ) {
	$page = get_page_by_path( $slug );
	if ( $page ) {
		return get_permalink( $page );
	}
	return home_url( '/' . ltrim( $fallback_path ?: $slug, '/' ) . '/' );
}
