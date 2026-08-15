<?php
/**
 * Homepage — ported from the static design reference's index.html: hero (H1 = brand name per
 * audit P0.4's final recommendation, "Murat Kombi & Hidrofor..." was rejected — real brand is
 * "Merkez Isı Teknik Servis"), 5-item trust bar, 5 service cards, process steps, CTA band.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$data = merkez_isi_get_business_data();

$services = array(
	array(
		'anchor' => 'kombi',
		'title'  => 'Kombi Servisi',
		'desc'   => 'Kombi arıza tespiti, bakım ve onarım desteği için bize ulaşın.',
		'svg'    => '<path d="M12 2c1 3-3 4-3 8a3 3 0 0 0 6 0c0-1-1-2-1-2 1 3 3 3 3 6a5 5 0 0 1-10 0c0-5 5-6 5-12Z"/>',
	),
	array(
		'anchor' => 'kazan',
		'title'  => 'Kazan Sistemleri',
		'desc'   => 'Kazan sistemlerinde teknik inceleme ve bakım hizmeti sunuyoruz.',
		'svg'    => '<rect x="7" y="4" width="10" height="16" rx="5"/><path d="M7 9h10"/><path d="M7 15h10"/>',
	),
	array(
		'anchor' => 'hidrofor',
		'title'  => 'Hidrofor Sistemleri',
		'desc'   => 'Hidrofor arıza tespiti, bakım ve kurulum desteği sağlıyoruz.',
		'svg'    => '<circle cx="12" cy="9" r="4"/><path d="M12 5V3"/><rect x="8" y="13" width="8" height="7" rx="1.5"/>',
	),
	array(
		'anchor' => 'dalgic-motorlari',
		'title'  => 'Dalgıç Motorları',
		'desc'   => 'Dalgıç motor arıza tespiti ve teknik servis desteği veriyoruz.',
		'svg'    => '<rect x="9" y="3" width="6" height="10" rx="2"/><path d="M4 18c1.5-1.5 3-1.5 4.5 0s3 1.5 4.5 0 3-1.5 4.5 0 3 1.5 4.5 0"/>',
	),
	array(
		'anchor' => 'otomasyon',
		'title'  => 'Otomasyon Servisi',
		'desc'   => 'Isıtma ve su sistemlerinde otomasyon kontrolü için teknik destek sağlıyoruz.',
		'svg'    => '<rect x="4" y="5" width="16" height="14" rx="2"/><circle cx="9" cy="12" r="1.6"/><circle cx="15" cy="12" r="1.6"/><path d="M9 5v2"/><path d="M15 5v2"/>',
	),
);

$hizmetler_url = merkez_isi_page_url( 'hizmetler' );
?>

<section class="hero">
	<div class="hero__scene" aria-hidden="true">
		<div class="hero__scene-base"></div>
		<div class="hero__scene-grid"></div>
		<div class="hero__scrim"></div>
	</div>

	<div class="container hero__grid">
		<div class="hero__text">
			<p class="eyebrow"><?php echo esc_html( $data['serviceArea'] ); ?> · <?php echo esc_html( $data['hours'] ); ?> Teknik Servis</p>
			<h1 class="hero__title"><?php echo esc_html( $data['name'] ); ?></h1>
			<p class="hero__lede">Kombi, kazan, hidrofor, dalgıç motorları ve otomasyon hizmetlerinde <?php echo esc_html( $data['hours'] ); ?> teknik servis.</p>
			<div class="hero__actions">
				<a href="<?php echo esc_url( $data['phones']['mobile']['href'] ); ?>" class="btn btn--danger">
					<span class="btn__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3h3l1.5 4-2 1.5a12 12 0 0 0 6 6l1.5-2 4 1.5v3a2 2 0 0 1-2 2C10.5 19 5 13.5 5 5.5A2 2 0 0 1 6.5 3Z"/></svg></span>
					<span>Şimdi Ara</span>
				</a>
				<a href="<?php echo esc_url( $data['whatsapp']['href'] ); ?>" class="btn btn--secondary" target="_blank" rel="noopener">
					<span class="btn__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M21 11.5a8.5 8.5 0 0 1-8.5 8.5c-1.4 0-2.7-.3-3.9-.9L3 21l1.9-5.6A8.5 8.5 0 1 1 21 11.5Z"/></svg></span>
					<span>WhatsApp'tan Yaz</span>
				</a>
			</div>
		</div>

		<div class="hero__visual" aria-hidden="true">
			<picture>
				<source type="image/avif" srcset="<?php echo esc_url( MERKEZ_ISI_CHILD_URI . '/assets/images/hero/hero-photo.avif' ); ?>" />
				<source type="image/webp" srcset="<?php echo esc_url( MERKEZ_ISI_CHILD_URI . '/assets/images/hero/hero-photo.webp' ); ?>" />
				<img
					class="hero__illustration"
					src="<?php echo esc_url( MERKEZ_ISI_CHILD_URI . '/assets/images/hero/hero-photo.jpg' ); ?>"
					width="1376" height="768" alt="" fetchpriority="high" decoding="async"
				/>
			</picture>
		</div>
	</div>

	<div class="container hero__trust">
		<?php get_template_part( 'template-parts/trust-bar', null, array( 'variant' => 'services' ) ); ?>
	</div>
</section>

<section class="section container" id="hizmetler">
	<div class="section-head section-head--center" data-reveal>
		<p class="eyebrow">Hizmetlerimiz</p>
		<h2>Nerede Yardımcı Oluyoruz</h2>
		<p class="section-head__lede">Isınma ve su sistemlerinizde beş ana alanda teknik destek sağlıyoruz.</p>
	</div>
	<div class="grid grid--5">
		<?php foreach ( $services as $service ) : ?>
		<a href="<?php echo esc_url( $hizmetler_url . '#' . $service['anchor'] ); ?>" class="service-card" data-reveal>
			<span class="service-card__icon" aria-hidden="true">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $service['svg']; // phpcs:ignore -- fixed inline SVG constants defined above ?></svg>
			</span>
			<h3 class="service-card__title"><?php echo esc_html( $service['title'] ); ?></h3>
			<p class="service-card__desc"><?php echo esc_html( $service['desc'] ); ?></p>
			<span class="service-card__link">Detaylı Bilgi <span class="service-card__link-arrow" aria-hidden="true">→</span></span>
		</a>
		<?php endforeach; ?>
	</div>
</section>

<section class="section section--surface">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<p class="eyebrow">Nasıl Çalışıyoruz</p>
			<h2>Teknik Servis Süreci</h2>
		</div>
		<div class="process" data-reveal>
			<div class="process__step">
				<span class="process__number">01</span>
				<h3 class="process__title">Arayın</h3>
				<p class="process__desc">Telefon veya WhatsApp üzerinden bize ulaşın.</p>
			</div>
			<div class="process__step">
				<span class="process__number">02</span>
				<h3 class="process__title">Sorunu Anlatalım</h3>
				<p class="process__desc">Arızayı veya ihtiyacınızı kısaca aktarın.</p>
			</div>
			<div class="process__step">
				<span class="process__number">03</span>
				<h3 class="process__title">Teknik İnceleme</h3>
				<p class="process__desc">Sistem yerinde incelenerek değerlendirilir.</p>
			</div>
			<div class="process__step">
				<span class="process__number">04</span>
				<h3 class="process__title">Çözüm</h3>
				<p class="process__desc">Uygun bakım veya onarım çözümü uygulanır.</p>
			</div>
		</div>
	</div>
</section>

<section class="section container">
	<?php
	get_template_part(
		'template-parts/cta-band',
		null,
		array(
			'lede' => esc_html( $data['serviceArea'] ) . "'nda kombi, kazan, hidrofor, dalgıç motoru ve otomasyon ihtiyaçlarınız için " . esc_html( $data['hours'] ) . ' bize ulaşın.',
		)
	);
	?>
</section>

<?php get_footer(); ?>
