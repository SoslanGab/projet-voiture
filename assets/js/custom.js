(function ($) {
	
	"use strict";

	$(function() {
        $("#tabs").tabs();
    });

	$(window).scroll(function() {
	  var scroll = $(window).scrollTop();
	  var box = $('.header-text').height();
	  var header = $('header').height();

	  if (scroll >= box - header) {
	    $("header").addClass("background-header");
	  } else {
	    $("header").removeClass("background-header");
	  }
	});
	

	$('.schedule-filter li').on('click', function() {
        var tsfilter = $(this).data('tsfilter');
        $('.schedule-filter li').removeClass('active');
        $(this).addClass('active');
        if (tsfilter == 'all') {
            $('.schedule-table').removeClass('filtering');
            $('.ts-item').removeClass('show');
        } else {
            $('.schedule-table').addClass('filtering');
        }
        $('.ts-item').each(function() {
            $(this).removeClass('show');
            if ($(this).data('tsmeta') == tsfilter) {
                $(this).addClass('show');
            }
        });
    });


	// Window Resize Mobile Menu Fix
	mobileNav();


	// Scroll animation init
	window.sr = new scrollReveal();
	

	// Menu Dropdown Toggle
		$(".menu-trigger").on('click', function() {	
			$(this).toggleClass('active');
			
			if ($('.header-area .nav').css('display') == 'block') {
				$('.header-area .nav').css('display', 'none');
				
			}else {
				$('.header-area .nav').css('display', 'block');

			}
			console.log($('.header-area .nav').css('display'))
		});
	


	function onScroll(event){
	    var scrollPos = $(document).scrollTop();
	    $('.nav a').each(function () {
	        var currLink = $(this);
	        var refElement = $(currLink.attr("href"));
	        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
	            $('.nav ul li a').removeClass("active");
	            currLink.addClass("active");
	        }
	        else{
	            currLink.removeClass("active");
	        }
	    });
	}

	// Mobile Menu 
	$(window).on('resize', function() {
		mobileNav();
	});


	// Mobile Menu 
	function mobileNav() {
		var width = $(window).width();
		$('.submenu').on('click', function() {
			if(width < 767) {
				$('.submenu ul').removeClass('active');
				$(this).find('ul').toggleClass('active');
			}
		});
	}

	
$(document).ready(function() {
    $('.user-icon').click(function() {
        $('.login-box').toggle();
    });

    // Fermer la boîte de connexion lorsque l'utilisateur clique à l'extérieur
    $(document).click(function(event) {
        if (!$(event.target).closest('.login-box, .user-icon').length) {
            $('.login-box').hide();
        }
    });
});

})(window.jQuery);