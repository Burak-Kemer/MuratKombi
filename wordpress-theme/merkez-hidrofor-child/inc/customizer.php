<?php
/**
 * "İşletme Bilgileri" Customizer panel — every field the audit's P0.9 flagged as "değişmesi
 * muhtemel" (likely to change again) lives here instead of hardcoded in templates or JS, so a
 * future phone/address/hours change is a wp-admin → Customize edit, not a code deploy.
 *
 * Defaults below are the P0 source-of-truth values confirmed by the business owner on
 * 2026-08-15 (see MURAT-KOMBI-SITE-AUDIT.md, "P0 SONUÇ RAPORU" → P0.2). They are starting values
 * for a fresh install, not a hardcoded permanent source — editing them here only changes what a
 * brand-new install starts with; an already-configured site keeps whatever is saved in wp-admin.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function merkez_isi_customizer_defaults() {
	return array(
		'business_name'     => 'Merkez Isı Teknik Servis',
		'phone_mobile'      => '0539 881 58 92',
		'phone_landline_1'  => '0212 630 58 92',
		'phone_landline_2'  => '0212 630 29 00',
		'phone_landline_3'  => '0212 639 06 43',
		'whatsapp_number'   => '0539 881 58 92',
		'address_line'      => 'Yenibosna Merkez Mahallesi, Yıldıztepe Sokak No: 8',
		'address_district'  => 'Bahçelievler',
		'address_city'      => 'İstanbul',
		'business_hours'    => '7/24',
		'service_area'      => 'İstanbul Avrupa Yakası',
		'founded_year'      => '2001',
		'experience_text'   => '25+ yıl',
	);
}

function merkez_isi_customize_register( $wp_customize ) {
	$defaults = merkez_isi_customizer_defaults();

	$wp_customize->add_section(
		'merkez_isi_business',
		array(
			'title'       => __( 'İşletme Bilgileri', 'merkez-isi-child' ),
			'priority'    => 30,
			'description' => __( 'Telefon, adres, çalışma saatleri ve diğer işletme bilgileri. Buradaki değişiklikler siteye anında yansır, kod değişikliği gerekmez.', 'merkez-isi-child' ),
		)
	);

	$fields = array(
		'business_name'    => __( 'Firma Adı', 'merkez-isi-child' ),
		'phone_mobile'      => __( 'Mobil / WhatsApp Numarası', 'merkez-isi-child' ),
		'phone_landline_1'  => __( 'Sabit Hat 1', 'merkez-isi-child' ),
		'phone_landline_2'  => __( 'Sabit Hat 2', 'merkez-isi-child' ),
		'phone_landline_3'  => __( 'Sabit Hat 3', 'merkez-isi-child' ),
		'whatsapp_number'   => __( 'WhatsApp Numarası (mobil ile aynıysa tekrar girin)', 'merkez-isi-child' ),
		'address_line'      => __( 'Adres — Cadde/Sokak/No', 'merkez-isi-child' ),
		'address_district'  => __( 'Adres — İlçe', 'merkez-isi-child' ),
		'address_city'      => __( 'Adres — Şehir', 'merkez-isi-child' ),
		'business_hours'    => __( 'Çalışma Saatleri (örn. "7/24")', 'merkez-isi-child' ),
		'service_area'      => __( 'Hizmet Bölgesi', 'merkez-isi-child' ),
		'founded_year'      => __( 'Kuruluş Yılı', 'merkez-isi-child' ),
		'experience_text'   => __( 'Tecrübe (örn. "25+ yıl")', 'merkez-isi-child' ),
	);

	foreach ( $fields as $id => $label ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => isset( $defaults[ $id ] ) ? $defaults[ $id ] : '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			$id,
			array(
				'label'   => $label,
				'section' => 'merkez_isi_business',
				'type'    => 'text',
			)
		);
	}
}
add_action( 'customize_register', 'merkez_isi_customize_register' );

/**
 * "0212 630 58 92" → "tel:+902126305892". Accepts numbers already in +90.../0... form too.
 */
function merkez_isi_tel_href( $raw_number ) {
	$digits = preg_replace( '/\D/', '', (string) $raw_number );

	if ( 0 === strpos( $digits, '90' ) && 12 === strlen( $digits ) ) {
		return 'tel:+' . $digits;
	}
	if ( 0 === strpos( $digits, '0' ) ) {
		$digits = substr( $digits, 1 );
	}
	return 'tel:+90' . $digits;
}

/**
 * "0539 881 58 92" → "https://wa.me/905398815892".
 */
function merkez_isi_wa_href( $raw_number ) {
	$digits = preg_replace( '/\D/', '', (string) $raw_number );

	if ( 0 === strpos( $digits, '0' ) && 11 === strlen( $digits ) ) {
		$digits = '9' . $digits; // 0539... -> 90539... after the 90+ prefix below
	}
	if ( 0 !== strpos( $digits, '90' ) ) {
		$digits = '90' . ltrim( $digits, '0' );
	}
	return 'https://wa.me/' . $digits;
}

/**
 * Single shape used by both the front-end JS localization (functions.php) and the JSON-LD
 * schema output (inc/schema.php), so the two can never drift out of sync with each other —
 * they always read the same Customizer values through this one function.
 */
function merkez_isi_get_business_data() {
	$mobile     = get_theme_mod( 'phone_mobile', '0539 881 58 92' );
	$landline1  = get_theme_mod( 'phone_landline_1', '0212 630 58 92' );
	$landline2  = get_theme_mod( 'phone_landline_2', '0212 630 29 00' );
	$landline3  = get_theme_mod( 'phone_landline_3', '0212 639 06 43' );
	$whatsapp   = get_theme_mod( 'whatsapp_number', '0539 881 58 92' );

	return array(
		'name'        => get_theme_mod( 'business_name', 'Merkez Isı Teknik Servis' ),
		'phones'      => array(
			'mobile'    => array( 'number' => $mobile, 'href' => merkez_isi_tel_href( $mobile ) ),
			'landlines' => array(
				array( 'number' => $landline1, 'href' => merkez_isi_tel_href( $landline1 ) ),
				array( 'number' => $landline2, 'href' => merkez_isi_tel_href( $landline2 ) ),
				array( 'number' => $landline3, 'href' => merkez_isi_tel_href( $landline3 ) ),
			),
		),
		'whatsapp'    => array( 'number' => $whatsapp, 'href' => merkez_isi_wa_href( $whatsapp ) ),
		'services'    => array( 'Kombi', 'Kazan', 'Hidrofor', 'Dalgıç Motorları', 'Otomasyon' ),
		'address'     => array(
			'line'     => get_theme_mod( 'address_line', 'Yenibosna Merkez Mahallesi, Yıldıztepe Sokak No: 8' ),
			'district' => get_theme_mod( 'address_district', 'Bahçelievler' ),
			'city'     => get_theme_mod( 'address_city', 'İstanbul' ),
		),
		'hours'       => get_theme_mod( 'business_hours', '7/24' ),
		'serviceArea' => get_theme_mod( 'service_area', 'İstanbul Avrupa Yakası' ),
		'founded'     => get_theme_mod( 'founded_year', '2001' ),
		'experience'  => get_theme_mod( 'experience_text', '25+ yıl' ),
	);
}
