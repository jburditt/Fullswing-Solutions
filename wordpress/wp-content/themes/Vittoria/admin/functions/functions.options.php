<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = STYLESHEETPATH. '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_bloginfo('template_url').'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();
//$prefix = 'vittoria_'


$of_options[] = array( 	"name" 		=> "General Settings",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Logo",
	"desc" 		=> "Jpeg/Png/Gif Logo image.",
	"id" 		=> "custom_logo",
	"std" 		=> "",
	"type" 		=> "upload"
	);

$of_options[] = array( "name" => "Logo as text",
	"desc" => "Show text instead of image as Logo",
	"id" => "logo_as_text",
	"std" => 0,
	"folds" => 1,
	"type" => "checkbox");

$of_options[] = array( "name" => "Logo text",
	"desc" => "",
	"id" => "logo_text",
	"std" => "",
	"fold" => "logo_as_text",
	"type" => "text");

$of_options[] = array( "name" => "Slogan",
	"desc" => "Text near the Logo",
	"id" => "custom_slogan",
	"std" => "New edge of the template experience",
	"type" => "text");

$of_options[] = array( 	"name" 		=> "Favicon",
	"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
	"id" => "custom_favicon",
	"std" => "",
	"type" => "upload"
	);

//$of_options[] = array( "name" => "Responsive Design",
//	"desc" => "Use the responsive design features",
//	"id" => "responsive_design",
//	"std" => 1,
//	"type" => "checkbox");

$of_options[] = array( 	"name" 		=> "Google Analytics Tracking Code<br><img src=\"http://www.lolinez.com/ss.jpg\">",
	"desc" 		=> "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
	"id" 		=> "tracking_code",
	"std" 		=> "",
	"type" 		=> "textarea");

$of_options[] = array( "name" => "Styling",
	"type" => "heading");

$of_options[] = array( "name" => "Predefined Color Schemes",
	"desc" => "",
	"id" => "color_scheme",
	"std" => "Orange",
	"type" => "select",
	"options" => array('orange' => 'Orange', 'red' => 'Red', 'brown' => 'Brown', 'grass' => 'Grass', 'green' => 'Green', 'aqua' => 'Aqua', 'blue' => 'Blue', 'purple' => 'Purple', 'pink' => 'Pink'));

$of_options[] = array( "name" => "Buld Your Own Color Scheme",
	"desc" => "",
	"id" => "own_color_scheme_intro",
	"std" => "<h3 style='margin: 0;'>Buld Your Own Color Scheme</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( "name" =>  "Primary Color",
	"desc" => "",
	"id" => "primary_color",
	"std" => "#f26500",
	"type" => "color");

$of_options[] = array( "name" =>  "Link Color",
	"desc" => "",
	"id" => "link_color",
	"std" => "#f26500",
	"type" => "color");

$of_options[] = array( "name" =>  "Button Shadow Color",
	"desc" => "",
	"id" => "btn_shadow_color",
	"std" => "#d94f00",
	"type" => "color");

$of_options[] = array( "name" => "Layout",
	"desc" => "Boxed or Wide",
	"id" => "layout",
	"std" => "Boxed",
	"type" => "select",
	"options" => array(
		'boxed' => 'Boxed',
		'wide' => 'Wide',
	));

$of_options[] = array( "name" =>  "Body Background Color",
	"desc" => "",
	"id" => "body_background_color",
	"std" => "#eeeeee",
	"type" => "color");

$of_options[] = array( 	"name" => "Body Background Image",
	"desc" => "",
	"id" => "body_background_image",
	"std" => get_template_directory_uri()."/img/bg-2.jpg",
	"type" => "upload"
	);

$of_options[] = array( "name" => "Body Background Repeat",
	"desc" => "",
	"id" => "body_background_image_repeat",
	"std" => "Repeat",
	"type" => "select",
	"options" => array(
		'repeat' => 'Repeat',
		'repeat-x' => 'Repeat Horizontally',
		'repeat-y' => 'Repeat Vertically',
		'no-repeat' => 'Do Not Repeat',
	));

$of_options[] = array( 	"name" => "Header Background Image",
	"desc" => "",
	"id" => "header_background_image",
	"std" => '',
	"type" => "upload"
);

