<?php

/*-----------------------------------------------------------------------------------*/
/*	Button Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['button'] = array(
	'no_preview' => true,
	'params' => array(
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button URL',
			'desc' => 'Add the button\'s url eg http://example.com'
		),
		'text' => array(
			'std' => 'Button Text',
			'type' => 'text',
			'label' => 'Button\'s Text',
			'desc' => 'Font Awesome Icon name',
		),
		'icon' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button\'s Icon',
			'desc' => '',
		),
		'type' => array(
			'type' => 'select',
			'label' => 'Button Type',
			'desc' => 'Select the button\'s type, ie the button\'s styling',
			'options' => array(
				'' => 'Default',
				'color' => 'Color',
				'dark' => 'Dark',
				'inverse' => 'Inverse',
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => 'Button Size',
			'desc' => '',
			'options' => array(
				'' => 'Normal',
				'small' => 'Small',
				'big' => 'Big'
			)
		),
		'target' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Link\'s target',
			'desc' => '_blank, _self or specific window ID',
		),
	),
	'shortcode' => '[button url="{{url}}" text="{{text}}" size="{{size}}" type="{{type}}" icon="{{icon}}" target="{{target}}"]',
	'popup_title' => 'Insert Button shortcode'
);

/*-----------------------------------------------------------------------------------*/
/*	Alert Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['alert'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => 'Alert Type',
			'desc' => 'Select the alert\'s type',
			'options' => array(
				'info' => 'Info',
				'attention' => 'Attention',
				'success' => 'Success',
				'error' => 'Error',
			)
		),
		'content' => array(
			'std' => 'Alert Text',
			'type' => 'textarea',
			'label' => 'Alert Text',
			'desc' => 'Add the alert\'s text',
		)
		
	),
	'shortcode' => '[alert type="{{type}}"] {{content}} [/alert]',
	'popup_title' => 'Insert Alert Message shortcode'
);

/*-----------------------------------------------------------------------------------*/
/*	Tabs Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['tabs'] = array(
    'params' => array(),
    'no_preview' => true,
    'shortcode' => '[tabs] {{child_shortcode}} <br>[/tabs]',
    'popup_title' => 'Insert Tabs shortcode',
    
    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => 'Title',
                'type' => 'text',
                'label' => 'Tab Title',
                'desc' => '',
            ),
			'icon' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Tab\'s Icon',
				'desc' => '',
			),
            'content' => array(
                'std' => 'Tab Content. You can use other shortcodes here',
                'type' => 'textarea',
                'label' => 'Tab Content',
                'desc' => ''
            ),
        ),
        'shortcode' => '<br>[item title="{{title}}" icon="{{icon}}"] {{content}} [/item]',
        'clone_button' => 'Add Tab'
    )
);


/*-----------------------------------------------------------------------------------*/
/*	Toggle Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['toggle'] = array(
    'params' => array(),
    'no_preview' => true,
    'shortcode' => '[toggle] {{child_shortcode}} [/toggle]',
    'popup_title' => 'Insert Toggles shortcode',

    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => 'Title',
                'type' => 'text',
                'label' => 'Toggle Title',
                'desc' => '',
            ),
			'icon' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Toggle\'s Icon',
				'desc' => '',
			),
			'open' => array(
				'type' => 'select',
				'label' => 'Open/Closed',
				'desc' => '',
				'options' => array(
					'0' => 'Closed',
					'1' => 'Open',
				)
			),
            'content' => array(
                'std' => 'Toggle Content',
                'type' => 'textarea',
                'label' => 'Toggle Content. You can use other shortcodes here',
                'desc' => ''
            ),
        ),
        'shortcode' => '<br>[item title="{{title}}" icon="{{icon}}" open="{{open}}"] {{content}} [/item]',
        'clone_button' => 'Add Toggle'
    )
);
/*-----------------------------------------------------------------------------------*/
/*	Accordion Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['accordion'] = array(
    'params' => array(),
    'no_preview' => true,
    'shortcode' => '[accordion] {{child_shortcode}} [/accordion]',
    'popup_title' => 'Insert Accordion shortcode',

    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => 'Title',
                'type' => 'text',
                'label' => 'Tab Title',
                'desc' => '',
            ),
			'icon' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Tab\'s Icon',
				'desc' => '',
			),
            'content' => array(
                'std' => 'Tab Content. You can use other shortcodes here',
                'type' => 'textarea',
                'label' => 'Tab Content',
                'desc' => ''
            ),
        ),
        'shortcode' => '<br>[item title="{{title}}" icon="{{icon}}"] {{content}} [/item]',
        'clone_button' => 'Add Accordion'
    )
);

/*-----------------------------------------------------------------------------------*/
/*	Video Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['video'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => 'Video Type',
			'desc' => '',
			'options' => array(
				'youtube' => 'YouTube',
				'vimeo' => 'Vimeo',
			)
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Video ID',
			'desc' => 'Enter video ID (eg. 0YlTOSiVLnQ for YouTube or 48363485 for Vimeo)',
		),
//		'width' => array(
//			'std' => '600',
//			'type' => 'text',
//			'label' => 'Width',
//			'desc' => '',
//		),
//		'height' => array(
//			'std' => '360',
//			'type' => 'text',
//			'label' => 'Height',
//			'desc' => '',
//		),

	),
	'shortcode' => '[{{type}} id="{{id}}"]',
	'popup_title' => 'Insert Video shortcode'
);

/*-----------------------------------------------------------------------------------*/
/*	Youtube Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['youtube'] = array(
	'no_preview' => true,
	'params' => array(
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'YouTube Video ID',
			'desc' => 'Enter video ID (eg. 0YlTOSiVLnQ)',
		),
//		'width' => array(
//			'std' => '600',
//			'type' => 'text',
//			'label' => 'Width',
//			'desc' => '',
//		),
//		'height' => array(
//			'std' => '360',
//			'type' => 'text',
//			'label' => 'Height',
//			'desc' => '',
//		),

	),
	'shortcode' => '[youtube id="{{id}}"]',
	'popup_title' => 'Insert Youtube shortcode'
);

/*-----------------------------------------------------------------------------------*/
/*	Vimeo Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['vimeo'] = array(
	'no_preview' => true,
	'params' => array(
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Vimeo Video ID',
			'desc' => 'Enter video ID (eg. 48363485)',
		),
//		'width' => array(
//			'std' => '600',
//			'type' => 'text',
//			'label' => 'Width',
//			'desc' => '',
//		),
//		'height' => array(
//			'std' => '360',
//			'type' => 'text',
//			'label' => 'Height',
//			'desc' => '',
//		),

	),
	'shortcode' => '[vimeo id="{{id}}"]',
	'popup_title' => 'Insert Vimeo shortcode'
);


/*-----------------------------------------------------------------------------------*/
/*	Section Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['section'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => 'Type',
			'desc' => 'Section\'s type, i.e. style',
			'options' => array(
				'normal' => 'White',
				'grey' => 'Grey',
				'colored' => 'Colored',
				'background' => 'Image as Background',
			)
		),
		'with' => array(
			'type' => 'select',
			'label' => 'With',
			'desc' => 'Additional Styling',
			'options' => array(
				'' => 'None',
				'arrow' => 'Arrow',
				'shadow' => 'Shadow',
			)
		),
		'background' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Background Image',
			'desc' => 'Link to Background Image (used only if Type = Image as Background)',
		),
		'content' => array(
			'std' => 'You can use other shortcodes here ',
			'type' => 'textarea',
			'label' => 'Section content',
			'desc' => '',
		),

	),
	'shortcode' => '[section type="{{type}}" with="{{with}}" background="{{background}}"] {{content}} [/section]',
	'popup_title' => 'Insert Section shortcode'
);
/*-----------------------------------------------------------------------------------*/
/*	Team Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['team'] = array(
	'params' => array(),
	'no_preview' => true,
	'shortcode' => '[team] {{child_shortcode}} [/team]',
	'popup_title' => 'Insert Team Member shortcode',

	'child_shortcode' => array(
		'params' => array(
			'type' => array(
				'type' => 'select',
				'label' => 'Type',
				'desc' => 'Section\'s type, i.e. size and position on page',
				'options' => array(
					'main' => 'Main (full width)',
					'half' => 'Half',
					'small' => 'Small',
				)
			),
			'name' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Name',
				'desc' => '',
			),
			'role' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Role',
				'desc' => 'E.g. CEO, Manager, etc',
			),
			'img' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Photo',
				'desc' => 'Path to member\'s photo',
			),
			'email' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Email',
				'desc' => '',
			),
			'facebook' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Facebook',
				'desc' => '',
			),
			'twitter' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Twitter',
				'desc' => '',
			),
			'linkedin' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'LinkedIn',
				'desc' => '',
			),
			'animate' => array(
				'std' => '',
				'type' => 'select',
				'label' => 'Animation',
				'desc' => '',
				'options' => array(
					'' => 'No Amimation',
					'afc' => 'Appear From Center',
					'afl' => 'Appear From Left',
					'afr' => 'Appear From Right',
					'afb' => 'Appear From Bottom',
					'aft' => 'Appear From Top',
					'hfc' => 'Height From Center',
					'wfc' => 'Width From Center',
					'rfc' => 'Rotate From Center',
					'rfl' => 'Rotate From Left',
					'rfr' => 'Rotate From Right',
				),
			),
			'description' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => 'Member Description',
				'desc' => '',
			),
		),
		'shortcode' => '<br>[member type="{{type}}" name="{{name}}" role="{{role}}" img="{{img}}" email="{{email}}" facebook="{{facebook}}" twitter="{{twitter}}" linkedin="{{linkedin}}" animate="{{animate}}"] {{description}} [/member]',
		'clone_button' => 'Add Member'
	)
);
/*-----------------------------------------------------------------------------------*/
/*	Separator Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['separator'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => 'Separator Type',
			'desc' => 'Separator\'s type, ie the separator\'s styling',
			'options' => array(
				'' => 'Full Width',
				'short' => 'Short',
				'invisible' => 'Invisible',
			)
		),
		'align' => array(
			'type' => 'select',
			'label' => 'Separator Algin',
			'desc' => '',
			'options' => array(
				'' => 'Center',
				'left' => 'Left',
				'right' => 'Right'
			)
		),
	),
	'shortcode' => '[separator type="{{type}}" align="{{align}}"]',
	'popup_title' => 'Insert Separator shortcode'
);
/*-----------------------------------------------------------------------------------*/
/*	Icon Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['icon'] = array(
	'no_preview' => true,
	'params' => array(
		'icon' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Icon',
			'desc' => 'FontAwesome icon name',
		),
	),
	'shortcode' => '[icon icon="{{icon}}"]',
	'popup_title' => 'Insert Icon shortcode'
);
/*-----------------------------------------------------------------------------------*/
/*	IconBox Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['iconbox'] = array(
	'no_preview' => true,
	'params' => array(
		'icon' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Icon',
			'desc' => 'FontAwesome icon name',
		),
		'img' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Image',
			'desc' => 'Path to 32x32 px image. Image overrides icon setting.',
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Title',
			'desc' => '',
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Link',
			'desc' => '',
		),
		'animate' => array(
			'std' => '',
			'type' => 'select',
			'label' => 'Animation',
			'desc' => '',
			'options' => array(
				'' => 'No Amimation',
				'afc' => 'Appear From Center',
				'afl' => 'Appear From Left',
				'afr' => 'Appear From Right',
				'afb' => 'Appear From Bottom',
				'aft' => 'Appear From Top',
				'hfc' => 'Height From Center',
				'wfc' => 'Width From Center',
				'rfc' => 'Rotate From Center',
				'rfl' => 'Rotate From Left',
				'rfr' => 'Rotate From Right',
			),
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => 'IconBox Text',
			'desc' => '',
		),
	),
	'shortcode' => '[iconbox icon="{{icon}}" img="{{img}}" title="{{title}}" link="{{link}}" animate="{{animate}}"] {{content}} [/iconbox]',
	'popup_title' => 'Insert IconBox shortcode'
);
/*-----------------------------------------------------------------------------------*/
/*	Testimonial Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['testimonial'] = array(
	'no_preview' => true,
	'params' => array(
		'author' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Author',
			'desc' => '',
		),
		'company' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Company',
			'desc' => 'Author\'s company',
		),
		'animate' => array(
			'std' => '',
			'type' => 'select',
			'label' => 'Animation',
			'desc' => '',
			'options' => array(
				'' => 'No Amimation',
				'afc' => 'Appear From Center',
				'afl' => 'Appear From Left',
				'afr' => 'Appear From Right',
				'afb' => 'Appear From Bottom',
				'aft' => 'Appear From Top',
				'hfc' => 'Height From Center',
				'wfc' => 'Width From Center',
				'rfc' => 'Rotate From Center',
				'rfl' => 'Rotate From Left',
				'rfr' => 'Rotate From Right',
			),
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => 'Testimonial Text',
			'desc' => '',
		),
	),
	'shortcode' => '[testimonial author="{{author}}" company="{{company}}" animate="{{animate}}"] {{content}} [/testimonial]',
	'popup_title' => 'Insert Testimonial shortcode'
);

/*-----------------------------------------------------------------------------------*/
/*	Services Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['services'] = array(
	'params' => array(),
	'no_preview' => true,
	'shortcode' => '[services] {{child_shortcode}} [/services]',
	'popup_title' => 'Insert Services shortcode',

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Service Title',
				'desc' => '',
			),
			'icon' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Icon',
				'desc' => 'FontAwesome icon name',
			),
			'img' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Image',
				'desc' => 'Path to 40x40 px image. Image overrides icon setting.',
			),
			'animate' => array(
				'std' => '',
				'type' => 'select',
				'label' => 'Animation',
				'desc' => '',
				'options' => array(
					'' => 'No Amimation',
					'afc' => 'Appear From Center',
					'afl' => 'Appear From Left',
					'afr' => 'Appear From Right',
					'afb' => 'Appear From Bottom',
					'aft' => 'Appear From Top',
					'hfc' => 'Height From Center',
					'wfc' => 'Width From Center',
					'rfc' => 'Rotate From Center',
					'rfl' => 'Rotate From Left',
					'rfr' => 'Rotate From Right',
				),
			),
			'description' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => 'Service Description',
				'desc' => '',
			),
		),
		'shortcode' => '<br>[service title="{{title}}" icon="{{icon}}" img="{{img}}" animate="{{animate}}"] {{description}} [/service]',
		'clone_button' => 'Add Service'
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Timeline Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['timeline'] = array(
	'params' => array(),
	'no_preview' => true,
	'shortcode' => '[timeline] {{child_shortcode}} [/timeline]',
	'popup_title' => 'Insert Timeline shortcode',

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Timepoint Title',
				'desc' => 'Displayed above timeline point',
			),
			'text' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => 'Timepoint text',
				'desc' => '',
			),
		),
		'shortcode' => '<br>[timepoint title="{{title}}"] {{text}} [/timepoint]',
		'clone_button' => 'Add Timepoint'
	)
);
/*-----------------------------------------------------------------------------------*/
/*	Latest Posts Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['latest_posts'] = array(
	'no_preview' => true,
	'params' => array(
		'posts' => array(
			'type' => 'select',
			'label' => 'Posts',
			'desc' => '',
			'options' => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
			)
		),
	),
	'shortcode' => '[latest_posts posts="{{posts}}"]',
	'popup_title' => 'Insert Latest Posts shortcode'
);
/*-----------------------------------------------------------------------------------*/
/*	Recent Works Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['recent_works'] = array(
	'no_preview' => true,
	'params' => array(
		'columns' => array(
			'type' => 'select',
			'label' => 'Columns',
			'desc' => '',
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
			)
		),
		'amount' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Amount',
			'desc' => 'Amount of fetched portfolio projects',
		),
		'animate' => array(
			'std' => '',
			'type' => 'select',
			'label' => 'Animation',
			'desc' => '',
			'options' => array(
				'' => 'No Amimation',
				'afc' => 'Appear From Center',
				'afl' => 'Appear From Left',
				'afr' => 'Appear From Right',
				'afb' => 'Appear From Bottom',
				'aft' => 'Appear From Top',
				'hfc' => 'Height From Center',
				'wfc' => 'Width From Center',
				'rfc' => 'Rotate From Center',
				'rfl' => 'Rotate From Left',
				'rfr' => 'Rotate From Right',
			),
		),
	),
	'shortcode' => '[recent_works columns="{{columns}}" amount="{{amount}}" animate="{{animate}}"]',
	'popup_title' => 'Insert Portfolio Preview shortcode'
);
/*-----------------------------------------------------------------------------------*/
/*	ActionBox Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['actionbox'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => 'ActionBox Type',
			'desc' => 'Select the ActionBox\'s type, ie the styling',
			'options' => array(
				'colored' => 'Colored',
				'grey' => 'Grey',
			)
		),
		'controls' => array(
			'type' => 'select',
			'label' => 'Controls Position',
			'desc' => '',
			'options' => array(
				'right' => 'Right',
				'bottom' => 'Bottom',
			)
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Title',
			'desc' =>  'Slogan Text',
		),
		'title_size' => array(
			'type' => 'select',
			'label' => 'Title Size',
			'desc' => '',
			'options' => array(
				'h2' => 'h2',
				'h3' => 'h3',
				'h1' => 'h1',
			)
		),
		'message' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => 'Message',
			'desc' =>  'Smaller text under title',
		),
		'button1' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button 1 Text',
			'desc' => '',
		),
		'link1' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button 1 URL',
			'desc' => '',
		),
		'style1' => array(
			'type' => 'select',
			'label' => 'Button 1 Type',
			'desc' => '',
			'options' => array(
				'' => 'Default',
				'color' => 'Color',
				'dark' => 'Dark',
				'inverse' => 'Inverse',
			)
		),
		'size1' => array(
			'type' => 'select',
			'label' => 'Button 1 Size',
			'desc' => '',
			'options' => array(
				'' => 'Normal',
				'small' => 'Small',
				'big' => 'Big'
			)
		),
		'button2' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button 2 Text',
			'desc' => '',
		),
		'link2' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button 2 URL',
			'desc' => '',
		),
		'style2' => array(
			'type' => 'select',
			'label' => 'Button 2 Type',
			'desc' => '',
			'options' => array(
				'' => 'Default',
				'color' => 'Color',
				'dark' => 'Dark',
				'inverse' => 'Inverse',
			)
		),
		'size2' => array(
			'type' => 'select',
			'label' => 'Button 2 Size',
			'desc' => '',
			'options' => array(
				'' => 'Normal',
				'small' => 'Small',
				'big' => 'Big'
			)
		),
		'animate' => array(
			'std' => '',
			'type' => 'select',
			'label' => 'Animation',
			'desc' => '',
			'options' => array(
				'' => 'No Amimation',
				'afc' => 'Appear From Center',
				'afl' => 'Appear From Left',
				'afr' => 'Appear From Right',
				'afb' => 'Appear From Bottom',
				'aft' => 'Appear From Top',
				'hfc' => 'Height From Center',
				'wfc' => 'Width From Center',
				'rfc' => 'Rotate From Center',
				'rfl' => 'Rotate From Left',
				'rfr' => 'Rotate From Right',
			),
		),
	),
	'shortcode' => '[actionbox type="{{type}}" controls="{{controls}}" title="{{title}}" title_size="{{title_size}}" message="{{message}}" button1="{{button1}}" link1="{{link1}}" style1="{{style1}}" size1="{{size1}}" button2="{{button2}}" link2="{{link2}}" style2="{{style2}}" size2="{{size2}}" animate="{{animate}}"]',
	'popup_title' => 'Insert ActionBox shortcode'
);
/*-----------------------------------------------------------------------------------*/
/*	Callout Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['callout'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => 'Callout Type',
			'desc' => 'Select the ActionBox\'s type, ie the styling',
			'options' => array(
				'colored' => 'Colored',
				'grey' => 'Grey',
			)
		),
		'with' => array(
			'type' => 'select',
			'label' => 'With',
			'desc' => 'Additional Styling',
			'options' => array(
				'' => 'None',
				'arrow' => 'Arrow',
				'shadow' => 'Shadow',
			)
		),
		'controls' => array(
			'type' => 'select',
			'label' => 'Controls Position',
			'desc' => '',
			'options' => array(
				'right' => 'Right',
				'bottom' => 'Bottom',
			)
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Title',
			'desc' =>  'Slogan Text',
		),
		'title_size' => array(
			'type' => 'select',
			'label' => 'Title Size',
			'desc' => '',
			'options' => array(
				'h2' => 'h2',
				'h3' => 'h3',
				'h1' => 'h1',
			)
		),
		'message' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => 'Message',
			'desc' =>  'Smaller text under title',
		),
		'button1' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button 1 Text',
			'desc' => '',
		),
		'link1' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button 1 URL',
			'desc' => '',
		),
		'style1' => array(
			'type' => 'select',
			'label' => 'Button 1 Type',
			'desc' => '',
			'options' => array(
				'' => 'Default',
				'color' => 'Color',
				'dark' => 'Dark',
				'inverse' => 'Inverse',
			)
		),
		'size1' => array(
			'type' => 'select',
			'label' => 'Button 1 Size',
			'desc' => '',
			'options' => array(
				'' => 'Normal',
				'small' => 'Small',
				'big' => 'Big'
			)
		),
		'button2' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button 2 Text',
			'desc' => '',
		),
		'link2' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button 2 URL',
			'desc' => '',
		),
		'style2' => array(
			'type' => 'select',
			'label' => 'Button 2 Type',
			'desc' => '',
			'options' => array(
				'' => 'Default',
				'color' => 'Color',
				'dark' => 'Dark',
				'inverse' => 'Inverse',
			)
		),
		'size2' => array(
			'type' => 'select',
			'label' => 'Button 2 Size',
			'desc' => '',
			'options' => array(
				'' => 'Normal',
				'small' => 'Small',
				'big' => 'Big'
			)
		),
	),
	'shortcode' => '[callout type="{{type}}" with="{{with}}" controls="{{controls}}" title="{{title}}" title_size="{{title_size}}" message="{{message}}" button1="{{button1}}" link1="{{link1}}" style1="{{style1}}" size1="{{size1}}" button2="{{button2}}" link2="{{link2}}" style2="{{style2}}" size2="{{size2}}"]',
	'popup_title' => 'Insert Callout shortcode'
);
/*-----------------------------------------------------------------------------------*/
/*	Animate Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['animate'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'std' => '',
			'type' => 'select',
			'label' => 'Animation type',
			'desc' => '',
			'options' => array(
				'afc' => 'Appear From Center',
				'afl' => 'Appear From Left',
				'afr' => 'Appear From Right',
				'afb' => 'Appear From Bottom',
				'aft' => 'Appear From Top',
				'hfc' => 'Height From Center',
				'wfc' => 'Width From Center',
				'rfc' => 'Rotate From Center',
				'rfl' => 'Rotate From Left',
				'rfr' => 'Rotate From Right',
			),
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => 'Animated Text',
			'desc' => 'You can use other shortcodes or HTML elements here',
		),
	),
	'shortcode' => '[animate type="{{type}}"] {{content}} [/animate]',
	'popup_title' => 'Insert Animation shortcode'
);