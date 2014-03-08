/***************************************************************************************
*
*		navigation
*
***************************************************************************************/

		function mainmenu(){
			$("#nav ul").css({display: "none"}); // Opera Fix
				$("#nav li").hover(function(){
						$(this).find('ul:first').css({visibility: "visible",display: "none"}).show(200);
						},function(){
						$(this).find('ul:first').css({visibility: "hidden"});
						});
				}	
			$(document).ready(function(){
				mainmenu();
		});

/***************************************************************************************
*
*		changing opacity for some images, buttons, portfolio items
*
***************************************************************************************/

		$(document).ready(function(){
			$("#latest-recipes img, .follow-us li a").fadeTo("fast", 1); // images opacity on start
				$("#latest-recipes img, .follow-us li a").hover(function(){
					$(this).stop().fadeTo("fast", 0.7); // images opacity on hover
					}, function(){
				$(this).stop().fadeTo("fast", 1); // images opacity on mouse out
			});
		});
		//to add new element just add link or image or what You want to 
		// $("#latest-recipes img, a.button-small, a.button-medium, a.button-large, .follow-us li a").fadeTo("fast", 1);
		//and to
		//$("#latest-recipes img, a.button-small, a.button-medium, a.button-large, .follow-us li a").hover(function()

/***************************************************************************************
*
*		adding padding on hover
*
***************************************************************************************/

		$(document).ready(function() {
		  $('.sidebar-widget li a').hover(function() { //mouse in
		    $(this).animate({ paddingLeft: '10px' }, 200); // adding padding when hovered
		  }, function() { //mouse out
		    $(this).animate({ paddingLeft: 0 }, 200); // your default css value!
		  });
		});
		
/***************************************************************************************
*
*		tabs
*
***************************************************************************************/

		$(document).ready(function() {
		
			//When page loads...
			$(".tab-content").hide(); //Hide all content
			$("ul.tabs li:first").addClass("active").show(); //Activate first tab
			$(".tab-content:first").show(); //Show first tab content
		
			//On Click Event
			$("ul.tabs li").click(function() {
		
				$("ul.tabs li").removeClass("active"); //Remove any "active" class
				$(this).addClass("active"); //Add "active" class to selected tab
				$(".tab-content").hide(); //Hide all tab content
		
				var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
				$(activeTab).fadeIn(); //Fade in the active ID content
				return false;
			});
		
		});
		
/***************************************************************************************
*
*		advices slider
*
***************************************************************************************/		
		
		$(document).ready(function(){
			$('.advices-slider').cycle({ 
				fx:    'fade', 
				speed:  1000 
			 });
		 });

/***************************************************************************************
*
*		accordion
*
***************************************************************************************/

		$(document).ready(function(){
			$("#accordion").accordion ({
				header: "h4"
			});
		});

/***************************************************************************************
*
*		anything slider
*
***************************************************************************************/

		$(document).ready(function(){
		 	$('#slider').anythingSlider({
		 		buildNavigation: false,
				buildStartStop: false,
				autoPlay: true
			}); // add any non-default options here
		});
		
/***************************************************************************************
*
*		jCarousel
*
***************************************************************************************/

		jQuery(document).ready(function() {
		    jQuery('#mycarousel').jcarousel({
		    	wrap: 'last',
				scroll: 1
		    });
		});
		
/***************************************************************************************
*
*		zAccordion
*
***************************************************************************************/

		$(document).ready(function() {
			$("#zaccordion").zAccordion({
				easing: "easeOutBounce",
				slideClass: "slider",
				animationStart: function() {
					$("#zaccordion").find("li.slider-open div.slider-info").css("display", "none");
					$("#zaccordion").find("li.slider-previous div.slider-info").css("display", "none");
					},
					animationComplete: function() {
					$("#zaccordion").find("li.slider-open div.slider-info").fadeIn(600);
					$("#zaccordion").find("li.slider-previous div.slider-info").fadeIn(600);
					},
				height: "312px",
				width: "900px",
				slideWidth: "700px"
			});
		});

/***************************************************************************************
*
*		roundabout Slider
*
***************************************************************************************/
		
		$(document).ready(function() {
			$('ul#myRoundabout').roundabout({
				minOpacity: 1,
				btnNext: '#roundabout-next',
				btnPrev: '#roundabout-prev'
			});
		});
		
/***************************************************************************************
*
*		nivo Slider
*
***************************************************************************************/

		$(window).load(function() {
	        $('#slider-nivo').nivoSlider();
	    });
		
/***************************************************************************************
*
*		overlays
*
***************************************************************************************/
	
		$(document).ready(function(){
			$(".fancycaption").fancyCaption();
		});
		
		
/***************************************************************************************
*
*		pretty photo
*
***************************************************************************************/
	
		$(document).ready(function(){
			$("a[data-rel^='prettyPhoto']").prettyPhoto({
				overlay_gallery: false
			});
		});
		
/***************************************************************************************
*
*		flickr feed
*
***************************************************************************************/
		
		$(document).ready(function(){
			$('#flickr-feed ul').jflickrfeed({
				feedapi: 'photoset.gne',
				limit: 9,
				qstrings: {
					nsid: '10729228@N07',
					set: '72157624798241210'
				},
				itemTemplate:
				'<li>' +
					'<a rel="prettyPhoto[flickr-feed]" href="{{image}}" title="{{title}}">' +
						'<img src="{{image_s}}" alt="{{title}}" width="50" height="50" />' +
					'</a>' +
				'</li>'
			}, function(data) {
				$("a[rel^='prettyPhoto']").prettyPhoto({
					overlay_gallery: false
				});
			});
		});

/***************************************************************************************
*
*		twitter feed
*
***************************************************************************************/		
		
		jQuery(function($){
        $(".tweet").tweet({
				username: "mthemes",
				count: 2,
				loading_text: "loading tweets..."
			});
		});
		
/***************************************************************************************
*
*		portfolio sorting
*
***************************************************************************************/

		$(document).ready(function(){

			$(document).ready(function(){
				$(".fancycaption").fancyCaption();
			});

			// Clone portfolio items to get a second collection for Quicksand plugin
			var $portfolioClone = $(".portfolio").clone();
			
			// Attempt to call Quicksand on every click event handler
			$(".filter a").click(function(e){
				
				$(".filter li").removeClass("current");	
				
				// Get the class attribute value of the clicked link
				var $filterClass = $(this).parent().attr("class");

				if ( $filterClass == "all" ) {
					var $filteredPortfolio = $portfolioClone.find("li");
				} else {
					var $filteredPortfolio = $portfolioClone.find("li[data-type~=" + $filterClass + "]");
				}
				
				// Call quicksand
				$(".portfolio").quicksand( $filteredPortfolio, { 
					duration: 800, 
					easing: 'easeInOutQuad'
				}, function(){
					
					$(document).ready(function(){
						$(".fancycaption").fancyCaption();
					});
				});

				$(this).parent().addClass("current");

				// Prevent the browser jump to the link anchor
				e.preventDefault();
			})
		});
