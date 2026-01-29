<?php global $smof_data;
if (have_posts()) : ?>
	<div class="w-blog imgpos_attop meta_all">
		<div class="w-blog-h">
			<div class="w-blog-list">

				<?php while (have_posts()) : the_post(); ?>

					<div <?php post_class('w-blog-entry') ?>>
						<div class="w-blog-entry-h">
							<a class="w-blog-entry-link" href="<?php the_permalink(); ?>">
								<?php  if ( has_post_thumbnail() ) { ?>
									<span class="w-blog-entry-img">
										<?php the_post_thumbnail('blog-large'); ?>
									</span>
								<?php } ?>

								<h2 class="w-blog-entry-title">
									<span class="w-blog-entry-title-h"><?php the_title(); ?></span>
								</h2>
							</a>
							<div class="w-blog-entry-body">
								<div class="w-blog-entry-meta">
									<div class="w-blog-entry-meta-date">
										<i class="icon-time"></i>
										<span class="w-blog-entry-meta-date-month"><?php echo get_the_date('F') ?></span>
										<span class="w-blog-entry-meta-date-day"><?php echo get_the_date('d') ?></span>
										<span class="w-blog-entry-meta-date-year"><?php echo get_the_date('Y') ?></span>
									</div>
									<?php if ( ! isset($smof_data['post_meta_author']) OR $smof_data['post_meta_author'] == 1) { ?>
									<div class="w-blog-entry-meta-author">
										<i class="icon-user"></i>
										<span class="w-blog-entry-meta-author-h" ><?php echo get_the_author() ?></span>
									</div>
									<?php } ?>
									<?php if ( ! isset($smof_data['post_meta_categories']) OR $smof_data['post_meta_categories'] == 1) { ?>
									<div class="w-blog-entry-meta-tags">
										<i class="icon-folder-open"></i>
										<?php the_category(', '); ?>
									</div>
									<?php } ?>
									<?php if ( ! isset($smof_data['post_meta_comments']) OR $smof_data['post_meta_comments'] == 1) { ?>
									<div class="w-blog-entry-meta-comments">
										<?php if ( ! (get_comments_number() == 0 AND ! comments_open() AND ! pings_open())) { echo '<i class="icon-comments"></i>'; }  ?>
										<?php comments_popup_link(__('No Comments', 'Vittoria'), __('1 Comment', 'Vittoria'), __('% Comments', 'Vittoria'), 'w-blog-entry-meta-comments-h', ''); ?>
									</div>
									<?php } ?>
								</div>

								<div class="w-blog-entry-short">
									<?php if ($smof_data['use_excert'] == 'Full Content') the_content(__('Read More &raquo;', 'Vittoria'));  else the_excerpt(); ?>
								</div>

								<a class="w-blog-entry-more g-btn size_small type_color" href="<?php the_permalink(); ?>"><?php echo __('Read More', 'Vittoria') ?></a>
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