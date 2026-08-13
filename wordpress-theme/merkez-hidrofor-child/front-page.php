<?php
/**
 * Front page template — converted from the MuratKombi static index.html.
 * The WP front page object's own the_content() is intentionally not dumped here:
 * it currently holds no real editorial content, so this stays a hand-built landing
 * page (hero, services, process, CTA) driven by inc/business-data.php instead.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$mh_business = merkez_hidrofor_business();
$mh_call     = $mh_business['primary_call'];
$mh_whatsapp = $mh_business['whatsapp'];

$mh_home_services = array(
	array(
		'icon'  => 'hidrofor',
		'title' => 'Hidrofor Servisi',
		'desc'  => 'Hidrofor arıza tespiti, bakım ve kurulum desteği sağlıyoruz.',
	),
	array(
		'icon'  => 'dalgic',
		'title' => 'Pompa Servisi',
		'desc'  => 'Pompa bakım ve onarımında yerinde teknik destek veriyoruz.',
	),
	array(
		'icon'  => 'kazan',
		'title' => 'Kazan Servisi',
		'desc'  => 'Kazan sistemlerinde teknik inceleme ve bakım hizmeti sunuyoruz.',
	),
	array(
		'icon'  => 'kombi',
		'title' => 'Kombi Servisi',
		'desc'  => 'Kombi arıza tespiti, bakım ve onarım desteği için bize ulaşın.',
	),
);
?>

<section class="hero">
	<div class="hero__scene" aria-hidden="true">
		<div class="hero__scene-base"></div>
		<div class="hero__scene-grid"></div>
		<div class="hero__scrim"></div>
	</div>

	<div class="container hero__grid">
		<div class="hero__text">
			<p class="eyebrow"><?php echo esc_html( $mh_business['name'] ); ?> · <?php echo esc_html( $mh_business['founded'] ); ?>'den Beri Teknik Servis</p>
			<h1 class="hero__title">Hidrofor, Pompa ve Isıtma Sistemlerinde Güvenilir Teknik Çözüm.</h1>
			<p class="hero__lede">
				<?php echo esc_html( $mh_business['service_area'] ); ?>'nda <?php echo esc_html( $mh_business['experience'] ); ?> tecrübeyle,
				<?php echo esc_html( $mh_business['hours'] ); ?> hidrofor, pompa, kazan, brülör ve kombi teknik servisi.
			</p>
			<div class="hero__actions">
				<a href="<?php echo esc_url( $mh_call['href'] ); ?>" class="btn btn--danger">
					<span class="btn__icon" aria-hidden="true"><?php merkez_hidrofor_the_icon( 'phone' ); ?></span>
					<span><?php esc_html_e( 'Hemen Ara', 'merkez-hidrofor-child' ); ?></span>
				</a>
				<a href="<?php echo esc_url( $mh_whatsapp['href'] ); ?>" class="btn btn--secondary" target="_blank" rel="noopener">
					<span class="btn__icon" aria-hidden="true"><?php merkez_hidrofor_the_icon( 'whatsapp' ); ?></span>
					<span><?php esc_html_e( "WhatsApp'tan Ulaş", 'merkez-hidrofor-child' ); ?></span>
				</a>
			</div>
		</div>

		<div class="hero__visual" aria-hidden="true">
			<picture>
				<source type="image/avif" srcset="<?php echo esc_url( MERKEZ_HIDROFOR_URI . '/assets/images/hero/hero-photo.avif' ); ?>" />
				<source type="image/webp" srcset="<?php echo esc_url( MERKEZ_HIDROFOR_URI . '/assets/images/hero/hero-photo.webp' ); ?>" />
				<img
					class="hero__illustration"
					src="<?php echo esc_url( MERKEZ_HIDROFOR_URI . '/assets/images/hero/hero-photo.jpg' ); ?>"
					width="1376"
					height="768"
					alt=""
					fetchpriority="high"
					decoding="async"
				/>
			</picture>
		</div>
	</div>

	<div class="container hero__trust">
		<ul class="trust-bar">
			<?php foreach ( $mh_home_services as $mh_service ) : ?>
				<li class="trust-bar__item">
					<span class="trust-bar__icon" aria-hidden="true"><?php merkez_hidrofor_the_icon( $mh_service['icon'] ); ?></span>
					<span class="trust-bar__title"><?php echo esc_html( $mh_service['title'] ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<section class="section container" id="hizmetler">
	<div class="section-head section-head--center" data-reveal>
		<p class="eyebrow"><?php esc_html_e( 'Hizmetlerimiz', 'merkez-hidrofor-child' ); ?></p>
		<h2><?php esc_html_e( 'Nerede Yardımcı Oluyoruz', 'merkez-hidrofor-child' ); ?></h2>
		<p class="section-head__lede"><?php echo esc_html( $mh_business['service_area'] ); ?>'nda hidrofor, pompa, ısıtma ve beyaz eşya sistemlerinde teknik destek sağlıyoruz.</p>
	</div>
	<div class="grid grid--4">
		<?php foreach ( $mh_home_services as $mh_service ) : ?>
			<div class="service-card" data-reveal>
				<span class="service-card__icon" aria-hidden="true"><?php merkez_hidrofor_the_icon( $mh_service['icon'] ); ?></span>
				<h3 class="service-card__title"><?php echo esc_html( $mh_service['title'] ); ?></h3>
				<p class="service-card__desc"><?php echo esc_html( $mh_service['desc'] ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>

	<div class="contact-services" data-reveal style="margin-top: var(--space-8); border-top: none; padding-top: 0;">
		<p class="eyebrow"><?php esc_html_e( 'Tüm Hizmet Alanlarımız', 'merkez-hidrofor-child' ); ?></p>
		<ul class="contact-services__list">
			<?php foreach ( $mh_business['services'] as $mh_service_name ) : ?>
				<li><?php echo esc_html( $mh_service_name ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<section class="section section--surface">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<p class="eyebrow"><?php esc_html_e( 'Çalıştığımız Markalar', 'merkez-hidrofor-child' ); ?></p>
			<h2><?php esc_html_e( 'Güvenilir Marka Desteği', 'merkez-hidrofor-child' ); ?></h2>
		</div>
		<ul class="contact-services__list" data-reveal style="justify-content: center;">
			<?php foreach ( $mh_business['brands'] as $mh_brand ) : ?>
				<li><?php echo esc_html( $mh_brand ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<section class="section section--surface">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<p class="eyebrow"><?php esc_html_e( 'Nasıl Çalışıyoruz', 'merkez-hidrofor-child' ); ?></p>
			<h2><?php esc_html_e( 'Teknik Servis Süreci', 'merkez-hidrofor-child' ); ?></h2>
		</div>
		<div class="process" data-reveal>
			<div class="process__step">
				<span class="process__number">01</span>
				<h3 class="process__title"><?php esc_html_e( 'Arayın', 'merkez-hidrofor-child' ); ?></h3>
				<p class="process__desc"><?php esc_html_e( 'Telefon veya WhatsApp üzerinden bize ulaşın.', 'merkez-hidrofor-child' ); ?></p>
			</div>
			<div class="process__step">
				<span class="process__number">02</span>
				<h3 class="process__title"><?php esc_html_e( 'Sorunu Anlatalım', 'merkez-hidrofor-child' ); ?></h3>
				<p class="process__desc"><?php esc_html_e( 'Arızayı veya ihtiyacınızı kısaca aktarın.', 'merkez-hidrofor-child' ); ?></p>
			</div>
			<div class="process__step">
				<span class="process__number">03</span>
				<h3 class="process__title"><?php esc_html_e( 'Teknik İnceleme', 'merkez-hidrofor-child' ); ?></h3>
				<p class="process__desc"><?php esc_html_e( 'Sistem yerinde incelenerek değerlendirilir.', 'merkez-hidrofor-child' ); ?></p>
			</div>
			<div class="process__step">
				<span class="process__number">04</span>
				<h3 class="process__title"><?php esc_html_e( 'Çözüm', 'merkez-hidrofor-child' ); ?></h3>
				<p class="process__desc"><?php esc_html_e( 'Uygun bakım veya onarım çözümü uygulanır.', 'merkez-hidrofor-child' ); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="section container">
	<div class="cta-band" data-reveal>
		<div class="cta-band__content">
			<p class="eyebrow"><?php esc_html_e( 'İletişim', 'merkez-hidrofor-child' ); ?></p>
			<h2><?php esc_html_e( 'Hemen Arayın, Yardımcı Olalım', 'merkez-hidrofor-child' ); ?></h2>
			<p class="text-dim"><?php echo esc_html( $mh_business['address']['line3'] ); ?> — <?php echo esc_html( $mh_business['hours'] ); ?> hizmetinizdeyiz.</p>
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
