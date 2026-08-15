<?php
/**
 * Template Name: Hakkımızda
 *
 * Optional template for the existing /hakkimizda-2/ page. SEO intent:
 * "2001'den beri / 25+ yıl deneyim". Only verified facts (founded year,
 * experience, service area, hours, services, brands) — no invented
 * milestones, awards, testimonials, or staff/customer counts.
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
	<p class="eyebrow"><?php echo esc_html( $mh_business['founded'] ); ?>'den Beri</p>
	<h1 class="page-header__title">Hakkımızda</h1>
	<p class="page-header__lede">
		<?php echo esc_html( $mh_business['legal_name'] ); ?>, <?php echo esc_html( $mh_business['founded'] ); ?> yılından beri
		<?php echo esc_html( $mh_business['service_area'] ); ?>'nda hidrofor, pompa, kazan, brülör ve kombi teknik servisi veriyor.
	</p>
</header>

<section class="section container">
	<div class="entry-content">

		<div>
			<h2>Kimiz?</h2>
			<p><?php echo esc_html( $mh_business['legal_name'] ); ?>, <?php echo esc_html( $mh_business['founded'] ); ?> yılında kurulmuş, <?php echo esc_html( $mh_business['experience'] ); ?> tecrübeye sahip bir teknik servis işletmesidir. <?php echo esc_html( $mh_business['service_area'] ); ?>'nda hidrofor ve ısıtma sistemlerinde bakım, arıza tespiti ve onarım hizmeti sunuyoruz.</p>
		</div>

		<div>
			<h2>Hizmetlerimiz</h2>
			<ul>
				<?php foreach ( $mh_business['services'] as $mh_service_name ) : ?>
					<li><?php echo esc_html( $mh_service_name ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div>
			<h2>Çalıştığımız Markalar</h2>
			<p><?php echo esc_html( implode( ', ', $mh_business['brands'] ) ); ?> markalarında teknik servis desteği veriyoruz.</p>
		</div>

		<div>
			<h2>Hizmet Bölgemiz</h2>
			<p><?php echo esc_html( $mh_business['service_area'] ); ?>, aralarında <?php echo esc_html( implode( ', ', $mh_business['service_districts'] ) ); ?>'nın da bulunduğu geniş bir hizmet ağına sahibiz. <?php echo esc_html( $mh_business['hours'] ); ?> hizmet veriyoruz.</p>
		</div>

		<?php merkez_hidrofor_related_services(); ?>
	</div>
</section>

<section class="section container">
	<div class="cta-band" data-reveal>
		<div class="cta-band__content">
			<p class="eyebrow"><?php esc_html_e( 'İletişim', 'merkez-hidrofor-child' ); ?></p>
			<h2><?php esc_html_e( 'Sorularınız İçin Bize Ulaşın', 'merkez-hidrofor-child' ); ?></h2>
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
