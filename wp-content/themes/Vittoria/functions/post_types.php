<?php
add_action( 'init', 'create_post_types' );
function create_post_types() {
	global $smof_data;
	// Portfolio post type
	register_post_type( 'us_portfolio',
		array(
			'labels' => array(
				'name' => __('Portfolio', 'Vittoria'),
				'singular_name' => __('Portfolio Item', 'Vittoria'),
				'add_new' => __('Add Portfolio Item', 'Vittoria'),
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => $smof_data['portfolio_slug']),
			'supports' => array('title', 'editor', 'thumbnail'),
			'can_export' => true,
		)
	);

	// Clients post type
	register_post_type( 'us_client',
		array(
			'labels' => array(
				'name' => __('Clients', 'Vittoria'),
				'singular_name' => __('Client', 'Vittoria'),
				'add_new' => __('Add client', 'Vittoria'),
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array('title', 'thumbnail'),
			'can_export' => true,
		)
	);

	// FAQ post type
	register_post_type( 'us_faq',
		array(
			'labels' => array(
				'name' => __('FAQs', 'Vittoria'),
				'singular_name' => __('Question', 'Vittoria'),
				'add_new' => __('Add question', 'Vittoria'),
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array('title', 'editor'),
			'can_export' => true,
		)
	);
}

// Portfolio categories
register_taxonomy('us_portfolio_category', array('us_portfolio'), array('hierarchical' => true, 'label' => __('Portfolio Categories', 'Vittoria'),'singular_label' => __('Portfolio Category', 'Vittoria'), 'rewrite' => true));

function portfolio_add_taxonomy_filters() {
	global $typenow;

	// An array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array( 'us_portfolio_category' );

	// must set this to the post type you want the filter(s) displayed on
	if ( $typenow == 'portfolio' ) {

		foreach ( $taxonomies as $tax_slug ) {
			$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
			$tax_obj = get_taxonomy( $tax_slug );
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if ( count( $terms ) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>$tax_name</option>";
				foreach ( $terms as $term ) {
					echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
				}
				echo "</select>";
			}
		}
	}
}

add_filter( 'the_password_form', 'custom_password_form' );
function custom_password_form() {
	global $post;
	$output = '<form class="g-form protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post"><div class="g-form-row"><div class="g-form-row-label"><label class="g-form-row-label-h" >' . __('This post is password protected. To view it please enter your password below', 'Vittoria') . '</label></div></div><div class="g-form-row"><div class="g-form-row-field"><div class="g-input"><input type="password" value="" name="post_password"/></div></div><div class="g-form-row-field"><input class="g-btn" type="submit" value="'.__('Submit', 'Vittoria') .'" /></div></div></form>';
	return $output;
}