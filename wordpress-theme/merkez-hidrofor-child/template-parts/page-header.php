<?php
/**
 * Reusable page-header block (eyebrow + H1 + lede) — used by every template except front-page.php,
 * which has its own hero. Pass values via get_template_part( 'template-parts/page-header', null,
 * array( 'eyebrow' => ..., 'title' => ..., 'lede' => ... ) ).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$eyebrow = isset( $args['eyebrow'] ) ? $args['eyebrow'] : '';
$title   = isset( $args['title'] ) ? $args['title'] : get_the_title();
$lede    = isset( $args['lede'] ) ? $args['lede'] : '';
?>
<header class="page-header container">
	<?php if ( $eyebrow ) : ?>
		<p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
	<?php endif; ?>
	<h1 class="page-header__title"><?php echo esc_html( $title ); ?></h1>
	<?php if ( $lede ) : ?>
		<p class="page-header__lede"><?php echo esc_html( $lede ); ?></p>
	<?php endif; ?>
</header>
