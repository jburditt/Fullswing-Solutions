<?php
define('IS_POST', TRUE);
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

					<div class="w-blogpost meta_all">
						<div class="w-blogpost-h">
							<?php if ( has_post_thumbnail() ) { ?>
							<div class="w-blogpost-image">
								<?php the_post_thumbnail(); ?>
							</div>
							<?php } ?>
							<div class="w-blogpost-content">
								<h1 class="w-blogpost-title"><?php the_title(); ?></h1>
								<div class="w-blogpost-meta">

									<div class="w-blogpost-meta-date">
										<i class="icon-time"></i>
										<span class="w-blog-entry-meta-date-month"><?php echo get_the_date('m') ?></span>
										<span class="w-blog-entry-meta-date-day"><?php echo get_the_date('d') ?></span>
										<span class="w-blog-entry-meta-date-year"><?php echo get_the_date('Y') ?></span>
									</div>
									<?php if ( ! isset($smof_data['post_meta_author']) OR $smof_data['post_meta_author'] == 1) { ?>
									<div class="w-blogpost-meta-author">
										<i class="icon-user"></i>
										<span class="w-blog-entry-meta-author-h"><?php echo get_the_author() ?></span>
									</div>
									<?php } ?>
									<?php if ( ! isset($smof_data['post_meta_comments']) OR $smof_data['post_meta_comments'] == 1) { ?>
									<div class="w-blog-entry-meta-comments">
										<?php comments_popup_link('<i class="icon-comments"></i>'.__('No Comments', 'Vittoria'), '<i class="icon-comments"></i>'.__('1 Comment', 'Vittoria'), '<i class="icon-comments"></i>'.__('% Comments', 'Vittoria'), 'w-blog-entry-meta-comments-h', ''); ?>
									</div>
									<?php } ?>
								</div>
								<div class="w-blogpost-text">
									<?php the_content(__('Read More &raquo;', 'Vittoria')); ?>

								</div>
							</div>
							<?php
							$tags = wp_get_post_tags($post->ID);
							if ($tags) {
							?>
							<?php if ( ! isset($smof_data['post_meta_tags']) OR $smof_data['post_meta_tags'] == 1) { ?>
							<div class="w-tags layout_block title_atleft">
								<div class="w-tags-h">
									<div class="w-tags-title">
										<h4 class="w-tags-title-h">Tags:</h4>
									</div>
									<div class="w-tags-list">
									<?php foreach ($tags as $tag) { ?>
										<div class="w-tags-item">
											<a class="w-tags-item-link" href="<?php echo get_tag_link($tag->term_id) ?>"><?php echo $tag->name ?></a><span class="w-tags-item-separator">,</span>
										</div>
									<?php } ?>
									</div>

								</div>
							</div>
							<?php } ?>
							<?php } ?>


							<?php if ($smof_data['blog_sharing_facebook'] == 1 || $smof_data['blog_sharing_twitter'] == 1 || $smof_data['blog_sharing_google'] == 1 || $smof_data['blog_sharing_pinterest'] == 1 || $smof_data['blog_sharing_email'] == 1) { ?>
								<script type="text/javascript">var switchTo5x=true;</script>
								<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
								<script type="text/javascript">stLight.options({publisher: "ur-b6bcdd5b-dde-cce8-a00c-478890414ff", doNotHash: true, doNotCopy: false, hashAddressBar: true});</script>
								<div class="w-share">
									<div class="w-share-h">
										<div class="w-share-title">
											<h4 class="w-share-title-h"><?php echo __('Share', 'Vittoria') ?>:</h4>
										</div>
										<div class="w-share-list">
											<?php if ($smof_data['blog_sharing_facebook'] == 1) { ?><span class="st_facebook_hcount"></span><?php } ?>
											<?php if ($smof_data['blog_sharing_twitter'] == 1) { ?><span class="st_twitter_hcount"></span><?php } ?>
											<?php if ($smof_data['blog_sharing_google'] == 1) { ?><span class="st_googleplus_hcount"></span><?php } ?>
											<?php if ($smof_data['blog_sharing_pinterest'] == 1) { ?><span class="st_pinterest_hcount"></span><?php } ?>
											<?php if ($smof_data['blog_sharing_email'] == 1) { ?><span class="st_email_hcount"></span><?php } ?>
										</div>
									</div>
								</div>
							<?php } ?>


						</div>
					</div>
					<?php if ($smof_data['post_related_posts'] == 1) { ?>
						<?php
						if ($tags) {
							$tag_ids = array();
							foreach ($tags as $tag )
							{
								$tag_ids[] = (int)$tag->term_id;
							}

							$args=array(
								'tag__in' => $tag_ids,
								'post__not_in' => array($post->ID),
								'paged' => 1,
								'showposts' => 3,
								'orderby'=>'rand',
								'ignore_sticky_posts'=>1,
								'post_type' => get_post_type($post->ID),
							);
							$related_query = new WP_Query($args);
							if( $related_query->have_posts() ) {
								?>
								<div class="w-bloglist">
									<h4 class="w-bloglist-title"><?php echo __('Related Posts', 'Vittoria') ?></h4>
									<div class="w-bloglist-list">
										<?php while ($related_query->have_posts()) { $related_query->the_post(); ?>
											<div class="w-bloglist-entry">
												<a class="w-bloglist-entry-link" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
												<span class="w-bloglist-entry-date"><?php the_time(get_option('F d, Y')); ?></span>
											</div>
										<?php
										}
										wp_reset_query();
										?>

									</div>
								</div>
							<?php
							}
						}
					} ?>
					<?php if (comments_open()) { comments_template(); } ?>
				</div>
			</div>
			<div class="l-sidebar at_left">
				<div class="l-sidebar-h i-widgets">
					<?php if ($smof_data['post_sidebar_pos'] != 'Right') generated_dynamic_sidebar(); ?>
				</div>
			</div>

			<div class="l-sidebar at_right">
				<div class="l-sidebar-h i-widgets">
					<?php if ($smof_data['post_sidebar_pos'] == 'Right') generated_dynamic_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; else : ?>
	<?php _e('No posts were found.', 'Vittoria'); ?>
<?php endif; ?>
<?php get_footer(); ?>