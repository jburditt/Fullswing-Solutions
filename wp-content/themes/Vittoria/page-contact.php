<?php
/*
Template Name: Page: Contact
*/
global $smof_data;
define('IS_FULLWIDTH', TRUE);
// Send mail on form submit
$errors = array();
if(isset($_POST['action']) AND $_POST['action'] == 'contact') {

	// Check name
	if(@$smof_data['contact_form_name_field'] == 'Shown, required' AND trim($_POST['contact_name']) == '') {
		$errors['contact_name'] = __('Please, enter Your name');
	} elseif (in_array(@$smof_data['contact_form_name_field'], array('Shown, required', 'Shown, not required'))) {
		$name = trim($_POST['contact_name']);
	}

	// Check email
	if(@$smof_data['contact_form_email_field'] == 'Shown, required' AND trim($_POST['contact_email']) == '')  {
		$errors['contact_email'] = __('Please, enter Your email');
	} elseif (@$smof_data['contact_form_email_field'] == 'Shown, required' AND filter_var($_POST['contact_email'],FILTER_VALIDATE_EMAIL) === false) {
		$errors['contact_email'] = __('Please, enter correct email');
	} elseif (in_array(@$smof_data['contact_form_email_field'], array('Shown, required', 'Shown, not required'))) {
		$email = trim($_POST['contact_email']);
	}

	// Check phone
	if(@$smof_data['contact_form_phone_field'] == 'Shown, required' AND trim($_POST['contact_phone']) == '') {
		$errors['contact_phone'] = __('Please, enter Your phone');
	} elseif (in_array(@$smof_data['contact_form_phone_field'], array('Shown, required', 'Shown, not required'))) {
		$phone = trim($_POST['contact_phone']);
	}

	//Check message
	if(trim($_POST['contact_message']) == '') {
		$errors['contact_message'] = __('Please, enter Your message');
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['contact_message']));
		} else {
			$comments = trim($_POST['contact_message']);
		}
	}


	// Send the email
	if(!count($errors)) {
		$emailTo = (@$smof_data['contact_form_email'] != '')?$smof_data['contact_form_email']:get_option('admin_email');
		$body = '';
		if (in_array(@$smof_data['contact_form_name_field'], array('Shown, required', 'Shown, not required'))) {
			$body .= "Name: $name \n\n";
		}
		if (in_array(@$smof_data['contact_form_email_field'], array('Shown, required', 'Shown, not required'))) {
			$body .= "Email: $email \n\n";
		}
		if (in_array(@$smof_data['contact_form_phone_field'], array('Shown, required', 'Shown, not required'))) {
			$body .= "Phone: $phone \n\n";
		}
		$body .= "Message:\n $comments";
		$headers = '';

		$mail = wp_mail($emailTo, __('Contact request from', 'Vittoria')." http://".$_SERVER['HTTP_HOST'].'/', $body, $headers);

		$mailSent = true;

		$_POST['contact_name'] = $_POST['contact_email'] = $_POST['contact_phone'] = $_POST['contact_message'] = '';
	}
}
get_header(); ?>
<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
	<?php get_template_part( 'templates/pagehead' ); ?>


	<?php the_content(); ?>

	<?php if ($smof_data['contact_gmap_address'] != '' OR ($smof_data['contact_gmap_latitude'] != '' AND $smof_data['contact_gmap_longitude'] != '')) {?>
	<div class="l-submain for_map">
		<div class="l-submain-h g-html i-cf">

			<div class="w-map animate_hfc">
				<div class="w-map-h">

				</div>
			</div>
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
			<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri().'/';?>js/jquery.gmap.min.js"></script>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('.w-map-h').gMap({
						<?php if ($smof_data['contact_gmap_latitude'] != '' AND $smof_data['contact_gmap_longitude'] != '') {?>
						latitude: "<?php echo $smof_data['contact_gmap_latitude'] ?>",
						longitude: "<?php echo $smof_data['contact_gmap_longitude'] ?>",
						<?php } else {?>
						address: "<?php echo $smof_data['contact_gmap_address'] ?>",
						<?php } ?>
						zoom: 13,
						markers:[
							{
								<?php if ($smof_data['contact_gmap_latitude'] != '' AND $smof_data['contact_gmap_longitude'] != '') {?>
									latitude: "<?php echo $smof_data['contact_gmap_latitude'] ?>",
									longitude: "<?php echo $smof_data['contact_gmap_longitude'] ?>"
								<?php } else {?>
									address: "<?php echo $smof_data['contact_gmap_address'] ?>"<?php } ?><?php if ($smof_data['contact_gmap_marker'] != '') { ?>,
								html: "<?php echo $smof_data['contact_gmap_marker'] ?>",
								popup: true<?php } ?>
							}
						]
					});
				});
			</script>

		</div>
	</div>
	<?php } ?>
	<div class="l-submain">
	<div class="l-submain-h g-html i-cf">

	<div class="g-cols">
	<div class="one-third">

		<?php if ($smof_data['contact_address'] != '' OR $smof_data['contact_phone'] != '' OR $smof_data['contact_email']) { ?>
		<div class="w-contacts">
			<div class="w-contacts-h">
				<h3 class="w-contacts-title"><?php echo __('Contact Info', 'Vittoria')?></h3>
				<dl class="w-contacts-list">
					<?php if ($smof_data['contact_address'] != '') { ?>
					<dt class="w-contacts-list-key for_address"><?php echo __('Address', 'Vittoria')?>:</dt>
					<dd class="w-contacts-list-value"><?php echo $smof_data['contact_address'] ?></dd>
					<?php } ?>
					<?php if ($smof_data['contact_phone'] != '') { ?>
					<dt class="w-contacts-list-key for_phone"><?php echo __('Phone', 'Vittoria')?>:</dt>
					<dd class="w-contacts-list-value"><?php echo $smof_data['contact_phone'] ?></dd>
					<?php } ?>
					<?php if ($smof_data['contact_email']) { ?>
					<dt class="w-contacts-list-key for_email"><?php echo __('Email', 'Vittoria')?>:</dt>
					<dd class="w-contacts-list-value"><a href="mailto:<?php echo $smof_data['contact_email'] ?>"><?php echo $smof_data['contact_email'] ?></a></dd>
					<?php } ?>
				</dl>
			</div>
		</div>

		<hr>
		<?php } ?>
		<?php if ($smof_data['contact_show_socials']) { ?>
		<h3>Get Social</h3>

		<div class="w-socials size_normal">
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
		<?php } ?>

	</div>
	<div class="two-thirds">


		<h3><?php echo __('Get in Touch with Us', 'Vittoria')?></h3>
		<?php if (@$smof_data['contact_form_intro'] != '') { ?>
			<p><?php echo $smof_data['contact_form_intro'] ?></p>
		<?php } ?>
		<form class="g-form" action="" method="post">

			<?php if (isset($mailSent) AND $mailSent) { ?><div class="g-alert type_success with_close">
				<div class="g-alert-close">×</div>
				<div class="g-alert-body">
					<p><b><?php echo __('Thank You', 'Vittoria') ?>!</b> <?php echo __('Your message was sent', 'Vittoria') ?>.</p>
				</div>
			</div><?php } ?>
			<input type="hidden" name="action" value="contact">
			<div class="g-form-group">
				<div class="g-form-group-rows">
					<?php if (in_array(@$smof_data['contact_form_name_field'], array('Shown, required', 'Shown, not required'))) { ?>
					<div class="g-form-row<?php if (isset($errors['contact_name'])) echo ' check_wrong'; ?>">
						<div class="g-form-row-label">
							<label class="g-form-row-label-h" for="contact_name"><?php echo __('Your name', 'Vittoria')?><?php if (@$smof_data['contact_form_name_field'] == 'Shown, required') { echo ' *'; }?></label>
						</div>
						<div class="g-form-row-field">
							<div class="g-input">
								<input type="text" name="contact_name" id="contact_name" value="<?php echo @$_POST['contact_name'] ?>">
							</div>
						</div>
						<?php if (isset($errors['contact_name'])) { ?><div class="g-form-row-state"><?php echo $errors['contact_name'] ?></div><?php } ?>
					</div>
					<?php } ?>
					<?php if (in_array(@$smof_data['contact_form_email_field'], array('Shown, required', 'Shown, not required'))) { ?>
					<div class="g-form-row<?php if (isset($errors['contact_email'])) echo ' check_wrong'; ?>">
						<div class="g-form-row-label">
							<label class="g-form-row-label-h" for="input1x2"><?php echo __('Your email', 'Vittoria')?><?php if (@$smof_data['contact_form_email_field'] == 'Shown, required') { echo ' *'; }?></label>
						</div>
						<div class="g-form-row-field">
							<div class="g-input">
								<input type="email" name="contact_email" id="contact_email" value="<?php echo @$_POST['contact_email'] ?>">
							</div>
						</div>
						<?php if (isset($errors['contact_email'])) { ?><div class="g-form-row-state"><?php echo $errors['contact_email'] ?></div><?php } ?>
					</div>
					<?php } ?>
					<?php if (in_array(@$smof_data['contact_form_phone_field'], array('Shown, required', 'Shown, not required'))) { ?>
					<div class="g-form-row<?php if (isset($errors['contact_phone'])) echo ' check_wrong'; ?>">
						<div class="g-form-row-label">
							<label class="g-form-row-label-h" for="contact_phone"><?php echo __('Your phone', 'Vittoria')?><?php if (@$smof_data['contact_form_phone_field'] == 'Shown, required') { echo ' *'; }?></label>
						</div>
						<div class="g-form-row-field">
							<div class="g-input">
								<input type="text" name="contact_phone" id="contact_phone" value="<?php echo @$_POST['contact_phone'] ?>">
							</div>
						</div>
						<?php if (isset($errors['contact_phone'])) { ?><div class="g-form-row-state"><?php echo $errors['contact_phone'] ?></div><?php } ?>
					</div>
					<?php } ?>
					<div class="g-form-row<?php if (isset($errors['contact_message'])) echo ' check_wrong'; ?>">
						<div class="g-form-row-label">
							<label class="g-form-row-label-h" for="input1x3"><?php echo __('Your message', 'Vittoria')?> *</label>
						</div>
						<div class="g-form-row-field">
							<div class="g-input">
								<textarea name="contact_message" id="contact_message" cols="30" rows="10"><?php echo @$_POST['contact_message'] ?></textarea>
							</div>
						</div>
						<?php if (isset($errors['contact_message'])) { ?><div class="g-form-row-state"><?php echo $errors['contact_message'] ?></div><?php } ?>
					</div>
					<div class="g-form-row">
						<div class="g-form-row-label"></div>
						<div class="g-form-row-field">
							<button class="g-btn type_color"><?php echo __('Send Message', 'Vittoria')?></button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	</div>

	</div>
	</div>

<?php endwhile; else : ?>
	<?php _e('No posts were found.', 'Vittoria'); ?>
<?php endif; ?>
<?php get_footer(); ?>