<?php global $smof_data; ?><!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php bloginfo('name'); ?> <?php wp_title(' - ', true, 'left'); ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<?php if($smof_data['custom_favicon'] != "") { ?><link rel="shortcut icon" href="<?php echo $smof_data['custom_favicon']; ?>"><?php } ?>
	<?php wp_head(); ?>
</head>
<?php
$header_expand = $smof_data['header_expand'];
if (rwmb_meta('vittoria_header_expanded') == 'Compact') {
	$header_expand = 0;
} elseif (rwmb_meta('vittoria_header_expanded') == 'Expand') {
	$header_expand = 1;
}
?>
<body class="l-body<?php if ((rwmb_meta('vittoria_slider_revolution') != '' && rwmb_meta('vittoria_slider_revolution') != '0') OR $header_expand) {  ?> home<?php } ?>">
<?php get_template_part('templates/colors_css'); ?>
<?php if (rwmb_meta('vittoria_header_image') != '') { ?>
<div class="l-background" style="background-image: url(<?php echo rwmb_meta('vittoria_header_image') ?>);<?php if (rwmb_meta('vittoria_header_image_stretch') == 1) { ?> background-size: cover;<?php } ?>"></div>
<?php } elseif (@$smof_data['header_background_image'] != '') { ?>
<div class="l-background" style="background-image: url(<?php echo @$smof_data['header_background_image'] ?>);<?php if (@$smof_data['header_background_image_stretch'] == 1) { ?> background-size: cover;<?php } ?>"></div>
<?php } else { ?>
<div class="l-background"></div>
<?php } ?>
<?php
if (defined('IS_FULLWIDTH') AND IS_FULLWIDTH)
{
	$sidebar_position_class = 'col_cont';
}
elseif (defined('IS_POST') AND IS_POST)
{
	$sidebar_position_class = ($smof_data['post_sidebar_pos'] == 'Right')?'col_contside':'col_sidecont';
}
elseif (defined('IS_BLOG') AND IS_BLOG)
{
	$sidebar_position_class = ($smof_data['blog_sidebar_pos'] == 'Right')?'col_contside':'col_sidecont';
}
else
{
	$sidebar_position_class = (defined('SIDEBAR_POS') AND SIDEBAR_POS == 'right')?'col_contside':'col_sidecont';
}
$layout_class = ($smof_data['layout'] == 'Wide')?'type_wide':'type_boxed';

?>
<!-- CANVAS -->
<div class="l-canvas <?php echo $layout_class ?> <?php echo $sidebar_position_class ?>">
	<div class="l-canvas-h">

		<!-- HEADER -->
		<div class="l-header type_normal">
			<div class="l-header-h">

				<!-- subheader: top -->
				<div class="l-subheader at_top type_fixed">
					<div class="l-subheader-h i-widgets i-cf">
						<?php if ($smof_data['header_show_language']) {
							get_template_part('templates/lang_switcher');
						} ?>
						<?php if ($smof_data['header_show_search']) { ?>
						<div class="w-search submit_inside">
							<div class="w-search-h">
								<a class="w-search-show" href="javascript:void(0)"></a>
								<form class="w-search-form show_hidden" action="<?php echo home_url( '/' ); ?>">
									<?php if (@ICL_LANGUAGE_CODE != '' AND @ICL_LANGUAGE_CODE != 'ICL_LANGUAGE_CODE') { ?><input type="hidden" name="lang" value="<?php echo(ICL_LANGUAGE_CODE); ?>"><?php } ?>
									<div class="w-search-input">
										<div class="w-search-input-h">
											<input type="text" value="" name="s" placeholder="<?php echo __( 'enter the query', 'Vittoria' ); ?>"/>
										</div>
										<a class="w-search-close" href="javascript:void(0)" title="<?php echo __( 'Close search', 'Vittoria' ); ?>"></a>
									</div>
									<div class="w-search-submit">
										<input type="submit" id="searchsubmit"  value="<?php echo __( 'Search', 'Vittoria' ); ?>" />
									</div>
								</form>
							</div>
						</div>
						<?php } ?>

						<!-- NAV -->
						<nav class="w-nav">
							<div class="w-nav-h">
								<a class="w-nav-control" href="javascript:void(0);">
									<span class="w-nav-control-toggle"><?php echo __( 'Toggle Nav', 'Vittoria' ); ?></span>
								</a>
								<div class="w-nav-select">
									<select class="w-nav-select-h">
									</select>
								</div>
								<div class="w-nav-list layout_hor width_stretch level_1">
									<?php wp_nav_menu(
										array(
											'theme_location' => 'vittoria-top-menu',
											'theme_location' => 'vittoria-top-menu',
											'container'       => 'div',
											'container_class' => 'w-nav-list-h',
											'walker' => new Walker_Nav_Menu_Vittoria(),
											'items_wrap' => '%3$s',
											'fallback_cb' => false,

										));
									?>
								</div>
							</div>
						</nav><!-- /NAV -->

					</div>
				</div>

				<div class="l-subheader at_middle">
					<div class="l-subheader-h i-widgets i-cf">

						<div class="w-logo <?php if ((rwmb_meta('vittoria_slider_revolution') != '' && rwmb_meta('vittoria_slider_revolution') != '0') OR $header_expand) {  ?>sloganat_bottom<?php } else { ?>sloganat_right<?php } ?><?php if (@$smof_data['logo_as_text'] == 1) { echo ' with_title'; } ?>">
							<div class="w-logo-h">
								<a class="w-logo-link" href="<?php echo get_option('siteurl'); ?>">
									<img class="w-logo-img" src="<?php echo ($smof_data['custom_logo'])?$smof_data['custom_logo']:get_stylesheet_directory_uri().'/img/logo.png';?>"  alt="<?php bloginfo('name'); ?>">
									<span class="w-logo-title">
										<span class="w-logo-title-h"><?php if (@$smof_data['logo_text'] != '') { echo $smof_data['logo_text']; } else { bloginfo('name'); } ?></span>
									</span>
								</a>
								<div class="w-logo-slogan">
									<div class="w-logo-slogan-h"><?php echo ($smof_data['custom_slogan'] != '')?$smof_data['custom_slogan']:'';?></div>
								</div>
							</div>
						</div>

					</div>
				</div>

				<div class="l-subheader at_bottom">
				<?php if (rwmb_meta('vittoria_slider_revolution') != '' && rwmb_meta('vittoria_slider_revolution') != '0') {  ?>
					<div class="l-subheader-h  i-cf">

					<?php if(class_exists('RevSlider')){ putRevSlider(rwmb_meta('vittoria_slider_revolution')); } ?>

					</div>
				<?php } ?>
				</div>

			</div>
		</div>
		<!-- /HEADER -->

		<!-- MAIN -->
		<div class="l-main">
			<div class="l-main-h">



