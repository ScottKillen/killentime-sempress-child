<?php
defined('ABSPATH') || exit;

/**
 * SemPress Child functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 */

add_action('wp_enqueue_scripts', 'sempress_child_enqueue_scripts');
function sempress_child_enqueue_scripts()
{
  $theme = wp_get_theme();

  wp_enqueue_script(
    'color-modes',
    get_stylesheet_directory_uri() . '/js/dark-mode-toggle.js',
    array(),
    $theme->get('Version'),
    true
  );

  $parent_handle = 'sempress-style';
  wp_enqueue_style(
    $parent_handle,
    get_template_directory_uri() . '/style.css',
    array(),  // If the parent theme code has a dependency, copy it to here.
    $theme->parent()->get('Version')
  );

  $child_handle = 'child-style';
  wp_enqueue_style(
    $child_handle,
    get_stylesheet_uri(),
    array($parent_handle),
    $theme->get('Version')
  );

  wp_enqueue_style(
    'dark-mode-toggle-style',
    get_theme_file_uri('/css/dark-mode-toggle.css'),
    array($parent_handle),
    $theme->get('Version')
  );

  wp_enqueue_style(
    'typography-style',
    get_theme_file_uri('/css/typography.css'),
    array($child_handle),
    $theme->get('Version')
  );

  $colors_handle = 'colors-style';
  wp_enqueue_style(
    $colors_handle,
    get_theme_file_uri('/css/colors.css'),
    array($child_handle),
    $theme->get('Version')
  );

  wp_enqueue_style(
    'utilities-style',
    get_theme_file_uri('/css/utilities.css'),
    array($colors_handle),
    $theme->get('Version')
  );

  wp_enqueue_style(
    'callouts-style',
    get_theme_file_uri('/css/callouts.css'),
    array($colors_handle),
    $theme->get('Version')
  );
}

function sempress_customize_css()
{
  //Override the parent theme to remove custom colors
}

function custom_post_excerpt($post_id = null)
{
  if ($post_id === null) {
    $post_id = get_the_ID(); // Get the current post ID in the loop
  }

  $post = get_post($post_id);

  // Check if a manual excerpt is set
  $manual_excerpt = get_post_meta($post->ID, '_excerpt', true);

  if (!empty($manual_excerpt)) {
    echo '<p>' . $manual_excerpt . '</p>';
  } else {
    // If no manual excerpt, check for "more" tag
    $content = $post->post_content;
    $more_position = strpos($content, '<!--more-->');

    if ($more_position !== false) {
      // Display content up to the "more" tag
      echo substr($content, 0, $more_position);
    } else {
      // If neither manual excerpt nor "more" tag, display default excerpt
      $default_excerpt = get_the_excerpt();
      echo '<p>' . $default_excerpt . '</p>';
    }
  }

  echo '<a href="' . esc_url(get_permalink(($post->ID))) . '" class="u-url more-link icon-link gap-1 icon-link-hover">Continue reading...<svg class="bi"><use xlink:href="#fa-chevron-right"/></svg></a>';
}

function sempress_reading_time()
{
  // Getting the post content and stripping HTML tags
  $content = strip_tags(get_the_content());
  $content = html_entity_decode($content);

  // Getting the number of words in the content
  $word_count = str_word_count($content);

  // Calculate the estimated reading time, considering 200 words per minute
  $reading_time_minutes = ceil($word_count / 200);

  // Determine the reading time string
  if ($reading_time_minutes < 1) {
    $reading_time = "Less than a minute";
  } elseif ($reading_time_minutes === 1) {
    $reading_time = "1 minute";
  } else {
    $reading_time = $reading_time_minutes . " minutes";
  }
  return $reading_time;
}


/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function sempress_posted_on()
{
  printf(
    '<span class="sep"><svg class="bi"><title>Posted on</title><use xlink:href="#fa-calendar"/></svg> </span><a href="%1$s" title="%2$s" rel="bookmark" class="url u-url"><time class="entry-date updated published dt-updated dt-published" datetime="%3$s" itemprop="dateModified datePublished">%4$s</time></a>',
    esc_url(get_permalink()),
    esc_attr(get_the_time()),
    esc_attr(get_the_date('c')),
    esc_html(get_the_date()),
  );

  if (!in_array(get_post_format(), array('aside'))) {

    printf(
      ' <svg class="bi"><use xlink:href="#fa-pipe" /></svg> <address class="byline"> <span class="sep"><svg class="bi"><title>By</title><use xlink:href="#fa-user-large" /></svg></span> <span class="author p-author vcard hcard h-card" itemprop="author " itemscope itemtype="http://schema.org/Person">%1$s <a class="url uid u-url u-uid fn p-name" href="%2$s" title="%3$s" rel="author" itemprop="url"><span itemprop="name">%4$s</span></a></span></address>',
      get_avatar(get_the_author_meta('ID'), 90),
      esc_url(get_author_posts_url(get_the_author_meta('ID'))),
      esc_attr(sprintf(__('View all posts by %s', 'sempress'), get_the_author())),
      esc_html(get_the_author())
    );
  }

  if (!in_array(get_post_format(), array('aside'))) {
    printf(
      ' <svg class="bi"><use xlink:href="#fa-pipe" /></svg> <span class="reading-time"><svg class="bi"><title>Reading time</title><use xlink:href="#fa-book-open-reader" /></svg> %1$s</span>',
      esc_html(sempress_reading_time())
    );
  }
}

require_once 'dark-mode.php';
require_once 'icons.php';
