<?php
/**
 * 404 template — ported from the MuratKombi static 404.html.
 *
 * Deliberately self-contained (does NOT call get_header()/get_footer()): the source
 * static 404.html has no nav/footer chrome at all, just a centered message. wp_head()
 * and wp_footer() are still called directly so WordPress core/plugins keep working.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="robots" content="noindex" />
<meta name="theme-color" content="#0a0c10" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<main class="container state-page">
	<p class="eyebrow">404</p>
	<h1><?php esc_html_e( 'Bu Sayfa Bulunamadı', 'merkez-hidrofor-child' ); ?></h1>
	<p class="text-dim"><?php esc_html_e( 'Aradığınız sayfa taşınmış ya da hiç var olmamış olabilir.', 'merkez-hidrofor-child' ); ?></p>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--danger"><?php esc_html_e( 'Ana Sayfaya Dön', 'merkez-hidrofor-child' ); ?></a>
</main>

<?php wp_footer(); ?>
</body>
</html>
