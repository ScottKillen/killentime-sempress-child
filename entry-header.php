<?php defined('ABSPATH') || exit; ?>

<?php if (get_the_title()) : ?>
	<header class="entry-header">
		<?php $before = ('aside' === get_post_format()) ? '<span class="announcement">Announcement: </span>' : ''; ?>
		<h1 class="entry-title p-name" itemprop="name headline"><a href="<?php the_permalink(); ?>" class="u-url url" title="<?php printf(esc_attr__('Permalink to %s', 'sempress'), the_title_attribute('echo=0')); ?>" rel="bookmark" itemprop="url">
				<?php
				echo $before;
				the_title();
				?>
			</a></h1>
		<div class="entry-meta">
			<?php sempress_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
<?php endif; ?>
<?php do_action('sempress_before_entry_content'); ?>
