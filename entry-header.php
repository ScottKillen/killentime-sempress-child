<?php defined('ABSPATH') || exit; ?>

<?php if (get_the_title()) : ?>
	<header class="entry-header">
		<?php
	if (is_home() && !in_array(get_post_format(), array('chat'))) {
			sempress_the_blog_cover();
		}
		?>
		<h1 class="entry-title p-name" itemprop="name headline"><a href="<?php the_permalink(); ?>" class="u-url url" title="<?php printf(esc_attr__('Permalink to %s', 'sempress'), the_title_attribute('echo=0')); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a></h1>

		<?php if ('post' === get_post_type()) : ?>
			<div class="entry-meta">
				<?php
			$show_reading_time = !in_array(get_post_format(), array('aside', 'audio', 'chat', 'gallery'));
				sempress_posted_on($show_reading_time);
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
<?php endif; ?>
<?php do_action('sempress_before_entry_content'); ?>
