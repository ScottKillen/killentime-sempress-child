<?php
defined('ABSPATH') || exit;

/**
 * @package SemPress
 * @since SemPress 1.0.0
 */
?>

<article <?php sempress_post_id(); ?> <?php post_class(); ?><?php sempress_semantics('post'); ?>>
	<div class="entry-content e-content" itemprop="description articleBody">
		<?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'sempress')); ?>
	</div><!-- .entry-content -->

	<?php get_template_part('entry', 'footer'); ?>
</article><!-- #post-<?php the_ID(); ?> -->
