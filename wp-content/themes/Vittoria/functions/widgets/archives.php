<?php

class US_Widget_Archives extends WP_Widget_Archives {
	function US_Widget_Archives()
	{
		US_Widget_Archives::__construct();
	}

	function __construct()
	{
		$widget_ops = array('classname' => 'widget_archive', 'description' => __( 'A monthly archive of your site&#8217;s posts'));
		$this->WP_Widget('archives', __('Vittoria: Archives', 'Vittoria'), $widget_ops);
	}

	function widget( $args, $instance ) {

		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Archives') : $instance['title'], $instance, $this->id_base);

		echo $args['before_widget'];
		?><div class="w-links"><div class="w-links-h"><?php
		if ( $title )
		{
			?><h4 class="w-links-title"><?php echo $title; ?></h4><?php
		}
		if ( $d ) {
			?>
			<select name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'> <option value=""><?php echo esc_attr(__('Select Month')); ?></option> <?php wp_get_archives(apply_filters('widget_archives_dropdown_args', array('type' => 'monthly', 'format' => 'option', 'show_post_count' => $c))); ?> </select>
		<?php
		} else {
			?>
			<div class="w-links-list">
				<?php wp_get_archives(apply_filters('widget_archives_args', array('type' => 'monthly', 'show_post_count' => $c, 'format' => 'custom', 'before' => '', 'after' => ''))); ?>
			</div>
		<?php
		}

		?></div></div><?php
		echo $args['after_widget'];
	}
}

function get_archives_link_mod ( $link_html )
{
	$link_html = preg_replace("%<a ([^>]*)>([^<]*)</a>(&nbsp;\(\d+\))?%i", '<div class="w-links-item"><a \1 class="w-links-anchor"><span class="w-links-anchor-title">\2\3</span></a></div>', $link_html);
	return $link_html;
}
add_filter("get_archives_link", "get_archives_link_mod");

add_action('widgets_init', 'us_register_archives_widget');

function us_register_archives_widget()
{
	unregister_widget('WP_Widget_Archives');
	register_widget('US_Widget_Archives');
}