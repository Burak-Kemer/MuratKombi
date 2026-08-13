<?php
/**
 * Header template — ported from the MuratKombi static design.
 * Ends with an open <main id="main"> tag on purpose; footer.php closes it.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$mh_business = merkez_hidrofor_business();
$mh_call     = $mh_business['primary_call'];
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="theme-color" content="#0a0c10" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main"><?php esc_html_e( 'İçeriğe geç', 'merkez-hidrofor-child' ); ?></a>

<header class="site-header">
	<div class="container nav">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__logo">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<?php merkez_hidrofor_the_icon( 'logo-mark' ); ?>
				Merkez <strong><?php esc_html_e( 'Hidrofor', 'merkez-hidrofor-child' ); ?></strong>
			<?php endif; ?>
		</a>

		<?php
		wp_nav_menu(
			array(
				'theme_location'      => MERKEZ_HIDROFOR_MENU_LOCATION,
				'container'           => 'nav',
				'container_class'     => '',
				'container_aria_label' => __( 'Ana menü', 'merkez-hidrofor-child' ),
				'menu_id'             => 'primary-menu',
				'menu_class'          => 'nav__links',
				'fallback_cb'         => 'wp_page_menu',
				'depth'               => 2,
			)
		);
		?>

		<div class="nav__actions">
			<a href="<?php echo esc_url( $mh_call['href'] ); ?>" class="btn btn--danger nav__cta">
				<?php esc_html_e( 'HEMEN ARA', 'merkez-hidrofor-child' ); ?>
			</a>
			<button type="button" class="nav__toggle" aria-label="<?php esc_attr_e( 'Menüyü aç', 'merkez-hidrofor-child' ); ?>" aria-expanded="false" aria-controls="mobile-drawer">
				<span></span><span></span><span></span>
			</button>
		</div>
	</div>
</header>

<nav id="mobile-drawer" class="nav__drawer" aria-label="<?php esc_attr_e( 'Mobil menü', 'merkez-hidrofor-child' ); ?>">
	<?php
	wp_nav_menu(
		array(
			'theme_location' => MERKEZ_HIDROFOR_MENU_LOCATION,
			'container'      => false,
			'menu_id'        => 'mobile-menu',
			'menu_class'     => 'nav__links',
			'fallback_cb'    => 'wp_page_menu',
			'depth'          => 2,
		)
	);
	?>
	<a href="<?php echo esc_url( $mh_call['href'] ); ?>" class="btn btn--danger">
		<?php esc_html_e( 'HEMEN ARA', 'merkez-hidrofor-child' ); ?>
	</a>
</nav>

<main id="main">
