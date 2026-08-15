<?php
/**
 * Generic page template — page-header (from the post title/excerpt) + the_content(), so real
 * migrated WordPress content (e.g. the /hidrofor-servisi/ pillar page, district pages — see
 * MURAT-KOMBI-SITE-AUDIT.md P0.5 URL/301 table) renders through the new design without this theme
 * needing to hardcode or re-type that content anywhere. Ends with the shared CTA band.
 *
 * The Hakkımızda page additionally gets the two trust-bar strips (2001/25+ yıl/7-24/Avrupa Yakası
 * + the 5 service icons) between the header and the_content(), matching hakkimizda.html in the
 * static design reference — this is the one page-specific exception in an otherwise generic file.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$data       = merkez_isi_get_business_data();
$is_about   = is_page( 'hakkimizda' );
?>

<?php
get_template_part(
	'template-parts/page-header',
	null,
	array(
		'eyebrow' => get_the_title(),
		'title'   => $is_about
			? $data['founded'] . "'den Bu Yana Isınma ve Su Sistemlerinde Teknik Servis"
			: get_the_title(),
		'lede'    => $is_about
			? $data['name'] . ', ' . $data['founded'] . ' yılından bu yana ' . $data['experience'] . ' tecrübeyle ' . $data['serviceArea'] . "'nda kombi, kazan, hidrofor, dalgıç motoru ve otomasyon alanlarında " . $data['hours'] . ' teknik servis hizmeti sunuyor.'
			: '',
	)
);
?>

<?php if ( $is_about ) : ?>
	<section class="section container">
		<div class="section-head" data-reveal>
			<p class="eyebrow">Neden Biz</p>
			<h2>Güven Verdiğimiz Noktalar</h2>
		</div>
		<?php get_template_part( 'template-parts/trust-bar', null, array( 'variant' => 'trust' ) ); ?>
	</section>

	<section class="section container">
		<div class="section-head" data-reveal>
			<p class="eyebrow">Çalışma Alanlarımız</p>
			<h2>Neyle İlgileniyoruz</h2>
		</div>
		<?php get_template_part( 'template-parts/trust-bar', null, array( 'variant' => 'services' ) ); ?>
	</section>
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php if ( get_the_content() ) : ?>
		<section class="section container">
			<div class="prose" data-reveal>
				<?php the_content(); ?>
			</div>
		</section>
	<?php endif; ?>
<?php endwhile; ?>

<section class="section container">
	<?php get_template_part( 'template-parts/cta-band', null, array( 'heading' => 'Sorularınız İçin Bize Ulaşın' ) ); ?>
</section>

<?php get_footer(); ?>
