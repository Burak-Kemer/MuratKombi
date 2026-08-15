<?php
/**
 * "İşletme Bilgileri" Customizer panel — the fields most likely to change again
 * (name, phones, WhatsApp, address, hours, founded year, experience, service area)
 * live here instead of hardcoded in inc/business-data.php, so a future change is a
 * wp-admin → Customize edit, not a code deploy.
 *
 * Defaults below are the P0 source-of-truth values confirmed by the business owner
 * on 2026-08-15 (see MURAT-KOMBI-SITE-AUDIT.md, "P0 SONUÇ RAPORU"). They are
 * starting values for a fresh install, not a hardcoded permanent source — editing
 * them here only changes what a brand-new install starts with; an
 * already-configured site keeps whatever is saved in wp-admin.
 *
 * merkez_hidrofor_business() in functions.php merges the output of
 * merkez_hidrofor_customizer_data() (this file) with the static catalog data in
 * inc/business-data.php (services/brands/districts/etc — the parts that don't
 * change often and aren't exposed as Customizer fields).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function merkez_hidrofor_customizer_defaults() {
	return array(
		'mh_business_name'    => 'Merkez Isı Teknik Servis',
		'mh_phone_mobile'     => '0539 881 58 92',
		'mh_phone_landline_1' => '0212 630 58 92',
		'mh_phone_landline_2' => '0212 630 29 00',
		'mh_phone_landline_3' => '0212 639 06 43',
		'mh_whatsapp_number'  => '0539 881 58 92',
		'mh_address_line1'    => 'Yenibosna Merkez Mahallesi',
		'mh_address_line2'    => 'Yıldıztepe Sokak No: 8',
		'mh_address_line3'    => 'Bahçelievler / İstanbul',
		'mh_business_hours'   => '7/24',
		'mh_service_area'     => 'İstanbul Avrupa Yakası',
		'mh_founded_year'     => '2001',
		'mh_experience_text'  => '25 yılı aşkın',
	);
}

function merkez_hidrofor_customize_register( $wp_customize ) {
	$defaults = merkez_hidrofor_customizer_defaults();

	$wp_customize->add_section(
		'merkez_hidrofor_business',
		array(
			'title'       => __( 'İşletme Bilgileri', 'merkez-hidrofor-child' ),
			'priority'    => 30,
			'description' => __( 'Telefon, adres, çalışma saatleri ve diğer işletme bilgileri. Buradaki değişiklikler siteye anında yansır, kod değişikliği gerekmez.', 'merkez-hidrofor-child' ),
		)
	);

	$fields = array(
		'mh_business_name'    => __( 'Firma Adı', 'merkez-hidrofor-child' ),
		'mh_phone_mobile'     => __( 'Mobil / WhatsApp Numarası', 'merkez-hidrofor-child' ),
		'mh_phone_landline_1' => __( 'Sabit Hat 1', 'merkez-hidrofor-child' ),
		'mh_phone_landline_2' => __( 'Sabit Hat 2', 'merkez-hidrofor-child' ),
		'mh_phone_landline_3' => __( 'Sabit Hat 3', 'merkez-hidrofor-child' ),
		'mh_whatsapp_number'  => __( 'WhatsApp Numarası (mobil ile aynıysa tekrar girin)', 'merkez-hidrofor-child' ),
		'mh_address_line1'    => __( 'Adres — Satır 1 (Mahalle)', 'merkez-hidrofor-child' ),
		'mh_address_line2'    => __( 'Adres — Satır 2 (Sokak/No)', 'merkez-hidrofor-child' ),
		'mh_address_line3'    => __( 'Adres — Satır 3 (İlçe/Şehir)', 'merkez-hidrofor-child' ),
		'mh_business_hours'   => __( 'Çalışma Saatleri (örn. "7/24")', 'merkez-hidrofor-child' ),
		'mh_service_area'     => __( 'Hizmet Bölgesi', 'merkez-hidrofor-child' ),
		'mh_founded_year'     => __( 'Kuruluş Yılı', 'merkez-hidrofor-child' ),
		'mh_experience_text'  => __( 'Tecrübe (örn. "25 yılı aşkın")', 'merkez-hidrofor-child' ),
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
				'section' => 'merkez_hidrofor_business',
				'type'    => 'text',
			)
		);
	}
}
add_action( 'customize_register', 'merkez_hidrofor_customize_register' );

/**
 * "0212 630 58 92" → "tel:+902126305892". Accepts numbers already in +90.../0... form too.
 */
