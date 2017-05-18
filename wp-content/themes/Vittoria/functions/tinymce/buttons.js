/**
 * Rows with columns
 */
(function() {
	tinymce.create('tinymce.plugins.columns', {
		init : function(ed, url) {
			// TODO fix this
			window.columnsImageUrl = url;
		},
		createControl : function(n, cm) {
			switch (n) {
				case 'columns':
					var c = cm.createMenuButton('columns', {
						title : 'Add a row with columns',
						image : window.columnsImageUrl+'/columns.png',
						icons : false
					});

					c.onRenderMenu.add(function(c, m) {

						var sub2 = m.addMenu({title : '2 columns', alt: '...'});

						sub2.add({title : '[____1/2____][____1/2____]', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[row]<br />[one_half] ... [/one_half]<br />[one_half] ... [/one_half]<br />[/row]');
						}});

						sub2.add({title : '[__1/3__][______2/3______]', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[row]<br />[one_third] ... [/one_third]<br />[two_third] ... [/two_third]<br />[/row]');
						}});

						sub2.add({title : '[______2/3______][__1/3__]', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[row]<br />[two_third] ... [/two_third]<br />[one_third] ... [/one_third]<br />[/row]');
						}});

						sub2.add({title : '[_1/4_][_______3/4_______]', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[row]<br />[one_quarter] ... [/one_quarter]<br />[three_quarter] ... [/three_quarter]<br />[/row]');
						}});

						sub2.add({title : '[_______3/4_______][_1/4_]', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[row]<br />[three_quarter] ... [/three_quarter]<br />[one_quarter] ... [/one_quarter]<br />[/row]');
						}});


						var sub3 = m.addMenu({title : '3 columns'});

						sub3.add({title : '[__1/3__][__1/3__][__1/3__]', /*icon: 'columns-one_third-one_third-one_third', */onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[row]<br />[one_third] ... [/one_third]<br />[one_third] ... [/one_third]<br />[one_third] ... [/one_third]<br />[/row]');
						}});

						sub3.add({title : '[____1/2____][_1/4_][_1/4_]', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[row]<br />[one_half] ... [/one_half]<br />[one_quarter] ... [/one_quarter]<br />[one_quarter] ... [/one_quarter]<br />[/row]');
						}});

						sub3.add({title : '[_1/4_][_1/4_][____1/2____]', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[row]<br />[one_quarter] ... [/one_quarter]<br />[one_quarter] ... [/one_quarter]<br />[one_half] ... [/one_half]<br />[/row]');
						}});

						sub3.add({title : '[_1/4_][____1/2____][_1/4_]', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[row]<br />[one_quarter] ... [/one_quarter]<br />[one_half] ... [/one_half]<br />[one_quarter] ... [/one_quarter]<br />[/row]');
						}});

						m.add({title : '4 columns', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[row]<br />[one_quarter] ... [/one_quarter]<br />[one_quarter] ... [/one_quarter]<br />[one_quarter] ... [/one_quarter]<br />[one_quarter] ... [/one_quarter]<br />[/row]');
						}});
					});

					// Return the new menu button instance
					return c;
			}

			return null;

		}
	});


	tinymce.PluginManager.add('columns', tinymce.plugins.columns);
})();


/**
 * Alert
 */
