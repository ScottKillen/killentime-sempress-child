<?php
defined('ABSPATH') || exit;
?>

<article <?php sempress_post_id(); ?> <?php post_class(); ?><?php sempress_semantics('post'); ?>>
	<?php get_template_part('entry', 'header'); ?>

	<?php if (is_search()) : // Only display Excerpts for search pages
	?>
		<div class="entry-summary p-summary" itemprop="description">
			<?php custom_post_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="entry-content e-content" itemprop="description">
			<?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'sempress')); ?>
			<?php wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'sempress') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
		</div><!-- .entry-content -->
	<?php endif; ?>
	<hr />

	<?php get_template_part('entry', 'footer'); ?>
</article><!-- #post-<?php the_ID(); ?> -->
