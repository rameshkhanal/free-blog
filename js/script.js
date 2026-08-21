(function($) {
    "use strict";

    // Localised in functions.php; falls back to English if the script is
    // loaded without wp_localize_script having run.
    var freeBlogMenuText = ( window.freeBlogL10n && window.freeBlogL10n.expandMenu ) || 'Expand child menu';
	
	$(window).on('scroll', function(){
		if($(this).scrollTop() > 100){
			 $('.main-navigation').addClass('affix');
		}
			else{
				$('.main-navigation').removeClass('affix');
			}
	});
	
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