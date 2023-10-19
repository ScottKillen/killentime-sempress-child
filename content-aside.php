<?php
defined('ABSPATH') || exit;
?>

<article <?php sempress_post_id(); ?> <?php post_class(); ?><?php sempress_semantics('post'); ?>>
	<?php get_template_part('entry', 'header'); ?>

	<?php
	if (is_search()) : // Only display Excerpts for search pages
	?>
		<div class="entry-summary p-summary entry-title p-name" itemprop="name description">
			<?php custom_post_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="entry-content e-content p-summary entry-title p-name" itemprop="name headline description articleBody">
			<?php if (is_single()) { ?>
				<div class="entry-media">
					<?php sempress_the_post_thumbnail('<p>', '</p>'); ?>
				</div>
			<?php } ?>
			<?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'sempress')); ?>
			<?php wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'sempress'), 'after' => '</div>')); ?>
		</div><!-- .entry-content -->
	<?php
	endif;
	?>
	<hr />

	<?php get_template_part('entry', 'footer'); ?>
</article><!-- #post-<?php the_ID(); ?> -->
