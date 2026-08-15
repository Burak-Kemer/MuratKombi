<?php
/**
 * Closes </main> opened in header.php, then the site footer + mobile sticky call/WhatsApp bar,
 * ported 1:1 from the static design reference.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$data = merkez_isi_get_business_data();
?>
	</main>

	<footer class="site-footer">
		<div class="container">
			<div class="footer__grid">
				<div class="footer__brand">
					<span class="footer__logo">Merkez <strong>Isı</strong> Teknik Servis</span>
					<p class="footer__tagline">Kombi, kazan, hidrofor, dalgıç motoru ve otomasyon hizmetlerinde <?php echo esc_html( $data['serviceArea'] ); ?>'nda <?php echo esc_html( $data['hours'] ); ?> teknik servis.</p>
				</div>
				<div>
					<p class="footer__heading">Sayfalar</p>
					<nav class="footer__list" aria-label="Footer sayfa bağlantıları">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Ana Sayfa</a>
						<a href="<?php echo esc_url( merkez_isi_page_url( 'hizmetler' ) ); ?>">Hizmetler</a>
						<a href="<?php echo esc_url( merkez_isi_page_url( 'hakkimizda' ) ); ?>">Hakkımızda</a>
						<a href="<?php echo esc_url( merkez_isi_page_url( 'iletisim' ) ); ?>">İletişim</a>
					</nav>
				</div>
				<div>
					<p class="footer__heading">İletişim</p>
					<div class="footer__list">
						<a href="<?php echo esc_url( $data['phones']['mobile']['href'] ); ?>"><?php echo esc_html( $data['phones']['mobile']['number'] ); ?></a>
						<?php foreach ( $data['phones']['landlines'] as $landline ) : ?>
							<a href="<?php echo esc_url( $landline['href'] ); ?>"><?php echo esc_html( $landline['number'] ); ?></a>
						<?php endforeach; ?>
						<a href="<?php echo esc_url( $data['whatsapp']['href'] ); ?>" target="_blank" rel="noopener">WhatsApp'tan Yaz</a>
						<span><?php echo esc_html( $data['address']['line'] . ', ' . $data['address']['district'] . ' / ' . $data['address']['city'] ); ?></span>
						<span><?php echo esc_html( $data['serviceArea'] ); ?> · <?php echo esc_html( $data['hours'] ); ?> Hizmet</span>
					</div>
				</div>
			</div>
			<div class="footer__bottom">
				<span>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php echo esc_html( $data['name'] ); ?>. Tüm hakları saklıdır.</span>
				<span>Atlas Game Studio tarafından geliştirildi.</span>
			</div>
		</div>
	</footer>

	<nav class="sticky-cta" aria-label="Hızlı iletişim">
		<a href="<?php echo esc_url( $data['phones']['mobile']['href'] ); ?>" class="sticky-cta__link sticky-cta__link--call">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3h3l1.5 4-2 1.5a12 12 0 0 0 6 6l1.5-2 4 1.5v3a2 2 0 0 1-2 2C10.5 19 5 13.5 5 5.5A2 2 0 0 1 6.5 3Z"/></svg>
			Şimdi Ara
		</a>
		<a href="<?php echo esc_url( $data['whatsapp']['href'] ); ?>" class="sticky-cta__link sticky-cta__link--whatsapp" target="_blank" rel="noopener">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 11.5a8.5 8.5 0 0 1-8.5 8.5c-1.4 0-2.7-.3-3.9-.9L3 21l1.9-5.6A8.5 8.5 0 1 1 21 11.5Z"/></svg>
			WhatsApp
		</a>
	</nav>

	<?php wp_footer(); ?>
</body>
</html>
