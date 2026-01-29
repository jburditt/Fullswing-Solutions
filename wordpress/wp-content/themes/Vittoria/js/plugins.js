jQuery(document).ready(function(){

	jQuery('.w-nav-list.layout_hor.level_1').navToSelect({select:'.w-nav-select-h', list: '.w-nav-list', item: '.w-nav-item'});

	if (jQuery.magnificPopup)
	{
		jQuery('.w-gallery-tnails-h').magnificPopup({
			type: 'image',
			delegate: 'a',
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1]
			},
			removalDelay: 300,
			mainClass: 'mfp-fade',
			fixedContentPos: false

		});

		jQuery('.image-link').magnificPopup({
			type: 'image',
			fixedContentPos: false
		});
	}

	// Carousel
	if (jQuery().carousello){
		jQuery(".w-listing.type_carousel, .w-clients.type_carousel, .w-portfolio.type_carousel").carousello();
	}

	if (jQuery().isotope){
		var portfolioContainer = jQuery('.w-portfolio.type_sortable .w-portfolio-list-h');
		if (portfolioContainer) {
			portfolioContainer.imagesLoaded(function(){
				portfolioContainer.isotope({
					itemSelector : '.w-portfolio-item',
					layoutMode : 'fitRows'
				});
			});

			jQuery('.w-filters-item').each(function() {
				var item = jQuery(this),
					link = item.find('.w-filters-item-link');
				link.click(function(){
					if ( ! item.hasClass('active')) {
						jQuery('.w-filters-item').removeClass('active');
						item.addClass('active');
						var selector = jQuery(this).attr('data-filter');
						portfolioContainer.isotope({ filter: selector });
						return false;
					}

				});
			});
			jQuery('.w-portfolio-item-meta-tags a').each(function() {

				jQuery(this).click(function(){
					var selector = jQuery(this).attr('data-filter'),
						topFilterLink = jQuery('a[class="w-filters-item-link"][data-filter="'+selector+'"]'),
						topFilter = topFilterLink.parent('.w-filters-item');
					if ( ! topFilter.hasClass('active')) {
						jQuery('.w-filters-item').removeClass('active');
						topFilter.addClass('active');
						portfolioContainer.isotope({ filter: selector });
						return false;
					}

				});
			});

		}

		var postsContainer = jQuery('.w-blog.type_masonry .w-blog-list');

		if (postsContainer.length) {
			postsContainer.imagesLoaded(function(){
				postsContainer.isotope({
					itemSelector : '.w-blog-entry',
					layoutMode : 'masonry'
				});
			});

			var postsResizeTimer;

			jQuery(window).resize(function(){
				window.clearTimeout(postsResizeTimer);
				postsResizeTimer = window.setTimeout(function(){
					postsContainer.isotope('reLayout');

				}, 50);

			});
		}

		var galleryContainer = jQuery('.w-gallery.type_masonry .w-gallery-tnails-h');

		if (galleryContainer.length) {
			galleryContainer.imagesLoaded(function(){
				galleryContainer.isotope({
					layoutMode : 'masonry'
				});
			});

			var galleryResizeTimer;

			jQuery(window).resize(function(){
				window.clearTimeout(galleryResizeTimer);
				galleryResizeTimer = window.setTimeout(function(){
					galleryContainer.isotope('reLayout');

				}, 50);

			});
		}

	}

	if (jQuery().revolution){
		if (jQuery.fn.cssOriginal !== undefined) {
			jQuery.fn.css = jQuery.fn.cssOriginal;
		}
		jQuery('.fullwidthbanner').revolution({
			delay: 9000,
			startwidth: 1024,
			startheight: 600,
			soloArrowLeftHOffset: 0,
			soloArrowLeftVOffset: 0,
			soloArrowRightHOffset: 0,
			soloArrowRightVOffset: 0,
			onHoverStop:"on",						// Stop Banner Timet at Hover on Slide on/off
			fullWidth:"on",
			hideThumbs: false,
			shadow:0								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)
		});
	}

	// Video iframes z-index fix
	jQuery('iframe').each(function(){
		var url = jQuery(this).attr("src");console.log(jQuery(this).attr("src"));
		var char = "?";
		if(jQuery.inArray("?", url) !== -1){
			char = "&";
		}

		jQuery(this).attr("src",url+char+"wmode=transparent");console.log(jQuery(this).attr("src"));
	});

	if (jQuery().waypoint){
		jQuery('body').imagesLoaded(function(){

			jQuery('.animate_afc, .animate_afl, .animate_afr, .animate_aft, .animate_afb, .animate_wfc, .animate_hfc, .animate_rfc, .animate_rfl, .animate_rfr').waypoint(function() {
				if ( ! jQuery(this).hasClass('animate_start')){
					var elm = jQuery(this);
					setTimeout(function() {
						elm.addClass('animate_start');
					}, 20);
				}
			}, {offset:'85%', triggerOnce: true});

		});
	}

});
