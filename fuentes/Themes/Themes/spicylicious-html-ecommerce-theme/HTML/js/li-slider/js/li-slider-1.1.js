/**
 * jQuery Li Slider 
 * Copyright (c) 2010 Spotnil (http://spotnil.com)
 * Version: 1.1 (3/03/2011)
 */
(function($) {	
		  
	var methods = {
		init : function( options ) {
				
				var default_settings = { 	
					width				:	'',
					height				:	'',
					auto_play 			: 	true,
					repeat	 			: 	true,
					repeatRe 			: 	'',
					goToSlideOnStart	:	1,
					lightBoxDisplay		:	'off',
					modalMode			:	'off',
					timer				:   'no',
					pauseOnMouseOver	:	false,
					tooltip				:	'none',
					tooltipSize			:   15,
					shuffle				:	false,
					auto_hide 			: 	true,
					delay     			: 	3000,
					trans_period		:	1000,
					animation			:   "Fade",
					effect				:	false,
					vert_sections		:	15,
					new_vert_sections	:	'',
					sqr_sections_Y		:	5,					
					sqr_sections_X		:	0,
					new_sqr_sections	:	'',
					buttons_show		:	true,
					play_pause_show		:	true,
					next_prev_show		:	true,
					transitions			:   '',
					active_links		:	true,
					buttons_hide_time 	:	3000,
					buttons_hide_delay	:	500,
					buttons_show_time	:	500,
					buttons_show_delay	:	500
				};
				var settings = $.extend({}, default_settings, options);				
				return this.each(
					function() {
						slider = new Slider(this,settings);
						slider.init();
					}
			);
		},
		goToSlide: function(value){
					slider.stopRealSlider();
					slider.togglePlay();
					slider.showSpecImage(value);
		},
		Stop: function(value){
					$(this).find('.pause-btn').trigger('click');
		},
		Play: function(value){
					$(this).find('.play-btn').trigger('click');
		},
		Next: function(value){
					
					slider.stopRealSlider();
					slider.togglePlay();
					slider.showNextImage();
		},
		Prev: function(value){
					slider.stopRealSlider();
					slider.showPrevImage();
					slider.togglePlay();
		}
  	};
		  		  
		  
	$.fn.sp_Li_Slider = function(method) {
		
		var slider;
		
		// Method calling logic
		if ( methods[method] ) {
		  return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof method === 'object' || ! method ) {
		  return methods.init.apply( this, arguments );
		} else {
		  $.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
		}  

	};
		// class Slider
		function Slider($newSlider,settings) {

				var oSlider = this;
				this.settings = settings;
				var $slider = $($newSlider);
				this.slide = $slider;
				settings.width = parseInt($slider.css('width'));
				settings.height = parseInt($slider.css('height'));				
				this.prefix = $slider.attr('id');
				var $sliderImage = $slider.find('ul').first().children();
				var container;
				this.currentImage, this.prevPosition;
				var numberImages;
				var playSliderRec = null;
				var activeButtons = $( [] ) ;
				var $play_btn, $pause_btn;
				var sections = '';
				var animRandom = 0, animCons = 0;
				var animList;
				var showContent;
				var inTransition;
				var pauseSlider;
				this.width4, this.height4, this.width2, this.height2;
				var easing = new Array("linear","swing","easeInQuad","easeOutQuad","easeInOutQuad","easeInCubic","easeOutCubic","easeInOutCubic","easeInQuart","easeOutQuart","easeInOutQuart","easeInQuint","easeOutQuint","easeInOutQuint","easeInSine","easeOutSine","easeInOutSine","easeInExpo","easeOutExpo","easeInOutExpo","easeInCirc","easeOutCirc","easeInOutCirc","easeInElastic","easeOutElastic","easeInOutElastic","easeInBack","easeOutBack","easeInOutBack","easeInBounce","easeOutBounce","easeInOutBounce");
				var easingNumber=0;					 

				
				// init class Slider
				this.init = function() {
				numberImages = $sliderImage.length;
				var goToSlide = $(document).getUrlParam('sp_slide');
				if (goToSlide & goToSlide!=''& goToSlide>0 & goToSlide <= numberImages)
				settings.goToSlideOnStart = goToSlide;
				oSlider.currentImage = settings.goToSlideOnStart -1;
				if(settings.shuffle)
					shuffledLi();
				initFirstImg();
				if (settings.modalMode == 'lightBox')
					this.fixLiLightBox();
				else if (settings.modalMode == 'prettyPhoto')
					this.fixLiPrettyPhoto();
				if(settings.buttons_show){
					this.initButtonsPlayPause();
					this.initButtonsNextPrev();
					this.initPointers();
					this.initActiveButtons();
					this.initTooltip();
				}else{
					initPlayPause();
					this.initPauseOnMouseOver();
				}
				initAttributes();
				if(!settings.active_links)
					this.fixLi();
				else
					this.initLinks();
				initStructure();
				initAnimation();
				if (!isNaN(settings.repeat)){
						if (settings.repeat== false)
								settings.repeat = 0;
						settings.repeatRe = settings.repeat;
				}
				if (settings.auto_play)
					playSlider();				
			};
			// check animation in progress
			var inProgres = function(fun){

					if 	(inTransition) {

			}else
			
					fun();
			};
			// check animation in progress
			var inProgresSpec = function(pos,time){
				if 	(inTransition) {
				}else {
					var time = $($sliderImage[pos]).data('time');
					if (!time) time = settings.trans_period;
					oSlider.showSpecImage(pos);
//					showContent(pos,time);
				}
			};
			
			// init Buttons	
			this.initButtonsPlayPause = function() {
				if(settings.play_pause_show){	
					$play_btn = $('<div class="play-btn"></div>');
					$pause_btn = $('<div class="pause-btn"></div>');
					
					$play_btn	.click(function(event){event.preventDefault();
														activeButtons = activeButtons.add( $pause_btn.show()).not( $play_btn.hide());
														pauseSlider = false;
														if (oSlider.currentImage==(numberImages-1))
														settings.repeatRe = settings.repeat+1;
//														playOnMouseOver();
														oSlider.startSlider();})
								.css('display', 'none');
					
					$pause_btn	.click(function(event){event.preventDefault();
														stopSlider(true);
														pauseSlider = false;
														oSlider.pauseTimer();})
								.css('display', 'none');
					$slider.append($play_btn);
					$slider.append($pause_btn);					
					if (settings.auto_play) activeButtons = activeButtons.add( $pause_btn );
					else activeButtons = activeButtons.add( $play_btn );					
				}
			};
			
			// init Buttons
			this.initButtonsNextPrev = function() {
				if(settings.next_prev_show){
					var $prev_btn = $('<div class="prev-btn"></div>');
					var $next_btn = $('<div class="next-btn"></div>');
					
					$prev_btn	.click(function(event){event.preventDefault();
													stopSlider(true);	
													pauseSlider = false;
													inProgres(oSlider.showPrevImage);})
								.css('display', 'none');
					
					$next_btn	.click(function(event){event.preventDefault();
														stopSlider(true);
														pauseSlider = false;
														inProgres(oSlider.showNextImage);})
								.css('display', 'none');
					
					$slider.append($prev_btn);
					$slider.append($next_btn);
					activeButtons = activeButtons.add( $prev_btn ).add( $next_btn );
				}
					
			};
			
			//init Play Pause for outside use
			var initPlayPause = function() {
									
					$play_btn = $('<div class="play-btn"></div>');
					$pause_btn = $('<div class="pause-btn"></div>');
											
					$play_btn	.click(function(event){event.preventDefault();
														oSlider.startSlider();})
								.css('display', 'none');
					
					$pause_btn	.click(function(event){event.preventDefault();
														stopSliderDistance();})
								.css('display', 'none');
					$slider.append($play_btn);
					$slider.append($pause_btn);					
			};
			
			//init Pointers
			this.initPointers = function() {
				
				var allPointers = $('<div class="nav-btns" ></div>').css('display', 'none');
				
				for (i=1;i<=numberImages;i++){
					var $pointer = $('<div class="nav-btn"></div>');
//					showTooltip($pointer);
					$pointer.click(function(event) {	event.preventDefault();
														if (!$(this).hasClass('current-slide')){
																stopSlider(true);
																pauseSlider = false;
																inProgresSpec($(this).index());
																hideTooltip();}})	
							.mouseover(function(event) {
														if (settings.tooltip && !$(this).hasClass('current-slide')){
															showTooltip(this);															
														}})
							.mouseout(function(){hideTooltip()});
					$($pointer).appendTo(allPointers);
				}
				activeButtons = activeButtons.add( allPointers);
				$slider.append(allPointers);
				$($(".nav-btns",$slider).find('.nav-btn')[oSlider.currentImage]).addClass('current-slide');
					
			};
			
			this.initTooltip = function() {
				var dim = settings.tooltipSize;
				if (isNaN(dim)) dim = 15;
				var width = parseInt(settings.width)*dim/100;
				if (settings.tooltip == 'image'){					
					var tooltip = $('<div class="tooltip tooltipi" ><img src="" width='+width+' /></div>').css({'display': 'none', 'z-index': 150 ,  'position': 'absolute', 'opacity': 0});
				
				$slider.append(tooltip);
				}else if ( settings.tooltip == 'text'){
					var tooltip = $('<div class="tooltip" />').css({'display': 'none', 'z-index': 150 ,  'position': 'absolute', 'opacity': 0});
					var tooltip_text = $('<div class="tooltip-text" />').css({'width':width});					
					$slider.append(tooltip);
					tooltip.append(tooltip_text);				
				}
					
			};
			
			
			var showTooltip = function(pointer) {
				
				var showTooltip = $('.tooltip',$slider);								
				if (showTooltip){
					var position = $(pointer).position(), left_tooltip =0;
					var left_pointer = parseInt($(pointer).css('width'))/2;
					if (settings.tooltip == 'text'){
						var text = $('img',$sliderImage[$(pointer).index()]).attr('alt');
						$('.tooltip-text').html(text);
						left_tooltip = parseInt($(".tooltip-text").css('width'))/2;
					}else {
						var url = $('img',$sliderImage[$(pointer).index()]).attr('src');
						$(showTooltip).find('img').attr('src',url);
						left_tooltip = parseInt($(showTooltip).find('img').css('width'))/2;
					}
					$(showTooltip).css({'left': position.left+left_pointer-left_tooltip, 'z-index': 150});
					
					$(showTooltip).show().animate({
						 opacity: 1
						 },300);
				}
			};

			
			var hideTooltip = function(pointer) {
				
				if ($('.tooltip:visible')){
						$('.tooltip:visible').stop(true,true).hide().css({'opacity': 0, 'z-index': -100});															
				};								
			};
			
			
			
//			var ext = info_link_Lifhtbox.split('.').pop().toLowerCase();
//			if($.inArray(ext, ['gif','png','jpg','jpeg']) != -1) {		
			this.fixLi = function() {
				
				for ( var i=0; i < $sliderImage.size(); i++){												
				
					var img = $($sliderImage[i]).find('img:first');
					var a = $($sliderImage[i]).find('a:first');
					if (a.length>0){
						var href = a.attr('href');
						var target = a.attr('target');
						$($sliderImage[i]).html(img);
						$($sliderImage[i]).find('img').data({'href':href, 'target': target});
					}
				}
			};
			
			this.fixLiLightBox = function() {
									
					for ( var i=0; i < $sliderImage.size(); i++){		

						var a = $($sliderImage[i]).find('a:first');
						if (a.length>0){
							var href = a.attr('href');
							var ext = href.split('.').pop().toLowerCase();
							if($.inArray(ext, ['gif','png','jpg','jpeg']) != -1) {	
								a.addClass('lightBox');
							}
						}
					}
					$('.lightBox',$slider).lightBox();
			};
			
			this.fixLiPrettyPhoto = function() {
									
					for ( var i=0; i < $sliderImage.size(); i++){		

						var a = $($sliderImage[i]).find('a:first');
						if (a.length>0){
							var href = a.attr('href');
							var ext = href.split('.').pop().toLowerCase();
							if($.inArray(ext, ['gif','png','jpg','jpeg']) != -1) {	
								a.attr('rel','prettyPhoto');
							}else if(href.lastIndexOf('youtube.com') != -1) {	
								a.attr('rel','prettyPhoto');
							}else if(href.lastIndexOf('vimeo.com') != -1) {	
								a.attr('rel','prettyPhoto');
							}else if(href.lastIndexOf('.mov') != -1) {	
								a.attr('rel','prettyPhoto');
							}
						}
					}
					$("a[rel^='prettyPhoto']").prettyPhoto();
			};

			
			this.reFixLi = function() {
				
				for ( var i=0; i < $sliderImage.size(); i++){												
					var href = $($sliderImage[i]).find('img').data('href');
					if (href)
					var a = $('<a />').attr('href',href);					
					var target = $($sliderImage[i]).find('img').data('target');
					if (target)
						a.attr('target',target);
					$($sliderImage[i]).find('img').wrap(a);
				}
			};
			
			var shuffledLi = function() {
				
				var oldVal, newVal;
					for (i = 0; i < $sliderImage.size(); i++){
						newVal = Math.floor(Math.random()*($sliderImage.size()));
						oldVal = $sliderImage[i];						
						$sliderImage[i] = $sliderImage[newVal];
						$sliderImage[newVal] = oldVal;
				}
/*				$('ul:first',$slider).html('');
				for ( var i=0; i < $sliderImage.size(); i++){												
					
					$('ul:first',$slider).append($sliderImage[i]);//.first()
					$($sliderImage[i]).append($($sliderImage[i]).find('a'));
				}
*/				
			};
			
			
			
			//init First Image
			var initFirstImg = function() {
				
				$($sliderImage[oSlider.currentImage]).show();
				$($slider).css({"background-image": "url('')"});   							
				var info_link = $($sliderImage[oSlider.currentImage]).find('>a').attr('href');
					if (info_link)
						$('div.li-banner-image-wrap',$slider).css({cursor:'pointer'});
				if(settings.effect) 
				playEffect();
			};
			
			//init Active Buttons
			this.initActiveButtons = function() {
				if (settings.auto_hide){
						if (settings.auto_play) activeButtons.show().delay(settings.buttons_hide_time).fadeOut(settings.buttons_hide_delay);
						$slider.not(activeButtons)	.mouseenter(function(){
								if (settings.pauseOnMouseOver) {
										activeButtons = activeButtons.add( $play_btn).not( $pause_btn);
										activeButtons.stop(true,true).fadeIn();
										if (settings.auto_play)
											pauseSlider = true;
										stopSlider(false);
										oSlider.pauseTimer();
								}else
								activeButtons.stop(true,true).delay(settings.buttons_show_delay).fadeIn(settings.buttons_show_time);
						})
													.mouseleave(function(){
								if (settings.pauseOnMouseOver && pauseSlider){	
										activeButtons = activeButtons.add( $pause_btn.show()).not( $play_btn.hide());
										pauseSlider = false;
										oSlider.startSlider();
								}
								activeButtons.stop(true,true).delay(settings.buttons_hide_time).fadeOut(settings.buttons_hide_delay);});

				}else {
					
						activeButtons.show();	
						if (settings.pauseOnMouseOver){	
									
							$slider.not(activeButtons)	.mouseenter(function(){
									activeButtons = activeButtons.add( $play_btn.show()).not( $pause_btn.hide());
									if (settings.auto_play)
										pauseSlider = true;
									stopSlider(false);
									oSlider.pauseTimer();})									
													.mouseleave(function(){
									if (pauseSlider){
										activeButtons = activeButtons.add( $pause_btn.show()).not( $play_btn.hide());				
										pauseSlider = false;
										oSlider.startSlider();
									}});
						}
				}
			};
			
			
			this.unbind = function(){
								
					$slider.not(activeButtons).unbind('mouseenter');
					$slider.not(activeButtons).unbind('mouseleave');
			};

			this.unbindAL = function(){
								
					$slider.unbind('mouseup');
					$($sliderImage[oSlider.currentImage]).find('>a').unbind('click');
					
			};
			
			this.initPauseOnMouseOver = function(){
				
				if (settings.pauseOnMouseOver){
					
					$slider	.mouseenter(function(){
									oSlider.stopRealSlider();
									oSlider.pauseTimer();})									
							.mouseleave(function(){
									oSlider.startSlider();});					
				}
			};
			
			//init Links		
			this.initLinks = function(){
				
				
				$sliderImage.mouseup(function(){
									
									if (settings.auto_play){									
											stopSlider(true);
											pauseSlider = false;
											oSlider.pauseTimer();
									}
				});				
			};			
			//init Attributes
			var initAttributes = function() {
				
				var image = 0;
				var nov, custClass, custClasses, transition ='', delay ='', time ='';
				
				for ( image; image < $sliderImage.size(); image++){
						
						custClass = $($sliderImage[image]).attr('class');
						custClasses = custClass.split(' ');
						for (i=0; i < custClasses.length; i++){
							
								if( custClasses[i].indexOf('transition_') > -1)
								transition = custClasses[i].replace('transition_','');
								if( custClasses[i].indexOf('delay_') > -1)
								delay = custClasses[i].replace('delay_','');
								if( custClasses[i].indexOf('time_') > -1)
								time = parseInt(custClasses[i].replace('time_',''));

						}
						$($sliderImage[image]).find('img').data('href');
						$($sliderImage[image]).data({'delay':delay, 'transition': transition, 'time':time});
						$($sliderImage[image]).find('img').data('href');
						delay = '';
						transition = '';
						time = '';
					}
				
				if (settings.animation == 'Regular' || settings.animation == 'Random'){
						animList = new Array();
						var i = 0;
						for (key in animations){
							animList[i] = key;
							i++;							
						}
						animList = animList.slice(0,-6);
				}
				if (settings.animation == 'Regular-Exception' || settings.animation == 'Random-Exception'){
						animList = new Array();
						var animListEx = settings.transitions.split(' ');
						var i = 0;
						for (key in animations){
							if($.inArray(key, animListEx)>=0) continue;
							animList[i] = key;
							i++;							
						}
						animList = animList.slice(0,-6);
				}
				if (settings.animation == 'Regular-Custom' || settings.animation == 'Random-Custom'){
					
					animList = settings.transitions.split(' ');										

				}
				if (settings.animation == 'Random' || settings.animation == 'Random-Custom' || settings.animation == 'Random-Exception'){
										
					var oldVal, newVal;
					for (i = 0; i < animList.length; i++){
						newVal = Math.floor(Math.random()*(animList.length));
						oldVal = animList[i];						
						animList[i] = animList[newVal];
						animList[newVal] = oldVal;
					}					
				}
				
			};
			
			//init Structure
			var initStructure = function(){								
			
				container = $('<div class="li-banner-image-wrap" ></div>').css({'position': 'absolute', 'top': '0px', 'left': '0px', 'overflow': 'hidden','height':settings.height, 'width':settings.width, 'z-index': -100}); 
				$('ul',$slider).before(container);
				
				if ((settings.animation == 'Random') || (settings.animation == 'Regular')){
					
					initSections();
					init_2_X_Sections();
					initBgSections();
					oSlider.initVertSections();
					oSlider.initSqrSections();
				}else{
				
				var animStructure = [0,0,0,0,0,0];

				for ( var image=0; image < $sliderImage.size(); image++){
						
						var anim = $($sliderImage[image]).data('transition');
						if(anim && animations[anim]) {
							animStructure[animations[anim][2]] ++;
						}
					}
				if (animations[settings.animation]){
					animStructure[animations[settings.animation][2]] ++;
					if (animations[settings.animation][0] >= animations['Regular-Custom'][0]){
						
						for(var i=0; i< animList.length; i++){
							if(animations[animList[i]])
							animStructure[animations[animList[i]][2]] ++;
							else animList[i] = 'None';
						}
					}
				}else settings.animation = 'None';
				
				if(animStructure[1]>0)
					init_2_X_Sections();
				
				if(animStructure[2]>0)
					initBgSections();

				if(animStructure[3]>0)
					initSections();
				
				if(animStructure[4]>0)
					oSlider.initVertSections();
					
				if(animStructure[5]>0)
					oSlider.initSqrSections();
				};	
				
			};
			
			//init Sections - 2*2
			var initSections = function() {
				
				var sqr_sections, sqr_section, image, sectionsX = 2, sectionsY = 2, sectionsZ = 2 ;
				var url="";// = $('img',$sliderImage[oSlider.currentImage]).attr('src');
				var xPos, tOffset;
				var width = Math.ceil(parseInt(settings.width)/sectionsX);
				oSlider.width4 = width*2;
				var height = Math.ceil(parseInt(settings.height)/sectionsY);
				oSlider.height4 = height*2;
								
				for ( var y=0; y < sectionsY; y++){
					for ( var i=0; i < sectionsX; i++){
						for ( var z=0; z < sectionsZ; z++){
												
						sqr_section=$('<div class="li-sectors'+z+'" id="'+oSlider.prefix+'-sqr-sect-'+y+'-'+i+'-'+z+'" style="left:'+i*width+'px; top: '+y*height+'px; width:'+width+'px; height:'+height+'px; position: absolute; display: none; overflow: hidden;  z-index:-100">');
						image = '<img src="'+url+'" alt="Pic '+y+'.'+i+'" style="position: absolute; left: -'+i*width+'px; top: -'+y*height+'px" />';
						$(sqr_section).html(image);

						sqr_sections = $(sqr_sections).add(sqr_section);
						}
													
					}
				}
				$(container,$slider).append(sqr_sections);
//				oSlider.reInitSectors();
				
					
			};
			// init Sections 2*1
			var init_2_X_Sections = function() {
				
				var sections_2, section_2, image, sectionsX = 2, sectionsY = 1, sectionsZ = 2 ;
				var url="";// = $('img',$sliderImage[oSlider.currentImage]).attr('src');
				var xPos, tOffset;
				var width = Math.ceil(parseInt(settings.width)/sectionsX);
				oSlider.width2 = width*2;
				var height = Math.ceil(parseInt(settings.height)/sectionsY);
				oSlider.height2 = height;
								
				for ( var y=0; y < sectionsY; y++){
					for ( var i=0; i < sectionsX; i++){
						for ( var z=0; z < sectionsZ; z++){
												
						section_2=$('<div class="li-sectors_2_X-'+z+'" id="'+oSlider.prefix+'-sect-2-x-'+y+'-'+i+'-'+z+'" style="left:'+i*width+'px; top: '+y*height+'px; width:'+width+'px; height:'+height+'px; position: absolute; display: none; overflow: hidden;">');
						image = '<img src="" alt="Pic '+y+'.'+i+'" style="position: absolute; left: -'+i*width+'px; top: -'+y*height+'px;" />';
						$(section_2).html(image);

						sections_2= $(sections_2).add(section_2);
						}
													
					}
				}
				$(container,$slider).append(sections_2);
//				oSlider.reInit_2_X_Sectors();
				
					
			};
			//init Sections 2*2 with bg images
			var initBgSections = function() {
				
				var section, sectionsX = 2, sectionsY = 2 ;
				var bgColor = $slider.css("background-color");
				var url = $('img',$sliderImage[oSlider.currentImage]).attr('src');
				var xPos, tOffset;
				var width = Math.ceil(parseInt(settings.width)/sectionsX);
				oSlider.width4 = width*2;
				var height = Math.ceil(parseInt(settings.height)/sectionsY);
				oSlider.height4 = height*2;
								
				for ( var y=0; y < sectionsY; y++){
					for ( var i=0; i < sectionsX; i++){
												
						section = '<div class="sectors-bg" id="'+oSlider.prefix+'-bg-sect-'+y+'-'+i+'" style="left:'+i*width+'px; top: '+y*height+'px; width:'+width+'px; height:'+height+'px; position: absolute; display: none;" >';

						sections = $(sections).add($(section).css({background:bgColor + " url('"+ url +"') no-repeat ", backgroundPosition:-i*width + "px " + -y*height + "px ", "z-index":-100 }));
													
					}
				}
				$(container,$slider).append(sections);
				
					
			};
			// init Sections - Vertical
			this.initVertSections = function() {
				
				var section, sections, sectionsX = settings.vert_sections;
				var bgColor = $slider.css("background-color");
				var url="";// = $('img',$sliderImage[oSlider.currentImage]).attr('src');				
				var width = Math.ceil(parseInt(settings.width)/sectionsX);
				var sectionsXRed = Math.ceil(settings.width/width);
				settings.vert_sections = sectionsXRed;
				var height = parseInt(settings.height);

				
					for ( i=0; i < sectionsXRed; i++){
												
						section = '<div class="v-sectors" id="'+oSlider.prefix+'-v'+i+'" style="left:'+i*width+'px; top: 0px; width:'+width+'px; height:'+height+'px; position: absolute; display: none" >';

						sections = $(sections).add($(section).css({background:bgColor + " url('"+ url +"') no-repeat ", backgroundPosition:-i*width + "px 0px " }));
													
					}
				$(container,$slider).append(sections);
				
					
			};
			//init Sections Squares
			this.initSqrSections = function() {
				
				var section, sections, sectionsY = settings.sqr_sections_Y, sectionsX ;
				var bgColor = $slider.css("background-color");
				var url="";// = $('img',$sliderImage[oSlider.currentImage]).attr('src');				
				var height = Math.ceil(settings.height/sectionsY);
				var sectionsYRed = Math.ceil(settings.height/height);
				settings.sqr_sections_Y = sectionsYRed;
				sectionsX = Math.ceil(settings.width/height);
				settings.sqr_sections_X = sectionsX;
				var width = height;

				for (y = 0; y < sectionsYRed; y++){
					for ( i=0; i < sectionsX; i++){
												
						section = '<div id="'+oSlider.prefix+'-sqr-'+i+'-'+y+'" class="sqr-sectors" style="left:'+i*width+'px; top: '+y*height+'px; width:'+width+'px; height:'+height+'px; position: absolute; display: none" >';

						sections = $(sections).add($(section).css({background:bgColor + " url('"+ url +"') no-repeat ", backgroundPosition:-i*width + "px " + -y*height + "px "}));
													
					}
				}
				$(container,$slider).append(sections);
				
					
			};
			
			
			//init Animation effect
			var initAnimation = function() {
				
				var funcName = animations[settings.animation][1];
				if (funcName == showImage_random){
					showContent = function(pos,time){
								showImage_random(pos,time,animations[settings.animation][3],false);
							};
				}else{
					var anim = animations[settings.animation];
					if (typeof funcName == 'string' && eval('typeof ' + funcName) == 'function') {
						var arg = animations[settings.animation][3];
						if (arg) arg = ','+arg+'';
						else arg = '';
						showContent = function(pos,time){
									eval(funcName+'('+pos+','+time+',oSlider,$sliderImage,settings'+arg+')');
								};					
					}else {
						showContent = function(pos,time){									
									showImage(pos,time);
								};
					}
				}
				
			};

			// Show next image
			this.showNextImage = function() {
				
					var pos = (oSlider.currentImage<(numberImages-1))?(oSlider.currentImage+1):(0);
					var transition = $($sliderImage[pos]).data('transition');
					var time = $($sliderImage[pos]).data('time');
					if (time=='') time = settings.trans_period;
					if(transition)
					showImage_random(pos,time,'',transition);
					else showContent(pos,time);										
			};
			
			// Show prev image
			this.showPrevImage = function() {
				
					var pos = (oSlider.currentImage>0)?(oSlider.currentImage-1):(numberImages-1);
					var transition = $($sliderImage[pos]).data('transition');
					var time = $($sliderImage[pos]).data('time');
					if ( time == '') time = settings.trans_period;
					if(transition)
					showImage_random(pos,time,'',transition);
					else showContent(pos,time);
			};
			
			this.showSpecImage = function(pos) {
					
					var transition = $($sliderImage[pos]).data('transition');
					var time = $($sliderImage[pos]).data('time');
					if (time == '') time = settings.trans_period;
					if(transition)
					showImage_random(pos,time,'',transition);
					else showContent(pos,time);
			};
			
			//change position
			this.newPosition = function(position) {
				
				$($(".nav-btns",$slider).find('.nav-btn')[oSlider.currentImage]).removeClass('current-slide');				
				$($(".nav-btns",$slider).find('.nav-btn')[position]).addClass('current-slide');
				
				oSlider.prevPosition = oSlider.currentImage;
				oSlider.currentImage = position;	
//				return position;				
			};
			
			this.setTransition = function(val){
				
				inTransition = val;
				if(!inTransition && settings.active_links){
					var info_link = $($sliderImage[oSlider.currentImage]).find('>a').attr('href');
					if (info_link)
						$('div.li-banner-image-wrap',$slider).css({cursor:'pointer'});
					else 
						$('div.li-banner-image-wrap',$slider).css({cursor:'default'});
				}
				if(settings.effect){
					if(!val){
						playEffect();
						if (settigs.new_vert_sections != '' && settigs.new_vert_sections != settings.vert_sections){
							settings.vert_sections = settigs.new_vert_sections;
							$slider.find('.v-sectors').remove();
							oSlider.initVertSections();
						}
					}										
				}
				if(!val){
						$('div.li-banner-image-wrap',$slider).css({'z-index':-100});
						if (settings.new_vert_sections != '' && settings.new_vert_sections != settings.vert_sections){
							settings.vert_sections = settings.new_vert_sections;
							$slider.find('.v-sectors').remove();
							oSlider.initVertSections();
						}
						if (settings.new_sqr_sections != '' && settings.new_sqr_sections != settings.sqr_sections_Y){
							settings.sqr_sections_Y = settings.new_sqr_sections;
							$slider.find('.sqr-sectors').remove();
							oSlider.initSqrSections();
						}
				}
				if(val){
						$('div.li-banner-image-wrap',$slider).css({'z-index':-10});
						stopTimer();
						stopTimer2();
				}
			};
			//spacial efect played during slider shows image
			var playEffect = function(){

				$('img',$sliderImage[oSlider.currentImage]).css({'width':settings.width, 'height':settings.height , 'left':0,'position':'absolute'}).animate({
								width: (settings.width+80)+'px',
								height: (settings.height+80)+'px',
								left: '- 40px',
								top: '- 20px'								
								}, settings.delay*2, 'linear',function(){ 
											$('img',$sliderImage[prevPosition]).css({'width':'', 'height':'' , 'left':'','position':''})});
			};
			
			
			var startTimer1 = function(currDelay) {
				if ($('.timer').length==0){
				var claSS;
				if (settings.timer == 'line_bottom') claSS = 'timer-horizontal-bottom timer';
				else if (settings.timer == 'line_top') claSS = 'timer-horizontal-top timer';
				var timer = $('<div class="'+claSS+'" ></div>');//.css({'position':'absolute', 'top':settings.height-10, 'left':0,'width': 0, 'height':10, 'background-color':'#CCC' });
//				$(container,$slider).append(timer);
				$slider.append(timer);
				}
				$('.timer').show().animate({						
						width: settings.width+1
					  }, currDelay,'linear' );			
				
			};
			
			var startTimer2 = function(currDelay) {
				if ($('.timer').length==0){
				var claSS;
				if (settings.timer == 'line_right') claSS = 'timer-vertical-right timer';
				else if (settings.timer == 'line_left') claSS = 'timer-vertical-left timer';
				var timer = $('<div class="'+claSS+'" ></div>');//.css({'position':'absolute', 'top':0, 'left':0,'width': 10, 'height':0,  'background-color':'#CCC'});
//				$(container,$slider).append(timer);
				$slider.append(timer);
				}
				$('.timer').animate({						
						height: settings.height+1
					  }, currDelay, 'linear' );			
				
			};
			
			var stopTimer = function(){
						clearInterval(timer_id);
						$($slider).find('.timer-circle').remove();
			};
			
			var stopTimer2 = function(){
						
						$($slider).find('.timer').remove();
			};
			
			this.pauseTimer = function(){
				if (settings.timer=='circle'){
						clearInterval(timer_id);
						$($slider).find('.timer-circle').stop().fadeOut(500,function(){$($slider);});
				}else 
						$($slider).find('.timer').stop();//.fadeOut(500,function(){$($slider)});
			};
			
			var timer_id;
			
			//play Slider
			var playSlider = function(){
				if (oSlider.currentImage!=(numberImages-1)){
						doPlaySlider();
				}else if ( settings.repeat == true & ('boolean' == typeof (settings.repeat)) ){
						doPlaySlider();
				}else if (settings.repeatRe >0){
						settings.repeatRe = settings.repeatRe -1;
						doPlaySlider();				
				}else{
					stopSlider(true);
//					activeButtons.show().hide(200);					
				}
			};
						
			
			var doPlaySlider = function(){
						var new_del = 1 - (parseInt($($slider).find('.timer').css('width'))/settings.width);
						var currDelay = $($sliderImage[oSlider.currentImage]).data('delay');						
						if (isNaN(currDelay) || currDelay == '')
						currDelay = settings.delay;
						if(!isNaN(new_del) && new_del>0 )
						currDelay = currDelay*new_del;
						playSliderRec = setTimeout(oSlider.showNextImage,Number(currDelay));
						if (settings.timer!='' && settings.timer != 'no'){
							switch (settings.timer){
								case 'circle': // line_botom, line_top, line_right, line_left
									startTimer(Number(currDelay));
									break;
								case 'line_bottom':
								case 'line_top':
									startTimer1(Number(currDelay));
									break;
								case 'line_right':
								case 'line_left':
									startTimer2(Number(currDelay));
									break;								
							}
						}
			};
			
			this.startSlider = function(){
				if (!settings.auto_play){
					settings.auto_play = true;
					if (!inTransition){							
							playSlider();
					}
				}
			};
			
			//stop Slider
			var stopSlider = function(show){
				if(settings.play_pause_show){
					if(show)
					activeButtons = activeButtons.add( $play_btn.show()).not( $pause_btn.hide());
					else
					activeButtons = activeButtons.add( $play_btn).not( $pause_btn.hide());
				}
				oSlider.stopRealSlider();			
			};
			
			this.togglePlay = function(){
				if(settings.buttons_show){
					if(settings.play_pause_show){
						if(!settings.auto_play)
							activeButtons = activeButtons.add( $play_btn.show()).not( $pause_btn.hide());
						else
							activeButtons = activeButtons.add( $pause_btn.show()).not( $play_btn.hide());
					}else
						activeButtons = activeButtons.add( $play_btn).not( $pause_btn);							
				}
			};
			
			this.stopRealSlider = function(){				
				clearTimeout(playSliderRec);
				playSliderRec = null;
				settings.auto_play = false;				
			};
						
			
			//stop Slider from outside
			var stopSliderDistance = function(){
				
				clearTimeout(playSliderRec);
				playSliderRec = null;
				settings.auto_play = false;				
			};
			
			//auto play
			this.autoPlaySlider = function(){
				if (settings.auto_play)
					playSlider();
			};
						
			//animation
			var showImage = function(position,time) {
					
					oSlider.setTransition(true);
					$($sliderImage[oSlider.currentImage]).hide();
					$($sliderImage[position]).show();
					oSlider.newPosition(position);
					oSlider.setTransition(false);
					oSlider.autoPlaySlider();
			};
			
			//claer li
			this.clearLi = function(){
					
					$($sliderImage[oSlider.prevPosition]).css({'z-index':'','left': '', 'top':'', 'width':'', 'height': '', 'opacity': '' }).hide();
					$($sliderImage[oSlider.currentImage]).css({'z-index':'','left': '', 'top':'', 'width':'', 'height': '', 'opacity': '' });
			};
			
			//clear image
			this.clearImg = function(){										
					$('img',$sliderImage[oSlider.prevPosition]).removeAttr("style");
					$('img',$sliderImage[oSlider.currentImage]).removeAttr("style");
			};
			
			// replace li
			this.replaceLi = function(){										
					$($sliderImage[oSlider.prevPosition]).hide();
					$($sliderImage[oSlider.currentImage]).show();
			};						
			
			//re init 2_X_Sectors
			this.reInit_2_X_Sectors = function(){
				
				$('.li-sectors_2_X-0',$slider).hide().css({'z-index': '','opacity':0 });
				$('.li-sectors_2_X-1',$slider).hide().css({'z-index': '','opacity':0 });
				$('#'+oSlider.prefix+'-sect-2-x-0-0-0').find('img').css({'left': 0, 'top':0, 'width':'', 'height':'' });
				$('#'+oSlider.prefix+'-sect-2-x-0-0-1').find('img').css({'left': 0, 'top':0, 'width':'', 'height':''});
				$('#'+oSlider.prefix+'-sect-2-x-0-1-0').find('img').css({'left': '-'+oSlider.width2/2+'px', 'top':0, 'width':'', 'height':'' });
				$('#'+oSlider.prefix+'-sect-2-x-0-1-1').find('img').css({'left': '-'+oSlider.width2/2+'px', 'top':0, 'width':'', 'height':'' });				
			};
			
			//re init Sectors
			this.reInitSectors = function(){
				
				$('.li-sectors0',$slider).hide().css({'z-index': '','opacity':0 });
				$('.li-sectors1',$slider).hide().css({'z-index': '','opacity':0 });
				$('#'+oSlider.prefix+'-sqr-sect-0-0-0').find('img').css({'left': 0, 'top':0 });
				$('#'+oSlider.prefix+'-sqr-sect-0-0-1').find('img').css({'left': 0, 'top':0 });
				$('#'+oSlider.prefix+'-sqr-sect-0-1-0').find('img').css({'left': '-'+oSlider.width4/2+'px', 'top':0 });
				$('#'+oSlider.prefix+'-sqr-sect-0-1-1').find('img').css({'left': '-'+oSlider.width4/2+'px', 'top':0 });
				$('#'+oSlider.prefix+'-sqr-sect-1-0-0').find('img').css({'left': 0, 'top':'-'+oSlider.height4/2+'px' });
				$('#'+oSlider.prefix+'-sqr-sect-1-0-1').find('img').css({'left': 0, 'top':'-'+oSlider.height4/2+'px' });
				$('#'+oSlider.prefix+'-sqr-sect-1-1-0').find('img').css({'left': '-'+oSlider.width4/2+'px', 'top':'-'+oSlider.height4/2+'px' });
				$('#'+oSlider.prefix+'-sqr-sect-1-1-1').find('img').css({'left': '-'+oSlider.width4/2+'px', 'top':'-'+oSlider.height4/2+'px' });
			};
			
						
			//animation Random, Regular Custom 
			var showImage_random = function(pos,time,type,anim){
					
					if (anim) animRandom = anim;
					else{
							animRandom = animList[animCons];
							(animCons < animList.length-1)?animCons++:animCons=0;
						}					
				
					var funcName = animations[animRandom][1];
					if (typeof funcName == 'string' &&
						eval('typeof ' + funcName) == 'function') {
						var arg = animations[animRandom][3];
						if (arg) arg = ','+arg+'';
						else arg = '';
							eval(funcName+'('+pos+','+time+',oSlider,$sliderImage,settings'+arg+')');			
					}else if (anim)	 showImage(pos,time);
					else showImage_random(pos,time,type,anim);
			};

		var animations = new Array();
		animations['None'] = [0,'showImage',0,];
		animations['Fade'] = [animations['None'][0]+1,'fade',0,];
		animations['Slide-Left'] = [animations['Fade'][0]+1,'slide_left_right',0,'-1'];
		animations['Slide-Right'] = [animations['Slide-Left'][0]+1,'slide_left_right' ,0,'1'];
		animations['Slide-Down'] = [animations['Slide-Right'][0]+1,'slide_down',0,];
		animations['Slide-Up'] = [animations['Slide-Down'][0]+1,'slide_up' ,0,];
		animations['Curtain-Cl'] = [animations['Slide-Up'][0]+1,'curtain' ,0,];					
		animations['Curtain-Cl-Bou'] = [animations['Curtain-Cl'][0]+1,'curtain_bounce' ,0,];
		animations['Curtain-Cl-Ran-Bou'] = [animations['Curtain-Cl-Bou'][0]+1,'curtain_random_bounce' ,0,];
		animations['Curtain-Op'] = [animations['Curtain-Cl-Ran-Bou'][0]+1,'curtain_open' ,0,];					
		animations['Curtain-Op-Bou'] = [animations['Curtain-Op'][0]+1,'curtain_open_bounce' ,0,];
		animations['Curtain-Op-Ran-Bou'] = [animations['Curtain-Op-Bou'][0]+1,'curtain_open_random_bounce' , 0, ''];
		animations['Curtain-V-Cl'] = [animations['Curtain-Op-Ran-Bou'][0]+1,'h_curtain' , 0, ''];
		animations['Curtain-V-Cl-Bou'] = [animations['Curtain-V-Cl'][0]+1,'h_curtain_bounce' , 0, ''];
		animations['Curtain-V-Cl-Ran-Bou'] = [animations['Curtain-V-Cl-Bou'][0]+1,'h_curtain_random_bounce' ,0 , ''];
		animations['Curtain-V-Op'] = [animations['Curtain-V-Cl-Ran-Bou'][0]+1,'h_curtain_open' ,0 , ''];					
		animations['Curtain-V-Op-Bou'] = [animations['Curtain-V-Op'][0]+1,'h_curtain_open_bounce' ,0 , ''];
		animations['Curtain-V-Op-Ran-Bou'] = [animations['Curtain-V-Op-Bou'][0]+1,'h_curtain_open_random_bounce' , 0, ''];					
		animations['Shrink-Left-Bottom'] = [animations['Curtain-V-Op-Ran-Bou'][0]+1,'shrink_angle' , 0, '0,1'];
		animations['Shrink-Left-Top'] = [animations['Shrink-Left-Bottom'][0]+1,'shrink_angle' , 0, '0,0'];
		animations['Shrink-Right-Bottom'] = [animations['Shrink-Left-Top'][0]+1,'shrink_angle' , 0, '1,1'];
		animations['Shrink-Right-Top'] = [animations['Shrink-Right-Bottom'][0]+1,'shrink_angle' , 0, '1,0']; 																		
		animations['Shrink-Center'] = [animations['Shrink-Right-Top'][0]+1,'shrink_center' ,0 , ''];					
		animations['Shrink-Center-Bounce'] = [animations['Shrink-Center'][0]+1,'shrink_center_bounce' , 0, ''];
		animations['Srink-Random-Bounce'] = [animations['Shrink-Center-Bounce'][0]+1,'srink_random_bounce' ,0 , ''];
		animations['Zoom-Up-Left'] = [animations['Srink-Random-Bounce'][0]+1,'zoom_up_left' ,0 , ''];
		animations['Zoom-Up-Right'] = [animations['Zoom-Up-Left'][0]+1,'zoom_up_right' ,0 , ''];
		animations['Zoom-Down-Right'] = [animations['Zoom-Up-Right'][0]+1,'zoom_down_right' ,0 , ''];
		animations['Zoom-Down-Left'] = [animations['Zoom-Down-Right'][0]+1,'zoom_down_left' ,0 , ''];
		animations['Zoom-Center'] = [animations['Zoom-Down-Left'][0]+1,'zoom_center' ,0 , ''];
		animations['Push-Right'] = [animations['Zoom-Center'][0]+1,'push_right' , 0, ''];
		animations['Push-Left'] = [animations['Push-Right'][0]+1,'push_left' ,0 , ''];
		animations['Push-Up'] = [animations['Push-Left'][0]+1,'push_up' , 0, ''];
		animations['Push-Down'] = [animations['Push-Up'][0]+1,'push_down' , 0, ''];
		animations['Move-Left'] = [animations['Push-Down'][0]+1,'move_left_right' , 0, '1'];
		animations['Move-Right'] = [animations['Move-Left'][0]+1,'move_left_right' , 0, '-1'];
		animations['Move-Top'] = [animations['Move-Right'][0]+1,'move_top_bottom' , 0, '1'];
		animations['Move-Bottom'] = [animations['Move-Top'][0]+1,'move_top_bottom' , 0,'-1'];
		animations['Appear-Up-Left'] = [animations['Move-Bottom'][0]+1,'appear_up_left' , 0,];
		animations['Appear-Up-Center'] = [animations['Appear-Up-Left'][0]+1,'appear_up_center' , 0,];
		animations['Appear-Up-Right'] = [animations['Appear-Up-Center'][0]+1,'appear_up_right' , 0,];
		animations['Appear-Center-Left'] = [animations['Move-Bottom'][0]+1,'appear_center_left' , 0,];
		animations['Appear-Center'] = [animations['Appear-Up-Left'][0]+1,'appear_center' , 0,];
		animations['Appear-Center-Right'] = [animations['Appear-Center'][0]+1,'appear_center_right' , 0,];
		
		animations['Close-Center'] = [animations['Appear-Center-Right'][0]+1,'close_center' ,1 , ''];
		animations['Open-Center'] = [animations['Close-Center'][0]+1,'open_center' ,1 , ''];
		animations['2-Close-Bounce'] = [animations['Open-Center'][0]+1,'close_bounce_2' ,1 , ''];
		animations['2-Shrink-Bounce'] = [animations['2-Close-Bounce'][0]+1,'shrink_bounce_2' ,1 , ''];
		animations['2-Shrink-Top-Bottom'] = [animations['2-Shrink-Bounce'][0]+1,'shrink_top_bottom_2' , 1, ''];
		
		animations['4-Shrink-Close'] = [animations['2-Shrink-Top-Bottom'][0]+1,'shrink_close_4' , 3, ''];
					
		animations['4-Close'] = [animations['4-Shrink-Close'][0]+1,'close_4' ,2 , ''];
		animations['4-Open'] = [animations['4-Close'][0]+1,'open_4' , 2, ''];
		animations['4-Close-Delay'] = [animations['4-Open'][0]+1,'close_delay_4' ,2 , ''];
		animations['4-Open-Delay'] = [animations['4-Close-Delay'][0]+1,'open_delay_4' ,2 , ''];
		animations['4-Close-Shift'] = [animations['4-Open-Delay'][0]+1,'close_shift_4' ,2 , ''];
		animations['4-Open-Shift'] = [animations['4-Close-Shift'][0]+1,'open_shift_4' , 2, ''];
		animations['4-Cross'] = [animations['4-Open-Shift'][0]+1,'cross_4' ,2 , ''];
							
		animations['Blind-Right'] = [animations['4-Cross'][0]+1,'blind_right' ,4 , ''];		
		animations['Blind-Right-Step'] = [animations['Blind-Right'][0]+1,'blind_right_step' ,4 , ''];
		animations['Blind-Pair-Right'] = [animations['Blind-Right-Step'][0]+1,'blind_pair_right' ,4 , ''];
		animations['Blind-Pair'] = [animations['Blind-Pair-Right'][0]+1,'blind_pair' ,4 , ''];
		animations['Blind-Pair-Right-Left'] = [animations['Blind-Pair'][0]+1,'blind_pair_right_left' ,4 , ''];
		animations['Blind-Right-All'] = [animations['Blind-Pair-Right-Left'][0]+1,'blind_right_all' , 4, ''];
		animations['Blind-Right-Wave'] = [animations['Blind-Right-All'][0]+1,'blind_right_wave' ,4 , ''];
		animations['Blind-Right-Wave-Full'] = [animations['Blind-Right-Wave'][0]+1,'blind_right_wave_full' ,4 , ''];
		animations['Blind-Right-Fade'] = [animations['Blind-Right-Wave-Full'][0]+1,'blind_right_fade' , 4, ''];
		animations['Blind-Down-Right'] = [animations['Blind-Right-Fade'][0]+1,'blind_down_right' , 4, ''];
		animations['Blind-Down-Center'] = [animations['Blind-Down-Right'][0]+1,'blind_down_center' ,4 , ''];
		animations['Blind-Down-Random'] = [animations['Blind-Down-Center'][0]+1,'blind_down_random' ,4 , ''];
		animations['Blind-Down-Up'] = [animations['Blind-Down-Random'][0]+1,'blind_down_up__wave' ,4 , '0,"easeOutCirc"'];
		animations['Blind-Down-Up-Fade'] = [animations['Blind-Down-Up'][0]+1,'blind_down_up_fade' ,4 , ''];
		animations['Blind-Down-Up-Bounce'] = [animations['Blind-Down-Up-Fade'][0]+1,'blind_down_up__wave' ,4 , '0,"easeOutBack"'];		
		animations['Blind-Down-Up-Wave'] = [animations['Blind-Down-Up-Bounce'][0]+1,'blind_down_up__wave' ,4 , '1'];
		
		animations['Line-Down'] = [animations['Blind-Down-Up-Wave'][0]+1,'line_down' ,5 , ''];
		animations['Sqr-Down'] = [animations['Line-Down'][0]+1,'sqr_down' , 5, ''];
		animations['Line-Down-Reverse'] = [animations['Sqr-Down'][0]+1,'line_down_revers' , 5, ''];
		animations['Sqr-Down-Expand'] = [animations['Line-Down-Reverse'][0]+1,'sqr_down_expand' ,5 , ''];
		animations['Sqr-Ex-Pairs'] = [animations['Sqr-Down-Expand'][0]+1,'sqr_ex_pairs' ,5 , ''];
		animations['Sqr-Ex-S-E'] = [animations['Sqr-Ex-Pairs'][0]+1,'sqr_ex_s_e' ,5 , ''];
		animations['Sqr-Ex-N-E'] = [animations['Sqr-Ex-S-E'][0]+1,'sqr_ex_n_e' ,5 , ''];
		animations['Sqr-Ex-S-W'] = [animations['Sqr-Ex-N-E'][0]+1,'sqr_ex_s_w' ,5 , ''];
		animations['Sqr-Ex-N-W'] = [animations['Sqr-Ex-S-W'][0]+1,'sqr_ex_n_w' ,5 , ''];
		animations['Sqr-Ex-Down'] = [animations['Sqr-Ex-N-W'][0]+1,'sqr_ex_down' ,5 , ''];
		animations['Sqr-Ex-Left'] = [animations['Sqr-Ex-Down'][0]+1,'sqr_ex_left' ,5 , ''];
		animations['Sqr-Ex-Rirht'] = [animations['Sqr-Ex-Left'][0]+1,'sqr_ex_right' ,5 , ''];
		animations['Sqr-Ex-Up'] = [animations['Sqr-Ex-Rirht'][0]+1,'sqr_ex_up' ,5 , ''];
		animations['Sqr-Ex-Random'] = [animations['Sqr-Ex-Up'][0]+1,'sqr_ex_random' ,5 , ''];
		animations['Sqr-Ex-Cros'] = [animations['Sqr-Ex-Random'][0]+1,'sqr_ex_cros' ,5 , ''];
		animations['Sqr-Sl-S-E'] = [animations['Sqr-Ex-Cros'][0]+1,'sqr_sl_s_e' ,5 , ''];
		animations['Sqr-Sl-N-E'] = [animations['Sqr-Sl-S-E'][0]+1,'sqr_sl_n_e' ,5 , ''];
		animations['Sqr-Sl-S-W'] = [animations['Sqr-Sl-N-E'][0]+1,'sqr_sl_s_w' ,5 , ''];
		animations['Sqr-Sl-N-W'] = [animations['Sqr-Sl-S-W'][0]+1,'sqr_sl_n_w' ,5 , ''];
		animations['Sqr-Sl-Down'] = [animations['Sqr-Sl-N-W'][0]+1,'sqr_sl_down' ,5 , ''];
		animations['Sqr-Sl-Up'] = [animations['Sqr-Sl-Down'][0]+1,'sqr_sl_up' ,5 , ''];
		animations['Sqr-Sl-Random'] = [animations['Sqr-Sl-Up'][0]+1,'sqr_sl_random' ,5 , ''];
		animations['Sqr-Expand'] = [animations['Sqr-Sl-Random'][0]+1,'sqr_expand' , 5, ''];
//		animations['Sqr-Expand-Center'] = [animations['Sqr-Expand'][0]+1,'sqr_expand_center' ,5 , ''];
		animations['Sqr-Fade'] = [animations['Sqr-Expand'][0]+1,'sqr_fade' , 5, ''];
		animations['Sqr-Fade-Chess'] = [animations['Sqr-Fade'][0]+1,'sqr_fade_chess' , 5, ''];
		animations['Sqr-Fade-Down'] = [animations['Sqr-Fade-Chess'][0]+1,'sqr_fade_down' , 5, ''];
		animations['Sqr-Random'] = [animations['Sqr-Fade-Down'][0]+1,'sqr_random' ,5 , ''];
		animations['Slide-Back-Left'] = [animations['Sqr-Random'][0]+1,'slide_back' , 0, '-1'];
		animations['Slide-Back-Right'] = [animations['Slide-Back-Left'][0]+1,'slide_back' ,0 , '1'];
		animations['Slide-Back-Up'] = [animations['Slide-Back-Right'][0]+1,'slide_back_v' ,0 , '-1']; 
		animations['Slide-Back-Down'] = [animations['Slide-Back-Up'][0]+1,'slide_back_v' , 0, '1']; 
		animations['Regular'] = [animations['Slide-Back-Down'][0]+1,showImage_random , , 'Regular'];
		animations['Random'] = [animations['Regular'][0]+1,showImage_random , , 'Random'];
		animations['Regular-Custom'] = [animations['Random'][0]+1,showImage_random ,,'Regular-Custom'];
		animations['Random-Custom'] = [animations['Regular-Custom'][0]+1,showImage_random ,,'Random-Custom'];
		animations['Regular-Exception'] = [animations['Random-Custom'][0]+1,showImage_random ,,'Regular-Exception'];
		animations['Random-Exception'] = [animations['Regular-Exception'][0]+1,showImage_random ,,'Random-Exception'];
					
}

})(jQuery);


