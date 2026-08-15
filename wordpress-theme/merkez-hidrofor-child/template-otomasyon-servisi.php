<?php
/**
 * Template Name: Otomasyon Servisi
 *
 * New template for a new page under /otomasyon-servisi/ (no old-site equivalent —
 * see MURAT-KOMBI-SITE-AUDIT.md P0.5: neither the old site nor the pre-2026-08-15
 * theme build had a dedicated Otomasyon page, only a bullet mention).
 *
 * P0-3 (2026-08-15): content here is deliberately generic — no PLC brand, no
 * specific control-panel model, no client/project reference, no invented
 * success rate or technical claim is added. Compare to template-hidrofor-servisi.php,
 * which can cite specific verifiable hydrophore-system facts; this page cannot make
 * the same kind of specific claims without information the business owner hasn't
 * yet provided, so it stays intentionally short until that's available.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$mh_business = merkez_hidrofor_business();
$mh_call     = $mh_business['primary_call'];
$mh_whatsapp = $mh_business['whatsapp'];

merkez_hidrofor_breadcrumbs();
?>

<header class="page-header container">
	<p class="eyebrow"><?php echo esc_html( $mh_business['service_area'] ); ?> · <?php echo esc_html( $mh_business['hours'] ); ?></p>
	<h1 class="page-header__title">Otomasyon Servisi</h1>
	<p class="page-header__lede">
		Isıtma ve su sistemlerinde otomasyon kontrolü için teknik destek sunuyoruz. <?php echo esc_html( $mh_business['service_area'] ); ?>'nda <?php echo esc_html( $mh_business['hours'] ); ?> hizmetinizdeyiz.
	</p>
</header>

<section class="section container">
	<div class="entry-content">

		<div>
			<h2>Otomasyon Desteği</h2>
			<p>Kombi, kazan, hidrofor ve pompa sistemlerinin otomatik kontrol ve izleme ihtiyaçlarında teknik destek veriyoruz. Sisteminize özel kapsam, iletişime geçtiğinizde birlikte netleştirilir.</p>
		</div>

		<div>
			<h2>Hizmet Bölgelerimiz</h2>
			<p><?php echo esc_html( implode( ', ', $mh_business['service_districts'] ) ); ?> dahil <?php echo esc_html( $mh_business['service_area'] ); ?> genelinde hizmet veriyoruz.</p>
		</div>

		<div>
			<h2>Sık Sorulan Sorular</h2>

			<h3>Hangi sistemler için otomasyon desteği veriyorsunuz?</h3>
			<p>Kombi, kazan, hidrofor ve pompa sistemlerinin otomatik kontrol ihtiyaçlarında destek veriyoruz. Sisteminize özel kapsam, iletişime geçtiğinizde birlikte netleştirilir.</p>

			<h3>7/24 destek veriyor musunuz?</h3>
			<p>Evet, <?php echo esc_html( $mh_business['hours'] ); ?> hizmet veriyoruz.</p>
		</div>

		<?php merkez_hidrofor_related_services( 'otomasyon-servisi' ); ?>
	</div>
</section>

<section class="section container">
	<div class="cta-band" data-reveal>
		<div class="cta-band__content">
			<p class="eyebrow"><?php esc_html_e( 'İletişim', 'merkez-hidrofor-child' ); ?></p>
			<h2><?php esc_html_e( 'Otomasyon İhtiyacınız İçin Hemen Arayın', 'merkez-hidrofor-child' ); ?></h2>
			<div class="cta-band__phones">
				<a href="<?php echo esc_url( $mh_call['href'] ); ?>" class="cta-band__phone">
					<?php merkez_hidrofor_the_icon( 'phone' ); ?>
					<?php echo esc_html( $mh_call['label'] ); ?>
				</a>
				<?php foreach ( $mh_business['phones'] as $mh_phone ) : ?>
					<a href="<?php echo esc_url( $mh_phone['href'] ); ?>" class="cta-band__phone">
						<?php merkez_hidrofor_the_icon( 'phone' ); ?>
						<?php echo esc_html( $mh_phone['label'] ); ?>
					</a>
				<?php endforeach; ?>
			</div>
			<div class="cta-band__actions">
				<a href="<?php echo esc_url( $mh_call['href'] ); ?>" class="btn btn--danger"><?php esc_html_e( 'Hemen Ara', 'merkez-hidrofor-child' ); ?></a>
				<a href="<?php echo esc_url( $mh_whatsapp['href'] ); ?>" class="btn btn--secondary" target="_blank" rel="noopener"><?php esc_html_e( "WhatsApp'tan Ulaş", 'merkez-hidrofor-child' ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
