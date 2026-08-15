<?php
/**
 * Template Name: Kombi Servisi
 *
 * New page — the old site never had a dedicated Kombi URL either (only a
 * homepage bullet mention — see SEO-CONTENT-MIGRATION-PLAN.md). Content below
 * is original, general kombi service knowledge — no brand/model/certification
 * claims (P0 instruction, 2026-08-15). This page also keeps the domain's
 * hidrofor-first SEO history balanced against the new "Merkez Isı Teknik
 * Servis" brand by treating Kombi as one of five equal services, not the
 * site's sole focus (audit MURAT-KOMBI-SITE-AUDIT.md P0.4/section 26).
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
	<h1 class="page-header__title">Kombi Servisi — Arıza Tespiti, Bakım ve Onarım</h1>
	<p class="page-header__lede">
		Kombi arıza tespiti, periyodik bakım ve onarım desteği sunuyoruz. <?php echo esc_html( $mh_business['service_area'] ); ?>'nda <?php echo esc_html( $mh_business['hours'] ); ?> hizmetinizdeyiz.
	</p>
</header>

<section class="section container">
	<div class="entry-content">

		<div>
			<h2>Kombi Ne İş Yapar?</h2>
			<p>Kombi, konut ve iş yerlerinde hem ısınma hem de sıcak su ihtiyacını tek bir cihazdan karşılayan kompakt bir ısıtma sistemidir. Doğru çalışması için düzenli bakım ve arıza durumunda hızlı müdahale önemlidir.</p>
		</div>

		<div>
			<h2>Sık Görülen Kombi Arızaları</h2>
			<ul>
				<li>Kombi ısınmıyor veya yetersiz ısıtıyor</li>
				<li>Sıcak su gelmiyor</li>
				<li>Kombi devreye girmiyor veya sık sık kapanıyor</li>
				<li>Su basıncı düşük veya düzensiz</li>
				<li>Hata kodu / arıza göstergesi yanıyor</li>
				<li>Anormal ses geliyor</li>
			</ul>
		</div>

		<div>
			<h2>Kombi Bakımı</h2>
			<p>Periyodik kombi bakımı; su basıncı kontrolü, genel çalışma testi, bağlantı ve conta kontrolü ile emniyet ekipmanlarının gözden geçirilmesini kapsar. Marka ve modele özel detaylar görüşme sırasında netleştirilir.</p>
		</div>

		<div>
			<h2>Hizmet Bölgelerimiz</h2>
			<p><?php echo esc_html( implode( ', ', $mh_business['service_districts'] ) ); ?> dahil <?php echo esc_html( $mh_business['service_area'] ); ?> genelinde kombi servisi veriyoruz.</p>
		</div>

		<div>
			<h2>Sık Sorulan Sorular</h2>

			<h3>7/24 kombi arıza servisi veriyor musunuz?</h3>
			<p>Evet, <?php echo esc_html( $mh_business['hours'] ); ?> kombi arıza ve servis desteği sağlıyoruz.</p>

			<h3>Hangi marka kombilere bakıyorsunuz?</h3>
			<p>Marka ve modele özel detaylar, arızanızı ilettiğinizde görüşme sırasında netleştirilir.</p>

			<h3>Hangi bölgelere hizmet veriyorsunuz?</h3>
			<p><?php echo esc_html( $mh_business['service_area'] ); ?>'nda, aralarında <?php echo esc_html( implode( ', ', array_slice( $mh_business['service_districts'], 0, 6 ) ) ); ?> ve diğer ilçelerin bulunduğu geniş bir bölgeye hizmet veriyoruz.</p>
		</div>

		<?php merkez_hidrofor_related_services( 'kombi-servisi' ); ?>
	</div>
</section>

<section class="section container">
	<div class="cta-band" data-reveal>
		<div class="cta-band__content">
			<p class="eyebrow"><?php esc_html_e( 'İletişim', 'merkez-hidrofor-child' ); ?></p>
			<h2><?php esc_html_e( 'Kombi Arızanız İçin Hemen Arayın', 'merkez-hidrofor-child' ); ?></h2>
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
