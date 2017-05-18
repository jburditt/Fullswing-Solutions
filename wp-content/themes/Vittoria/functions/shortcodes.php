<?php

// Avoid direct calls to this file where wp core files not present
if (!function_exists ('add_action')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

$auto_open = FALSE;
$first_tab = FALSE;
$first_tab_title = FALSE;

class US_Shortcodes {

	public function __construct()
	{
		add_filter('the_content', array($this, 'paragraph_fix'));
		add_filter('the_content', array($this, 'sections_fix'));
		add_filter('the_content', array($this, 'a_to_img_magnific_pupup'));

		add_shortcode('row', array($this, 'row'));
		add_shortcode('one_half', array($this, 'one_half'));
		add_shortcode('one_third', array($this, 'one_third'));
		add_shortcode('two_third', array($this, 'two_third'));
		add_shortcode('one_quarter', array($this, 'one_quarter'));
		add_shortcode('three_quarter', array($this, 'three_quarter'));
		add_shortcode('one_fourth', array($this, 'one_fourth'));
		add_shortcode('three_fourth', array($this, 'three_fourth'));

		add_shortcode('button', array($this, 'button'));
		add_shortcode('alert', array($this, 'alert'));

		add_shortcode('tabs', array($this, 'tabs'));
		add_shortcode('accordion', array($this, 'accordion'));
		add_shortcode('toggle', array($this, 'toggle'));
		add_shortcode('item', array($this, 'item'));
		add_shortcode('item_title', array($this, 'item_title'));

		add_shortcode('timeline', array($this, 'timeline'));
		add_shortcode('timepoint', array($this, 'timepoint'));
		add_shortcode('timepoint_title', array($this, 'timepoint_title'));

		add_shortcode('separator', array($this, 'separator'));

		add_shortcode('icon', array($this, 'icon'));
		add_shortcode('iconbox', array($this, 'iconbox'));
		add_shortcode('testimonial', array($this, 'testimonial'));

//		add_shortcode('table', array($this, 'table'));

		add_shortcode('youtube', array($this, 'youtube'));
		add_shortcode('vimeo', array($this, 'vimeo'));

		add_shortcode('services', array($this, 'services'));
		add_shortcode('service', array($this, 'service'));

		add_shortcode('clients', array($this, 'clients'));
		add_shortcode('recent_works', array($this, 'recent_works'));
		add_shortcode('latest_posts', array($this, 'latest_posts'));

		add_shortcode('section', array($this, 'section'));

		add_shortcode('team', array($this, 'team'));
		add_shortcode('member', array($this, 'member'));

		add_shortcode('actionbox', array($this, 'actionbox'));
		add_shortcode('callout', array($this, 'callout'));
		add_shortcode('mission', array($this, 'mission'));

		add_shortcode('pricing_table', array($this, 'pricing_table'));
		add_shortcode('pricing_column', array($this, 'pricing_column'));
		add_shortcode('pricing_row', array($this, 'pricing_row'));
		add_shortcode('pricing_footer', array($this, 'pricing_footer'));

		add_shortcode('animate', array($this, 'animate'));


		remove_shortcode('gallery');
		add_shortcode('gallery', array($this, 'gallery'));
	}

	public function paragraph_fix($content)
	{
		$array = array (
			'<p>[' => '[',
			']</p>' => ']',
			']<br />' => ']',
			']<br>' => ']',
		);

		$content = strtr($content, $array);
		return $content;
	}

	public function sections_fix($content)
	{
		$link_pages_args = array(
			'before'           => '<div class="w-blog-pagination"><div class="g-pagination">',
			'after'            => '</div></div>',
			'next_or_number'   => 'next_and_number',
			'nextpagelink'     => __('Next', 'Vittoria'),
			'previouspagelink' => __('Previous', 'Vittoria'),
			'echo'             => 0
		);

		if (strpos($content, '[callout') !== FALSE)
		{
			$content = preg_replace('%(\[callout(?:(?:(?:(?:(?!type=)[^\]]*)(type=)["\']?(grey|colored)["\']?)(?:(?:(?!with=)[^\]]*)(with=)["\']?(shadow|arrow)["\']?))|(?:(?:(?:(?!with=)[^\]]*)(with=)["\']?(shadow|arrow)["\']?)(?:(?:(?!type=)[^\]]*)(type=)["\']?(grey|colored)["\']?))|(?:(?:(?:(?!with=)[^\]]*)(with=)["\']?(shadow|arrow)["\']?)?(?:(?:(?!type=)[^\]]*)(type=)["\']?(grey|colored)["\']?)?))[^\]]*?\])%i', '[section $2$3 $4$5 $6$7 $8$9 $10$11 $12$13]$1[/section]', $content);
		}

		if (strpos($content, '[mission') !== FALSE)
		{
			$content = preg_replace('%(\[mission(?:(?:(?:(?:(?!type=)[^\]]*)(type=)["\']?(grey|colored)["\']?)(?:(?:(?!with=)[^\]]*)(with=)["\']?(shadow|arrow)["\']?))|(?:(?:(?:(?!with=)[^\]]*)(with=)["\']?(shadow|arrow)["\']?)(?:(?:(?!type=)[^\]]*)(type=)["\']?(grey|colored)["\']?))|(?:(?:(?:(?!with=)[^\]]*)(with=)["\']?(shadow|arrow)["\']?)?(?:(?:(?!type=)[^\]]*)(type=)["\']?(grey|colored)["\']?)?))[^\]]*?\])%i', '[section $2$3 $4$5 $6$7 $8$9 $10$11 $12$13]$1[/section]', $content);
		}

		if (strpos($content, '[section') !== FALSE)
		{
			$content = strtr($content, array('[section' => '[/section automatic_end_section="1"][section'));

			$content = strtr($content, array('[/section]' => '[/section][section]'));

			$content = strtr($content, array('[/section automatic_end_section="1"]' => '[/section]'));

			$content = '[section]'.$content.us_wp_link_pages($link_pages_args).'[/section]';
		}
		else
		{
			$content = '[section]'.$content.us_wp_link_pages($link_pages_args).'[/section]';
		}

		$content = preg_replace('%\[section\](\\s)*\[/section\]%i', '', $content);//echo '<textarea>'.$content.'</textarea>';

		return $content;
	}

	public function a_to_img_magnific_pupup ($content)
	{
		$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
		$replacement = '<a$1class="image-link" href=$2$3.$4$5$6>';
		$content = preg_replace($pattern, $replacement, $content);

		return $content;
	}

	public function row ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		$output = '<div class="g-cols">'.do_shortcode($content).'</div>';

		return $output;
	}

	public function one_half ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'animate' => '',
			), $attributes);

		$animate_class = ($attributes['animate'] != '')?' animate_'.$attributes['animate']:'';

		$output = '<div class="one-half'.$animate_class.'">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function one_third ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'animate' => '',
			), $attributes);

		$animate_class = ($attributes['animate'] != '')?' animate_'.$attributes['animate']:'';

		$output = '<div class="one-third'.$animate_class.'">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function two_third ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'animate' => '',
			), $attributes);

		$animate_class = ($attributes['animate'] != '')?' animate_'.$attributes['animate']:'';

		$output = '<div class="two-thirds'.$animate_class.'">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function one_quarter ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'animate' => '',
			), $attributes);

		$animate_class = ($attributes['animate'] != '')?' animate_'.$attributes['animate']:'';

		$output = '<div class="one-quarter'.$animate_class.'">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function three_quarter ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'animate' => '',
			), $attributes);

		$animate_class = ($attributes['animate'] != '')?' animate_'.$attributes['animate']:'';

		$output = '<div class="three-quarters'.$animate_class.'">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function one_fourth ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'animate' => '',
			), $attributes);

		$animate_class = ($attributes['animate'] != '')?' animate_'.$attributes['animate']:'';

		$output = '<div class="one-quarter'.$animate_class.'">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function three_fourth ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'animate' => '',
			), $attributes);

		$animate_class = ($attributes['animate'] != '')?' animate_'.$attributes['animate']:'';

		$output = '<div class="three-quarters'.$animate_class.'">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function button($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'text' => '',
				'url' => '',
				'target' => '',
				'type' => '',
				'size' => '',
				'icon' => '',
			), $attributes);

		$icon_part = '';
		if ($attributes['icon'] != '') {
			$icon_part = '<i class="icon-'.$attributes['icon'].'"></i>';
		}

		$output = '<a href="'.$attributes['url'].'"';
		$output .= ($attributes['target'] != '')?' target="'.$attributes['target'].'"':'';
		$output .= 'class="g-btn';
		$output .= ($attributes['type'] != '')?' type_'.$attributes['type']:'';
		$output .= ($attributes['size'] != '')?' size_'.$attributes['size']:'';
		$output .= '">'.$icon_part.$attributes['text'].'</a>';

		return $output;
	}

	public function alert($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'type' => 'info',
			), $attributes);

		$output = '<div class="g-alert with_close type_'.$attributes['type'].'"><div class="g-alert-close">×</div><div class="g-alert-body"><p>'.do_shortcode($content).'</p></div></div>';

		return $output;
	}

	public function pricing_table($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		$output = '<div class="w-pricing"> <div class="w-pricing-h">'.do_shortcode($content).'</div></div>';

		return $output;
	}

	public function pricing_column($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'title' => '',
				'type' => '',
				'price' => '',
				'time' => '',
			), $attributes);

		$featured_class = ($attributes['type'] == 'featured')?' type_featured':'';

		$output = 	'<div class="w-pricing-item'.$featured_class.'"><div class="w-pricing-item-h">
						<div class="w-pricing-item-header">
							<div class="w-pricing-item-title">'.$attributes['title'].'</div>
							<div class="w-pricing-item-price">'.$attributes['price'].'<small>'.$attributes['time'].'</small></div>
						</div>
						<ul class="w-pricing-item-features">'.
						do_shortcode($content).
					'</ul></div></div>';

		return $output;
	}

	public function pricing_row($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		$output = 	'<li class="w-pricing-item-feature">'.do_shortcode($content).'</li>';

		return $output;

	}

	public function pricing_footer($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'url' => '',
				'type' => '',
				'size' => '',
				'icon' => '',
			), $attributes);

		if ($attributes['url'] == '') $attributes['url'] = 'javascript:void(0)';

		$output = 	'<div class="w-pricing-item-footer">
						<a class="w-pricing-item-footer-button g-btn';
		$output .= ($attributes['type'] != '')?' type_'.$attributes['type']:'';
		$output .= ($attributes['size'] != '')?' size_'.$attributes['size']:'';
		$output .= '" href="'.$attributes['url'].'">'.do_shortcode($content).'</a>
					</div>';

		return $output;

	}



	public function timeline($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		global $first_tab, $first_tab_title, $auto_open;
		$auto_open = TRUE;
		$first_tab_title = TRUE;
		$first_tab = TRUE;

		$content_titles = str_replace('[timepoint', '[timepoint_title', $content);
		$content_titles = str_replace('[/timepoint', '[/timepoint_title', $content_titles);

		$output = '<div class="w-timeline"><div class="w-timeline-h"><div class="w-timeline-list"><div class="w-timeline-list-h">'.do_shortcode($content_titles).'</div></div><div class="w-timeline-sections">'.do_shortcode($content).'</div></div></div>';

		$auto_open = FALSE;
		$first_tab_title = FALSE;
		$first_tab = FALSE;

		return $output;
	}

	public function timepoint_title($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'title' => '',
				'open' => (@in_array('open', $attributes) OR (isset($attributes['open']) AND $attributes['open'] == 1))
			), $attributes);

		global $first_tab_title, $auto_open;
		if ($auto_open) {
			$active_class = ($first_tab_title)?' active':'';
			$first_tab_title = FALSE;
		} else {
			$active_class = ($attributes['open'])?' active':'';
		}

		$output = 	'<div class="w-timeline-item'.$active_class.'">
						<span class="w-timeline-item-bullet"></span>
						<span class="w-timeline-item-title">'.$attributes['title'].'</span>
					</div>';

		return $output;
	}

	public function timepoint($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'title' => '',
				'open' => (@in_array('open', $attributes) OR (isset($attributes['open']) AND $attributes['open'] == 1))
			), $attributes);

		global $first_tab, $auto_open;
		if ($auto_open) {
			$active_class = ($first_tab)?' active':'';
			$first_tab = FALSE;
		} else {
			$active_class = ($attributes['open'])?' active':'';
		}

		$output = 	'<div class="w-timeline-section'.$active_class.'">
						<div class="w-timeline-section-h">
							<div class="w-timeline-section-title">
								<span class="w-timeline-section-title-bullet"></span>
								<span class="w-timeline-section-title-text">'.$attributes['title'].'</span>
							</div>
							<div class="w-timeline-section-content">
								'.do_shortcode($content).'
							</div>
						</div>
					</div>';

		return $output;
	}

	public function tabs($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		global $first_tab, $first_tab_title, $auto_open;
		$auto_open = TRUE;
		$first_tab_title = TRUE;
		$first_tab = TRUE;

		$content_titles = str_replace('[item', '[item_title', $content);
		$content_titles = str_replace('[/item', '[/item_title', $content_titles);

		$output = '<div class="w-tabs"><div class="w-tabs-h"><div class="w-tabs-list">'.do_shortcode($content_titles).'</div>'.do_shortcode($content).'</div></div>';

		$auto_open = FALSE;
		$first_tab_title = FALSE;
		$first_tab = FALSE;

		return $output;
	}

	public function accordion($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		global $first_tab, $first_tab_title, $auto_open;
		$auto_open = TRUE;
		$first_tab_title = TRUE;
		$first_tab = TRUE;


		$output = '<div class="w-tabs layout_accordion with_icon"><div class="w-tabs-h">'.do_shortcode($content).'</div></div>';

		$auto_open = FALSE;
		$first_tab_title = FALSE;
		$first_tab = FALSE;

		return $output;
	}

	public function item_title($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'title' => '',
				'open' => (@in_array('open', $attributes) OR (isset($attributes['open']) AND $attributes['open'] == 1)),
				'icon' => '',
			), $attributes);

		global $first_tab_title, $auto_open;
		if ($auto_open) {
			$active_class = ($first_tab_title)?' active':'';
			$first_tab_title = FALSE;
		} else {
			$active_class = ($attributes['open'])?' active':'';
		}


		$icon_class = ($attributes['icon'] != '')?' icon-'.$attributes['icon']:'';
		$item_icon_class = ($attributes['icon'] != '')?' with_icon':'';

		$output = 	'<div class="w-tabs-item'.$active_class.$item_icon_class.'">'.
						'<span class="w-tabs-item-icon'.$icon_class.'"></span>'.
						'<span class="w-tabs-item-title">'.$attributes['title'].'</span>'.
					'</div>';

		return $output;
	}

	public function item($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'title' => '',
				'open' => (@in_array('open', $attributes) OR (isset($attributes['open']) AND $attributes['open'] == 1)),
				'icon' => '',
			), $attributes);

		global $first_tab, $auto_open;
		if ($auto_open) {
			$active_class = ($first_tab)?' active':'';
			$first_tab = FALSE;
		} else {
			$active_class = ($attributes['open'])?' active':'';
		}
		$icon_class = ($attributes['icon'] != '')?' icon-'.$attributes['icon']:'';
		$item_icon_class = ($attributes['icon'] != '')?' with_icon':'';

		$output = 	'<div class="w-tabs-section'.$active_class.$item_icon_class.'">'.
						'<div class="w-tabs-section-title">'.
							'<span class="w-tabs-section-title-icon'.$icon_class.'"></span>'.
							'<span class="w-tabs-section-title-text">'.$attributes['title'].'</span>'.
							'<span class="w-tabs-section-title-control"></span>'.
						'</div>'.
						'<div class="w-tabs-section-content">'.
							'<div class="w-tabs-section-content-h">'.
								'<p>'.do_shortcode($content).'</p>'.
							'</div>'.
						'</div>'.
					'</div>';

		return $output;
	}

	public function toggle($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'open' => (@in_array('open', $attributes) OR (isset($attributes['open']) AND $attributes['open'] == 1))
			), $attributes);

		$output = 	'<div class="w-tabs layout_accordion type_toggle with_icon"><div class="w-tabs-h">'.do_shortcode($content).'</div></div>';

		return $output;
	}

	public function separator($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'type' => "",
				'align' => "",
			), $attributes);

		$type_class = ($attributes['type'] != '')?' hr_'.$attributes['type']:'';
		$align_class = ($attributes['align'] != '')?' hr_'.$attributes['align']:'';
		if ($attributes['type'] == 'short' AND $attributes['align'] != '')
		{

		}
		$output = 	'<div class="hr'.$type_class.$align_class.'">
						<span class="hr-h">
							<span class="hr-hh"></span>
						</span>
					</div>';

		return $output;
	}

	public function icon($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'icon' => "",
			), $attributes);

		$output = 	'<span class="icon-'.$attributes['icon'].'"></span>';

		return $output;
	}

	public function table($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'type' => 1,
			), $attributes);

		$output = str_replace('<table', '<table class="g-table-'.$attributes['type'].'" ', do_shortcode($content));

		return $output;
	}

	public function youtube ($attributes)
	{
		$attributes = shortcode_atts(
			array(
				'id' => '',
				'width' => 600,
				'height' => 360
			), $attributes);

		$output = '<div class="w-video"><div class="w-video-h"><iframe title="YouTube video player" width="' . $attributes['width'] . '" height="' . $attributes['height'] . '" src="http://www.youtube.com/embed/' . $attributes['id'] . '" frameborder="0" allowfullscreen></iframe></div></div>';

		return $output;
	}

	public function vimeo ($attributes)
	{
		$attributes = shortcode_atts(
			array(
				'id' => '',
				'width' => 600,
				'height' => 360
			), $attributes);

		$output = '<div class="w-video"><div class="w-video-h"><iframe src="http://player.vimeo.com/video/' . $attributes['id'] . '?byline=0&amp;color=cc2200" width="' . $attributes['width'] . '" height="' . $attributes['height'] . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';

		return $output;
	}

	public function callout ($attributes, $content) // TODO remove if not needed
	{
		$attributes = shortcode_atts(
			array(
				'type' => 'grey',
				'controls' => 'right',
				'title' => 'Intro box title',
				'title_size' => 'h2',
				'message' => 'Intro box message',
				'button1' => '',
				'link1' => '',
				'style1' => '',
				'size1' => '',
				'button2' => '',
				'link2' => '',
				'style2' => '',
				'size2' => '',
			), $attributes);

		$controls_position_class = ($attributes['controls'] != 'bottom')?' at_right':'';
		$actionbox_controls_position_class = ($attributes['controls'] != 'bottom')?' controls_aside':'';

		switch ($attributes['title_size']) {
			case 'h1': $title_tag = 'h1';
				break;

			case 'h3': $title_tag = 'h3';
				break;

			default: $title_tag = 'h2';
			break;

		}

		$output = 	'<div class="w-actionbox type_'.$attributes['type'].$actionbox_controls_position_class.'">'.
			'<div class="w-actionbox-h">'.
			'<div class="w-actionbox-text">';
		if ($attributes['title'] != '')
		{
			$output .= 			'<'.$title_tag.'>'.html_entity_decode($attributes['title']).'</'.$title_tag.'>';
		}
		if ($attributes['message'] != '')
		{
			$output .= 			'<p>'.html_entity_decode($attributes['message']).'</p>';
		}


		$output .=			'</div>'.
			'<div class="w-actionbox-controls'.$controls_position_class.'">';

		if ($attributes['button1'] != '' AND $attributes['link1'] != '')
		{
			$colour_class = ($attributes['style1'] != '')?' type_'.$attributes['style1']:'';
			$size_class = ($attributes['size1'] != '')?' size_'.$attributes['size1']:'';
			$output .= 			'<a class="w-actionbox-button g-btn'.$size_class.$colour_class.'" href="'.$attributes['link1'].'">'.$attributes['button1'].'</a>';
		}

		if ($attributes['button2'] != '' AND $attributes['link2'] != '')
		{
			$colour_class = ($attributes['style2'] != '')?' type_'.$attributes['style2']:'';
			$size_class = ($attributes['size2'] != '')?' size_'.$attributes['size2']:'';
			$output .= 			'<a class="w-actionbox-button g-btn'.$size_class.$colour_class.'" href="'.$attributes['link2'].'">'.$attributes['button2'].'</a>';
		}

		$output .=			'</div>'.
			'</div>'.
			'</div>';
		return $output;
	}

	public function mission ($attributes, $content) // TODO remove if not needed
	{
		$attributes = shortcode_atts(
			array(
				'type' => 'grey',
				'with' => '',
				'caption' => 'Intro box message',
				'text' => 'Intro box title',
				'text_size' => 'normal',
			), $attributes);

		switch ($attributes['text_size']) {
			case 'big': $text_tag = 'h1';
				break;

			case 'small': $text_tag = 'h3';
				break;

			default: $text_tag = 'h2';
			break;

		}

		$output =	'<div class="w-mission">';
		if ($attributes['caption'] != '')
		{
			$output .=	'<span class="w-mission-title">'.$attributes['caption'].'</span>';
		}
		if ($attributes['text'] != '')
		{
			$output .=	'<'.$text_tag.'>'.html_entity_decode($attributes['text']).'</'.$text_tag.'>';
		}

		$output .=	'</div>';

		return $output;
	}

	public function actionbox ($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'type' => 'grey',
				'controls' => 'right',
				'title' => 'Intro box title',
				'title_size' => 'h2',
				'message' => 'Intro box message',
				'button1' => '',
				'link1' => '',
				'style1' => '',
				'size1' => '',
				'button2' => '',
				'link2' => '',
				'style2' => '',
				'size2' => '',
				'animate' => '',
			), $attributes);

		$animate_class = ($attributes['animate'] != '')?' animate_'.$attributes['animate']:'';

		$controls_position_class = ($attributes['controls'] != 'bottom')?' at_right':'';
		$actionbox_controls_position_class = ($attributes['controls'] != 'bottom')?' controls_aside':'';

		switch ($attributes['title_size']) {
			case 'h1': $title_tag = 'h1';
				break;

			case 'h3': $title_tag = 'h3';
				break;

			default: $title_tag = 'h2';
				break;

		}

		$output = 	'<div class="w-actionbox type_'.$attributes['type'].$actionbox_controls_position_class.$animate_class.'">'.
			'<div class="w-actionbox-h">'.
			'<div class="w-actionbox-text">';
		if ($attributes['title'] != '')
		{
			$output .= 			'<'.$title_tag.'>'.html_entity_decode($attributes['title']).'</'.$title_tag.'>';
		}
		if ($attributes['message'] != '')
		{
			$output .= 			'<p>'.html_entity_decode($attributes['message']).'</p>';
		}


		$output .=			'</div>'.
			'<div class="w-actionbox-controls'.$controls_position_class.'">';

		if ($attributes['button1'] != '' AND $attributes['link1'] != '')
		{
			$colour_class = ($attributes['style1'] != '')?' type_'.$attributes['style1']:'';
			$size_class = ($attributes['size1'] != '')?' size_'.$attributes['size1']:'';
			$output .= 			'<a class="w-actionbox-button g-btn'.$size_class.$colour_class.'" href="'.$attributes['link1'].'">'.$attributes['button1'].'</a>';
		}

		if ($attributes['button2'] != '' AND $attributes['link2'] != '')
		{
			$colour_class = ($attributes['style2'] != '')?' type_'.$attributes['style2']:'';
			$size_class = ($attributes['size2'] != '')?' size_'.$attributes['size2']:'';
			$output .= 			'<a class="w-actionbox-button g-btn'.$size_class.$colour_class.'" href="'.$attributes['link2'].'">'.$attributes['button2'].'</a>';
		}

		$output .=			'</div>'.
			'</div>'.
			'</div>';
		return $output;
	}

	public function section ($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'type' => FALSE,
				'with' => FALSE,
				'background' => FALSE,

			), $attributes);

		$output_type = ($attributes['type'] != FALSE)?' type_'.$attributes['type']:'';
		$output_with = ($attributes['with'] != FALSE)?' with_'.$attributes['with']:'';
		$background_style = '';
		if ($attributes['type'] == 'background')
		{
			$background_style = ' style="background-image: url('.$attributes['background'].')"';
		}

		$output =	'<div class="l-submain'.$output_type.$output_with.'"'.$background_style.'>'.
						'<div class="l-submain-h g-html i-cf">'.
							do_shortcode($content).
						'</div>'.
					'</div>';

		return $output;
	}

	public function section_dummy ($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'type' => FALSE,
				'with' => FALSE,

			), $attributes);

		$output = 	'<div>'.do_shortcode($content).'</div>';

		return $output;
	}

	public function iconbox($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'icon' => '',
				'img' => '',
				'title' => '',
				'animate' => '',
				'link' => '',

			), $attributes);

		$img_class = ($attributes['img'] != '')?' with_img':'';
		$animate_class = ($attributes['animate'] != '')?' animate_'.$attributes['animate']:'';
		$link_start = $link_end = '';
		if ($attributes['link'] != '') {
			$link = (substr($attributes['link'], 0, 4) == 'http')?$attributes['link']:'//'.$attributes['link'];
			$link_start = '<a class="w-iconbox-link" href="'.$link.'">';
			$link_end = '</a>';
		}

		$output =	'<div class="w-iconbox'.$img_class.$animate_class.'">
						<div class="w-iconbox-h">'.$link_start.'
							<div class="w-iconbox-icon">
								<i class="icon-'.$attributes['icon'].'"></i>';
		if ($attributes['img'] != '') {
			$output .=			'<div class="w-iconbox-icon-img">
									<img src="'.$attributes['img'].'" alt=""/>
								</div>';
		}
		$output .=	'			</div>
							<div class="w-iconbox-text">
								<h3>'.$attributes['title'].'</h3>
								<p>'.do_shortcode($content).'</p>
							</div>
						'.$link_end.'</div>
					</div>';

		return $output;
	}

	public function testimonial($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'author' => '',
				'company' => '',
				'animate' => '',

			), $attributes);

		$animate_class = ($attributes['animate'] != '')?' animate_'.$attributes['animate']:'';

		$output = 	'<div class="w-testimonial'.$animate_class.'">
						<div class="w-testimonial-h">
							<blockquote>
								<q class="w-testimonial-text">'.do_shortcode($content).'</q>
								<div class="w-testimonial-person">
									<i class="icon-user"></i>
									<span class="w-testimonial-person-name">'.$attributes['author'].'</span>,
									<span class="w-testimonial-person-meta">'.$attributes['company'].'</span>
								</div>
							</blockquote>
						</div>
					</div>';

		return $output;
	}

	public function services ($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		$output = 	'<div class="w-services columns_4">
						<div class="w-services-h">
							<div class="w-services-list">';
		$output .= do_shortcode($content);
		$output .= 			'</div>'.
						'</div>'.
					'</div>';

		return $output;
	}

	public function service ($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'title' => '',
				'icon' => '',
				'img' => '',
				'animate' => '',
			), $attributes);

		$img_class = ($attributes['img'] != '')?' with_img':'';
		$animate_class = ($attributes['animate'] != '')?' animate_'.$attributes['animate']:'';

		$output = '<div class="w-services-item'.$img_class.$animate_class.'">
						<div class="w-services-item-h">
							<div class="w-services-item-icon">
								<i class="icon-'.$attributes['icon'].'"></i>';
		if ($attributes['img'] != '') {
			$output .=			'<div class="w-services-item-icon-img">
									<img src="'.$attributes['img'].'" alt=""/>
								</div>';
		}
		$output .= 			'</div>
							<div class="w-services-item-text">
								<h3>'.$attributes['title'].'</h3>
								<p>'.do_shortcode($content).'</p>
							</div>
						</div>
					</div>';

		return $output;
	}

	public function team ($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		$output = 	'<div class="w-team columns_2 cols_fluid imgpos_left">'.
						'<div class="w-team-h">'.
							'<div class="w-team-list">';
		$output .= 				do_shortcode($content);
		$output .= 			'</div>'.
						'</div>'.
					'</div>';

		return $output;
	}

	public function member ($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'type' => '',
				'name' => '',
				'role' => '',
				'img' => '',
				'email' => '',
				'facebook' => '',
				'twitter' => '',
				'linkedin' => '',
				'animate' => '',
			), $attributes);

		$type_class = ($attributes['type'] != '')?' type_'.$attributes['type']:'type_half';

		$animate_class = ($attributes['animate'] != '')?' animate_'.$attributes['animate']:'';

		$output =	'<div class="w-team-member'.$type_class.$animate_class.'"><div class="w-team-member-h"><div class="w-team-member-hh">';

		if ($attributes['img'] != '')
		{
			$output .= 	'<div class="w-team-member-image">
							<img src="'.$attributes['img'].'" alt="'.$attributes['name'].'" />
						</div>';
		}
		else
		{
			$output .= 	'<div class="w-team-member-image">
							<img src="'.get_template_directory_uri().'/img/placeholder/500x500.gif" alt="'.$attributes['name'].'" />
						</div>';
		}

		$output .=		'<div class="w-team-member-meta"><div class="w-team-member-meta-h">'.
							'<h4 class="w-team-member-name">'.$attributes['name'].'</h4>'.
							'<div class="w-team-member-role">'.$attributes['role'].'</div>'.
							'<div class="w-team-member-description">'.
								'<p>'.do_shortcode($content).'</p>'.
							'</div>';
		if ($attributes['email'] != '' OR $attributes['facebook'] != '' OR $attributes['twitter'] != '' OR $attributes['linkedin'] != '')
		{
			$output .=		'<div class="w-team-member-links">'.
								'<div class="w-team-member-links-list">';
			if ($attributes['email'] != '')
			{
				$output .= 			'<a class="w-team-member-links-item" href="mailto:'.$attributes['email'].'" target="_blank"><i class="icon-envelope"></i></a>';
			}
			if ($attributes['facebook'] != '')
			{
				$output .= 			'<a class="w-team-member-links-item" href="'.$attributes['facebook'].'" target="_blank"><i class="icon-facebook"></i></a>';
			}
			if ($attributes['twitter'] != '')
			{
				$output .= 			'<a class="w-team-member-links-item" href="'.$attributes['twitter'].'" target="_blank"><i class="icon-twitter"></i></a>';
			}
			if ($attributes['linkedin'] != '')
			{
				$output .= 			'<a class="w-team-member-links-item" href="'.$attributes['linkedin'].'" target="_blank"><i class="icon-linkedin"></i></a>';
			}
			$output .=			'</div>'.
							'</div>';
		}
		$output .=		'</div></div>'.
					'</div></div></div>';

		return $output;
	}

	public function clients($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'title' => __('Our Clients', 'Vittoria'),
				'amount' => 1000,
			), $attributes);

		$args = array(
			'post_type' => 'us_client',
			'paged' => 1,
			'posts_per_page' => $attributes['amount'],
		);

		$cleints = new WP_Query($args);

		$output = 	'<div class="w-clients type_carousel columns_5">
							<div class="w-clients-h">
								<div class="w-clients-list">
									<div class="w-clients-list-h">';

		while($cleints->have_posts())
		{
			$cleints->the_post();
			if(has_post_thumbnail())
			{
				$client_new_tab = (rwmb_meta('vittoria_client_new_tab') == 1)?' target="_blank"':'';
				$client_url = (rwmb_meta('vittoria_client_url') != '')?rwmb_meta('vittoria_client_url'):'javascript:void(0);';
				$client_url = (substr($client_url, 0, 4) == 'http' OR $client_url == 'javascript:void(0);' OR $client_url == '#')?$client_url:'//'.$client_url;
				$output .= 			'<a class="w-clients-item" href="'.$client_url.'"'.$client_new_tab.'>'.
										get_the_post_thumbnail(get_the_ID(), 'carousel-thumb').
									'</a>';
			}
		}

	$output .=						'</div>
								</div>
								<a class="w-clients-nav to_prev disabled" href="javascript:void(0)" title="Show previous"></a>
								<a class="w-clients-nav to_next" href="javascript:void(0)" title="Show next"></a>
							</div>
						</div>';
		return $output;
	}

	public function animate($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'type' => 'afc',
			), $attributes);

		$output = '<div class="animate_'.$attributes['type'].'">'.do_shortcode($content).'</div>';

		return $output;
	}

	public function latest_posts($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'posts' => 2,
			), $attributes);

		if ( ! in_array($attributes['posts'], array(1,2,3)))
		{
			$attributes['posts'] = 2;
		}


		$args = array(
			'paged' => 1,
			'posts_per_page' => $attributes['posts'],
			'post__not_in' => get_option( 'sticky_posts' )
		);

		$posts = new WP_Query($args);

		$output = 	'<div class="w-shortblog columns_'.$attributes['posts'].' date_atleft">
							<div class="w-shortblog-h">
								<div class="w-shortblog-list">';
		while($posts->have_posts())
		{
			$posts->the_post();
			$output .= 				'<div class="w-shortblog-entry">
										<div class="w-shortblog-entry-h">
											<a class="w-shortblog-entry-link" href="'.get_permalink(get_the_ID()).'">
												<h4 class="w-shortblog-entry-title">
													<span class="w-shortblog-entry-title-h">'.get_the_title().'</span>
												</h4>
											</a>
											<div class="w-shortblog-entry-meta">
												<div class="w-shortblog-entry-meta-date">
													<span class="w-shortblog-entry-meta-date-month">'.get_the_date('M').'</span>
										<span class="w-shortblog-entry-meta-date-day">'.get_the_date('d').'</span>
										<span class="w-shortblog-entry-meta-date-year">'.get_the_date('Y').'</span>
												</div>
											</div>
											<div class="w-shortblog-entry-short">
											'.apply_filters('the_excerpt', get_the_excerpt()).'
											</div>
										</div>
									</div>';
		}
		$output .=				'</div>
							</div>
						</div>';
		return $output;
	}

	public function recent_works($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'columns' => 4,
				'amount' => NULL,
				'animate' => '',
			), $attributes);

		$animate_class = ($attributes['animate'] != '')?' animate_'.$attributes['animate']:'';

		if ( ! in_array($attributes['columns'], array(2,3,4)))
		{
			$attributes['columns'] = 4;
		}

		if ($attributes['amount'] == NULL)
		{
			$attributes['amount'] = $attributes['columns'];
		}

		$args = array(
			'post_type' => 'us_portfolio',
			'paged' => 1,
			'posts_per_page' => $attributes['amount'],
		);

		$works = new WP_Query($args);

		$output = 	'<div class="w-portfolio columns_'.$attributes['columns'].$animate_class.'">
						<div class="w-portfolio-h">
							<div class="w-portfolio-list">
								<div class="w-portfolio-list-h">';

		while($works->have_posts())
		{
			$works->the_post();

			$item_categories_links = '';
			$item_categories = get_the_terms(get_the_ID(), 'us_portfolio_category');
			if (is_array($item_categories))
			{
				foreach ($item_categories as $item_category)
				{
					$item_categories_links .= $item_category->name.' / ';
				}
			}
			if (mb_strlen($item_categories_links) > 0 )
			{
				$item_categories_links = mb_substr($item_categories_links, 0, -2);
			}

			if ( has_post_thumbnail() ) {
				$the_thumbnail = get_the_post_thumbnail( null, 'portfolio-list');
			} else {
				$the_thumbnail =  '<img src="'.get_template_directory_uri() .'/img/placeholder/500x500.gif" alt="">';
			}

			$output .= 			'<div class="w-portfolio-item">
								<div class="w-portfolio-item-h">
									<a class="w-portfolio-item-anchor" href="'.get_permalink(get_the_ID()).'">
										<div class="w-portfolio-item-image">
											'.$the_thumbnail.'
											<div class="w-portfolio-item-meta">
												<h2 class="w-portfolio-item-title">'.get_the_title().'</h2>
												<span class="w-portfolio-item-text">'.$item_categories_links.'</span>
											</div>
										</div>
									</a>
								</div>
								</div>';

		}


		$output .=				'</div>'.
							'</div>'.
						'</div>'.
					'</div>';
		return $output;
	}

	public function gallery($attributes)
	{
		$post = get_post();

		static $instance = 0;
		$instance++;

		if ( ! empty( $attributes['ids'] ) )
		{
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attributes['orderby'] ) )
			{
				$attributes['orderby'] = 'post__in';
			}
			$attributes['include'] = $attributes['ids'];
		}

		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attributes['orderby'] ) )
		{
			$attributes['orderby'] = sanitize_sql_orderby( $attributes['orderby'] );
			if ( !$attributes['orderby'] )
			{
				unset( $attributes['orderby'] );
			}
		}

		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 3,
			'type'       => 's',
			'include'    => '',
			'exclude'    => ''
		), $attributes));

		if ( ! in_array($type, array('xs', 's', 'm', 'l', 'masonry',))) {
			$type = "s";
		}

		$size = 'gallery-'.$type;
		if ($type == 'masonry') {
			$type_classes = ' type_masonry';
		} else {
			$type_classes = ' layout_tile size_'.$type;
		}


		$id = intval($id);
		if ( 'RAND' == $order )
		{
			$orderby = 'none';
		}

		if ( !empty($include) )
		{
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

			$attachments = array();
			if (is_array($_attachments))
			{
				foreach ( $_attachments as $key => $val ) {
					$attachments[$val->ID] = $_attachments[$key];
				}
			}
		}
		elseif ( !empty($exclude) )
		{
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}
		else
		{
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}

		if ( empty($attachments) )
		{
			return '';
		}

		if ( is_feed() )
		{
			$output = "\n";
			if (is_array($attachments))
			{
				foreach ( $attachments as $att_id => $attachment )
					$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			}
			return $output;
		}


		$output = '<div class="w-gallery'.$type_classes.'"> <div class="w-gallery-h"> <div class="w-gallery-tnails"> <div class="w-gallery-tnails-h">';

		$i = 1;
		if (is_array($attachments))
		{
			foreach ( $attachments as $id => $attachment ) {


				$title = trim(strip_tags( get_post_meta($id, '_wp_attachment_image_alt', true) ));
				if (empty($title))
				{
					$title = trim(strip_tags( $attachment->post_excerpt )); // If not, Use the Caption
				}
				if (empty($title ))
				{
					$title = trim(strip_tags( $attachment->post_title )); // Finally, use the title
				}

				$output .= '<a class="w-gallery-tnail order_'.$i.'" href="'.wp_get_attachment_url($id).'" title="'.$title.'">';
				$output .= '<span class="w-gallery-tnail-h">';
				$output .= wp_get_attachment_image( $id, $size, 0 );
				$output .= '<span class="w-gallery-tnail-title"><i class="icon-search"></i></span>';

				$output .= '</span>';
				$output .= '</a>';

				$i++;

			}
		}

		$output .= "</div> </div> </div> </div>\n";

		return $output;
	}
}

