<?php
defined('ABSPATH') || exit;

/**
 * @package SemPress
 * @since SemPress 1.0.0
 */
?>

<article <?php sempress_post_id(); ?> <?php post_class(); ?><?php sempress_semantics('post'); ?>>
	<div class="entry-content e-content d-flex flex-row" itemprop="description articleBody">
		<div class="icon">
			<svg class="bi">
				<use xlink:href="#fa-volume" />
			</svg>
		</div />
		<div class="audio">
			<?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'sempress')); ?>
		</div>
	</div><!-- .entry-content -->

	<?php get_template_part('entry', 'footer'); ?>
</article><!-- #post-<?php the_ID(); ?> -->
