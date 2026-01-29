<?php global $smof_data; ?><div class="w-blog type_masonry imgpos_attop meta_comments more_hidden">
	<div class="w-blog-h">
		<div class="w-blog-list">

			<?php
			$temp = $wp_query; $wp_query= null;
			$blog_items = ($smof_data['blog_grid_items'])?$smof_data['blog_grid_items']:12;
			$wp_query = new WP_Query(); $wp_query->query('showposts='.$blog_items . '&paged='.$paged);
			$max_num_pages = $wp_query->max_num_pages;
			while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

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

						</div>
					</div>
				</div>

			<?php endwhile; ?>

		</div>
	</div>
</div>
<?php
if ($max_num_pages > 1) {
?>
<script type="text/javascript">
var page = 1,
	max_page = <?php echo $max_num_pages ?>;
jQuery(document).ready(function(){
	jQuery("#grid_load_more").click(function(){
		jQuery(this).hide();
		jQuery('#spinner').show();
		jQuery.ajax({
			type: 'POST',
			url: '<?php echo admin_url('admin-ajax.php'); ?>',
			data: {
				action: 'gridPagination',
				page: page+1
			},
			success: function(data, textStatus, XMLHttpRequest){
				page++;

				var newItems = jQuery('<div>', {html:data}),
					blogList = jQuery('.w-blog-list');

				newItems.imagesLoaded(function() {
					newItems.children().each(function(childIndex,child){
						blogList.append(jQuery(child)).isotope('appended', jQuery(child), function(){
							blogList.isotope('reLayout');

						});


					});

				});


				jQuery('#spinner').hide();
				if (max_page > page) {
					jQuery("#grid_load_more").show();
				}

			},
			error: function(MLHttpRequest, textStatus, errorThrown){
				jQuery('#spinner').hide();
				jQuery(this).show();
			}
		});
	});
});
</script>
<div class="w-blog-load" style="text-align: center;">
	<a href="javascript:void(0);" id="grid_load_more" class="g-btn size_small">Load More Posts</a>
	<img id="spinner" src="<?php echo get_template_directory_uri() ?>/img/rs/loader2.gif" style="display: none;">
</div>
<?php
}
wp_reset_postdata();
$wp_query= $temp;