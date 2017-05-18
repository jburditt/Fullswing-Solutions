<?php

class US_Widget_Contact extends WP_Widget {
	function US_Widget_Contact()
	{
		US_Widget_Contact::__construct();
	}

	function __construct()
	{
		$widget_ops = array('classname' => 'widget_contact', 'description' => __('Contact Information', 'Vittoria'));
		$control_ops = array();
		$this->WP_Widget('contact', __('Vittoria: Contact Widget', 'Vittoria'), $widget_ops, $control_ops);
	}

	function form($instance)
	{
		$defaults = array('title' => __('Contacts', 'Vittoria'), 'address' => '', 'phone' => '', 'email' => '', );
		$instance = wp_parse_args((array) $instance, $defaults);
?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title', 'Vittoria') ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" /></p>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('address'); ?>"><?php echo __('Address', 'Vittoria') ?>:</label>
			<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>"><?php echo esc_textarea($instance['address']); ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('phone'); ?>"><?php echo __('Phone(s)', 'Vittoria') ?>:</label>
			<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" style="height: 47px;"><?php echo esc_textarea($instance['phone']); ?></textarea>
		</p>

		<label for="<?php echo $this->get_field_id('email'); ?>"><?php echo __('Email', 'Vittoria') ?>:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($instance['email']); ?>" />
		</p>

<?php
	}

	function widget($args, $instance)
	{
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Contacts', 'Vittoria') : $instance['title'], $instance, $this->id_base);

		echo $args['before_widget'];
		?><div class="w-contacts"><div class="w-contacts-h"><?php
		if ($title){
			echo '<h4 class="w-contacts-title">'.$title.'</h4>';
		}
		?><dl class="w-contacts-list"><?php
		if ($instance['address']){
			echo '<dt class="w-contacts-list-key for_address">'.__('Address', 'Vittoria').':</dt>';
			echo '<dd class="w-contacts-list-value">'.$instance['address'].'</dd>';
		}
		if ($instance['phone']){
			echo '<dt class="w-contacts-list-key for_phone">'.__('Phone', 'Vittoria').':</dt>';
			echo '<dd class="w-contacts-list-value">'.$instance['phone'].'</dd>';
		}
		if ($instance['email']){
			echo '<dt class="w-contacts-list-key for_email">'.__('Email', 'Vittoria').':</dt>';
			echo '<dd class="w-contacts-list-value"><a href="mailto:'.$instance['email'].'">'.$instance['email'].'</a></dd>';
		}
		?></dl></div></div><?php
		echo $args['after_widget'];
	}
}

add_action('widgets_init', 'us_register_contact_widget');

function us_register_contact_widget()
{
	register_widget('US_Widget_Contact');
}