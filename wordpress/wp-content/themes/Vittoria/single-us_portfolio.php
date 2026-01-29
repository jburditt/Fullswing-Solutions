<?php
global $smof_data;
define('IS_FULLWIDTH', TRUE);
get_header(); ?>
<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
<?php get_template_part( 'templates/pagehead' ); ?>


<div class="l-submain">
	<div class="l-submain-h g-html">

<?php
$slides = rwmb_meta('vittoria_portfolio_slider_images', 'type=image');
//var_dump($slides);
if (count($slides) > 0)
{
?>
	<div class="w-gallery type_slider">
		<div class="w-gallery-h">
			<div class="w-gallery-main nav_show">
				<div class="w-gallery-main-h flexslider flex-loading">
					<ul class="slides">
	<?php foreach ($slides as $slide) {?>
						<li>
							<img src="<?php echo $slide['full_url'] ?>" title="<?php echo $slide['title'] ?>">
						</li>
	<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery('.flexslider').flexslider({
				controlNav: false,
				smoothHeight: true,
				start: function() {
					jQuery('.flexslider').removeClass('flex-loading');
				}
			});
		});
	</script>
<?php
}
?>
	<?php if ( ! rwmb_meta('vittoria_hide_portfolio_details')) { ?><div class="g-cols">
			<div class="two-thirds"><?php } ?>
				<h3><?php echo $smof_data['portfolio_desc_title'] ?></h3>
				<p><?php echo rwmb_meta('vittoria_portfolio_description'); ?> </p>
				<?php if ($smof_data['project_sharing_facebook'] == 1 || $smof_data['project_sharing_twitter'] == 1 || $smof_data['project_sharing_google'] == 1 || $smof_data['project_sharing_pinterest'] == 1 || $smof_data['project_sharing_email'] == 1) { ?>
				<script type="text/javascript">var switchTo5x=true;</script>
				<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
				<script type="text/javascript">stLight.options({publisher: "ur-b6bcdd5b-dde-cce8-a00c-478890414ff", doNotHash: true, doNotCopy: false, hashAddressBar: true});</script>
				<div class="w-share">
					<div class="w-share-h">
						<div class="w-share-title">
							<h4 class="w-share-title-h"><?php echo __('Share', 'Vittoria') ?>:</h4>
						</div>
						<div class="w-share-list">
							<?php if ($smof_data['project_sharing_facebook'] == 1) { ?><span class="st_facebook_hcount"></span><?php } ?>
							<?php if ($smof_data['project_sharing_twitter'] == 1) { ?><span class="st_twitter_hcount"></span><?php } ?>
							<?php if ($smof_data['project_sharing_google'] == 1) { ?><span class="st_googleplus_hcount"></span><?php } ?>
							<?php if ($smof_data['project_sharing_pinterest'] == 1) { ?><span class="st_pinterest_hcount"></span><?php } ?>
							<?php if ($smof_data['project_sharing_email'] == 1) { ?><span class="st_email_hcount"></span><?php } ?>
						</div>
					</div>
				</div>
				<?php } ?>
			<?php if ( ! rwmb_meta('vittoria_hide_portfolio_details')) { ?></div><?php } ?>
			<?php if ( ! rwmb_meta('vittoria_hide_portfolio_details')) { ?>
			<div class="one-third">
				<h3><?php echo $smof_data['portfolio_details_title']; ?></h3>
				<div class="w-info">

					<?php if ($client = rwmb_meta('vittoria_portfolio_client')) { ?>
					<div class="w-info-item">
						<h4 class="w-info-item-title"><?php echo $smof_data['portfolio_client_title']; ?>:</h4>
						<span class="w-info-item-content"><?php echo $client ?></span>
					</div>
					<?php } ?>
					<?php if ($date = rwmb_meta('vittoria_portfolio_date')) { ?>
					<div class="w-info-item">
						<h4 class="w-info-item-title"><?php echo $smof_data['portfolio_date_title']; ?>:</h4>
						<span class="w-info-item-content"><?php echo $date ?></span>
					</div>
					<?php } ?>
					<?php
					$item_categories_links = '';
					$item_categories_classes = '';
					$item_categories = get_the_terms(get_the_ID(), 'us_portfolio_category');
					if (is_array($item_categories))
					{
						foreach ($item_categories as $item_category)
						{
							$item_categories_links .= $item_category->name.', ';
							$item_categories_classes .= ' '.$item_category->slug;
						}
					}
					if (mb_strlen($item_categories_links) > 0 )
					{
						$item_categories_links = mb_substr($item_categories_links, 0, -2);
					}
					if ($item_categories_links != '') { ?>
					<div class="w-info-item">
						<h4 class="w-info-item-title"><?php echo $smof_data['portfolio_category_title']; ?>:</h4>
										<span class="w-info-item-content">
											<?php echo $item_categories_links ?>
										</span>
					</div>
					<?php } ?>
					<?php if ($url = rwmb_meta('vittoria_portfolio_url')) { ?>
					<div class="w-info-item">
						<h4 class="w-info-item-title"><?php echo $smof_data['portfolio_url_title']; ?>:</h4>
										<span class="w-info-item-content">
											<a href="<?php echo (substr($url, 0, 4) == 'http')?$url:'//'.$url; ?>"><?php echo $url ?></a>
										</span>
					</div>
					<?php } ?>

				</div>

			</div>
		<?php } ?>
		<?php if ( ! rwmb_meta('vittoria_hide_portfolio_details')) { ?></div><?php } ?>
	</div>
</div>

	<?php the_content(); ?>

<?php endwhile; else : ?>
	<?php _e('No posts were found.', 'Vittoria'); ?>
<?php endif; ?>
<?php get_footer(); ?>