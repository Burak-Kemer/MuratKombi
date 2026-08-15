<?php
/**
 * Not-found page — ported from the static design reference's 404.html. Deliberately does NOT
 * call get_header()/get_footer() (matches the static reference, which is a bare minimal page with
 * no nav/footer chrome) — just wp_head()/wp_footer() directly, same as the original.
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
	<meta name="robots" content="noindex" />
	<meta name="theme-color" content="#0a0c10" />
	<title>Sayfa Bulunamadı | <?php echo esc_html( $data['name'] ); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<main class="container state-page">
		<p class="eyebrow">404</p>
		<h1>Bu Sayfa Bulunamadı</h1>
		<p class="text-dim">Aradığınız sayfa taşınmış ya da hiç var olmamış olabilir.</p>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--danger">Ana Sayfaya Dön</a>
	</main>
	<?php wp_footer(); ?>
</body>
</html>
