<?php
/*
Template Name: Page: Sidebar Right
*/
define('SIDEBAR_POS', 'right');
get_header();
global $smof_data, $us_shortcodes;

// Disabling Section shortcode
remove_shortcode('section');
add_shortcode('section', array($us_shortcodes, 'section_dummy'));
?>
<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
	<?php get_template_part( 'templates/pagehead' ); ?>
	<div class="l-submain">
		<div class="l-submain-h g-html i-cf">
			<div class="l-content">
				<div class="l-content-h i-widgets">

					<?php the_content(__('Read More &raquo;', 'Vittoria')); ?>

				</div>
			</div>
			<div class="l-sidebar at_left">
				<div class="l-sidebar-h i-widgets">

				</div>
			</div>

			<div class="l-sidebar at_right">
				<div class="l-sidebar-h i-widgets">
					<?php dynamic_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; else : ?>
	<?php _e('No posts were found.', 'Vittoria'); ?>
<?php endif; ?>
<?php get_footer(); ?>