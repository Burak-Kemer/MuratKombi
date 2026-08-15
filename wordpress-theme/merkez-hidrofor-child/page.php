<?php
/**
 * Generic page template — used for EVERY existing WordPress page (hakkimizda-2,
 * markalar, iletisim-05398815892, all district "-wilo-hidrofor-servisi" pages,
 * sample-page, etc). Renders the real the_title()/the_content() of each page inside
 * the new design's chrome. Content is never hardcoded or rewritten here — whatever
 * is actually stored for that page (including old demo/Lorem Ipsum text) is what
 * renders, so no existing page loses its content.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$mh_business = merkez_hidrofor_business();
$mh_call     = $mh_business['primary_call'];
$mh_whatsapp = $mh_business['whatsapp'];
?>

<?php merkez_hidrofor_breadcrumbs(); ?>

<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>

	<header class="page-header container">
		<p class="eyebrow"><?php echo esc_html( $mh_business['name'] ); ?></p>
		<h1 class="page-header__title"><?php the_title(); ?></h1>
		<?php if ( has_excerpt() ) : ?>
			<p class="page-header__lede"><?php echo esc_html( get_the_excerpt() ); ?></p>
		<?php endif; ?>
	</header>

	<section class="section container">
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
			wp_link_pages(
				array(
					'before' => '<nav class="entry-content__pages">',
					'after'  => '</nav>',
				)
			);
			?>
		</div>

		<?php merkez_hidrofor_related_services( get_post_field( 'post_name' ) ); ?>
	</section>
<?php endwhile; ?>

<section class="section container">
	<div class="cta-band" data-reveal>
		<div class="cta-band__content">
			<p class="eyebrow"><?php esc_html_e( 'İletişim', 'merkez-hidrofor-child' ); ?></p>
			<h2><?php esc_html_e( 'Sorularınız İçin Bize Ulaşın', 'merkez-hidrofor-child' ); ?></h2>
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
