<?php

if ( ! function_exists('gridAjaxPagination'))
{
	function gridAjaxPagination() {
		global $smof_data;

		if (isset($_POST['page']) AND $_POST['page'] > 1)
		{
			$page = $_POST['page'];
		}
		else
		{
			return;
		}

		$blog_items = ($smof_data['blog_grid_items'])?$smof_data['blog_grid_items']:12;
		$wp_query = new WP_Query();


		$wp_query->query('showposts='.$blog_items . '&paged='.$page);
		$max_num_pages = $wp_query->max_num_pages;

		while ($wp_query->have_posts()) { $wp_query->the_post(); ?>
			<div <?php post_class('w-blog-entry') ?>>
				<div class="w-blog-entry-h">
					<a class="w-blog-entry-link" href="<?php the_permalink(); ?>">
						<?php  if ( has_post_thumbnail() ) { ?>
							<span class="w-blog-entry-img">
											<?php the_post_thumbnail('blog-grid'); ?>
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



							<div class="w-blog-entry-meta-comments">
								<i class="icon-comments"></i>
								<?php comments_popup_link(__('No Comments', 'Vittoria'), __('1 Comment', 'Vittoria'), __('% Comments', 'Vittoria'), 'w-blog-entry-meta-comments-h', ''); ?>
							</div>
						</div>

					</div>
				</div>
			</div>
		<?php  }

		die();

	}

	add_action( 'wp_ajax_nopriv_gridPagination', 'gridAjaxPagination' );
	add_action( 'wp_ajax_gridPagination', 'gridAjaxPagination' );
}
