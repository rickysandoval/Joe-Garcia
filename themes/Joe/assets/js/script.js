$(document).ready(function(){
	$('.hamburger').on('click', function(){
		$(this).toggleClass('open');
		$('.mobile-nav').toggleClass('shown');
	});

	// Add special functionality for dropdown lists
	$('.mobile-nav .nav > li').has('ul').prepend('<a class="sub-open"></a>').addClass('parent');

	$('.mobile-nav .parent > a:not(.sub-open)').dblclick(function(){
		var url = $(this).attr('href');
		window.location = url;
	});
	$('.mobile-nav .parent > a').on('click', function(){
		$(this).parent().toggleClass('on');
		return false;
	});

	var mixStart = $('#list-filter-start').data('start') || 'all';
	$('.mix-container').mixItUp({
		load: {
			'filter': mixStart 
		}
	});

	$('.footer-testimonials .testimonial').each(function(){
		if ($(this).find('blockquote').text().length > 300){
			$(this).remove();
		}
	});
	$('.footer-testimonials .testimonial-list').slick({
		infinite: true,
		autoplay: true,
		autoplaySpeed: 7000,
		speed: 600,
		cssEase: 'ease',
		arrows: false,
		adaptiveHeight: true
	});
});