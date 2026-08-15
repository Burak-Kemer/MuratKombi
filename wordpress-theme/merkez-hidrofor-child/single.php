<?php
/**
 * Minimal single-post fallback — covers the one migrated blog post the audit found
 * (/avcilar-hidrofor-servis/, see MURAT-KOMBI-SITE-AUDIT.md P0.5) if it's kept as a post rather
 * than 301-redirected into the matching district page. Same page-header + the_content() + CTA
 * band pattern as page.php, without the Hakkımızda-specific trust-bar branch.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'template-parts/page-header', null, array( 'eyebrow' => get_the_date() ) ); ?>

	<section class="section container">
		<div class="prose" data-reveal>
			<?php the_content(); ?>
		</div>
	</section>
<?php endwhile; ?>

<section class="section container">
	<?php get_template_part( 'template-parts/cta-band', null, array( 'heading' => 'Sorularınız İçin Bize Ulaşın' ) ); ?>
</section>

<?php get_footer(); ?>