(function() {
	tinymce.create('tinymce.plugins.alert', {
		init : function(ed, url) {
			ed.addButton('alert', {
				title : 'Add Alert Message',
				image : url+'/alert.png',
				onclick : function () {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Alert',
						identifier: 'alert'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('alert', tinymce.plugins.alert);
})();
/**
 * Tabs
 */
(function() {
	tinymce.create('tinymce.plugins.tabs', {
		init : function(ed, url) {
			ed.addButton('tabs', {
				title : 'Add Tabs',
				image : url+'/tabs.png',
				onclick :  function () {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Tabs',
						identifier: 'tabs'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);
})();
/**
 * Accordion
 */
(function() {
	tinymce.create('tinymce.plugins.accordion', {
		init : function(ed, url) {
			ed.addButton('accordion', {
				title : 'Add Accordion',
				image : url+'/accordion.png',
				onclick : function () {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Accordion',
						identifier: 'accordion'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('accordion', tinymce.plugins.accordion);
})();
/**
 * Toggle
 */
(function() {
	tinymce.create('tinymce.plugins.toggle', {
		init : function(ed, url) {
			ed.addButton('toggle', {
				title : 'Add a Toggles',
				image : url+'/toggle.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Toggle',
						identifier: 'toggle'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('toggle', tinymce.plugins.toggle);
})();
/**
 * Youtube
 */
(function() {
	tinymce.create('tinymce.plugins.video', {
		init : function(ed, url) {
			ed.addButton('video', {
				title : 'Add a Video',
				image : url+'/video.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Video',
						identifier: 'video'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('video', tinymce.plugins.video);
})();

/**
 * Team
 */
(function() {
	tinymce.create('tinymce.plugins.team', {
		init : function(ed, url) {
			ed.addButton('team', {
				title : 'Add Team Members',
				image : url+'/team.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Team',
						identifier: 'team'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('team', tinymce.plugins.team);
})();
/**
 * Button
 */
(function() {
	tinymce.create('tinymce.plugins.button', {
		init : function(ed, url) {
			ed.addButton('button', {
				title : 'Add Button',
				image : url+'/button.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Button',
						identifier: 'button'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('button', tinymce.plugins.button);
})();
/**
 * Section
 */
(function() {
	tinymce.create('tinymce.plugins.section', {
		init : function(ed, url) {
			ed.addButton('section', {
				title : 'Add Section',
				image : url+'/section.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Section',
						identifier: 'section'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('section', tinymce.plugins.section);
})();
/**
 * Separator
 */
(function() {
	tinymce.create('tinymce.plugins.separator_btn', {
		init : function(ed, url) {
			ed.addButton('separator_btn', {
				title : 'Add Separator',
				image : url+'/separator.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Separator',
						identifier: 'separator'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('separator_btn', tinymce.plugins.separator_btn);
})();

/**
 * Icon
 */
(function() {
	tinymce.create('tinymce.plugins.icon', {
		init : function(ed, url) {
			ed.addButton('icon', {
				title : 'Add Icon',
				image : url+'/icon.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Icon',
						identifier: 'icon'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('icon', tinymce.plugins.icon);
})();
/**
 * Iconbox
 */
(function() {
	tinymce.create('tinymce.plugins.iconbox', {
		init : function(ed, url) {
			ed.addButton('iconbox', {
				title : 'Add Iconbox',
				image : url+'/iconbox.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'IconBox',
						identifier: 'iconbox'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('iconbox', tinymce.plugins.iconbox);
})();
/**
 * Testimonial
 */
(function() {
	tinymce.create('tinymce.plugins.testimonial', {
		init : function(ed, url) {
			ed.addButton('testimonial', {
				title : 'Add Testimonial',
				image : url+'/testimonial.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Testimonial',
						identifier: 'testimonial'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('testimonial', tinymce.plugins.testimonial);
})();
/**
 * Services
 */
(function() {
	tinymce.create('tinymce.plugins.services', {
		init : function(ed, url) {
			ed.addButton('services', {
				title : 'Add Services',
				image : url+'/services.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Services',
						identifier: 'services'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('services', tinymce.plugins.services);
})();

/**
 * Timeline
 */
(function() {
	tinymce.create('tinymce.plugins.timeline', {
		init : function(ed, url) {
			ed.addButton('timeline', {
				title : 'Add Timeline',
				image : url+'/timeline.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Timeline',
						identifier: 'timeline'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('timeline', tinymce.plugins.timeline);
})();

/**
 * Recent Works
 */
(function() {
	tinymce.create('tinymce.plugins.recent_works', {
		init : function(ed, url) {
			ed.addButton('recent_works', {
				title : 'Add Portfolio Preview',
				image : url+'/projects.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Recent Works',
						identifier: 'recent_works'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('recent_works', tinymce.plugins.recent_works);
})();

/**
 * Latest Posts
 */
(function() {
	tinymce.create('tinymce.plugins.latest_posts', {
		init : function(ed, url) {
			ed.addButton('latest_posts', {
				title : 'Add Latest Posts',
				image : url+'/latest_posts.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Latest Posts',
						identifier: 'latest_posts'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('latest_posts', tinymce.plugins.latest_posts);
})();

/**
 * Clients
 */
(function() {
	tinymce.create('tinymce.plugins.clients', {
		init : function(ed, url) {
			ed.addButton('clients', {
				title : 'Add Clients',
				image : url+'/clients.png',
				onclick : function() {
					ed.selection.setContent('[clients]');

				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('clients', tinymce.plugins.clients);
})();

/**
 * Actionbox
 */
(function() {
	tinymce.create('tinymce.plugins.actionbox', {
		init : function(ed, url) {
			ed.addButton('actionbox', {
				title : 'Add ActionBox',
				image : url+'/actionbox.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'ActionBox',
						identifier: 'actionbox'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('actionbox', tinymce.plugins.actionbox);
})();

/**
 * Callout
 */
(function() {
	tinymce.create('tinymce.plugins.callout', {
		init : function(ed, url) {
			ed.addButton('callout', {
				title : 'Add Callout',
				image : url+'/callout.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Callout',
						identifier: 'callout'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('callout', tinymce.plugins.callout);
})();

/**
 * Animate
 */
(function() {
	tinymce.create('tinymce.plugins.animate', {
		init : function(ed, url) {
			ed.addButton('animate', {
				title : 'Add Animation',
				image : url+'/animation.png',
				onclick : function() {
					tinyMCE.activeEditor.execCommand("us_zillaPopup", false, {
						title: 'Animation',
						identifier: 'animate'
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('animate', tinymce.plugins.animate);
})();

/**
 * Mission
 */
(function() {
	tinymce.create('tinymce.plugins.mission', {
		init : function(ed, url) {
			ed.addButton('mission', {
				title : 'Add Mission',
				image : url+'/mission.png',
				onclick : function() {
					ed.selection.setContent('[mission type="grey, colored or leave blank" with="shadow or arrow" caption="Our Mission" text="Organize the World Information and Make It Universally Accessible"]');

				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('mission', tinymce.plugins.mission);
})();

/**
 * Gallery
 */
(function() {
	tinymce.create('tinymce.plugins.gallery', {
		init : function(ed, url) {
			ed.addButton('gallery', {
				title : 'Add Gallery',
				image : url+'/gallery.png',
				onclick : function() {
					ed.selection.setContent('[gallery type="xs, s, m, l or masonry" include=""]');

				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('gallery', tinymce.plugins.gallery);
})();

/**
 * Pricing Table
 */
(function() {
	tinymce.create('tinymce.plugins.pricing_table', {
		init : function(ed, url) {
			ed.addButton('pricing_table', {
				title : 'Add Pricing Table',
				image : url+'/pricing.png',
				onclick : function() {
					ed.selection.setContent('[pricing_table]<br>[pricing_column title="Standard" type="featured or leave blank" price="$10" time="per month"]<br>[pricing_row]Feature 1[/pricing_row]<br>[pricing_row]Feature 2[/pricing_row]<br>[pricing_footer url="" type="color, dark, inverse or leave blank" size="small, big or leave blank for normal"]Signup[/pricing_footer]<br>[/pricing_column]<br><br>[pricing_column title="Business" type="featured or leave blank" price="$20" time="per month"]<br>[pricing_row]Feature 1[/pricing_row]<br>[pricing_row]Feature 2[/pricing_row]<br>[pricing_footer url="" type="color, dark, inverse or leave blank" size="small, big or leave blank for normal"]Signup[/pricing_footer]<br>[/pricing_column]<br>[/pricing_table]');

				}
			});
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('pricing_table', tinymce.plugins.pricing_table);
})();