/* Custom JS File */

(function($) {

	"use strict";

	jQuery(document).ready(function() {



    	// Js for slider section in header

    	$('.header-slider').slick({
    		slidesToShow: 1,
    		slidesToScroll: 1,
    		arrows: false,
    		fade: true,
    		asNavFor: '.header-slider-thumbnail'

    	});

    	$('.header-slider-thumbnail').slick({
    		slidesToShow: 3,
    		slidesToScroll: 1,
    		asNavFor: '.header-slider',
    		dots: true,
    		vertical: false,
    		centerMode: false,
    		focusOnSelect: true
    	});
	    
		//sticky sidebar

		var at_body = $("body");

		var at_window = $(window);



		if(at_body.hasClass('pt-sticky-sidebar')){

			if(at_body.hasClass('right-sidebar left-sidebar')){

				$('#secondary, #primary').theiaStickySidebar();

			}

			else{

				$('#secondary, #primary').theiaStickySidebar();

			}

		}





		// Initialize gototop for carousel

		if ( $('#toTop').length > 0 ) {

	    // Hide the toTop button when the page loads.

	    $("#toTop").css("display", "none");

	    

	      // This function runs every time the user scrolls the page.

	      $(window).scroll(function(){



	        // Check weather the user has scrolled down (if "scrollTop()"" is more than 0)

	        if($(window).scrollTop() > 0){



	          // If it's more than or equal to 0, show the toTop button.

	          $("#toTop").fadeIn("slow");

	      }

	      else {

	          // If it's less than 0 (at the top), hide the toTop button.

	          $("#toTop").fadeOut("slow");



	      }

	  	});



	      // When the user clicks the toTop button, we want the page to scroll to the top.

	      jQuery("#toTop").click(function(event){



	        // Disable the default behaviour when a user clicks an empty anchor link.

	        // (The page jumps to the top instead of // animating)

	        event.preventDefault();



	        // Animate the scrolling motion.

	        jQuery("html, body").animate({

	        	scrollTop:0

	        },"slow");



	     });

	  	}

	    //infinite pagination

	    /*new pagination style*/

    var paged = parseInt(free_blog_ajax.paged) + 1;

    var max_num_pages = parseInt(free_blog_ajax.max_num_pages);

    var next_posts = free_blog_ajax.next_posts;





    $(document).on( 'click', '.show-more', function( event ) {

        event.preventDefault();

        var show_more = $(this);

        var click = show_more.attr('data-click');



        if( (paged-1) >= max_num_pages){

            show_more.html(free_blog_ajax.no_more_posts)

        }



        if( click == 0 || (paged-1) >= max_num_pages){

            return false;

        }

        show_more.html('<i class="fa fa-spinner fa-spin fa-fw"></i>');

        show_more.attr("data-click", 0);

        var page = parseInt( show_more.attr('data-number') );





        $('#free-temp-post').load(next_posts + ' article.post', function() {

            /*http://stackoverflow.com/questions/17780515/append-ajax-items-to-masonry-with-infinite-scroll*/

            paged++;/*next page number*/

            next_posts = next_posts.replace(/(\/?)page(\/|d=)[0-9]+/, '$1page$2'+ paged);



            var html = $('#free-temp-post').html();

            $('#free-temp-post').html('');



            // Make jQuery object from HTML string

            var $moreBlocks = $( html ).filter('article.masonry-post, article.one-column, article.two-column  ');



            // Append new blocks to container

            $('#masonry-loop').append( $moreBlocks ).imagesLoaded(function(){

                // Have Masonry position new blocks

                $('#masonry-loop').masonry( 'appended', $moreBlocks );

            });



            show_more.attr("data-number", page+1);

            show_more.attr("data-click", 1);

            show_more.html("<i class='fa fa-refresh'></i>"+free_blog_ajax.show_more)



        });

        return false;

    });
    
    
    var maxHeight = 0;
    jQuery('.two-column article.two-column').each(function(){
        if(jQuery(this).height() > maxHeight) {
            maxHeight = jQuery(this).height();
        }
    });
    jQuery('.two-column article.two-column').height(maxHeight);



	    //end pagination

	});

})(jQuery);

