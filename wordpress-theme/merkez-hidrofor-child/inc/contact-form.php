<?php
/**
 * Contact form integration point — CONFIGURATION REQUIRED AFTER PLUGIN INSTALL.
 *
 * Staging QA (2026-08-16) asked for the contact form to be prepared in code
 * without touching WordPress admin/plugins this sprint. Recommended solution:
 * Contact Form 7 (free, minimal footprint, precise markup control matching
 * this theme's hand-styled approach, and a real documented JS success event —
 * `wpcf7mailsent` — already wired in assets/js/modules/tracking.js).
 *
 * Nothing here assumes the plugin is installed. `mh_contact_form_shortcode`
 * defaults to empty; merkez_hidrofor_contact_form() renders nothing until an
 * admin pastes a real shortcode in Customizer — same "empty until configured,
 * never a fake placeholder" pattern as inc/tracking.php's GTM fields.
 *
 * Recommended CF7 field setup (create in wp-admin → Contact → Add New once
 * the plugin is installed, then paste the resulting shortcode, e.g.
 * "[contact-form-7 id="123"]", into Customizer → İletişim Formu):
 *
 *   [text* your-name placeholder "Ad Soyad"]
 *   [tel* your-phone placeholder "Telefon"]
 *   [select* your-service "Hidrofor Servisi" "Wilo Servisi" "Hidrofor Pompa Servisi"
 *       "Dalgıç Pompa Tamiri" "Kazan Servisi" "Kombi Servisi" "Otomasyon Servisi" "Diğer"]
 *   [textarea* your-message placeholder "Mesajınız"]
 *   [acceptance kvkk-onay] KVKK Aydınlatma Metni'ni okudum, kabul ediyorum. [/acceptance]
 *   [submit "Gönder"]
 *
 * Spam protection (no extra plugin/API key needed): CF7's own built-in quiz
 * field, e.g. [quiz mh-quiz "2+3=:5"] — avoids depending on a real reCAPTCHA
 * site key that doesn't exist yet (same "no invented external ID" rule as
 * Google Ads/GTM). A reCAPTCHA v3 upgrade can replace this later once a real
 * site key is issued — that's a wp-admin + Google account step, not a code one.
 *
 * The "your-service" options above match merkez_hidrofor_business()['services']
 * exactly on purpose — keep them in sync if the service list ever changes.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function merkez_hidrofor_contact_form_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'merkez_hidrofor_contact_form',
		array(
			'title'       => __( 'İletişim Formu', 'merkez-hidrofor-child' ),
			'priority'    => 45,
			'description' => __( 'Contact Form 7 (veya seçilen form eklentisi) kurulup form oluşturulduktan sonra, üretilen shortcode\'u buraya yapıştırın — sayfa kodu değişmeden form aktif olur. Boşken hiçbir form alanı gösterilmez.', 'merkez-hidrofor-child' ),
		)
	);

	$wp_customize->add_setting(
		'mh_contact_form_shortcode',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'mh_contact_form_shortcode',
		array(
			'label'       => __( 'Form Shortcode (örn. [contact-form-7 id="123"])', 'merkez-hidrofor-child' ),
			'description' => __( 'Contact Form 7 önerilir — bkz. inc/contact-form.php dosyasındaki alan/spam-koruması önerisi.', 'merkez-hidrofor-child' ),
			'section'     => 'merkez_hidrofor_contact_form',
			'type'        => 'text',
		)
	);
}
add_action( 'customize_register', 'merkez_hidrofor_contact_form_customize_register' );

/**
 * Whether a real form shortcode has been configured yet. Templates should
 * check this before rendering any surrounding heading/wrapper markup, so an
 * unconfigured form never leaves behind an empty "Formu Doldurun" heading
 * with nothing underneath it.
 *
 * @return bool
 */
function merkez_hidrofor_has_contact_form() {
	return '' !== get_theme_mod( 'mh_contact_form_shortcode', '' );
}

/**
 * Render the configured form shortcode, or nothing at all if none is set yet.
 * Safe to call unconditionally from a template — never errors, never shows a
 * "form coming soon" placeholder (this theme doesn't ship fake UI, see
 * README.md "Not yet provided" policy), just renders nothing until real.
 */
function merkez_hidrofor_contact_form() {
	$shortcode = get_theme_mod( 'mh_contact_form_shortcode', '' );
	if ( empty( $shortcode ) ) {
		return;
	}
	echo do_shortcode( $shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput -- form plugin output, not user input; admin-entered shortcode already sanitized via sanitize_text_field on save.
}
