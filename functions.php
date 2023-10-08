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

  $parenthandle = 'sempress-style';
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
    $theme->get('Version')
  );
  wp_enqueue_style(
    'dark-mode-toggle',
    get_stylesheet_directory_uri() . '/css/dark-mode-toggle.css',
    array($parenthandle),
    $theme->get('Version')
  );
}

add_action('dark_mode_toggle', 'dark_mode_toggle');
function dark_mode_toggle()
{
?>
  <label class="theme-toggle" title="Toggle theme">
    <input type="checkbox" id="darkModeToggle">
    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="1em" height="1em" fill="currentColor" class="theme-toggle__expand" viewBox="0 0 32 32">
      <clipPath id="theme-toggle__expand__cutout">
        <path d="M0-11h25a1 1 0 0017 13v30H0Z" />
      </clipPath>
      <g clip-path="url(#theme-toggle__expand__cutout)">
        <circle cx="16" cy="16" r="8.4" />
        <path d="M18.3 3.2c0 1.3-1 2.3-2.3 2.3s-2.3-1-2.3-2.3S14.7.9 16 .9s2.3 1 2.3 2.3zm-4.6 25.6c0-1.3 1-2.3 2.3-2.3s2.3 1 2.3 2.3-1 2.3-2.3 2.3-2.3-1-2.3-2.3zm15.1-10.5c-1.3 0-2.3-1-2.3-2.3s1-2.3 2.3-2.3 2.3 1 2.3 2.3-1 2.3-2.3 2.3zM3.2 13.7c1.3 0 2.3 1 2.3 2.3s-1 2.3-2.3 2.3S.9 17.3.9 16s1-2.3 2.3-2.3zm5.8-7C9 7.9 7.9 9 6.7 9S4.4 8 4.4 6.7s1-2.3 2.3-2.3S9 5.4 9 6.7zm16.3 21c-1.3 0-2.3-1-2.3-2.3s1-2.3 2.3-2.3 2.3 1 2.3 2.3-1 2.3-2.3 2.3zm2.4-21c0 1.3-1 2.3-2.3 2.3S23 7.9 23 6.7s1-2.3 2.3-2.3 2.4 1 2.4 2.3zM6.7 23C8 23 9 24 9 25.3s-1 2.3-2.3 2.3-2.3-1-2.3-2.3 1-2.3 2.3-2.3z" />
      </g>
    </svg>
  </label>
<?php
}
