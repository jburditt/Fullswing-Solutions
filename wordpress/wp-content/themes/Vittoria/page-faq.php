<?php
/*
Template Name: Page: FAQs
*/
global $smof_data, $us_shortcodes;
define('IS_BLOG', TRUE);
// Disabling Section shortcode
remove_shortcode('section');
add_shortcode('section', array($us_shortcodes, 'section_dummy'));

get_header();
?>
<?php if (have_posts()) : while(have_posts()) : the_post();  ?>
	<?php get_template_part( 'templates/pagehead' ); ?>
	<div class="l-submain for_faq">
		<div class="l-submain-h g-html i-cf">
			<div class="l-content">
				<div class="l-content-h i-widgets">
					<?php the_content(__('Read More &raquo;', 'Vittoria')); ?>

					<div class="w-tabs layout_accordion with_icon type_toggle">
						<div class="w-tabs-h">
						<?php
							$iterator = 0;
							$args = array(
								'post_type' => 'us_faq',
								'nopaging' => true
							);
							$faqs = new WP_Query($args);
							while($faqs->have_posts()): $faqs->the_post(); $iterator++;
						?>
							<div class="w-tabs-section with_icon">
								<div class="w-tabs-section-title">
									<span class="w-tabs-section-title-icon"><?php echo $iterator ?>.</span>
									<span class="w-tabs-section-title-text"><?php the_title(); ?></span>
									<span class="w-tabs-section-title-control"></span>
								</div>
								<div class="w-tabs-section-content">
									<div class="w-tabs-section-content-h">
										<?php the_content(); ?>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
						</div>
					</div>

				</div>
			</div>
			<div class="l-sidebar at_left">
				<div class="l-sidebar-h i-widgets">
					<?php if ($smof_data['blog_sidebar_pos'] != 'Right') generated_dynamic_sidebar(); ?>
				</div>
			</div>

			<div class="l-sidebar at_right">
				<div class="l-sidebar-h i-widgets">
					<?php if ($smof_data['blog_sidebar_pos'] == 'Right') generated_dynamic_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; else : ?>
	<?php _e('No posts were found.', 'Vittoria'); ?>
<?php endif; ?>
<?php get_footer(); ?>