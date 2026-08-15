<?php
/**
 * Template Name: Wilo Servisi
 *
 * Optional template for the existing /wilo-servisi/ page. SEO intent:
 * "Wilo Servisi / Wilo Hidrofor Servisi". Wilo is referenced only as a real,
 * publicly known pump brand — this page does NOT claim an authorized/certified
 * Wilo partnership, since that isn't verified. Framed as third-party technical
 * service on Wilo-brand equipment, not an official Wilo service center.
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
	<h1 class="page-header__title">Wilo Servisi — Wilo Hidrofor ve Pompa Servisi</h1>
	<p class="page-header__lede">
		Wilo marka hidrofor ve sirkülasyon pompalarında arıza tespiti, bakım ve onarım desteği veriyoruz. <?php echo esc_html( $mh_business['service_area'] ); ?>'nda <?php echo esc_html( $mh_business['hours'] ); ?> hizmetinizdeyiz.
	</p>
</header>

<section class="section container">
	<div class="entry-content">

		<div>
			<h2>Wilo Pompalarda Teknik Servis</h2>
			<p>Wilo, hidrofor ve sirkülasyon pompaları alanında yaygın olarak kullanılan bir pompa markasıdır. Bina, site ve iş yerlerinde hidrofor sistemlerinde sıkça tercih edilir. Wilo marka pompalarda arıza tespiti, bakım ve onarım hizmeti veriyoruz.</p>
		</div>

		<div>
			<h2>Sık Karşılaşılan Wilo Pompa Arızaları</h2>
			<ul>
				<li>Pompa çalışmıyor veya çalışırken duruyor</li>
				<li>Su basıncı düşük veya düzensiz</li>
				<li>Pompa aşırı ısınıyor veya devre koruması atıyor</li>
				<li>Rulman veya mil sesi/titreşimi</li>
				<li>Kontrol panosu veya elektronik kart arızaları</li>
			</ul>
		</div>

		<?php $mh_hidrofor_servisi_url = merkez_hidrofor_page_url( 'hidrofor-servisi' ); ?>
		<div>
			<h2>Wilo Hidrofor Bakımı</h2>
			<p>
				Wilo hidrofor sistemlerinde düzenli bakım; basınç şalteri kontrolü, genleşme tankı hava basıncı kontrolü, pompa/motor kontrolü ve elektriksel bağlantıların gözden geçirilmesini kapsar.
				<?php if ( $mh_hidrofor_servisi_url ) : ?>
					Detaylı bilgi için <a href="<?php echo esc_url( $mh_hidrofor_servisi_url ); ?>">hidrofor servisi</a> sayfamıza bakabilirsiniz.
				<?php else : ?>
					Detaylı bilgi için hidrofor servisi sayfamıza bakabilirsiniz.
				<?php endif; ?>
			</p>
		</div>

		<div>
			<h2>Hizmet Bölgelerimiz</h2>
			<p><?php echo esc_html( implode( ', ', $mh_business['service_districts'] ) ); ?> dahil <?php echo esc_html( $mh_business['service_area'] ); ?> genelinde Wilo pompa servisi veriyoruz.</p>
		</div>

		<div>
			<h2>Sık Sorulan Sorular</h2>

			<h3>Yetkili Wilo servisi misiniz?</h3>
			<p>Wilo markasının resmi yetkili servisi olduğumuza dair bir sertifikasyonumuz yoktur; Wilo marka pompalarda bağımsız teknik servis, bakım ve onarım desteği sunuyoruz.</p>

			<h3>7/24 Wilo pompa arıza servisi veriyor musunuz?</h3>
			<p>Evet, <?php echo esc_html( $mh_business['hours'] ); ?> Wilo pompa arıza ve servis desteği sağlıyoruz.</p>
		</div>

		<?php merkez_hidrofor_related_services( 'wilo-servisi' ); ?>
	</div>
</section>

<section class="section container">
	<div class="cta-band" data-reveal>
		<div class="cta-band__content">
			<p class="eyebrow"><?php esc_html_e( 'İletişim', 'merkez-hidrofor-child' ); ?></p>
			<h2><?php esc_html_e( 'Wilo Pompa Arızanız İçin Hemen Arayın', 'merkez-hidrofor-child' ); ?></h2>
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
