(function($){	
	
	$(document).ready(function(){
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////						   
								
		// -------------------------------------------------------------------------------------------------------
		// Dropdown Menu
		// -------------------------------------------------------------------------------------------------------
		
		if ( ! ( $.browser.msie && ($.browser.version == 6) ) ){
			$("ul#topnav li:has(ul)").addClass("dropdown");
		}
		
		$("ul#topnav li.dropdown").hover(function () {
												 
			$('ul:first', this).css({visibility: "visible",display: "none"}).slideDown('normal');
		}, function () {
			
			$('ul:first', this).css({visibility: "hidden"});
		});
		
		
		$("div.prod_hold").hover(function () {
												 
			$('.info', this).css({visibility: "visible",display: "none"}).slideDown('normal');
		}, function () {
			
			$('.info', this).css({visibility: "hidden"});
		});
		
		$("li.cat_hold").hover(function () {
												 
			$('.info', this).fadeIn(300);
		}, function () {
			
			$('.info', this).fadeOut(200);
		});
		
		$("li.side_cart").hover(function () {
												 
			$('#cart', this).fadeIn(500);
		}, function () {
			
			$('#cart', this).fadeOut(200);
		});
		
		$("li.side_currency").hover(function () {
												 
			$('#currency', this).fadeIn(500);
		}, function () {
			
			$('#currency', this).fadeOut(200);
		});
		
		$("li.side_lang").hover(function () {
												 
			$('#language', this).fadeIn(500);
		}, function () {
			
			$('#language', this).fadeOut(200);
		});
		
		$("li.side_search").hover(function () {
												 
			$('#search', this).fadeIn(500);
		}, function () {
			
			$('#search', this).fadeOut(200);
		});
		
		$(".main_menu li").hover(function () {
												 
			$('.secondary', this).fadeIn(500);
		}, function () {
			
			$('.secondary', this).fadeOut(200);
		});

		
		// -------------------------------------------------------------------------------------------------------
		// Tipsy - tooltips jQuery plugin
		// -------------------------------------------------------------------------------------------------------
		
		$('a.wish_button, a.compare_button, a#button-cart, a.twitter_follow').tipsy({gravity: 's', fade: true, title: function() { return this.getAttribute('original-title').toUpperCase(); }});
		$('#service_links li a').tipsy({gravity: 'e', fade: true, title: function() { return this.getAttribute('original-title').toUpperCase(); }});
		
		
		// -------------------------------------------------------------------------------------------------------
		// SLIDING ELEMENTS
		// -------------------------------------------------------------------------------------------------------
		
		$("ul.categories li, #sidebar ul.secondary_menu li").hover(function(){
		$("a", this).stop().animate({left:"15px"},{queue:false,duration:200});
		}, function() {
		$("a", this).stop().animate({left:"0px"},{queue:false,duration:200});
		});
		
		// -------------------------------------------------------------------------------------------------------
		// FADING ELEMENTS
		// -------------------------------------------------------------------------------------------------------
		
		$(".banner a img").hover(function() {
		$(this).stop()
		.animate({opacity: 0.6}, "medium")

		}, function() {
		$(this).stop()
		.animate({opacity: 1}, "medium")
		});
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	});
	
})(window.jQuery);	

// non jQuery scripts below