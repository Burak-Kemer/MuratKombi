<?php
/**
 * Site header — nav + mobile drawer, ported from the static design reference's index.html.
 *
 * The 4-page nav (Ana Sayfa/Hizmetler/Hakkımızda/İletişim) is rendered directly rather than
 * through wp_nav_menu() — this matches the site's actual fixed information architecture (audit
 * P0.5: the URL/301 strategy keeps a small, deliberate page set, not an open-ended menu a client
 * grows over time) and avoids needing a custom nav walker just to strip <li> wrappers down to the
 * flat `<a class="nav__link">` markup nav.css expects. register_nav_menus() in functions.php still
 * registers a 'primary' location for future flexibility if the site's structure grows later.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$data = merkez_isi_get_business_data();
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#0a0c10" />
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'no-js' ); ?>>
<?php wp_body_open(); ?>
	<a class="skip-link" href="#main">İçeriğe geç</a>

	<header class="site-header">
		<div class="container nav">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__logo">
				<svg class="nav__logo-mark" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
					<circle cx="12" cy="12" r="8" fill="none" stroke="var(--color-accent)" stroke-width="1.6" />
					<circle cx="12" cy="12" r="1.4" fill="var(--color-accent)" />
					<path d="M12 12 L16.2 8.2" stroke="var(--color-accent)" stroke-width="1.6" stroke-linecap="round" />
				</svg>
				Merkez <strong>Isı</strong> Teknik Servis
			</a>

			<nav class="nav__links" aria-label="Ana menü">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__link"<?php echo is_front_page() ? ' aria-current="page"' : ''; ?>>Ana Sayfa</a>
				<a href="<?php echo esc_url( merkez_isi_page_url( 'hizmetler' ) ); ?>" class="nav__link"<?php echo is_page( 'hizmetler' ) ? ' aria-current="page"' : ''; ?>>Hizmetler</a>
				<a href="<?php echo esc_url( merkez_isi_page_url( 'hakkimizda' ) ); ?>" class="nav__link"<?php echo is_page( 'hakkimizda' ) ? ' aria-current="page"' : ''; ?>>Hakkımızda</a>
				<a href="<?php echo esc_url( merkez_isi_page_url( 'iletisim' ) ); ?>" class="nav__link"<?php echo is_page( 'iletisim' ) ? ' aria-current="page"' : ''; ?>>İletişim</a>
			</nav>

			<div class="nav__actions">
				<a href="<?php echo esc_url( $data['phones']['mobile']['href'] ); ?>" class="btn btn--danger nav__cta">ŞİMDİ ARA</a>
				<button type="button" class="nav__toggle" aria-label="Menüyü aç" aria-expanded="false" aria-controls="mobile-drawer">
					<span></span><span></span><span></span>
				</button>
			</div>
		</div>
	</header>

	<nav id="mobile-drawer" class="nav__drawer" aria-label="Mobil menü">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__link"<?php echo is_front_page() ? ' aria-current="page"' : ''; ?>>Ana Sayfa</a>
		<a href="<?php echo esc_url( merkez_isi_page_url( 'hizmetler' ) ); ?>" class="nav__link">Hizmetler</a>
		<a href="<?php echo esc_url( merkez_isi_page_url( 'hakkimizda' ) ); ?>" class="nav__link">Hakkımızda</a>
		<a href="<?php echo esc_url( merkez_isi_page_url( 'iletisim' ) ); ?>" class="nav__link">İletişim</a>
		<a href="<?php echo esc_url( $data['phones']['mobile']['href'] ); ?>" class="btn btn--danger">ŞİMDİ ARA</a>
	</nav>

	<main id="main">
