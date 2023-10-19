<?php
defined('ABSPATH') || exit;
?>

<article <?php sempress_post_id(); ?> <?php post_class(); ?><?php sempress_semantics('post'); ?>>
	<?php get_template_part('entry', 'header'); ?>

	<div class="entry-content e-content" itemprop="articleBody description">
		<?php sempress_the_post_thumbnail('<p>', '</p>'); ?>
		<div class="chat-content">
			<?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'sempress')); ?>
		</div>
		<?php wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'sempress'), 'after' => '</div>')); ?>
	</div><!-- .entry-content -->
	<hr />

	<?php get_template_part('entry', 'footer'); ?>
</article><!-- #post-<?php the_ID(); ?> -->
