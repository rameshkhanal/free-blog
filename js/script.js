(function($) {
    "use strict";
	
	$(window).on('scroll', function(){
		if($(this).scrollTop > 100){
			 $('.main-navigation').addClass('affix');
		}
			else{
				$('.main-navigation').removeClass('affix');
			}
	});
	
	 //Submenu Dropdown Toggle
    if($('.top-nav li.menu-item-has-children').length){
        $('.top-nav li.menu-item-has-children ').append('<div class="dropdown-btn"><Span class="fa fa-angle-down"></span></div>');

        //Dropdown Button
        $('.top-nav li.menu-item-has-children .dropdown-btn').on('click', function() {
            $(this).prev('ul').slideToggle(500);
        });


        //Disable dropdown parent link
        $('.top-nav .navbar-nav li.menu-item-has-children > a').on('click', function(e) {
            e.preventDefault();
        });
    }	
	
    //Submenu Dropdown Toggle
    if($('.main-menu  li.menu-item-has-children ul').length){
        $('.main-menu  li.menu-item-has-children').append('<div class="dropdown-btn"><Span class="fa fa-angle-down"></span></div>');

        //Dropdown Button
        $('.main-menu li.menu-item-has-children .dropdown-btn').on('click', function() {
            $(this).prev('ul').slideToggle(500);
        });


        //Disable dropdown parent link
        $('.main-menu .navbar-nav li.menu-item-has-children > a').on('click', function(e) {
            e.preventDefault();
        });
    }
    
   
	
	$('.search-wrapper i').click(function() {
		$('.search-form-wrapper').toggleClass('search-form-active');
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