$of_options[] = array( "name" => "Stretch Header Background Image",
	"desc" => "Stretch the loaded image to 100% width",
	"id" => "header_background_image_stretch",
	"std" => 0,
	"type" => "checkbox");

$of_options[] = array( "name" => "Expand header",
	"desc" => "Header takes more space. Use this when you want bigger image to show as Header Background.",
	"id" => "header_expand",
	"std" => 0,
	"type" => "checkbox");



$of_options[] = array( "name" => "Quick CSS",
	"desc" => "",
	"id" => "advanced_css_intro",
	"std" => "<h3 style='margin: 0;'>Quick CSS Customizations</h3><p style='margin-bottom:0;'>Paste your css code. Do not include &lt;stlye&gt;&lt;/stlye&gt; tags or any html tag in this field.</p>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( 	"name" 		=> "Quick CSS",
	"desc" 		=> "Quickly add some CSS to your theme by adding it to this block.",
	"id" 		=> "custom_css",
	"std" 		=> "",
	"type" 		=> "textarea"
);

$of_options[] = array(	"name" => "Header Options",
						"type"=> "heading");

$of_options[] = array( "name" => "Show Search",
	"desc" => "Show Search Widget",
	"id" => "header_show_search",
	"std" => 1,
	"type" => "checkbox");

$of_options[] = array( "name" => "Show Language",
	"desc" => "Show Language Widget",
	"id" => "header_show_language",
	"std" => 0,
	"type" => "checkbox");

$of_options[] = array( "name" => "Language Widget Type",
	"desc" => "",
	"id" => "header_language_type",
	"std" => "Your own links",
	"type" => "select",
	"options" => array(
		'own' => 'Your own links',
		'wpml' => 'WPML language switcher',
	));

$of_options[] = array( "name" => "Languages Amount",
	"desc" => "Only for Your own links",
	"id" => "header_language_amount",
	"std" => "2",
	"type" => "select",
	"options" => array(
		'2' => '2',
		'3' => '3',
		'4' => '4',
		'5' => '5',
		'6' => '6',
		'7' => '7',
		'8' => '8',
		'9' => '9',
		'10' => '10',
	));

$of_options[] = array( "name" => "Current Language",
	"desc" => "Current Language Code or Name",
	"id" => "header_language_1_name",
	"std" => "",
	"type" => "text");



$of_options[] = array( "name" => "Language 2",
	"desc" => "Language 2 Code or Name",
	"id" => "header_language_2_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 2 URL",
	"id" => "header_language_2_url",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Language 3",
	"desc" => "Language 3 Code or Name",
	"id" => "header_language_3_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 3 URL",
	"id" => "header_language_3_url",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Language 4",
	"desc" => "Language 4 Code or Name",
	"id" => "header_language_4_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 4 URL",
	"id" => "header_language_4_url",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Language 5",
	"desc" => "Language 5 Code or Name",
	"id" => "header_language_5_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 5 URL",
	"id" => "header_language_5_url",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Language 6",
	"desc" => "Language 6 Code or Name",
	"id" => "header_language_6_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 6 URL",
	"id" => "header_language_6_url",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Language 7",
	"desc" => "Language 7 Code or Name",
	"id" => "header_language_7_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 7 URL",
	"id" => "header_language_7_url",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Language 8",
	"desc" => "Language 8 Code or Name",
	"id" => "header_language_8_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 8 URL",
	"id" => "header_language_8_url",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Language 9",
	"desc" => "Language 9 Code or Name",
	"id" => "header_language_9_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 9 URL",
	"id" => "header_language_9_url",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Language 10",
	"desc" => "Language 10 Code or Name",
	"id" => "header_language_10_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 10 URL",
	"id" => "header_language_10_url",
	"std" => "",
	"type" => "text");

$of_options[] = array(	"name" => "Footer Options",
						"type"=> "heading");

$of_options[] = array( "name" => "Copyright Text",
	"desc" => "",
	"id" => "footer_copyright",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Footer Widgets",
	"desc" => "Show Footer Widgets",
	"id" => "footer_show_widgets",
	"std" => 1,
	"type" => "checkbox");

