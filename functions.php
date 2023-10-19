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

/**
 * Display the blog cover image and author information for a post.
 *
 * This function checks if a post has a featured image and displays it as the blog cover.
 * If there is no featured image, it displays author information without a cover.
 */
function sempress_the_blog_cover()
{
  $thumbnail = get_the_post_thumbnail();

  if (!empty($thumbnail)) {
    // Display the blog cover with the featured image.
    $image = get_post_thumbnail_id();
    $image_src = wp_get_attachment_image_src($image, 'post-thumbnail');

    if ($image_src) {
      $image_url = $image_src[0];

?>
      <div class="blog-cover" style="background: url('<?php echo $image_url; ?>'); background-size: 100% auto">
      </div>
<?php
    }
  }
}

function sempress_customize_css()
{
  //Override the parent theme to remove custom colors
}

function custom_excerpt_more($more)
{
  global $post;
  return '…';
}
add_filter('excerpt_more', 'custom_excerpt_more');

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
 * Display post metadata including publication date, author information, and reading time.
 *
 * This function is used to generate HTML content for displaying various post metadata, including:
 * - Publication date
 * - Author information (optional)
 * - Estimated reading time (optional)
 *
 * @param bool $include_reading_time Whether to include estimated reading time (default is true).
 * @param bool $include_author       Whether to include author information (default is true).
 * @param bool $echo                 Whether to echo the generated content (default is true).
 *
 * @return string|null Generated HTML content if $echo is false, or null if $echo is true.
 */
function sempress_posted_on($include_reading_time = true, $include_author = true, $echo = true)
{
  $output = '<span class="sep"><svg class="bi"><title>Posted on</title><use xlink:href="#fa-calendar"/></svg> </span>';
  $output .= '<a href="' . esc_url(get_permalink()) . '" title="' . esc_attr(get_the_time()) . '" rel="bookmark" class="url u-url">';
  $output .= '<time class="entry-date updated published dt-updated dt-published" datetime="' . esc_attr(get_the_date('c')) . '" itemprop="dateModified datePublished">';
  $output .= esc_html(get_the_date()) . '</time></a>';

  if ($include_author) {
    $author_avatar = get_avatar(get_the_author_meta('ID'), 90);
    $author_url = esc_url(get_author_posts_url(get_the_author_meta('ID')));
    $author_name = esc_attr(sprintf(__('View all posts by %s', 'sempress'), get_the_author()));
    $author_display_name = esc_html(get_the_author());

    $output .= ' <svg class="bi"><use xlink:href="#fa-pipe" /></svg>';
    $output .= '<address class="byline"><span class="sep"><svg class="bi"><title>By</title><use xlink:href="#fa-user-large" /></svg></span>';
    $output .= '<span class="author p-author vcard hcard h-card" itemprop="author" itemscope itemtype="http://schema.org/Person">';
    $output .= $author_avatar . ' <a class="url uid u-url u-uid fn p-name" href="' . $author_url . '" title="' . $author_name . '" rel="author" itemprop="url">';
    $output .= '<span itemprop="name">' . $author_display_name . '</span></a></span></address>';
  }

  if ($include_reading_time) {
    $reading_time = esc_html(sempress_reading_time());
    $output .= ' <svg class="bi"><use xlink:href="#fa-pipe" /></svg>';
    $output .= '<span class="reading-time"><svg class="bi"><title>Reading time</title><use xlink:href="#fa-book-open-reader" /></svg> ' . $reading_time . '</span>';
  }

  if ($echo) {
    echo $output;
  } else {
    return $output;
  }
}

function get_first_image_id($post = null)
{
  $post = get_post($post);

  if (!$post) {
    return false;
  }

  $blocks = parse_blocks($post->post_content);

  $images = array_filter($blocks, function ($block) {
    return 'core/image' === $block['blockName'];
  });

  return count($images) > 0 ? $images[0]['attrs']['id'] : false;
}

function get_first_image_from_first_gallery($post_id = null)
{
  $post_id = get_post($post_id);
  $galleries = get_post_galleries($post_id, false);

  if (!empty($galleries)) {
    $first_gallery = reset($galleries);

    if (!empty($first_gallery)) {
      $image_ids = explode(',', $first_gallery['ids']);

      return empty($image_ids[0]) ? false : $image_ids[0];
    }
  }

  return false;
}

/**
 * Adds post-thumbnail support :)
 *
 * @since SemPress 1.0.0
 */
function child_the_post_thumbnail($before = '', $after = '')
{
  if ('' != get_the_post_thumbnail()) {
    $imageID = get_post_thumbnail_id();
  } else {
    $imageID = get_first_image_id();
  }

  if (!$imageID) {
    $imageID = get_first_image_from_first_gallery();
  }

  if (!$imageID) {
    return;
  }

  $image = wp_get_attachment_image_src($imageID, 'thumbnail');

  if (!$image) {
    return;
  }

  $class = 'photo';

  $post_format = get_post_format();

  // use `u-photo` on photo/gallery posts
  if (in_array($post_format, array('image', 'gallery'))) {
    $class .= ' u-photo';
  } else { // otherwise use `u-featured`
    $class .= ' u-featured';
  }

  echo $before;
  echo wp_get_attachment_image($imageID, 'thumbnail', false, array('class' => $class, 'itemprop' => 'image'));
  echo $after;
}

require_once 'dark-mode.php';
require_once 'icons.php';
