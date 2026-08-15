<?php
/**
 * Two fixed variants, matching the static design reference exactly:
 *   'services' — the 5 service icons (Kombi/Kazan/Hidrofor/Dalgıç Motorları/Otomasyon)
 *   'trust'    — the 5 trust signals (2001'den Beri/25+ Yıl/7-24/Avrupa Yakası/Profesyonel)
 * Usage: get_template_part( 'template-parts/trust-bar', null, array( 'variant' => 'services' ) );
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$variant = isset( $args['variant'] ) ? $args['variant'] : 'services';
$data    = merkez_isi_get_business_data();

if ( 'trust' === $variant ) {
	$items = array(
		array(
			'label' => esc_html( $data['founded'] ) . "'den Beri",
			'svg'   => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		),
		array(
			'label' => esc_html( $data['experience'] ) . ' Tecrübe',
			'svg'   => '<path d="M8 3v3M16 3v3M4 8h16M5 6h14a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1Z"/><path d="M9 13l2 2 4-4"/>',
		),
		array(
			'label' => esc_html( $data['hours'] ) . ' Hizmet',
			'svg'   => '<circle cx="12" cy="12" r="9"/><path d="M12 6v6l4 2"/>',
		),
		array(
			'label' => esc_html( $data['serviceArea'] ),
			'svg'   => '<path d="M12 21s-7-5.2-7-11a7 7 0 0 1 14 0c0 5.8-7 11-7 11Z"/><circle cx="12" cy="10" r="2.4"/>',
		),
		array(
			'label' => 'Profesyonel Teknik Servis',
			'svg'   => '<path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="9"/>',
		),
	);
} else {
	$items = array(
		array( 'label' => 'Kombi', 'svg' => '<path d="M12 2c1 3-3 4-3 8a3 3 0 0 0 6 0c0-1-1-2-1-2 1 3 3 3 3 6a5 5 0 0 1-10 0c0-5 5-6 5-12Z"/>' ),
		array( 'label' => 'Kazan', 'svg' => '<rect x="7" y="4" width="10" height="16" rx="5"/><path d="M7 9h10"/><path d="M7 15h10"/>' ),
		array( 'label' => 'Hidrofor', 'svg' => '<circle cx="12" cy="9" r="4"/><path d="M12 5V3"/><rect x="8" y="13" width="8" height="7" rx="1.5"/>' ),
		array( 'label' => 'Dalgıç Motorları', 'svg' => '<rect x="9" y="3" width="6" height="10" rx="2"/><path d="M4 18c1.5-1.5 3-1.5 4.5 0s3 1.5 4.5 0 3-1.5 4.5 0 3 1.5 4.5 0"/>' ),
		array( 'label' => 'Otomasyon', 'svg' => '<rect x="4" y="5" width="16" height="14" rx="2"/><circle cx="9" cy="12" r="1.6"/><circle cx="15" cy="12" r="1.6"/><path d="M9 5v2"/><path d="M15 5v2"/>' ),
	);
}
?>
<ul class="trust-bar" data-reveal>
	<?php foreach ( $items as $item ) : ?>
	<li class="trust-bar__item">
		<span class="trust-bar__icon" aria-hidden="true">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $item['svg']; // phpcs:ignore -- fixed inline SVG constants defined above, not user input ?></svg>
		</span>
		<span class="trust-bar__title"><?php echo esc_html( $item['label'] ); ?></span>
	</li>
	<?php endforeach; ?>
</ul>
