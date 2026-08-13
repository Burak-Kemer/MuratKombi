<?php
/**
 * Template Name: İletişim
 *
 * Optional template for the existing /iletisim-05398815892/ page. SEO intent:
 * "Merkez Hidrofor İletişim / 7/24 Servis". All contact panels read from
 * inc/business-data.php (single source of truth) — no hardcoded numbers here.
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
	<p class="eyebrow"><?php echo esc_html( $mh_business['hours'] ); ?> Servis</p>
	<h1 class="page-header__title">Bize Ulaşın</h1>
	<p class="page-header__lede">
		Hidrofor, pompa, kazan, brülör ve kombi ihtiyaçlarınız için telefon veya WhatsApp üzerinden <?php echo esc_html( $mh_business['hours'] ); ?> ulaşabilirsiniz.
	</p>
</header>

<section class="section container">
	<div class="contact-grid">
		<a href="<?php echo esc_url( $mh_whatsapp['href'] ); ?>" class="contact-panel contact-panel--accent" target="_blank" rel="noopener" data-reveal>
			<span class="contact-panel__icon" aria-hidden="true"><?php merkez_hidrofor_the_icon( 'whatsapp' ); ?></span>
			<span class="contact-panel__label">WhatsApp</span>
			<span class="contact-panel__value mono"><?php echo esc_html( $mh_whatsapp['label'] ); ?></span>
		</a>

		<a href="<?php echo esc_url( $mh_call['href'] ); ?>" class="contact-panel" data-reveal>
			<span class="contact-panel__icon" aria-hidden="true"><?php merkez_hidrofor_the_icon( 'phone' ); ?></span>
			<span class="contact-panel__label">Mobil</span>
			<span class="contact-panel__value mono"><?php echo esc_html( $mh_call['label'] ); ?></span>
		</a>

		<?php foreach ( $mh_business['phones'] as $mh_phone ) : ?>
			<a href="<?php echo esc_url( $mh_phone['href'] ); ?>" class="contact-panel" data-reveal>
				<span class="contact-panel__icon" aria-hidden="true"><?php merkez_hidrofor_the_icon( 'phone' ); ?></span>
				<span class="contact-panel__label">Sabit Hat</span>
				<span class="contact-panel__value mono"><?php echo esc_html( $mh_phone['label'] ); ?></span>
			</a>
		<?php endforeach; ?>
	</div>

	<div class="entry-content">
		<div>
			<h2>Adresimiz</h2>
			<p>
				<?php echo esc_html( $mh_business['address']['line1'] ); ?><br />
				<?php echo esc_html( $mh_business['address']['line2'] ); ?><br />
				<?php echo esc_html( $mh_business['address']['line3'] ); ?>
			</p>
			<?php
			// No Google Maps API key required — this is the public embed-without-key
			// format, built directly from the real, verified address (no invented
			// coordinates or place ID).
			$mh_map_query = sprintf(
				'%s, %s, %s',
				$mh_business['address']['line1'],
				$mh_business['address']['line2'],
				$mh_business['address']['line3']
			);
			?>
			<div class="map-embed">
				<iframe
					src="https://www.google.com/maps?q=<?php echo rawurlencode( $mh_map_query ); ?>&output=embed"
					loading="lazy"
					referrerpolicy="no-referrer-when-downgrade"
					title="<?php esc_attr_e( 'Merkez Hidrofor konum haritası', 'merkez-hidrofor-child' ); ?>"
				></iframe>
			</div>
		</div>

		<div>
			<h2>Çalışma Saatleri</h2>
			<p><?php echo esc_html( $mh_business['hours'] ); ?> hizmet veriyoruz.</p>
		</div>

		<div>
			<h2>Hizmet Bölgelerimiz</h2>
			<p><?php echo esc_html( implode( ', ', $mh_business['service_districts'] ) ); ?> dahil <?php echo esc_html( $mh_business['service_area'] ); ?> genelinde hizmet veriyoruz.</p>
		</div>

		<div class="contact-services" data-reveal>
			<p class="eyebrow"><?php esc_html_e( 'Hizmet Alanlarımız', 'merkez-hidrofor-child' ); ?></p>
			<ul class="contact-services__list">
				<?php foreach ( $mh_business['services'] as $mh_service_name ) : ?>
					<li><?php echo esc_html( $mh_service_name ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>

		<?php merkez_hidrofor_related_services(); ?>
	</div>
</section>

<?php get_footer(); ?>
