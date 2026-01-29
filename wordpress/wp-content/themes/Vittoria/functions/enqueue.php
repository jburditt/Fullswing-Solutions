<?php

function vittoria_fonts() {
	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style( 'vittoria-ptsans', "$protocol://fonts.googleapis.com/css?family=PT+Sans:400,700italic,700,400italic" );
	wp_enqueue_style( 'vittoria-cuprum', "$protocol://fonts.googleapis.com/css?family=Cuprum:400,700" );

}
add_action( 'wp_enqueue_scripts', 'vittoria_fonts' );

function vittoria_styles()
{
	wp_register_style( 'motioncss', get_template_directory_uri() . '/css/motioncss.css', array(), '1', 'all' );
	wp_register_style( 'motioncss-widgets', get_template_directory_uri() . '/css/motioncss-widgets.css', array(), '1', 'all' );
	wp_register_style( 'icons', get_template_directory_uri() . '/css/icons.css', array(), '1', 'all' );
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '1', 'all' );
	wp_register_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css', array(), '1', 'all' );
	wp_register_style( 'wp-widgets', get_template_directory_uri() . '/css/wp-widgets.css', array(), '1', 'all' );
	wp_register_style( 'style', get_template_directory_uri() . '/css/style.css', array(), '1', 'all' );
	wp_register_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array(), '1', 'all' );
	wp_register_style( 'animation', get_template_directory_uri() . '/css/animation.css', array(), '1', 'all' );

	wp_enqueue_style( 'motioncss' );
	wp_enqueue_style( 'motioncss-widgets' );
	wp_enqueue_style( 'icons' );
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'magnific-popup' );
	wp_enqueue_style( 'wp-widgets' );
	wp_enqueue_style( 'style' );
	wp_enqueue_style( 'responsive' );
	wp_enqueue_style( 'animation' );
}
add_action('wp_enqueue_scripts', 'vittoria_styles', 12);

function vittoria_jscripts()
{
	wp_deregister_script('jquery');
	wp_register_script('jquery', get_template_directory_uri().'/js/jquery-1.9.1.js', '', '1.9.1', TRUE);
	wp_register_script('g-alert', get_template_directory_uri().'/js/g-alert.js', array('jquery'), '');
	wp_register_script('carousello', get_template_directory_uri().'/js/jquery.carousello.js', array('jquery'), '', TRUE);
	wp_register_script('isotope', get_template_directory_uri().'/js/jquery.isotope.js', array('jquery'), '', TRUE);
	wp_register_script('magnific-popup', get_template_directory_uri().'/js/jquery.magnific-popup.js', array('jquery'), '', TRUE);
	wp_register_script('simpleplaceholder', get_template_directory_uri().'/js/jquery.simpleplaceholder.js', array('jquery'), '', TRUE);
	wp_register_script('w-search', get_template_directory_uri().'/js/w-search.js', array('jquery'), '', TRUE);
	wp_register_script('navToSelect', get_template_directory_uri().'/js/navToSelect.js', array('jquery'), '', TRUE);
	wp_register_script('tweet', get_template_directory_uri().'/js/jquery.tweet.js', array('jquery'), '', TRUE);
	wp_register_script('w-tabs', get_template_directory_uri().'/js/w-tabs.js', array('jquery'), '', TRUE);
	wp_register_script('w-timeline', get_template_directory_uri().'/js/w-timeline.js', array('jquery'), '', TRUE);
	wp_register_script('waypoints', get_template_directory_uri().'/js/waypoints.min.js', array('jquery'), '', TRUE);
	wp_register_script('flexslider', get_template_directory_uri().'/js/jquery.flexslider.js', array('jquery'), '', TRUE);
	wp_register_script('w-lang', get_template_directory_uri().'/js/w-lang.js', array('jquery'), '', TRUE);
	wp_register_script('plugins', get_template_directory_uri().'/js/plugins.js', array('jquery'), '', TRUE);
//	wp_register_script('', get_template_directory_uri().'/js/.js', array('jquery'), '');

	wp_enqueue_script('jquery');
	wp_enqueue_script('g-alert');
	wp_enqueue_script('carousello');
	wp_enqueue_script('isotope');
	wp_enqueue_script('magnific-popup');
	wp_enqueue_script('simpleplaceholder');
	wp_enqueue_script('w-search');
	wp_enqueue_script('navToSelect');
	wp_enqueue_script('tweet');
	wp_enqueue_script('w-tabs');
	wp_enqueue_script('w-timeline');
	wp_enqueue_script('waypoints');
	wp_enqueue_script('flexslider');
	wp_enqueue_script('w-lang');
	wp_enqueue_script('plugins');

}
add_action('wp_enqueue_scripts', 'vittoria_jscripts');