function merkez_hidrofor_tel_href( $raw_number ) {
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
function merkez_hidrofor_wa_href( $raw_number ) {
	$digits = preg_replace( '/\D/', '', (string) $raw_number );

	if ( 0 === strpos( $digits, '0' ) && 11 === strlen( $digits ) ) {
		$digits = '9' . $digits;
	}
	if ( 0 !== strpos( $digits, '90' ) ) {
		$digits = '90' . ltrim( $digits, '0' );
	}
	return 'https://wa.me/' . $digits;
}

/**
 * The Customizer-backed subset of the business-data array shape — same keys
 * inc/business-data.php used to hardcode (name, legal_name, founded, experience,
 * service_area, hours, address, whatsapp, primary_call, phones, address_schema),
 * built from get_theme_mod() so wp-admin edits take effect without a deploy.
 *
 * @return array
 */
function merkez_hidrofor_customizer_data() {
	$defaults = merkez_hidrofor_customizer_defaults();

	$name      = get_theme_mod( 'mh_business_name', $defaults['mh_business_name'] );
	$mobile    = get_theme_mod( 'mh_phone_mobile', $defaults['mh_phone_mobile'] );
	$landline1 = get_theme_mod( 'mh_phone_landline_1', $defaults['mh_phone_landline_1'] );
	$landline2 = get_theme_mod( 'mh_phone_landline_2', $defaults['mh_phone_landline_2'] );
	$landline3 = get_theme_mod( 'mh_phone_landline_3', $defaults['mh_phone_landline_3'] );
	$whatsapp  = get_theme_mod( 'mh_whatsapp_number', $defaults['mh_whatsapp_number'] );
	$line1     = get_theme_mod( 'mh_address_line1', $defaults['mh_address_line1'] );
	$line2     = get_theme_mod( 'mh_address_line2', $defaults['mh_address_line2'] );
	$line3     = get_theme_mod( 'mh_address_line3', $defaults['mh_address_line3'] );

	return array(
		'name'         => $name,
		'legal_name'   => $name,
		'founded'      => get_theme_mod( 'mh_founded_year', $defaults['mh_founded_year'] ),
		'experience'   => get_theme_mod( 'mh_experience_text', $defaults['mh_experience_text'] ),
		'service_area' => get_theme_mod( 'mh_service_area', $defaults['mh_service_area'] ),
		'hours'        => get_theme_mod( 'mh_business_hours', $defaults['mh_business_hours'] ),

		'address'      => array(
			'line1' => $line1,
			'line2' => $line2,
			'line3' => $line3,
		),

		'email'        => null,

		'whatsapp'     => array(
			'label' => $whatsapp,
			'href'  => merkez_hidrofor_wa_href( $whatsapp ),
		),

		'primary_call' => array(
			'label' => $mobile,
			'href'  => merkez_hidrofor_tel_href( $mobile ),
		),

		'phones'       => array(
			array( 'label' => $landline1, 'href' => merkez_hidrofor_tel_href( $landline1 ) ),
			array( 'label' => $landline2, 'href' => merkez_hidrofor_tel_href( $landline2 ) ),
			array( 'label' => $landline3, 'href' => merkez_hidrofor_tel_href( $landline3 ) ),
		),

		// Kept in sync with the display address above rather than a second
		// hand-typed copy — one Customizer edit updates both the visible address
		// and the schema.org PostalAddress inc/seo.php reads.
		'address_schema' => array(
			'streetAddress'   => trim( $line1 . ', ' . $line2, ', ' ),
			'addressLocality' => 'Bahçelievler',
			'addressRegion'   => 'İstanbul',
			'addressCountry'  => 'TR',
		),
	);
}
