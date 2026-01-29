<?php

$prefix = 'vittoria_';

$slider_revolution = array();
$slider_revolution[0] = 'No Slider';

if(class_exists('RevSlider')){
	$slider = new RevSlider();
	$arrSliders = $slider->getArrSliders();
	foreach($arrSliders as $revSlider) {
		$slider_revolution[$revSlider->getAlias()] = $revSlider->getTitle();
	}
}

$common_fields = array(
	array(
		'name'		=> 'Show Title Bar',
		'id'		=> $prefix . "titlebar",
		'type'		=> 'checkbox',
		'std'		=> true,
	),

	array(
		'name'		=> 'Small caption',
		'id'		=> $prefix . 'subtitle',
		'clone'		=> false,
		'type'		=> 'text',
		'std'		=> '',
		'desc'		=> 'Small caption is shown next to Page Title',
	),
	array(
		'name'		=> 'Show Breadcrumbs',
		'id'		=> $prefix . "breadcrumbs",
		'type'		=> 'checkbox',
		'std'		=> true,
	),
	array(
		'name'		=> 'Header Background Image',
		'id'		=> $prefix . "header_image",
		'type'		=> 'text',
		'std'		=> '',
		'desc'		=> 'Link to background image. Slider overrides this setting. Leave blank for default image.',
	),
	array(
		'name'		=> 'Stretch Header Background Image',
		'id'		=> $prefix . "header_image_stretch",
		'type'		=> 'checkbox',
		'std'		=> 0,
		'desc'		=> 'Stretch the loaded image to 100% width',
	),
	array(
		'name'		=> 'Expanded Header',
		'id'		=> $prefix . "header_expanded",
		'type'		=> 'select',
//		'std'		=> 'Default',
		'desc'		=> 'Header takes more space. Use this when you want bigger image to show as Header Background. Active Slider always expands the header.',
		'options'	=> array(
			'' => 'Default',
			'Compact' => 'Compact',
			'Expand' => 'Expand',
		),
	),
	array(
		'name'		=> 'Slider',
		'id'		=> $prefix . "slider_revolution",
		'type'		=> 'select',
		'options'	=> $slider_revolution,
		'multiple'	=> false,
	)
);

// Page and Post settings
$meta_boxes[] = array(
	'id' => 'common_layout_settings',
	'title' => 'Layout Settings',
	'pages' => array( 'post'),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> 'Expanded Header',
			'id'		=> $prefix . "header_expanded",
			'type'		=> 'select',
//		'std'		=> 'Default',
			'desc'		=> 'Header takes more space. Use this when you want bigger image to show as Header Background. Active Slider always expands the header.',
			'options'	=> array(
				'' => 'Default',
				'Compact' => 'Compact',
				'Expand' => 'Expand',
			),
		),
		array(
			'name'		=> 'Header Fullwidth Background Image',
			'id'		=> $prefix . "header_image",
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Link to background image. Slider overrides this setting',
		),
		array(
			'name'		=> 'Stretch Header Background Image',
			'id'		=> $prefix . "header_image_stretch",
			'type'		=> 'checkbox',
			'std'		=> 0,
			'desc'		=> 'Stretch the loaded image to 100% width',
		),
		array(
			'name'		=> 'Slider',
			'id'		=> $prefix . "slider_revolution",
			'type'		=> 'select',
			'options'	=> $slider_revolution,
			'multiple'	=> false,
		)
	),
);

$meta_boxes[] = array(
	'id' => 'common_layout_settings',
	'title' => 'Layout Settings',
	'pages' => array( 'page'),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array_merge( $common_fields, array (
		array(
			'name' => 'Show Portfolio Filters',
			'id' => $prefix . "portfolio_filter",
			'type' => 'checkbox',
			'std' => true,
		),
		array(
			'name' => 'Select Portfolio Categories',
			'id' => $prefix . "portfolio_categories",
			'type' => 'taxonomy',
			'options' => array(
				'taxonomy' => 'us_portfolio_category',
				'type' => 'checkbox_list',
			),
			'desc' => 'Optional: Choose what portfolio category you want to display on this page (If Portfolio Template chosen).<br>Note: If none is chosen, all Portfolio Categories are shown.'
		),
	)),
);




$meta_boxes[] = array(
	'id' => 'client_settings',
	'title' => 'Client Settings',
	'pages' => array('us_client'),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> 'Client URL',
			'id'		=> $prefix . 'client_url',
			'type'		=> 'text',
			'std'		=> '',
		),
		array(
			'name'		=> 'Open URL in new Tab',
			'id'		=> $prefix . "client_new_tab",
			'type'		=> 'checkbox',
			'std'		=> false,
		),
	),
);


$meta_boxes[] = array(
	'id' => 'portfolio_layout_settings',
	'title' => 'Portfolio Project Settings',
	'pages' => array('us_portfolio'),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array_merge( $common_fields, array(

		array(
			'name'	=> 'Portfolio Slider Images',
			'desc'	=> 'Upload up to 30 portfolio images for a slider (or a single image).',
			'id'	=> $prefix . 'portfolio_slider_images',
			'type'	=> 'plupload_image',
			'max_file_uploads' => 20,
		),
		array(
			'name'		=> 'Project Description',
			'id'		=> $prefix . 'portfolio_description',
			'type'		=> 'textarea',
			'std'		=> '',
		),
		array(
			'name'		=> 'Hide Project Details area',
			'id'		=> $prefix . "hide_portfolio_details",
			'type'		=> 'checkbox',
			'std'		=> false,
		),
		array(
			'name'		=> 'Client',
			'id'		=> $prefix . 'portfolio_client',
			'type'		=> 'text',
			'std'		=> '',
		),
		array(
			'name'		=> 'Date',
			'id'		=> $prefix . 'portfolio_date',
			'type'		=> 'date',
			'std'		=> '',
		),
		array(
			'name'		=> 'Project URL',
			'id'		=> $prefix . 'portfolio_url',
			'type'		=> 'text',
			'std'		=> '',
		),
	))
);



function us_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'us_register_meta_boxes' );