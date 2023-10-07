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
  $parenthandle = 'sempress-style';
  $theme        = wp_get_theme();
  wp_enqueue_style(
    $parenthandle,
    get_template_directory_uri() . '/style.css',
    array(),  // If the parent theme code has a dependency, copy it to here.
    $theme->parent()->get('Version')
  );
  wp_enqueue_style(
    'child-style',
    get_stylesheet_uri(),
    array($parenthandle),
    $theme->get('Version') // This only works if you have Version defined in the style header.
  );
}
