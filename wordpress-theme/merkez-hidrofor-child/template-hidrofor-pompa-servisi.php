<?php
/**
 * Template Name: Hidrofor Pompa Servisi
 *
 * Optional template for the existing /hidrofor-pompa-servisi/ page.
 * SEO intent: "Hidrofor Pompa Servisi / Pompa Arızası / Bakım".
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
	<h1 class="page-header__title">Hidrofor Pompa Servisi — Pompa Arızası ve Bakımı</h1>
	<p class="page-header__lede">
		Hidrofor pompalarında arıza tespiti, bakım ve onarım desteği veriyoruz. <?php echo esc_html( $mh_business['service_area'] ); ?>'nda <?php echo esc_html( $mh_business['hours'] ); ?> hizmetinizdeyiz.
	</p>
</header>

<section class="section container">
	<div class="entry-content">

		<div>
			<h2>Hidrofor Pompası Ne İş Yapar?</h2>
			<p>Hidrofor pompası, sistemin kalbidir — şebeke suyunu alıp binanın ihtiyaç duyduğu basınca yükseltir. Pompanın verimli çalışması, tüm hidrofor sisteminin performansını doğrudan etkiler.</p>
		</div>

		<div>
			<h2>Sık Görülen Pompa Arızaları</h2>
			<ul>
				<li>Pompa çalışmıyor</li>
				<li>Pompa çalışıyor ama su basmıyor</li>
				<li>Mil sıkışması veya dönmeme</li>
				<li>Rulman aşınması, aşırı ses/titreşim</li>
				<li>Aşırı ısınma, motor koruma devreye girmesi</li>
				<li>Verim düşüklüğü, düşük debi</li>
			</ul>
		</div>

		<div>
			<h2>Pompa Bakım ve Onarımı</h2>
			<p>Pompa bakımı; motor ve rulman kontrolü, mil/kaplin kontrolü, elektriksel bağlantı kontrolü ve genel performans testini kapsar. Arızanın türüne göre onarım veya parça değişimi gerekebilir; kesin kapsam yerinde inceleme sonrası netleşir.</p>
		</div>

		<div>
			<h2>Hizmet Bölgelerimiz</h2>
			<p><?php echo esc_html( implode( ', ', $mh_business['service_districts'] ) ); ?> dahil <?php echo esc_html( $mh_business['service_area'] ); ?> genelinde hidrofor pompa servisi veriyoruz.</p>
		</div>

		<?php merkez_hidrofor_related_services( 'hidrofor-pompa-servisi' ); ?>
	</div>
</section>

<section class="section container">
	<div class="cta-band" data-reveal>
		<div class="cta-band__content">
			<p class="eyebrow"><?php esc_html_e( 'İletişim', 'merkez-hidrofor-child' ); ?></p>
			<h2><?php esc_html_e( 'Pompa Arızanız İçin Hemen Arayın', 'merkez-hidrofor-child' ); ?></h2>
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
