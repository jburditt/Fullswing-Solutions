<?php global $smof_data; ?></div>
</div>
<!-- /MAIN -->

</div>
</div>
<!-- /CANVAS -->

<!-- FOOTER -->
<div class="l-footer type_normal">
	<div class="l-footer-h">
		<?php if ($smof_data['footer_show_widgets'] != 0) { ?>
		<!-- subfooter: top -->
		<div class="l-subfooter at_top">
			<div class="l-subfooter-h g-cols cols_fluid">

				<div class="one-third">
					<?php dynamic_sidebar('footer_first') ?>
				</div>

				<div class="one-third">
					<?php dynamic_sidebar('footer_second') ?>
				</div>

				<div class="one-third">
					<?php dynamic_sidebar('footer_third') ?>
				</div>

			</div>
		</div>
		<?php } ?>
		<!-- subfooter: bottom -->
		<div class="l-subfooter at_bottom">
			<div class="l-subfooter-h i-cf">

				<div class="w-copyright">© <?php echo $smof_data['footer_copyright'] ?></div>

				<div class="w-socials color_light">
					<div class="w-socials-h">
						<div class="w-socials-list">
<?php
$footer_socials = array (
	'rss' => 'RSS',
	'email' => 'Email',
	'facebook' => 'Facebook',
	'twitter' => 'Twitter',
	'gplus' => 'Google',
	'linkedin' => 'LinkedIn',
	'youtube' => 'YouTube',
	'vimeo' => 'Vimeo',
	'flickr' => 'Flickr',
	'pinterest' => 'Pinterest',
	'skype' => 'Skype',
	'tumblr' => 'Tumblr',
	'blogger' => 'Blogger',
	'dribbble' => 'Dribbble',
	'vk' => 'VK',
);
foreach ($footer_socials as $footer_social_key => $footer_social)
{
	if ($smof_data[$footer_social_key.'_link'] != '')
	{
		if ($footer_social_key == 'email')
		{
			?><div class="w-socials-item <?php echo $footer_social_key ?>">
			<a class="w-socials-item-link" href="mailto:<?php echo $smof_data[$footer_social_key.'_link'] ?>">
				<i class="iconsocial-<?php echo $footer_social_key ?>"></i>
			</a>
			<div class="w-socials-item-popup">
				<div class="w-socials-item-popup-h">
					<span class="w-socials-item-popup-text"><?php echo $footer_social ?></span>
				</div>
			</div>
			</div><?php
		}
		elseif ($footer_social_key == 'youtube')
		{
			?><div class="w-socials-item <?php echo $footer_social_key ?>">
			<a class="w-socials-item-link" target="_blank" href="<?php echo $smof_data[$footer_social_key.'_link'] ?>">
				<i class="iconsocial-<?php echo $footer_social_key ?>-1"></i>
			</a>
			<div class="w-socials-item-popup">
				<div class="w-socials-item-popup-h">
					<span class="w-socials-item-popup-text"><?php echo $footer_social ?></span>
				</div>
			</div>
			</div><?php
		}
		else
		{
			?><div class="w-socials-item <?php echo $footer_social_key ?>">
			<a class="w-socials-item-link" target="_blank" href="<?php echo $smof_data[$footer_social_key.'_link'] ?>">
				<i class="iconsocial-<?php echo $footer_social_key ?>"></i>
			</a>
			<div class="w-socials-item-popup">
				<div class="w-socials-item-popup-h">
					<span class="w-socials-item-popup-text"><?php echo $footer_social ?></span>
				</div>
			</div>
			</div><?php
		}

	}
}
?>

						</div>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>
<!-- /FOOTER -->
<?php if($smof_data['tracking_code'] != "") { echo $smof_data['tracking_code']; } ?>
<?php wp_footer(); ?>
</body>
</html>