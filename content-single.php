<?php
defined('ABSPATH') || exit;

/**
 * @package SemPress
 * @since SemPress 1.0.0
 */
?>
<article <?php sempress_post_id(); ?> <?php post_class(); ?><?php sempress_semantics('post'); ?> itemref="site-publisher">
	<?php get_template_part('entry', 'header'); ?>

	<?php if (is_search() || is_home()) : // Only display Excerpts for Search
	?>
		<div class="entry-summary p-summary" itemprop="description">
			<?php custom_post_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<?php sempress_the_post_thumbnail('<div class="entry-media">', '</div>'); ?>
		<div class="entry-content e-content" itemprop="description articleBody">
			<?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'sempress')); ?>
			<?php wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'sempress'), 'after' => '</div>')); ?>
		</div><!-- .entry-content -->
	<?php endif; ?>

	<?php get_template_part('entry', 'footer'); ?>
</article><!-- #post-<?php the_ID(); ?> -->
