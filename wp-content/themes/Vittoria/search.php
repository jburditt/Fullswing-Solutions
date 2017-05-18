<?php
define('IS_BLOG', TRUE);
get_header();
global $smof_data, $us_shortcodes;

// Disabling Section shortcode
remove_shortcode('section');
add_shortcode('section', array($us_shortcodes, 'section_dummy'));
?>
	<div class="l-submain for_pagehead">
		<div class="l-submain-h g-html i-cf">
			<div class="w-pagehead">
				<h1><?php echo __('Search Results for', 'Vittoria').' "'.$s.'"'; ?></h1>
				<p></p>
				<?php if (rwmb_meta('vittoria_breadcrumbs')) { ?>
					<!-- breadcrums -->
					<div class="g-breadcrumbs">

					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="l-submain">
		<div class="l-submain-h g-html i-cf">
			<div class="l-content">
				<div class="l-content-h i-widgets">
					<?php if (have_posts()) : ?>
					<div class="w-blog meta_authorcomments">
						<div class="w-blog-h">
							<div class="w-blog-list">

								<?php while (have_posts()) : the_post(); ?>

									<div class="w-blog-entry">
										<div class="w-blog-entry-h">
											<a class="w-blog-entry-link" href="<?php the_permalink(); ?>">


												<h2 class="w-blog-entry-title">
													<span class="w-blog-entry-title-h"><?php the_title(); ?></span>
												</h2>
											</a>
											<div class="w-blog-entry-body">
												<div class="w-blog-entry-meta">
													<div class="w-blog-entry-meta-date">
														<i class="icon-time"></i>
														<span class="w-blog-entry-meta-date-month"><?php echo get_the_date('m') ?></span>
														<span class="w-blog-entry-meta-date-day"><?php echo get_the_date('d') ?></span>
														<span class="w-blog-entry-meta-date-year"><?php echo get_the_date('Y') ?></span>
													</div>

													<div class="w-blog-entry-meta-author">
														<i class="icon-user"></i>
														<span class="w-blog-entry-meta-author-h"><?php echo get_the_author() ?></span>
													</div>

													<div class="w-blog-entry-meta-tags">
														<i class="icon-folder-open"></i>
														<?php the_category(', '); ?>
													</div>

													<div class="w-blog-entry-meta-comments">
														<?php comments_popup_link('<i class="icon-comments"></i>'.__('No Comments', 'Vittoria'), '<i class="icon-comments"></i>'.__('1 Comment', 'Vittoria'), '<i class="icon-comments"></i>'.__('% Comments', 'Vittoria'), 'w-blog-entry-meta-comments-h', ''); ?>
													</div>
												</div>

												<div class="w-blog-entry-short">
													<?php the_excerpt(); ?>
												</div>


											</div>
										</div>
									</div>






								<?php endwhile; ?>



							</div>
						</div>
					</div>
					<?php if ($pagination = us_pagination()) { ?>
						<div class="w-blog-pagination">
							<div class="g-pagination">
								<?php echo $pagination ?>
							</div>
						</div>
					<?php } ?>
					<?php else : ?>
						<?php _e('No posts were found.', 'Vittoria'); ?>
					<?php endif; ?>

				</div>
			</div>
			<div class="l-sidebar at_left">
				<div class="l-sidebar-h i-widgets">
					<?php if ($smof_data['blog_sidebar_pos'] != 'Right') dynamic_sidebar('default_sidebar'); ?>
				</div>
			</div>

			<div class="l-sidebar at_right">
				<div class="l-sidebar-h i-widgets">
					<?php if ($smof_data['blog_sidebar_pos'] == 'Right') dynamic_sidebar('default_sidebar'); ?>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>