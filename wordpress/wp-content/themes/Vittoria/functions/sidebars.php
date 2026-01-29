<?php
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => __('Default Sidebar', 'Vittoria'),
		'id' => 'default_sidebar',
		'description' => esc_html__('This is the default sidebar. You can choose from the theme\'s options page where the widgets from this sidebar will be shown.', 'Vittoria'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('Footer First Widget', 'Vittoria'),
		'id' => 'footer_first',
		'description' => esc_html__('Placeholder for First Footer Widget.', 'Vittoria'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('Footer Second Widget', 'Vittoria'),
		'id' => 'footer_second',
		'description' => esc_html__('Placeholder for Second Footer Widget.', 'Vittoria'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('Footer Third Widget', 'Vittoria'),
		'id' => 'footer_third',
		'description' => esc_html__('Placeholder for Third Footer Widget.', 'Vittoria'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));
}