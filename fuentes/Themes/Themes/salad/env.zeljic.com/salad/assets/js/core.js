;(function($){

	'use strict';

	var wnd = $(window),
	w = 0,
	h = 0,
	wrap = $('.wrap'),
	slides = $('.slide'),
	ssize = $('.slide').size(),
	parallaxContainer = $('.parallax-container'),
	expanded = false,
	currentSection = null,
	extraSpace = 80,
	times = ['seconds', 'minutes', 'hours', 'days'],
	everClick = false,
	calcSize = function()
	{
		w = wnd.width();
		h = wnd.height();
	},
	toMiddle = function(selector, animate)
	{
		var el = $(selector),
		parent = el.parent(),
		elH = el.height(),
		parentH = parent.height(),
		calc = parentH < elH ? 0 : parseInt((parentH - elH) / 2, 10);

		if(animate === true)
			el.animate({'margin-top': calc}, animeTime);
		else
			el.css({ 'margin-top': calc });
	},
	toFit = function(selector)
	{
		var el = $(selector),
		parent = el.parent(),
		parentW = parent.width(),
		parentH = parent.height();

		el.css({
			width: parentW,
			height: parentH
		});
	},
	onResize = function()
	{
		if(!expanded)
		{
			var _w = 0,
			signwrap = $('.signwrap');

			$('.section').css({display: 'none'});

			calcSize();
			_w = parseInt(w / ssize, 10);

			wrap.css({ height: h, width: w });
			slides.each(function(idx, __el){
				$(__el).css({
					height: h,
					width: idx + 1 === slides.size() ? w - (_w * (ssize - 1)) : _w
				});
			});

			signwrap.show();
			toFit(signwrap);
			toMiddle('.sign');

			$.fn.parallax.doResize();
		}else if(currentSection !== null)
		{
			calcSize();

			var ch = currentSection.height(),
			_h = ch + extraSpace < h ? h : ch + extraSpace;

			wrap.css({
				width: w,
				height: _h
			});

			calcSize();

			toFit(currentSection.closest('.slide'));
			toMiddle(currentSection);

			slides.css({
				height: _h
			});

			$.fn.parallax.doResize();
		}
	},
	formState = function(state)
	{
		var els = $('#contact_form input, #contact_form textarea, #contact_form button');

		if(!state)
			els.attr('disabled', 'disabled');
		else
			els.removeAttr('disabled');
	},
	checkEmail = function(em)
	{
		var emailRe = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return emailRe.test(em);
	};

	// init parallax
	parallaxContainer.parallax({
		overflow: 0.09,
		children: '.parallax-item',
		motion: [{x: 0.5, y: 0.5}, {x: 0.6, y: 0.6}]
	});

	// init clock timer
	$('.clock').countdown(countdownDate, function(e){

		var idx = $.inArray(e.type, times);

		if(idx < 0)
			return;

		for(var i = 0; i < idx + 1; i++)
		{
			var text = e.lasting[times[i]];
			$('.p'.concat(times[i], ' .pvalue')).text(''.concat(text < 10 ? '0' : '', text));
		}
	});

	// slide on mouseover icon
	slides.mouseenter(function(){
		var _t = $(this);
		_t.find('.icon').addClass('iconhover');
		_t.find('.icondesc').show();
	}).mouseleave(function(){
		var _t = $(this);
		_t.find('.icon').removeClass('iconhover');
		_t.find('.icondesc').hide();
	});

	// click on slide
	$('.signwrap').click(function(){
		everClick = true;

		var el = $(this).parent(),
		not = slides.not(this);

		not.find('.signwrap').fadeOut(animeTime / 2);

		el.find('.signwrap').fadeOut(animeTime / 2, function(){
			el.animate({width: w},{
				duration: animeTime,
				step: function(now)
				{
					el.css({width: now});
					not.css({width: parseInt((w - now) / (ssize - 1), 10)});
				},
				complete: function()
				{

					var whatShow = el.attr('data-show'),
					toShow, toShowH;

					if(whatShow === '')
						return;

					toShow = $('.' + whatShow);
					toShowH = toShow.height();
					toShowH = toShowH + extraSpace > h ? toShowH + extraSpace : h;

					wrap.height(toShowH);

					calcSize();

					wrap.css({
						width: w,
						height: toShowH
					});

					$.fn.parallax.doResize();

					toShow.closest('.slide').css({
						width: w,
						height: toShowH
					});

					toMiddle(toShow);

					toShow.css({
						visibility: 'visible',
						display: 'none'
					});

					toShow.fadeIn(animeTime / 2);

					expanded = true;
					currentSection = toShow;
				}
			});
		});
	});

	// click on close btn
	$('.closebtn').click(function(){

		var section = $(this).closest('.section'),
		slide = section.closest('.slide'),
		not = slides.not(slide);

		wrap.height(h);

		parallaxContainer.hide();

		calcSize();

		wrap.css({width: w, height: h});
		slide.css({width: w, height: h});

		$.fn.parallax.doResize();
		parallaxContainer.show();

		section.fadeOut(animeTime / 2, function(){
			slide.animate({width: parseInt(w / ssize, 10)}, {
				duration: animeTime,
				step:function(now)
				{
					var calc = parseInt((w - now) / (ssize - 1), 10);
					not.css({width: calc});
					slide.css({width: w - (calc * 2)});
				},
				complete: function()
				{
					section.css({
						visibility: 'hidden',
						display: 'block'
					});

					$('.signwrap').fadeIn(animeTime / 2);

					expanded = false;
					currentSection = null;

					onResize();
				}
			});
		});
	});

	// community
	$('.community').on('mouseover mouseout', 'i', function(e){
		$(this)[e.type === 'mouseover' ? 'addClass' : 'removeClass']('hover');
	});

	// submit contact form
	formState(true);

	// submit contact form
	$('.po').focus(function(){
		$(this).popover('destroy');
		$(this).parent().removeClass('error');
	});

	$('.btn_reset').click(function(){
		$('.po').parent().removeClass('error');
		$('.po').popover('destroy');
	});

	$('#contact_form').submit(function(){
		$.ajax({
			url: 'mailer.php',
			type: 'POST',
			dataType: 'json',
			data: $(this).serialize(),
			beforeSend: function()
			{
				var errors = false,
				validate = function()
				{
					var name = $('#name'),
					email = $('#email'),
					subject = $('#subject'),
					message = $('#message');

					errors = false;

					if(name.val().length === 0)
					{
						name.parent().addClass('error');
						name.popover({ content: 'Name field is required!' });
						name.popover('show');
						errors = true;
					} else
					name.parent().removeClass('error');

					if(email.val().length === 0)
					{
						email.parent().addClass('error');
						email.popover({ content: 'Email field is required!' }).popover('show');
						errors = true;
					} else if(!checkEmail(email.val())){
						email.parent().addClass('error');
						email.popover({ content: 'Invalid email address!' }).popover('show');
						errors = true;
					}else
					email.parent().removeClass('error');

					if(subject.val().length === 0)
					{
						subject.parent().addClass('error');
						subject.popover({ content: 'Subject field is required!' }).popover('show');
						errors = true;
					} else
					subject.parent().removeClass('error');

					if(message.val().length === 0)
					{
						message.parent().addClass('error');
						message.popover({ content: 'Message field is required!' }).popover('show');
						errors = true;
					} else
					message.parent().removeClass('error');

				};

				$('.po').popover('destroy');
				$('.po').parent().removeClass('error');

				formState(false);
				validate();
				if(errors)
				{
					formState(true);
					return false;
				}

				var progress = $('.progress'),
				bar = $('.progress .progress-bar');

				bar.css('width', '1%');
				progress.show();
				bar.animate({
					width: '53%'
				}, animeTime / 2);

			}
		}).done(function(data){
			$('.progress .progress-bar').animate({
				width: '100%'
			}, animeTime, function(){

				$('.progress').hide();

				if(data.success === true)
				{
					$('#contact_form').fadeOut(500, function(){
						var msgbox = $('.msgbox');
						msgbox.html('<i class="icon-check-sign"></i> Your message was sent. Thank you!');
						msgbox.fadeIn(500);

						$('#contact_form').remove();
					});
				}else
				{
					formState(true);

					if(data.type === 'system')
						$('.btn_send').popover({content: data.message}).popover('show');
					else if(data.type === 'validation')
					{
						if(!data.data)
							return;

						for(var i = 0, size = data.data.length; i < size; i++)
							$('#' + data.data[i].id).popover({content: data.data[i].message}).popover('show');
					}
				}

			});
		}).fail(function(){
			$('.progress').hide();
		});
	});

// submit subscribe form
var em = $('#semail');
em.focus(function(){
	$(this).popover('destroy');
	$(this).parent().removeClass('error');
});
$('.btn_subscribe').click(function(){

	$.ajax({
		url: 'subscribe.php',
		type: 'POST',
		dataType: 'json',
		data: {
			email: em.val()
		},
		beforeSend: function(){
			if(em.val().length === 0 || !checkEmail( em.val() ))
			{
				em.parent().addClass('error');
				em.popover({ content: 'Invalid email address!' }).popover('show');
				return false;
			}
		}
	}).done(function(data){
		if(data.success)
		{
			$('.shide').fadeOut(animeTime, function(){
				$('.smsgbox').fadeIn(animeTime);
			});
		}else{
			em.parent().addClass('error');
			em.popover({ content: data.message }).popover('show');
		}
	});

});

wrap.show();
toFit('.signwrap');
parallaxContainer.show();

wnd.resize(onResize);
onResize();

if(openAtInit)
{
	setTimeout(function(){
		if(!everClick)
			$('.'.concat(initPanelToOpen, ' .signwrap')).trigger('click');
	}, initTimeout);
}

})(jQuery);