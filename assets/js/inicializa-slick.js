// JavaScript Document
$(document).ready(function(){
	$('.fade').slick({
		dots: true,
		infinite: true,
		speed: 500,
		fade: true,
		cssEase: 'linear'
	});
	$('.autoplay').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 2000,
	});
	$('.slick-principal').slick({
		lazyLoad: 'ondemand',
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 5000,
		dots: true,
		infinite: true,
		speed: 1000,
		fade: true,
		cssEase: 'linear',
		arrows: false
	});
});