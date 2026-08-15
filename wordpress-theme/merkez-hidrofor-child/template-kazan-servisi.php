<?php
/**
 * Template Name: Kazan Servisi
 *
 * New page — the old site never had a dedicated Kazan URL either (only a
 * "Kazan - Brülör Servisi" heading on the homepage, no own page — see
 * SEO-CONTENT-MIGRATION-PLAN.md). Content below is original, general kazan
 * (boiler) service knowledge — no brand/model/capacity/certification claims
 * (P0 instruction, 2026-08-15). Brülör is mentioned only as a real physical
 * component of many kazan systems, not marketed as a separate confirmed
 * service (see the Brülör verification note in SEO-CONTENT-MIGRATION-PLAN.md).
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
	<h1 class="page-header__title">Kazan Servisi — Bakım, Arıza Tespiti ve Onarım</h1>
	<p class="page-header__lede">
		Kazan sistemlerinde teknik inceleme, bakım ve onarım hizmeti veriyoruz. <?php echo esc_html( $mh_business['service_area'] ); ?>'nda <?php echo esc_html( $mh_business['hours'] ); ?> hizmetinizdeyiz.
	</p>
</header>

<section class="section container">
	<div class="entry-content">

		<div>
			<h2>Kazan Sistemi Nedir?</h2>
			<p>Kazan, bina veya tesisin ısınma ve sıcak su ihtiyacını karşılamak için suyu ısıtan merkezi bir sistemdir. Apartman, site, iş yeri ve sanayi tesislerinde yaygın olarak kullanılır. Sistem; kazan gövdesi, yakıt/ısıtma ünitesi (brülör dahil olabilir), sirkülasyon pompası ve kontrol/emniyet ekipmanlarından oluşur.</p>
		</div>

		<div>
			<h2>Sık Görülen Kazan Arızaları</h2>
			<ul>
				<li>Yeterli ısınmama veya sıcak su gelmemesi</li>
				<li>Kazanın devreye girmemesi</li>
				<li>Basınç düşüklüğü veya dalgalanması</li>
				<li>Su/gaz kaçağı şüphesi</li>
				<li>Anormal ses veya titreşim</li>
				<li>Emniyet/kontrol ekipmanlarında arıza</li>
			</ul>
		</div>

		<div>
			<h2>Kazan Bakımı</h2>
			<p>Düzenli kazan bakımı; sistem basıncının kontrolü, sirkülasyon pompasının kontrolü, kazan gövdesi ve bağlantı noktalarının kaçak kontrolü, emniyet ekipmanlarının kontrolü ve genel performans değerlendirmesini kapsar. Sistemde brülör bulunuyorsa, brülörün genel çalışma durumu da bakım sırasında gözden geçirilir. Kesin bakım kapsamı, sistem tipine göre yerinde belirlenir.</p>
		</div>

		<div>
			<h2>Hizmet Bölgelerimiz</h2>
			<p><?php echo esc_html( implode( ', ', $mh_business['service_districts'] ) ); ?> dahil <?php echo esc_html( $mh_business['service_area'] ); ?> genelinde kazan servisi veriyoruz.</p>
		</div>

		<div>
			<h2>Sık Sorulan Sorular</h2>

			<h3>7/24 kazan arıza servisi veriyor musunuz?</h3>
			<p>Evet, <?php echo esc_html( $mh_business['hours'] ); ?> kazan arıza ve servis desteği sağlıyoruz.</p>

			<h3>Kazan bakımı ne sıklıkla yapılmalı?</h3>
			<p>Bakım sıklığı sistem tipine ve kullanım yoğunluğuna göre değişir; net bir öneri için yerinde değerlendirme yapılması gerekir.</p>

			<h3>Hangi bölgelere hizmet veriyorsunuz?</h3>
			<p><?php echo esc_html( $mh_business['service_area'] ); ?>'nda, aralarında <?php echo esc_html( implode( ', ', array_slice( $mh_business['service_districts'], 0, 6 ) ) ); ?> ve diğer ilçelerin bulunduğu geniş bir bölgeye hizmet veriyoruz.</p>
		</div>

		<?php merkez_hidrofor_related_services( 'kazan-servisi' ); ?>
	</div>
</section>

<section class="section container">
	<div class="cta-band" data-reveal>
		<div class="cta-band__content">
			<p class="eyebrow"><?php esc_html_e( 'İletişim', 'merkez-hidrofor-child' ); ?></p>
			<h2><?php esc_html_e( 'Kazan Arızanız İçin Hemen Arayın', 'merkez-hidrofor-child' ); ?></h2>
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
