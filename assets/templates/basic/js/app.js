'use strict';
$(document).ready(function(){
	$('.filter_in_btn').on('click', function(){
		$('.category-sidebar').addClass('active');
	})
	$('.close-sidebar').on('click', function(){
		$('.category-sidebar').removeClass('active');
	})
})
// menu options custom affix

var fixed_top = $(".header");
$(window).on("scroll", function(){
		if( $(window).scrollTop() > 50){  
				fixed_top.addClass("animated fadeInDown menu-fixed");
		}
		else{
				fixed_top.removeClass("animated fadeInDown menu-fixed");
		}
}); 


$('.navbar-toggler').on('click', function (){
	$('.header').toggleClass('active');
});

// mobile menu js
$(".navbar-collapse>ul>li>a, .navbar-collapse ul.sub-menu>li>a").on("click", function() {
  const element = $(this).parent("li");
  if (element.hasClass("open")) {
    element.removeClass("open");
    element.find("li").removeClass("open");
  }
  else {
    element.addClass("open");
    element.siblings("li").removeClass("open");
    element.siblings("li").find("li").removeClass("open");
  }
});

let img=$('.bg_img');
img.css('background-image', function () {
	let bg = ('url(' + $(this).data('background') + ')');
	return bg;
});

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

	$('#language').niceSelect();
	$('#languageSelection').niceSelect();
	
	  // lightcase plugin init
		$('a[data-rel^=lightcase]').lightcase();

/* Get the documentElement (<html>) to display the page in fullscreen */
let elem = document.documentElement;

// mainSlider
function mainSlider() {
	var BasicSlider = $('.hero__slider');
	BasicSlider.on('init', function (e, slick) {
		var $firstAnimatingElements = $('.single__slide:first-child').find('[data-animation]');
		doAnimations($firstAnimatingElements);
	});
	BasicSlider.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
		var $animatingElements = $('.single__slide[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
		doAnimations($animatingElements);
	});
	BasicSlider.slick({
		autoplay: false,
		autoplaySpeed: 10000,
		dots: false,
		fade: true,
		arrows: true,
		nextArrow: '<div class="next"><i class="las la-long-arrow-alt-right"></i></div>',
    	prevArrow: '<div class="prev"><i class="las la-long-arrow-alt-left"></i></div>',
		responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						infinite: true,
					}
				},
				{
					breakpoint: 991,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						arrows: false
					}
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						arrows: false
					}
				}
			]
	});
	function doAnimations(elements) {
		var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
		elements.each(function () {
			var $this = $(this);
			var $animationDelay = $this.data('delay');
			var $animationType = 'animated ' + $this.data('animation');
			$this.css({
				'animation-delay': $animationDelay,
				'-webkit-animation-delay': $animationDelay
			});
			$this.addClass($animationType).one(animationEndEvents, function () {
				$this.removeClass($animationType);
			});
		});
	}
}
mainSlider();


$('.story-thumb-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  asNavFor: '.story-slider'
});
$('.story-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  asNavFor: '.story-thumb-slider',
	dots: true,
	arrows: false
});


// Animate the scroll to top
$(".scroll-to-top").on("click", function(event) {
	event.preventDefault();
	$("html, body").animate({scrollTop: 0}, 300);
});


//preloader js code
$(".preloader").delay(300).animate({
	"opacity" : "0"
	}, 300, function() {
	$(".preloader").css("display","none");
});

$(".progressbar").each(function(){
	$(this).find(".bar").animate({
		"width": $(this).attr("data-perc")
	},3000);
	$(this).find(".label").animate({
		"left": $(this).attr("data-perc")
	},3000);
});

new WOW().init();