jQuery.fn.extend({
/**
* Returns get parameters.
*
* If the desired param does not exist, null will be returned
*
* To get the document params:
* @example value = $(document).getUrlParam("paramName");
* 
* To get the params of a html-attribut (uses src attribute)
* @example value = $('#imgLink').getUrlParam("paramName");
*/ 
 getUrlParam: function(strParamName){
	  strParamName = escape(unescape(strParamName));
	  
	  var returnVal = new Array();
	  var qString = null;
	  
	  if ($(this).attr("nodeName")=="#document") {
	  	//document-handler
		
		if (window.location.search.search(strParamName) > -1 ){
			
			qString = window.location.search.substr(1,window.location.search.length).split("&");
		}
			
	  } else if ($(this).attr("src")!="undefined") {
	  	
	  	var strHref = $(this).attr("src");
	  	if ( strHref.indexOf("?") > -1 ){
	    	var strQueryString = strHref.substr(strHref.indexOf("?")+1);
	  		qString = strQueryString.split("&");
	  	}
	  } else if ($(this).attr("href")!="undefined") {
	  	
	  	var strHref = $(this).attr("href");
	  	if ( strHref.indexOf("?") > -1 ){
	    	var strQueryString = strHref.substr(strHref.indexOf("?")+1);
	  		qString = strQueryString.split("&");
	  	}
	  } else {
	  	return null;
	  };
	  	
	  
	  if (qString==null) return null;
	  
	  
	  for (var i=0;i<qString.length; i++){
			if (escape(unescape(qString[i].split("=")[0])) == strParamName){
				returnVal.push(qString[i].split("=")[1]);
			}
			
	  };
	  
	  
	  if (returnVal.length==0) return null;
	  else if (returnVal.length==1) return returnVal[0];
	  else return returnVal;
	}
});