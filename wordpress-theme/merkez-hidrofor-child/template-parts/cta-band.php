<?php
/**
 * Primary conversion block — call + WhatsApp + all 4 phone numbers, reused on every template.
 * Usage: get_template_part( 'template-parts/cta-band', null, array(
 *     'heading' => '...', 'lede' => '...' (optional)
 * ) );
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$heading = isset( $args['heading'] ) ? $args['heading'] : 'Hemen Arayın, Yardımcı Olalım';
$lede    = isset( $args['lede'] ) ? $args['lede'] : '';
$data    = merkez_isi_get_business_data();

$phone_icon = '<path d="M6.5 3h3l1.5 4-2 1.5a12 12 0 0 0 6 6l1.5-2 4 1.5v3a2 2 0 0 1-2 2C10.5 19 5 13.5 5 5.5A2 2 0 0 1 6.5 3Z"/>';
?>
<div class="cta-band" data-reveal>
	<div class="cta-band__content">
		<p class="eyebrow">İletişim</p>
		<h2><?php echo esc_html( $heading ); ?></h2>
		<?php if ( $lede ) : ?>
			<p class="text-dim"><?php echo esc_html( $lede ); ?></p>
		<?php endif; ?>
		<div class="cta-band__phones">
			<a href="<?php echo esc_url( $data['phones']['mobile']['href'] ); ?>" class="cta-band__phone">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $phone_icon; // phpcs:ignore ?></svg>
				<?php echo esc_html( $data['phones']['mobile']['number'] ); ?>
			</a>
			<?php foreach ( $data['phones']['landlines'] as $landline ) : ?>
			<a href="<?php echo esc_url( $landline['href'] ); ?>" class="cta-band__phone">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $phone_icon; // phpcs:ignore ?></svg>
				<?php echo esc_html( $landline['number'] ); ?>
			</a>
			<?php endforeach; ?>
		</div>
		<div class="cta-band__actions">
			<a href="<?php echo esc_url( $data['phones']['mobile']['href'] ); ?>" class="btn btn--danger">Şimdi Ara</a>
			<a href="<?php echo esc_url( $data['whatsapp']['href'] ); ?>" class="btn btn--secondary" target="_blank" rel="noopener">WhatsApp'tan Yaz</a>
		</div>
	</div>
</div>
