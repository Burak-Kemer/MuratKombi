<?php
/**
 * Template Name: İlçe Servisi
 *
 * Reusable template for the ~28 existing district pages (bahcelievler-,
 * avcilar-, bagcilar-wilo-hidrofor-servisi/ etc). Deliberately does NOT
 * generate unique per-district copy itself — that would risk exactly the
 * doorway/scaled-content-abuse pattern Google's spam policies flag ("Aynı
 * paragrafı tüm ilçelerde değiştirerek çoğaltma").
 *
 * Instead: the_title()/the_content() (the page's own, genuinely unique DB
 * content — written by the client per district) is the PRIMARY, most
 * prominent section. Everything below it (services list, brands, related
 * links, CTA) is legitimate shared site-wide boilerplate — the same kind of
 * repetition a footer has, not disguised thin content — sourced entirely
 * from inc/business-data.php, never duplicated as prose.
 *
 * The client assigns this later via Page Attributes on whichever district
 * pages they want it applied to; existing content/URLs are untouched.
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

<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>

	<header class="page-header container">
		<p class="eyebrow"><?php echo esc_html( $mh_business['service_area'] ); ?> · <?php echo esc_html( $mh_business['hours'] ); ?></p>
		<h1 class="page-header__title"><?php the_title(); ?></h1>
	</header>

	<section class="section container">
		<?php
		/*
		 * Unique district content lives here — this the_content() call renders
		 * whatever real, district-specific text the client writes for THIS page
		 * (currently placeholder/demo text on most district pages; intentionally
		 * left untouched per this phase's "don't rewrite district content yet"
		 * instruction). This is the part that must stay genuinely unique per page.
		 */
		?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</section>
<?php endwhile; ?>

<section class="section section--surface">
	<div class="container">
		<div class="section-head section-head--center" data-reveal>
			<p class="eyebrow"><?php esc_html_e( 'Hizmetlerimiz', 'merkez-hidrofor-child' ); ?></p>
			<h2><?php esc_html_e( 'Sunduğumuz Hizmetler', 'merkez-hidrofor-child' ); ?></h2>
		</div>
		<ul class="contact-services__list" data-reveal style="justify-content: center;">
			<?php foreach ( $mh_business['services'] as $mh_service_name ) : ?>
				<li><?php echo esc_html( $mh_service_name ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<section class="section container">
	<?php merkez_hidrofor_related_services(); ?>

	<div class="cta-band" data-reveal style="margin-top: var(--space-8);">
		<div class="cta-band__content">
			<p class="eyebrow"><?php esc_html_e( 'İletişim', 'merkez-hidrofor-child' ); ?></p>
			<h2><?php esc_html_e( 'Hemen Arayın, Yardımcı Olalım', 'merkez-hidrofor-child' ); ?></h2>
			<div class="cta-band__actions">
				<a href="<?php echo esc_url( $mh_call['href'] ); ?>" class="btn btn--danger"><?php esc_html_e( 'Hemen Ara', 'merkez-hidrofor-child' ); ?></a>
				<a href="<?php echo esc_url( $mh_whatsapp['href'] ); ?>" class="btn btn--secondary" target="_blank" rel="noopener"><?php esc_html_e( "WhatsApp'tan Ulaş", 'merkez-hidrofor-child' ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
