<?php
/**
 * Include all needed files
 */
/* Slightly Modified Options Framework */
require_once ('admin/index.php');
/* Admin specific functions */
require_once('functions/admin.php');
/* Load shortcodes */
require_once('functions/shortcodes.php');
require_once('functions/zilla-shortcodes/zilla-shortcodes.php');
/* Breadcrumbs function */
require_once('functions/breadcrumbs.php');
/* Custom Post types */
require_once('functions/post_types.php');
/* Meta Box plugin and settings */
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/vendor/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/vendor/meta-box' ) );
require_once RWMB_DIR . 'meta-box.php';
require_once('functions/meta-box_settings.php');
/* Menu and it's custom markup */
require_once('functions/menu.php');
/* Comments custom markup */
require_once('functions/comments.php');
/* wp_link_pages both next and numbers usage */
require_once('functions/link_pages.php');
/* Sidebars init */
require_once('functions/sidebars.php');
/* Sidebar generator */
require_once('vendor/sidebar_generator.php');
/* Plugins activation */
require_once('functions/plugin_activation.php');
/* CSS and JS enqueue */
require_once('functions/enqueue.php');
/* Widgets */
require_once('functions/widgets/contact.php');
require_once('functions/widgets/twitter.php');
add_filter('widget_text', 'do_shortcode');

require_once('functions/ajax_grid_blog.php');


/**
 * Theme Setup
 */
function vittoria_theme_setup()
{
	global $smof_data;

	/* Add post thumbnail functionality */
	add_theme_support('post-thumbnails');
	add_image_size('portfolio-list', 465, 465, true);
	add_image_size('blog-grid', 465, 0, false);
	add_image_size('blog-large', 940, 600, true);
	add_image_size('carousel-thumb', 336, 176, true);
	add_image_size('gallery-xs', 170, 170, true);
	add_image_size('gallery-s', 280, 280, true);
	add_image_size('gallery-m', 344, 344, true);
	add_image_size('gallery-l', 440, 440, true);
	add_image_size('gallery-masonry', 454, 0, false);

	/* hide admin bar */
//	show_admin_bar( false );

	/* Excerpt length */
	if (isset($smof_data['blog_excerpt_length']) AND $smof_data['blog_excerpt_length'] != 55) {
		add_filter( 'excerpt_length', 'vittoria_excerpt_length', 999 );
	}

	/* Remove [...] from excerpt */
	add_filter('excerpt_more', 'vittoria_excerpt_more');

	/* Theme localization */
	load_theme_textdomain( 'Vittoria', get_template_directory() . '/functions/languages' );
}

add_action( 'after_setup_theme', 'vittoria_theme_setup' );

function vittoria_excerpt_length( $length ) {
	global $smof_data;
	return $smof_data['blog_excerpt_length'];
}

function vittoria_excerpt_more( $more ) {
	return '';
}

/* Custom code goes below this line. */

/* Custom code goes above this line. */