global $us_shortcodes;

$us_shortcodes = new US_Shortcodes;

// Add buttons to tinyMCE
function us_add_buttons() {
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'us_tinymce_plugin');
		add_filter('mce_buttons_3', 'us_tinymce_buttons');
	}
}

function us_tinymce_buttons($buttons) {
	array_push($buttons, "columns", "separator_btn", "button", "tabs", "accordion", "toggle", "icon", "iconbox", "testimonial", "services", "timeline", "team", "latest_posts", "recent_works", "clients", "actionbox", "callout", "section", "video", "pricing_table", "alert", "animate");
	return $buttons;
}

function us_tinymce_plugin($plugin_array) {
	$plugin_array['columns'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['alert'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['tabs'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['accordion'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['toggle'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['video'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['team'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['button'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['section'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['separator_btn'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['icon'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['iconbox'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['testimonial'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['services'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['timeline'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['latest_posts'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['recent_works'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['clients'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['actionbox'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['callout'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['mission'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['pricing_table'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['animate'] = get_template_directory_uri().'/functions/tinymce/buttons.js';

	return $plugin_array;
}

add_action('admin_init', 'us_add_buttons');

function us_media_templates(){

	?>
	<script type="text/html" id="tmpl-my-custom-gallery-setting">
		<label class="setting">
			<span><?php echo __('Type', 'Vittoria'); ?></span>
			<select data-setting="type">
				<option value="default_val"><?php echo __('S size thumbs', 'Vittoria'); ?></option>
				<option value="xs"><?php echo __('XS size thumbs', 'Vittoria'); ?></option>
				<option value="m"><?php echo __('M size thumbs', 'Vittoria'); ?></option>
				<option value="l"><?php echo __('L size thumbs', 'Vittoria'); ?></option>
				<option value="masonry"><?php echo __('Masonry', 'Vittoria'); ?></option>
			</select>
		</label>
	</script>

	<script>

		jQuery(document).ready(function(){

			// add your shortcode attribute and its default value to the
			// gallery settings list; $.extend should work as well...
			_.extend(wp.media.gallery.defaults, {
				type: 'default_val'
			});

			// merge default gallery settings template with yours
			wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
				template: function(view){
					return wp.media.template('gallery-settings')(view)
						+ wp.media.template('my-custom-gallery-setting')(view);
				}
			});

		});

	</script>
<?php

}

// Add Type select to Gallery window
add_action('print_media_templates', 'us_media_templates');

