<?php
/**
 * Footer template — ported from the MuratKombi static design.
 * Opens by closing the <main> tag that header.php left open.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$mh_business = merkez_hidrofor_business();
$mh_call     = $mh_business['primary_call'];
$mh_whatsapp = $mh_business['whatsapp'];
?>
</main>

<footer class="site-footer">
	<div class="container">
		<div class="footer__grid">
			<div class="footer__brand">
					<span class="footer__logo">Merkez <strong><?php esc_html_e( 'Isı', 'merkez-hidrofor-child' ); ?></strong> Teknik Servis</span>
				<p class="footer__tagline">
					<?php echo esc_html( $mh_business['legal_name'] ); ?> —
					<?php echo esc_html( $mh_business['service_area'] ); ?>, <?php echo esc_html( $mh_business['hours'] ); ?> <?php esc_html_e( 'hizmet', 'merkez-hidrofor-child' ); ?>.
				</p>
			</div>

			<div>
				<h3 class="footer__heading"><?php esc_html_e( 'Sayfalar', 'merkez-hidrofor-child' ); ?></h3>
				<?php if ( has_nav_menu( 'footer' ) ) : ?>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'menu_class'     => 'footer__list',
							'depth'          => 1,
						)
					);
					?>
				<?php else : ?>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => MERKEZ_HIDROFOR_MENU_LOCATION,
							'container'      => false,
							'menu_class'     => 'footer__list',
							'fallback_cb'    => 'wp_page_menu',
							'depth'          => 1,
						)
					);
					?>
				<?php endif; ?>
			</div>

			<div>
				<h3 class="footer__heading"><?php esc_html_e( 'İletişim', 'merkez-hidrofor-child' ); ?></h3>
				<div class="footer__list">
					<a href="<?php echo esc_url( $mh_call['href'] ); ?>"><?php echo esc_html( $mh_call['label'] ); ?></a>
					<?php foreach ( $mh_business['phones'] as $mh_phone ) : ?>
						<a href="<?php echo esc_url( $mh_phone['href'] ); ?>"><?php echo esc_html( $mh_phone['label'] ); ?></a>
					<?php endforeach; ?>
					<a href="<?php echo esc_url( $mh_whatsapp['href'] ); ?>" target="_blank" rel="noopener">
						<?php esc_html_e( "WhatsApp'tan Ulaş", 'merkez-hidrofor-child' ); ?>
					</a>
					<span>
						<?php echo esc_html( $mh_business['address']['line1'] ); ?>,
						<?php echo esc_html( $mh_business['address']['line2'] ); ?>,
						<?php echo esc_html( $mh_business['address']['line3'] ); ?>
					</span>
				</div>
			</div>
		</div>

		<div class="footer__districts">
			<h3 class="footer__heading"><?php esc_html_e( 'Hizmet Bölgelerimiz', 'merkez-hidrofor-child' ); ?></h3>
			<p class="footer__districts-list">
				<?php echo esc_html( implode( ', ', $mh_business['service_districts'] ) ); ?>
			</p>
		</div>

		<div class="footer__bottom">
			<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Tüm hakları saklıdır.', 'merkez-hidrofor-child' ); ?></span>
			<span><?php esc_html_e( 'Atlas Game Studio tarafından geliştirildi.', 'merkez-hidrofor-child' ); ?></span>
		</div>
	</div>
</footer>

<nav class="sticky-cta" aria-label="<?php esc_attr_e( 'Hızlı iletişim', 'merkez-hidrofor-child' ); ?>">
	<a href="<?php echo esc_url( $mh_call['href'] ); ?>" class="sticky-cta__link sticky-cta__link--call">
		<?php merkez_hidrofor_the_icon( 'phone' ); ?>
		<?php esc_html_e( 'ŞİMDİ ARA', 'merkez-hidrofor-child' ); ?>
	</a>
	<a href="<?php echo esc_url( $mh_whatsapp['href'] ); ?>" class="sticky-cta__link sticky-cta__link--whatsapp" target="_blank" rel="noopener">
		<?php merkez_hidrofor_the_icon( 'whatsapp' ); ?>
		WHATSAPP
	</a>
</nav>

<?php wp_footer(); ?>
</body>
</html>
