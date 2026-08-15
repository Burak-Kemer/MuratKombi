<?php
/**
 * Inline SVG icon set, ported 1:1 from the MuratKombi static design.
 *
 * These are fixed, theme-authored markup strings (not user input), so they are
 * echoed directly rather than passed through esc_html() — escaping would encode
 * the tags as text instead of rendering the icon.
 *
 * Kept in one place because the same handful of icons (phone, whatsapp, service
 * glyphs) repeat across header, footer, front-page and page templates — pulling
 * them out avoids ~15+ duplicated inline <svg> blocks across the theme.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return inline SVG markup for a known icon name. Unknown names return an empty string.
 *
 * @param string $name Icon key: phone, whatsapp, kombi, kazan, hidrofor, dalgic, otomasyon, arrow, logo-mark.
 * @return string Raw SVG markup.
 */
function merkez_hidrofor_icon( $name ) {
	$icons = array(
		'phone'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3h3l1.5 4-2 1.5a12 12 0 0 0 6 6l1.5-2 4 1.5v3a2 2 0 0 1-2 2C10.5 19 5 13.5 5 5.5A2 2 0 0 1 6.5 3Z"/></svg>',
		'whatsapp'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M21 11.5a8.5 8.5 0 0 1-8.5 8.5c-1.4 0-2.7-.3-3.9-.9L3 21l1.9-5.6A8.5 8.5 0 1 1 21 11.5Z"/></svg>',
		'kombi'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2c1 3-3 4-3 8a3 3 0 0 0 6 0c0-1-1-2-1-2 1 3 3 3 3 6a5 5 0 0 1-10 0c0-5 5-6 5-12Z"/></svg>',
		'kazan'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="7" y="4" width="10" height="16" rx="5"/><path d="M7 9h10"/><path d="M7 15h10"/></svg>',
		'hidrofor'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="9" r="4"/><path d="M12 5V3"/><rect x="8" y="13" width="8" height="7" rx="1.5"/></svg>',
		'dalgic'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="3" width="6" height="10" rx="2"/><path d="M4 18c1.5-1.5 3-1.5 4.5 0s3 1.5 4.5 0 3-1.5 4.5 0 3 1.5 4.5 0"/></svg>',
		'otomasyon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="5" width="16" height="14" rx="2"/><circle cx="9" cy="12" r="1.6"/><circle cx="15" cy="12" r="1.6"/><path d="M9 5v2"/><path d="M15 5v2"/></svg>',
		'arrow'     => '<span class="service-card__link-arrow" aria-hidden="true">&rarr;</span>',
		'logo-mark' => '<svg class="nav__logo-mark" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8" fill="none" stroke="var(--color-accent)" stroke-width="1.6" /><circle cx="12" cy="12" r="1.4" fill="var(--color-accent)" /><path d="M12 12 L16.2 8.2" stroke="var(--color-accent)" stroke-width="1.6" stroke-linecap="round" /></svg>',
	);

	return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
}

/**
 * Echo the icon markup for $name. Convenience wrapper around merkez_hidrofor_icon().
 *
 * @param string $name Icon key.
 */
function merkez_hidrofor_the_icon( $name ) {
	echo merkez_hidrofor_icon( $name ); // phpcs:ignore WordPress.Security.EscapeOutput -- fixed, theme-authored SVG, not user input.
}
