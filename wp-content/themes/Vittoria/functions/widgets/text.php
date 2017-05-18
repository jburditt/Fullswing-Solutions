<?php

class US_Widget_Text extends WP_Widget_Text {
	function US_Widget_Text()
	{
		US_Widget_Text::__construct();
	}

	function __construct()
	{
		$widget_ops = array('classname' => 'widget_text', 'description' => __('Arbitrary text or HTML', 'Vittoria'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('text', __('Vittoria: Text Widget', 'Vittoria'), $widget_ops, $control_ops);
	}

	function widget($args, $instance) {
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base);
		$text = apply_filters('widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance);
		echo $args['before_widget'];

?>
		<div class="w-html"><?php if ( !empty( $title ) ) { echo $args['before_title'] . $title . $args['after_title']; } ?><p><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></p></div>
<?php
		echo $args['after_widget'];
	}
}

add_action('widgets_init', 'us_register_text_widget');

function us_register_text_widget()
{
	unregister_widget('WP_Widget_Text');
	register_widget('US_Widget_Text');
}