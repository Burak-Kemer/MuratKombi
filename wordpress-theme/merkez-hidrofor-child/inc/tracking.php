<?php
/**
 * Google Ads / GTM readiness — CONFIGURATION REQUIRED AFTER ADS ACCOUNT ACCESS.
 *
 * No real GTM Container ID, Google Ads Conversion ID, or Conversion Label exists
 * yet, so none is hardcoded or guessed here (P0 instruction, 2026-08-15). The three
 * Customizer fields below default to empty; the GTM snippet is only ever printed if
 * a real container ID has been entered in wp-admin, so this ships completely inert.
 *
 * Once real values are available:
 *   1. Görünüm → Özelleştir → Reklam / Analitik Takibi'nden gerçek ID'leri gir.
 *   2. Bu dosyanın PHP tarafında ekstra bir şey yapmana gerek yok — GTM konteyner
 *      script'i otomatik olarak wp_head/wp_body_open'a eklenir.
 *   3. Google Ads telefon dönüşüm izlemesi (website call conversion tracking) GTM
 *      içinde ayrı bir tag olarak kurulmalı — assets/js/modules/tracking.js zaten
 *      her tel:/wa.me tıklamasında dataLayer'a "phone_click"/"whatsapp_click" event'i
 *      gönderiyor; GTM'de bu event'leri tetikleyici olarak kullanman yeterli.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function merkez_hidrofor_tracking_defaults() {
	return array(
		'mh_gtm_container_id'              => '',
		'mh_google_ads_conversion_id'      => '',
		'mh_google_ads_phone_conversion_label' => '',
	);
}

function merkez_hidrofor_tracking_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'merkez_hidrofor_tracking',
		array(
			'title'       => __( 'Reklam / Analitik Takibi', 'merkez-hidrofor-child' ),
			'priority'    => 40,
			'description' => __( 'Google Tag Manager ve Google Ads dönüşüm izleme kimlikleri. Ads hesabına erişim sağlandıktan sonra doldurulacak — boşken hiçbir tracking script yüklenmez.', 'merkez-hidrofor-child' ),
		)
	);

	$fields = array(
		'mh_gtm_container_id'                  => __( 'Google Tag Manager Container ID (örn. GTM-XXXXXXX)', 'merkez-hidrofor-child' ),
		'mh_google_ads_conversion_id'          => __( 'Google Ads Conversion ID (örn. AW-XXXXXXXXX) — GTM içinde kullanılacaksa burada tutmak zorunlu değil', 'merkez-hidrofor-child' ),
		'mh_google_ads_phone_conversion_label' => __( 'Google Ads Telefon Dönüşüm Etiketi (Conversion Label)', 'merkez-hidrofor-child' ),
	);

	foreach ( $fields as $id => $label ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $label,
				'section' => 'merkez_hidrofor_tracking',
				'type'    => 'text',
			)
		);
	}
}
add_action( 'customize_register', 'merkez_hidrofor_tracking_customize_register' );

/**
 * Print the GTM head snippet — ONLY if a real container ID has been configured.
 * No placeholder/example ID is ever printed as if it were real.
 */
function merkez_hidrofor_gtm_head() {
	$gtm_id = get_theme_mod( 'mh_gtm_container_id', '' );
	if ( empty( $gtm_id ) ) {
		return;
	}
	?>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?php echo esc_js( $gtm_id ); ?>');</script>
	<?php
}
add_action( 'wp_head', 'merkez_hidrofor_gtm_head' );

/**
 * Print the GTM <noscript> fallback right after <body> — same "only if configured" rule.
 */
function merkez_hidrofor_gtm_body() {
	$gtm_id = get_theme_mod( 'mh_gtm_container_id', '' );
	if ( empty( $gtm_id ) ) {
		return;
	}
	?>
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr( $gtm_id ); ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<?php
}
add_action( 'wp_body_open', 'merkez_hidrofor_gtm_body' );