$of_options[] = array( "name" => "Footer Social Links",
	"desc" => "",
	"id" => "footer_socials_intro",
	"std" => "<h3 style='margin: 0;'>Footer Social Links</h3><p style='margin-bottom:0;'>Place the links for social icons you want to appear at footer.</p>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( "name" => "RSS",
	"desc" => "Place the link you want and rss icon will appear. To remove it, just leave it blank.",
	"id" => "rss_link",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Email",
	"desc" => "Place the address you want and email icon will appear. To remove it, just leave it blank.",
	"id" => "email_link",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Facebook",
	"desc" => "Place the link you want and facebook icon will appear. To remove it, just leave it blank.",
	"id" => "facebook_link",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Twitter",
	"desc" => "Place the link you want and twitter icon will appear. To remove it, just leave it blank.",
	"id" => "twitter_link",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Google Plus",
	"desc" => "Place the link you want and g+ icon will appear. To remove it, just leave it blank.",
	"id" => "gplus_link",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "LinkedIn",
	"desc" => "Place the link you want and linkedin icon will appear. To remove it, just leave it blank.",
	"id" => "linkedin_link",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Youtube",
	"desc" => "Place the link you want and youtube icon will appear. To remove it, just leave it blank.",
	"id" => "youtube_link",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Vimeo",
	"desc" => "Place the link you want and vimeo icon will appear. To remove it, just leave it blank.",
	"id" => "vimeo_link",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Flickr",
	"desc" => "Place the link you want and flickr icon will appear. To remove it, just leave it blank.",
	"id" => "flickr_link",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Pinterest",
	"desc" => "Place the link you want and pinterest icon will appear. To remove it, just leave it blank.",
	"id" => "pinterest_link",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Skype",
	"desc" => "Place the link you want and skype icon will appear. To remove it, just leave it blank.",
	"id" => "skype_link",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Tumblr",
	"desc" => "Place the link you want and tumblr icon will appear. To remove it, just leave it blank.",
	"id" => "tumblr_link",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Blogger",
	"desc" => "Place the link you want and blogger icon will appear. To remove it, just leave it blank.",
	"id" => "blogger_link",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Dribbble",
	"desc" => "Place the link you want and dribbble icon will appear. To remove it, just leave it blank.",
	"id" => "dribbble_link",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Vkontakte",
	"desc" => "Place the link you want and vkontakte icon will appear. To remove it, just leave it blank.",
	"id" => "vk_link",
	"std" => "",
	"type" => "text");

$of_options[] = array(	"name" => "Portfolio Options",
						"type"=> "heading");

$of_options[] = array( "name" => "Number of Items per Page",
	"desc" => "",
	"id" => "portfolio_items",
	"std" => "12",
	"type" => "text");

$of_options[] = array( "name" => "Portfolio Slug",
	"desc" => "",
	"id" => "portfolio_slug",
	"std" => "portfolio",
	"type" => "text");

$of_options[] = array( "name" => "Project Description Title",
	"desc" => "",
	"id" => "portfolio_desc_title",
	"std" => "Project Description",
	"type" => "text");

$of_options[] = array( "name" => "Project Details Title",
	"desc" => "",
	"id" => "portfolio_details_title",
	"std" => "Project Details",
	"type" => "text");

$of_options[] = array( "name" => "Client Title",
	"desc" => "",
	"id" => "portfolio_client_title",
	"std" => "Client",
	"type" => "text");

$of_options[] = array( "name" => "Category Title",
	"desc" => "",
	"id" => "portfolio_category_title",
	"std" => "Category",
	"type" => "text");

$of_options[] = array( "name" => "Date Title",
	"desc" => "",
	"id" => "portfolio_date_title",
	"std" => "Date",
	"type" => "text");

$of_options[] = array( "name" => "Project URL Title",
	"desc" => "",
	"id" => "portfolio_url_title",
	"std" => "Project URL",
	"type" => "text");

$of_options[] = array( "name" => "Social Sharing Buttons for Project",
	"desc" => "",
	"id" => "project_socials",
	"std" => "<h3 style='margin: 0;'>Social Sharing Buttons for Project</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( "name" => "Facebook",
	"desc" => "Show the facebook sharing option in portfolio projects.",
	"id" => "project_sharing_facebook",
	"std" => 1,
	"type" => "checkbox");

