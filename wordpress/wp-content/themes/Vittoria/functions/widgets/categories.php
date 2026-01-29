<?php

class US_Widget_Categories extends WP_Widget_Categories {
	function US_Widget_Categories()
	{
		US_Widget_Categories::__construct();
	}

	function __construct()
	{
		$widget_ops = array( 'classname' => 'widget_categories', 'description' => __( "A list or dropdown of categories", 'Vittoria') );
		$this->WP_Widget('categories', __('Vittoria: Categories', 'Vittoria'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base);
		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

		echo $args['before_widget'];
		?><div class="w-links"><div class="w-links-h"><?php
		if ($title){
			echo '<h4 class="w-links-title">'.$title.'</h4>';
		}

		$cat_args = array('orderby' => 'name', 'show_count' => $c, 'hierarchical' => $h, 'style' => 'none', 'walker' => new Walker_Category_Vittoria());

		if ( $d ) {
			$cat_args['show_option_none'] = __('Select Category', 'Vittoria');
			wp_dropdown_categories(apply_filters('widget_categories_dropdown_args', $cat_args));
			?>

			<script type='text/javascript'>
				/* <![CDATA[ */
				var dropdown = document.getElementById("cat");
				function onCatChange() {
					if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
						location.href = "<?php echo home_url(); ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
					}
				}
				dropdown.onchange = onCatChange;
				/* ]]> */
			</script>

		<?php
		} else {
			?>
			<div class="w-links-list">
				<?php
				$cat_args['title_li'] = '';
				wp_list_categories(apply_filters('widget_categories_args', $cat_args));
				?>
			</div>
		<?php
		}
		?></div></div></div><?php
		echo $args['after_widget'];
	}
}

class Walker_Category_Vittoria extends Walker_Category {

	function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		extract($args);

		$cat_name = esc_attr( $category->name );
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );
		$link = '<div class="w-links-item"><a class="w-links-anchor" href="' . esc_url( get_term_link($category) ) . '" ';
		if ( $use_desc_for_title == 0 || empty($category->description) )
			$link .= 'title="' . esc_attr( sprintf(__( 'View all posts filed under %s' ), $cat_name) ) . '"';
		else
			$link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
		$link .= '>';
		$link .= '<span class="w-links-anchor-title">'.$cat_name;
		if ( !empty($show_count) )
			$link .= ' (' . intval($category->count) . ')';
		$link .= '</span></a></div>';

		if ( !empty($feed_image) || !empty($feed) ) {
			$link .= ' ';

			if ( empty($feed_image) )
				$link .= '(';

			$link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $feed_type ) ) . '"';

			if ( empty($feed) ) {
				$alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
			} else {
				$title = ' title="' . $feed . '"';
				$alt = ' alt="' . $feed . '"';
				$name = $feed;
				$link .= $title;
			}

			$link .= '>';

			if ( empty($feed_image) )
				$link .= $name;
			else
				$link .= "<img src='$feed_image'$alt$title" . ' />';

			$link .= '</a>';

			if ( empty($feed_image) )
				$link .= ')';
		}



		if ( 'list' == $args['style'] ) {
			$output .= "\t<li";
			$class = 'cat-item cat-item-' . $category->term_id;
			if ( !empty($current_category) ) {
				$_current_category = get_term( $current_category, $category->taxonomy );
				if ( $category->term_id == $current_category )
					$class .=  ' current-cat';
				elseif ( $category->term_id == $_current_category->parent )
					$class .=  ' current-cat-parent';
			}
			$output .=  ' class="' . $class . '"';
			$output .= ">$link\n";
		} else {
			$output .= "\t$link\n";
		}
	}
}

add_action('widgets_init', 'us_register_categories_widget');

function us_register_categories_widget()
{
	unregister_widget('WP_Widget_Categories');
	register_widget('US_Widget_Categories');
}