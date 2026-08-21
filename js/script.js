(function($) {
    "use strict";

    // Localised in functions.php; falls back to English if the script is
    // loaded without wp_localize_script having run.
    var freeBlogMenuText = ( window.freeBlogL10n && window.freeBlogL10n.expandMenu ) || 'Expand child menu';
	
	var freeBlogStickyBar = $('.main-menu');

	if ( freeBlogStickyBar.length ) {

		var freeBlogSpacer = $('<div class="main-menu-placeholder" aria-hidden="true"></div>')
			.insertAfter( freeBlogStickyBar );

		var freeBlogSync = function () {

			// A fixed bar costs too much of a phone screen to be worth it, and
			// the collapsed menu opens downwards from where it sits.
			if ( $(window).width() < 768 ) {
				freeBlogStickyBar.removeClass('affix');
				freeBlogSpacer.height(0);
				return;
			}

			// The placeholder sits where the bar was, in both states, so the
			// threshold never moves when the class is added or removed.
			var stickPoint = freeBlogSpacer.offset().top - freeBlogSpacer.height();

			if ( $(window).scrollTop() > stickPoint ) {
				if ( ! freeBlogStickyBar.hasClass('affix') ) {
					freeBlogSpacer.height( freeBlogStickyBar.outerHeight() );
					freeBlogStickyBar.addClass('affix');
				}
			} else if ( freeBlogStickyBar.hasClass('affix') ) {
				freeBlogStickyBar.removeClass('affix');
				freeBlogSpacer.height(0);
			}
		};

		$(window).on('scroll resize', freeBlogSync);
		freeBlogSync();
	}
	
	 //Submenu Dropdown Toggle
    if($('.top-nav li.menu-item-has-children').length){
        $('.top-nav li.menu-item-has-children').append('<button type="button" class="dropdown-btn" aria-expanded="false"><span class="screen-reader-text">' + freeBlogMenuText + '</span><span class="fa fa-angle-down" aria-hidden="true"></span></button>');

        //Dropdown Button
        $('.top-nav li.menu-item-has-children .dropdown-btn').on('click', function() {
            var expanded = $(this).attr('aria-expanded') === 'true';
            $(this).attr('aria-expanded', expanded ? 'false' : 'true');
            $(this).prev('ul').slideToggle(500);
        });

    }	
	
    //Submenu Dropdown Toggle
    if($('.main-menu  li.menu-item-has-children ul').length){
        $('.main-menu li.menu-item-has-children').append('<button type="button" class="dropdown-btn" aria-expanded="false"><span class="screen-reader-text">' + freeBlogMenuText + '</span><span class="fa fa-angle-down" aria-hidden="true"></span></button>');

        //Dropdown Button
        $('.main-menu li.menu-item-has-children .dropdown-btn').on('click', function() {
            var expanded = $(this).attr('aria-expanded') === 'true';
            $(this).attr('aria-expanded', expanded ? 'false' : 'true');
            $(this).prev('ul').slideToggle(500);
        });

    }
    
   
	
	$('.search-wrapper .search-toggle').on('click', function(e) {
		e.preventDefault();
		var open = $('.search-form-wrapper').toggleClass('search-form-active').hasClass('search-form-active');
		$(this).attr('aria-expanded', open ? 'true' : 'false');
		if (open) {
			$('.search-form-wrapper').find('input[type="search"], .search-field').first().trigger('focus');
		}
	});



    $('li.nav-setting').on('click', function(){
    	$('li.nav-setting ul').slideToggle(500);
    });
    $('.contact-filter span').on('click', function(){
    	$('.contact-filter ul').slideToggle(500);
    });
    $('.slider-switch span').on('click', function(){
    	$('.slider-switch span.active').removeClass('active');
    	$(this).addClass('active');
    });
    
    $('.post-slider-section').slick({
	        dots: true,
            infinite: true,
            speed: 500,
            autoplay: true,
            arrows:false
        });
	   
})(jQuery);