$of_options[] = array( "name" => "Twitter",
	"desc" => "Show the twitter sharing option in portfolio projects.",
	"id" => "project_sharing_twitter",
	"std" => 1,
	"type" => "checkbox");

$of_options[] = array( "name" => "Google Plus",
	"desc" => "Show the g+ sharing option in portfolio projects.",
	"id" => "project_sharing_google",
	"std" => 1,
	"type" => "checkbox");

$of_options[] = array( "name" => "Pinterest",
	"desc" => "Show the linkedin sharing option in portfolio projects.",
	"id" => "project_sharing_pinterest",
	"std" => 1,
	"type" => "checkbox");

$of_options[] = array( "name" => "Email",
	"desc" => "Show the email sharing option in portfolio projects.",
	"id" => "project_sharing_email",
	"std" => 1,
	"type" => "checkbox");




$of_options[] = array( "name" => "Blog Options",
	"type" => "heading");

$of_options[] = array( "name" => "Blog Layout",
	"desc" => "",
	"id" => "blog_layout",
	"std" => "Large Image",
	"type" => "select",
	"options" => array(
		'large_image' => 'Large Image',
		'small_image' => 'Small Image',
		'grid' => 'Grid',
		'simple' => 'Simple',
	));

$of_options[] = array( "name" => "Archives Layout",
	"desc" => "Select layout for Archives pages (Category Archive, Tagged Posts, Blog Archives)",
	"id" => "archive_layout",
	"std" => "Simple",
	"type" => "select",
	"options" => array(
		'simple' => 'Simple',
		'large_image' => 'Large Image',
		'small_image' => 'Small Image',
//		'grid' => 'Grid',
	));

$of_options[] = array( "name" => "Number of Posts at Blog page",
	"desc" => "5 by default",
	"id" => "blog_items",
	"std" => "5",
	"type" => "text");

$of_options[] = array( "name" => "Number of Posts at Grid Blog page",
	"desc" => "12 by default",
	"id" => "blog_grid_items",
	"std" => "12",
	"type" => "text");

$of_options[] = array( "name" => "Sidebar on Blog Page",
	"desc" => "Blog pages sidebar position",
	"id" => "blog_sidebar_pos",
	"std" => "Right",
	"type" => "select",
	"options" => array(
		'right' => 'Right',
		'left' => 'Left',
	));

$of_options[] = array( "name" => "Sidebar on Post Pages",
	"desc" => "Post pages sidebar position",
	"id" => "post_sidebar_pos",
	"std" => "Right",
	"type" => "select",
	"options" => array(
		'right' => 'Right',
		'left' => 'Left',
		'none' => 'No Sidebar',
	));

$of_options[] = array( "name" => "Post Meta",
	"desc" => "Show Author",
	"id" => "post_meta_author",
	"std" => 1,
	"type" => "checkbox");

$of_options[] = array( "name" => "",
	"desc" => "Show Categories",
	"id" => "post_meta_categories",
	"std" => 1,
	"type" => "checkbox");

$of_options[] = array( "name" => "",
	"desc" => "Show comments number",
	"id" => "post_meta_comments",
	"std" => 1,
	"type" => "checkbox");

$of_options[] = array( "name" => "",
	"desc" => "Show tags",
	"id" => "post_meta_tags",
	"std" => 1,
	"type" => "checkbox");
//$of_options[] = array( "name" => "Show Read More",
//	"desc" => "Show Read More button",
//	"id" => "post_read_more",
//	"std" => 1,
//	"type" => "checkbox");

//$of_options[] = array( "name" => "Date Format",
//	"desc" => "<a href=\"http://codex.wordpress.org/Formatting_Date_and_Time\" target=\"_blank\">Formatting Date and Time</a>",
//	"id" => "blog_date_format",
//	"std" => "F jS, Y",
//	"type" => "text");

$of_options[] = array( "name" => "Related Posts",
	"desc" => "Show  list of posts with same tags at single post page",
	"id" => "post_related_posts",
	"std" => 1,
	"type" => "checkbox");

//$of_options[] = array( "name" => "Comments",
//	"desc" => "Show comments.",
//	"id" => "blog_comments",
//	"std" => 1,
//	"type" => "checkbox");

