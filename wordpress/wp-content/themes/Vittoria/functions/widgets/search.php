<?php

class US_Widget_Search extends WP_Widget_Search {
	function US_Widget_Search()
	{
		US_Widget_Search::__construct();
	}

	function __construct()
	{
		$widget_ops = array('classname' => 'widget_search', 'description' => __('A search form for your site', 'Vittoria'));
		$this->WP_Widget('search', __('Vittoria: Search', 'Vittoria'), $widget_ops);
	}

	function widget($args, $instance) {
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base);
		$text = apply_filters('widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance);
		echo $args['before_widget'];
		if ( !empty( $title ) ) { echo $args['before_title'] . $title . $args['after_title']; }
		?>
		<div class="w-search submit_inside">
			<div class="w-search-h">
				<form class="w-search-form" action="<?php echo home_url( '/' ); ?>">
					<?php if (@ICL_LANGUAGE_CODE != '' AND @ICL_LANGUAGE_CODE != 'ICL_LANGUAGE_CODE') { ?><input type="hidden" name="lang" value="<?php echo(ICL_LANGUAGE_CODE); ?>"><?php } ?>
					<div class="w-search-input">
						<div class="w-search-input-h">
							<input type="text" value="" name="s" placeholder="<?php echo __( 'search', 'Vittoria' ); ?>..."/>
						</div>
					</div>
					<div class="w-search-submit">
						<input type="submit" value="<?php echo __( 'Search', 'Vittoria' ); ?>" />
					</div>
				</form>
			</div>
		</div>
		<?php
		echo $args['after_widget'];
	}
}

add_action('widgets_init', 'us_register_search_widget');

function us_register_search_widget()
{
	unregister_widget('WP_Widget_Search');
	register_widget('US_Widget_Search');
}