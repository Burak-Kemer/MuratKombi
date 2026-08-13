<?php
/**
 * Search results template.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<header class="page-header container">
	<p class="eyebrow"><?php esc_html_e( 'Arama', 'merkez-hidrofor-child' ); ?></p>
	<h1 class="page-header__title">
		<?php
		printf(
			/* translators: %s: search query */
			esc_html__( '"%s" için arama sonuçları', 'merkez-hidrofor-child' ),
			esc_html( get_search_query() )
		);
		?>
	</h1>
</header>

<section class="section container">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label class="visually-hidden" for="mh-search-input"><?php esc_html_e( 'Ara', 'merkez-hidrofor-child' ); ?></label>
		<input
			type="search"
			id="mh-search-input"
			class="search-form__input"
			placeholder="<?php esc_attr_e( 'Ne arıyorsunuz?', 'merkez-hidrofor-child' ); ?>"
			value="<?php echo esc_attr( get_search_query() ); ?>"
			name="s"
		/>
		<button type="submit" class="btn btn--danger"><?php esc_html_e( 'Ara', 'merkez-hidrofor-child' ); ?></button>
	</form>

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
	<?php else : ?>
		<p class="search-no-results"><?php esc_html_e( 'Aramanızla eşleşen bir sonuç bulunamadı.', 'merkez-hidrofor-child' ); ?></p>
	<?php endif; ?>
</section>

<?php get_footer(); ?>
