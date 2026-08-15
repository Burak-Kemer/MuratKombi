<?php
/**
 * Template Name: Dalgıç Pompa Tamiri
 *
 * Optional template for the existing /dalgic-pompa-tamiri/ page.
 * SEO intent: "Dalgıç Pompa Tamiri / Servisi".
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
	<h1 class="page-header__title">Dalgıç Pompa Tamiri ve Servisi</h1>
	<p class="page-header__lede">
		Dalgıç pompalarda arıza tespiti, tamir ve bakım desteği veriyoruz. <?php echo esc_html( $mh_business['service_area'] ); ?>'nda <?php echo esc_html( $mh_business['hours'] ); ?> hizmetinizdeyiz.
	</p>
</header>

<section class="section container">
	<div class="entry-content">

		<div>
			<h2>Dalgıç Pompa Nedir?</h2>
			<p>Dalgıç pompalar, kuyu veya su kaynağının içine tamamen daldırılarak çalışan pompalardır; suyu doğrudan kaynağın içinden çekip yüzeye taşır. Bina su temini, sulama ve kuyu sistemlerinde sıkça kullanılır.</p>
		</div>

		<div>
			<h2>Sık Görülen Dalgıç Pompa Arızaları</h2>
			<ul>
				<li>Pompa su çekmiyor veya basmıyor</li>
				<li>Pompa hiç çalışmıyor</li>
				<li>Motor kablosunda veya bağlantılarında arıza</li>
				<li>Conta/sızdırmazlık sorunları</li>
				<li>Motor aşırı ısınması veya devre koruması atması</li>
			</ul>
		</div>

		<div>
			<h2>Dalgıç Pompa Tamiri Süreci</h2>
			<p>Dalgıç pompa arızalarında öncelikle elektriksel ve mekanik kontrol yapılır; pompanın kuyudan çıkarılması gerekip gerekmediği yerinde değerlendirilir. Motor, kablo, conta ve pervane kontrolü sonrası uygun onarım uygulanır.</p>
		</div>

		<div>
			<h2>Hizmet Bölgelerimiz</h2>
			<p><?php echo esc_html( implode( ', ', $mh_business['service_districts'] ) ); ?> dahil <?php echo esc_html( $mh_business['service_area'] ); ?> genelinde dalgıç pompa servisi veriyoruz.</p>
		</div>

		<div>
			<h2>Sık Sorulan Sorular</h2>

			<h3>Dalgıç pompa kuyudan çıkarılmadan tamir edilebilir mi?</h3>
			<p>Arızanın türüne bağlıdır; bazı durumlarda yerinde elektriksel kontrol yeterli olabilir, bazı arızalarda pompanın kuyudan çıkarılması gerekir. Kesin yöntem yerinde değerlendirme sonrası belirlenir.</p>

			<h3>7/24 dalgıç pompa servisi veriyor musunuz?</h3>
			<p>Evet, <?php echo esc_html( $mh_business['hours'] ); ?> dalgıç pompa arıza ve servis desteği sağlıyoruz.</p>
		</div>

		<?php merkez_hidrofor_related_services( 'dalgic-pompa-tamiri' ); ?>
	</div>
</section>

<section class="section container">
	<div class="cta-band" data-reveal>
		<div class="cta-band__content">
			<p class="eyebrow"><?php esc_html_e( 'İletişim', 'merkez-hidrofor-child' ); ?></p>
			<h2><?php esc_html_e( 'Dalgıç Pompa Arızanız İçin Hemen Arayın', 'merkez-hidrofor-child' ); ?></h2>
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
