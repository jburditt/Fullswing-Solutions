<?php

class US_Widget_Twitter extends WP_Widget {

	function US_Widget_Twitter()
	{
		US_Widget_Twitter::__construct();
	}

	function __construct()
	{
		$widget_ops = array('classname' => 'twitter', 'description' => __('Recent Tweets block', 'Vittoria'));
		$control_ops = array('id_base' => 'twitter-widget');
		$this->WP_Widget('twitter-widget', __('Vittoria: Recent Tweets', 'Vittoria'), $widget_ops, $control_ops);
	}

	function get_instance_params() {
		$instance = $this->get_settings();
		if ( array_key_exists( $this->number, $instance ) ) {
			$instance = $instance[$this->number];
			return $instance;
		}
	}

	function widget($args, $instance)
	{
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Latest tweets', 'Vittoria') : $instance['title'], $instance, $this->id_base);

		echo $args['before_widget'];
		?><div class="w-twitter"><div class="w-twitter-h"><?php
		if ($title){
			echo '<h4 class="w-twitter-title">'.$title.'</h4>';
		}
		?><div class="w-twitter-tweets <?php echo $args['widget_id'] ?>"></div></div></div><?php
		echo $args['after_widget'];

		?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery(".w-twitter-tweets.<?php echo $args['widget_id'] ?>").tweet({
					join_text: "auto",
					username: ["<?php echo $instance['twitter_id'] ?>"],
					modpath: "<?php echo admin_url('admin-ajax.php?action=usAjaxTwitterBackend&id='.$args['widget_id']); ?>",
					avatar_size: 48,
					count: <?php echo $instance['count'] ?>,
					template: "<i class='icon-twitter'></i><span>{text}</span> <small>{time}</small>",
					loading_text: "<?php echo __('loading tweets', 'Vittoria') ?>..."
				});
			});
		</script>
		<?php
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['consumer_key'] = $new_instance['consumer_key'];
		$instance['consumer_secret'] = $new_instance['consumer_secret'];
		$instance['access_token'] = $new_instance['access_token'];
		$instance['access_token_secret'] = $new_instance['access_token_secret'];
		$instance['twitter_id'] = $new_instance['twitter_id'];
		$instance['count'] = $new_instance['count'];

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => __('Recent Tweets', 'Vittoria'), 'twitter_id' => '', 'consumer_key' => '', 'consumer_secret' => '', 'access_token' => '', 'access_token_secret' => '', 'count' => 3);
		$instance = wp_parse_args((array) $instance, $defaults);
?>

		<p>You need to have a twitter App for your usage in order to obtain OAuth credentials, see <a href="https://dev.twitter.com/apps">dev.twitter.com/apps</a> for help.</p>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title', 'Vittoria') ?>:</label>
		<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('consumer_key'); ?>">Consumer Key:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('consumer_key'); ?>" name="<?php echo $this->get_field_name('consumer_key'); ?>" value="<?php echo $instance['consumer_key']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('consumer_secret'); ?>">Consumer Secret:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('consumer_secret'); ?>" name="<?php echo $this->get_field_name('consumer_secret'); ?>" value="<?php echo $instance['consumer_secret']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('access_token'); ?>">Access Token:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" value="<?php echo $instance['access_token']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('access_token_secret'); ?>">Access Token Secret:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('access_token_secret'); ?>" name="<?php echo $this->get_field_name('access_token_secret'); ?>" value="<?php echo $instance['access_token_secret']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('twitter_id'); ?>">Twitter Username (optional):</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" value="<?php echo $instance['twitter_id']; ?>" />
		</p>

		<label for="<?php echo $this->get_field_id('count'); ?>"><?php echo __('Number of Tweets', 'Vittoria') ?>:</label>
		<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>" />
		</p>

<?php
	}
}

add_action('widgets_init', 'us_register_tweets_widget');

function us_register_tweets_widget()
{
	register_widget('US_Widget_Twitter');
}

if ( ! function_exists('usAjaxTwitterBackend')) {

	$usTwitterWidgetID = null;

	function usAjaxTwitterBackend() {
		if ( ! isset($_GET['id']))
		{
			return;
		}
		global $wp_registered_widgets;

		if ( ! array_key_exists($_GET['id'], $wp_registered_widgets))
		{
			return;
		}

		$widget = $wp_registered_widgets[$_GET['id']];
		$widget_object = $widget['callback'][0];
		$widget_params = $widget_object->get_instance_params();

		require_once(get_template_directory() . '/vendor/twitter/index.php');
		require_once(get_template_directory() . '/vendor/twitter/lib/tmhOAuth.php');
		require_once(get_template_directory() . '/vendor/twitter/lib/tmhUtilities.php');

		$ezTweet = new ezTweet($widget_params['consumer_key'], $widget_params['consumer_secret'], $widget_params['access_token'], $widget_params['access_token_secret']);
		$ezTweet->fetch();
		die();

	}

	add_action( 'wp_ajax_nopriv_usAjaxTwitterBackend', 'usAjaxTwitterBackend' );
	add_action( 'wp_ajax_usAjaxTwitterBackend', 'usAjaxTwitterBackend' );

}