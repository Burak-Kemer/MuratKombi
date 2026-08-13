<?php
/**
 * Archive template (category/tag/date/author archives).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<header class="page-header container">
	<p class="eyebrow"><?php esc_html_e( 'Arşiv', 'merkez-hidrofor-child' ); ?></p>
	<h1 class="page-header__title"><?php the_archive_title(); ?></h1>
	<?php if ( get_the_archive_description() ) : ?>
		<div class="page-header__lede"><?php echo wp_kses_post( get_the_archive_description() ); ?></div>
	<?php endif; ?>
</header>

<section class="section container">
	<?php if ( have_posts() ) : ?>
		<div class="archive-list">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article class="archive-card">
					<h2 class="archive-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="archive-card__meta"><?php echo esc_html( get_the_date() ); ?></p>
					<p class="archive-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
				</article>
				<?php
			endwhile;
			?>
		</div>

		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p class="search-no-results"><?php esc_html_e( 'Bu arşivde henüz içerik yok.', 'merkez-hidrofor-child' ); ?></p>
	<?php endif; ?>
</section>

<?php get_footer(); ?>
