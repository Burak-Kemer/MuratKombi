<?php
/**
 * Template Name: İletişim
 *
 * Contact panels (mobile / 3 landlines / WhatsApp) + address/hours + service list, ported from
 * iletisim.html. Assign this template to the site's "İletişim" page in the WordPress editor's
 * Page Attributes panel.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$data = merkez_isi_get_business_data();
$phone_icon = '<path d="M6.5 3h3l1.5 4-2 1.5a12 12 0 0 0 6 6l1.5-2 4 1.5v3a2 2 0 0 1-2 2C10.5 19 5 13.5 5 5.5A2 2 0 0 1 6.5 3Z"/>';
?>

<?php
get_template_part(
	'template-parts/page-header',
	null,
	array(
		'eyebrow' => 'İletişim',
		'title'   => 'Bize Ulaşın',
		'lede'    => esc_html( $data['serviceArea'] ) . "'nda kombi, kazan, hidrofor, dalgıç motoru ve otomasyon ihtiyaçlarınız için " . esc_html( $data['hours'] ) . ' telefon veya WhatsApp üzerinden ulaşabilirsiniz.',
	)
);
?>

<section class="section container">
	<div class="contact-grid">
		<a href="<?php echo esc_url( $data['phones']['mobile']['href'] ); ?>" class="contact-panel" data-reveal>
			<span class="contact-panel__icon" aria-hidden="true">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $phone_icon; // phpcs:ignore ?></svg>
			</span>
			<span class="contact-panel__label">Mobil</span>
			<span class="contact-panel__value mono"><?php echo esc_html( $data['phones']['mobile']['number'] ); ?></span>
		</a>

		<div class="contact-panel" data-reveal>
			<span class="contact-panel__icon" aria-hidden="true">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $phone_icon; // phpcs:ignore ?></svg>
			</span>
			<span class="contact-panel__label">Sabit Hatlar</span>
			<div class="contact-panel__lines mono">
				<?php foreach ( $data['phones']['landlines'] as $landline ) : ?>
					<a href="<?php echo esc_url( $landline['href'] ); ?>" class="contact-panel__line"><?php echo esc_html( $landline['number'] ); ?></a>
				<?php endforeach; ?>
			</div>
		</div>

		<a href="<?php echo esc_url( $data['whatsapp']['href'] ); ?>" class="contact-panel contact-panel--accent" target="_blank" rel="noopener" data-reveal>
			<span class="contact-panel__icon" aria-hidden="true">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M21 11.5a8.5 8.5 0 0 1-8.5 8.5c-1.4 0-2.7-.3-3.9-.9L3 21l1.9-5.6A8.5 8.5 0 1 1 21 11.5Z"/></svg>
			</span>
			<span class="contact-panel__label">WhatsApp</span>
			<span class="contact-panel__value mono"><?php echo esc_html( $data['whatsapp']['number'] ); ?></span>
		</a>
	</div>

	<div class="contact-services" data-reveal>
		<p class="eyebrow">Adres ve Çalışma Saatleri</p>
		<p class="text-dim"><?php echo esc_html( $data['address']['line'] . ', ' . $data['address']['district'] . ' / ' . $data['address']['city'] ); ?></p>
		<p class="text-dim"><?php echo esc_html( $data['serviceArea'] ); ?>'nda <?php echo esc_html( $data['hours'] ); ?> hizmet veriyoruz.</p>
	</div>

	<div class="contact-services" data-reveal>
		<p class="eyebrow">Hizmet Alanlarımız</p>
		<ul class="contact-services__list">
			<?php foreach ( $data['services'] as $service ) : ?>
				<li><?php echo esc_html( $service ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<?php get_footer(); ?>