$of_options[] = array( "name" => "Social Sharing Buttons for Post",
	"desc" => "",
	"id" => "post_socials",
	"std" => "<h3 style='margin: 0;'>Social Sharing Buttons for Post</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( "name" => "Facebook",
	"desc" => "Show the facebook sharing option in blog posts.",
	"id" => "blog_sharing_facebook",
	"std" => 1,
	"type" => "checkbox");

$of_options[] = array( "name" => "Twitter",
	"desc" => "Show the twitter sharing option in blog posts.",
	"id" => "blog_sharing_twitter",
	"std" => 1,
	"type" => "checkbox");

$of_options[] = array( "name" => "Google Plus",
	"desc" => "Show the g+ sharing option in blog posts.",
	"id" => "blog_sharing_google",
	"std" => 1,
	"type" => "checkbox");

$of_options[] = array( "name" => "Pinterest",
	"desc" => "Show the linkedin sharing option in blog posts.",
	"id" => "blog_sharing_pinterest",
	"std" => 1,
	"type" => "checkbox");

$of_options[] = array( "name" => "Email",
	"desc" => "Show the email sharing option in blog posts.",
	"id" => "blog_sharing_email",
	"std" => 1,
	"type" => "checkbox");

$of_options[] = array( "name" => "Excerpt or Full Content",
	"desc" => "Show the Excerpt or Full blog content on posts list",
	"id" => "use_excert",
	"std" => "Excerpt",
	"type" => "select",
	"options" => array('excerpt' => 'Excerpt', 'full' => 'Full Content'));

$of_options[] = array( "name" => "Excerpt Length",
	"desc" => "Input the number of words in the Excerpt",
	"id" => "blog_excerpt_length",
	"std" => "40",
	"type" => "text");

$of_options[] = array( "name" => "Contact Page",
	"type" => "heading");

$of_options[] = array( "name" => "Google Map Address",
	"desc" => "Leave blank to hide Google Map",
	"id" => "contact_gmap_address",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Google Map Latitude",
	"desc" => "If Longitude and Latitude are set, they override the Address for Google Map",
	"id" => "contact_gmap_latitude",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Google Map Longitude",
	"desc" => "If Longitude and Latitude are set, they override the Address for Google Map",
	"id" => "contact_gmap_longitude",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Google Map Marker text",
	"desc" => "",
	"id" => "contact_gmap_marker",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Contact Info Address",
	"desc" => "",
	"id" => "contact_address",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Contact Info Phone",
	"desc" => "",
	"id" => "contact_phone",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Contact Info Email",
	"desc" => "",
	"id" => "contact_email",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Social Links",
	"desc" => "Display Social Links below the Contact Info",
	"id" => "contact_show_socials",
	"std" => 1,
	"type" => "checkbox");

$of_options[] = array( "name" => "Contact Form Intro Text",
	"desc" => "Displayed above the Contact Form",
	"id" => "contact_form_intro",
	"std" => "",
	"type" => "textarea");

$of_options[] = array( "name" => "Contact Form Name Field",
	"desc" => "Select field's state",
	"id" => "contact_form_name_field",
	"std" => "Shown, required",
	"type" => "select",
	"options" => array('required' => 'Shown, required', 'show' => 'Shown, not required', 'hide' => 'Hidden')
	);

$of_options[] = array( "name" => "Contact Form Email Field",
	"desc" => "Select field's state",
	"id" => "contact_form_email_field",
	"std" => "Shown, required",
	"type" => "select",
	"options" => array('required' => 'Shown, required', 'show' => 'Shown, not required', 'hide' => 'Hidden')
	);

$of_options[] = array( "name" => "Contact Form Phone Field",
	"desc" => "Select field's state",
	"id" => "contact_form_phone_field",
	"std" => "Shown, required",
	"type" => "select",
	"options" => array('required' => 'Shown, required', 'show' => 'Shown, not required', 'hide' => 'Hidden')
	);

$of_options[] = array( "name" => "Contact Form Reciever Email",
	"desc" => "All Contact requests will be sent to this Email",
	"id" => "contact_form_email",
	"std" => "",
	"type" => "text");

// Backup Options
$of_options[] = array( 	"name" 		=> "Backup Options",
	"type" 		=> "heading"
);

$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
	"id" 		=> "of_backup",
	"std" 		=> "",
	"type" 		=> "backup",
	"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
);

				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
