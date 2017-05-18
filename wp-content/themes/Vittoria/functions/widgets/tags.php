<?php

class US_Widget_Tag_Cloud extends WP_Widget_Tag_Cloud {
	function US_Widget_Tag_Cloud()
	{
		US_Widget_Tag_Cloud::__construct();
	}

	function __construct()
	{
		$widget_ops = array( 'description' => __( "Your most used tags in cloud format", 'Vittoria') );
		$this->WP_Widget('tag_cloud', __('Vittoria: Tag Cloud', 'Vittoria'), $widget_ops);
	}

	function widget( $args, $instance ) {

		$current_taxonomy = $this->_get_current_taxonomy($instance);
		if ( !empty($instance['title']) ) {
			$title = $instance['title'];
		} else {
			if ( 'post_tag' == $current_taxonomy ) {
				$title = __('Tags');
			} else {
				$tax = get_taxonomy($current_taxonomy);
				$title = $tax->labels->name;
			}
		}
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		echo $args['before_widget'];
		?><div class="w-tags layout_block"><div class="w-tags-h"><?php
		if ($title){
			echo '<div class="w-tags-title"><h4 class="w-tags-title-h">'.$title.'</h4></div>';
		}
		?><div class="w-tags-list"><?php
		$tags = wp_tag_cloud( apply_filters('widget_tag_cloud_args', array('taxonomy' => $current_taxonomy, 'format' => 'array'/*'separator' => "<span class=\"w-tags-item-separator\">,</span>\n",*/)));
		foreach ($tags as $tag)
		{
			if (preg_match('%<a [^>]*href=\'([^\']+)\'[^>]*>([^<]*)</a>%i', $tag, $tag_args))
			{
				?><div class="w-tags-item"><a class="w-tags-item-link" href="<?php echo $tag_args[1] ?>"><?php echo $tag_args[2] ?></a><span class="w-tags-item-separator">,</span></div><?php
			}
			// @TODO add context to this markup

		}
		?></div></div></div><?php
		echo $args['after_widget'];
	}
}

add_action('widgets_init', 'us_register_tags_widget');

function us_register_tags_widget()
{
	unregister_widget('WP_Widget_Tag_Cloud');
	register_widget('US_Widget_Tag_Cloud');
}

//class Walker_Category_Vittoria extends Walker_Category {
//
//}