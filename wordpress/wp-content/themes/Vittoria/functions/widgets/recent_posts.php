<?php

class US_Widget_Recent_Posts extends WP_Widget_Recent_Posts {
	function US_Widget_Recent_Posts()
	{
		US_Widget_Recent_Posts::__construct();
	}

	function __construct()
	{
		$widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( 'The most recent posts on your site', 'Vittoria') );
		$this->WP_Widget('recent_posts', __('Vittoria: Recent Posts', 'Vittoria'), $widget_ops);

		$this->alt_option_name = 'widget_recent_entries';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
			$number = 10;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if ($r->have_posts()) :
			echo $args['before_widget']; ?>
			<div class="w-bloglist date_atbottom">
			<?php if ( $title ) echo '<h4 class="w-bloglist-title">' . $title . '</h4>'; ?>
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>
				<div class="w-bloglist-entry">
					<a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>" class="w-bloglist-entry-link"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
					<?php if ( $show_date ) : ?>
						<span class="w-bloglist-entry-date"><?php echo get_the_date(); ?></span>
					<?php endif; ?>
				</div>
			<?php endwhile; ?>
			</div>
			<?php echo $args['after_widget'];
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_posts', $cache, 'widget');
	}
}

add_action('widgets_init', 'us_register_recent_posts_widget');

function us_register_recent_posts_widget()
{
	unregister_widget('WP_Widget_Recent_Posts');
	register_widget('US_Widget_Recent_Posts');
}