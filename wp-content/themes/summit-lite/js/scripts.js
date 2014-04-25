jQuery(document).ready(function($) {
	// If using WP Custom Menu
	//$('#menu li ul.sub-menu').hide();
	$('#menu li').hover(
	    function () {
	        $(this).children('ul li > ul.sub-menu').stop().animate({
	        	opacity: 1,
	        	height: 'toggle',
	        }, 250);
	    },
	    function () {
	        $(this).children('ul li > ul.sub-menu').stop().animate({
	        	opacity: 0,
	        	height: 'toggle',
	        }, 250);
	    }
	);
	// If using default page list.
	//$('.menu li .children').hide();
	$('.top-nav ul li').hover(
	    function () {
	        $(this).children('ul li > .children').stop().animate({
	        	opacity: 1,
	        	height: 'toggle',
	        }, 250);
	    },
	    function () {
	        $(this).children('ul li > .children').stop().animate({
	        	opacity: 0,
	        	height: 'toggle',
	        }, 250);
	    }
	);

	// Mobile Nav 
	$('#mobile-nav').click(function() {
		$('.mobile-menu').slideToggle('fast');
	});    
});