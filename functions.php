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

require_once 'dark-mode.php';
require_once 'icons.php';
