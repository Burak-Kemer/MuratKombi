<?php
/**
 * Template Name: Hizmetler
 *
 * The 5 service-detail blocks, ported from hizmetler.html. Intentionally a fixed layout (not
 * the_content()) — matches the static design reference's approach of short, generic, non-fabricated
 * service copy (P0-3: no invented technical claims for Otomasyon). Assign this template to the
 * site's "Hizmetler" page in the WordPress editor's Page Attributes panel.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$data = merkez_isi_get_business_data();

$services = array(
	array(
		'id'    => 'kombi',
		'title' => 'Kombi Servisi',
		'desc'  => 'Kombi arıza tespiti, periyodik bakım ve onarım desteği sunuyoruz. Marka ve modele özel detaylar görüşme sırasında netleştirilir.',
		'svg'   => '<path d="M12 2c1 3-3 4-3 8a3 3 0 0 0 6 0c0-1-1-2-1-2 1 3 3 3 3 6a5 5 0 0 1-10 0c0-5 5-6 5-12Z"/>',
	),
	array(
		'id'    => 'kazan',
		'title' => 'Kazan Sistemleri',
		'desc'  => 'Kazan sistemlerinde teknik inceleme, bakım ve onarım hizmeti veriyoruz. Kapsam, sistem tipine göre yerinde değerlendirilir.',
		'svg'   => '<rect x="7" y="4" width="10" height="16" rx="5"/><path d="M7 9h10"/><path d="M7 15h10"/>',
	),
	array(
		'id'    => 'hidrofor',
		'title' => 'Hidrofor Sistemleri',
		'desc'  => 'Hidrofor arıza tespiti, bakım ve kurulum desteği sağlıyoruz. Basınç ve debi sorunları yerinde incelenir.',
		'svg'   => '<circle cx="12" cy="9" r="4"/><path d="M12 5V3"/><rect x="8" y="13" width="8" height="7" rx="1.5"/>',
	),
	array(
		'id'    => 'dalgic-motorlari',
		'title' => 'Dalgıç Motorları',
		'desc'  => 'Dalgıç motor arıza tespiti ve teknik servis desteği veriyoruz. Kurulum ve bakım ihtiyaçlarınızı görüşme sonrası planlıyoruz.',
		'svg'   => '<rect x="9" y="3" width="6" height="10" rx="2"/><path d="M4 18c1.5-1.5 3-1.5 4.5 0s3 1.5 4.5 0 3-1.5 4.5 0 3 1.5 4.5 0"/>',
	),
	array(
		'id'    => 'otomasyon',
		'title' => 'Otomasyon Servisi',
		'desc'  => 'Isıtma ve su sistemlerinizde otomasyon kontrolü için teknik destek sunuyoruz. Sisteminize özel kapsam, iletişime geçtiğinizde birlikte netleştirilir.',
		'svg'   => '<rect x="4" y="5" width="16" height="14" rx="2"/><circle cx="9" cy="12" r="1.6"/><circle cx="15" cy="12" r="1.6"/><path d="M9 5v2"/><path d="M15 5v2"/>',
	),
);
?>

<?php
get_template_part(
	'template-parts/page-header',
	null,
	array(
		'eyebrow' => 'Hizmetlerimiz',
		'title'   => 'Kombi, Kazan, Hidrofor, Dalgıç Motoru ve Otomasyon Teknik Servisi',
		'lede'    => esc_html( $data['serviceArea'] ) . "'nda beş ana alanda " . esc_html( $data['hours'] ) . ' teknik destek sağlıyoruz. Sisteminize özel kapsam, iletişime geçtiğinizde birlikte netleştirilir.',
	)
);
?>

<section class="section container">
	<?php foreach ( $services as $service ) : ?>
	<div class="service-detail" id="<?php echo esc_attr( $service['id'] ); ?>" data-reveal>
		<span class="service-detail__icon" aria-hidden="true">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $service['svg']; // phpcs:ignore -- fixed inline SVG constants defined above ?></svg>
		</span>
		<div class="service-detail__body">
			<h2><?php echo esc_html( $service['title'] ); ?></h2>
			<p class="text-dim"><?php echo esc_html( $service['desc'] ); ?></p>
			<div class="service-detail__actions">
				<a href="<?php echo esc_url( $data['phones']['mobile']['href'] ); ?>" class="btn btn--danger">Şimdi Ara</a>
				<a href="<?php echo esc_url( $data['whatsapp']['href'] ); ?>" class="btn btn--secondary" target="_blank" rel="noopener">WhatsApp'tan Yaz</a>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</section>

<section class="section container">
	<?php get_template_part( 'template-parts/cta-band' ); ?>
</section>

<?php get_footer(); ?>
