import './styles/style.scss';
import './styles/portfolio.scss';

import './js/jquery.min';

const anime = require('./js/anime.min');
Window.prototype.anime = anime;

import './js/main';

// import Swiper bundle with all modules installed
import Swiper from 'swiper/bundle';

// import styles bundle
import 'swiper/css/bundle';

const swiper = new Swiper('.swiper', {
	// Optional parameters
	loop: true,
	spaceBetween: 50,
	slidesPerView: 4,
	autoplay: {
		delay: 1500,
	},
	breakpoints: {
		0: {
			slidesPerView: 1,
			spaceBetween: 40,
		},
		426: {
			slidesPerView: 1,
			spaceBetween: 40,
		},
		640: {
			slidesPerView: 2,
			spaceBetween: 40
		},
		950: {
			slidesPerView: 3,
			spaceBetween: 40
		},
		1120: {
			slidesPerView: 4,
			spaceBetween: 40
		},
	},
	pauseOnMouseEnter : true,

	// If we need pagination
	pagination: {
		el: '.swiper-pagination',
	},

	// Navigation arrows
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},

	// And if we need scrollbar
	scrollbar: {
		el: '.swiper-scrollbar',
	},
});

const newSwiper = new Swiper('.new-swiper', {
	// Optional parameters
	loop: true,
	spaceBetween: 50,
	slidesPerView: 3,
	autoplay: {
		delay: 1500,
	},
	breakpoints: {
		0: {
			slidesPerView: 1,
			spaceBetween: 100,
		},
		426: {
			slidesPerView: 1,
			spaceBetween: 100,
		},
		640: {
			slidesPerView: 2,
			spaceBetween: 40
		},
		950: {
			slidesPerView: 3,
			spaceBetween: 40
		},
		1120: {
			slidesPerView: 3,
			spaceBetween: 40
		},
	},
	pauseOnMouseEnter : true,

	// If we need pagination
	pagination: {
		el: '.swiper-pagination',
	},

	// Navigation arrows
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},

	// And if we need scrollbar
	scrollbar: {
		el: '.swiper-scrollbar',
	},
});

const testimonialSwiper = new Swiper(".testimonials-swiper", {
	// Optional parameters
	loop: true,
	slidesPerView: 1,
	autoplay: {
		delay: 3000,
	},

	pauseOnMouseEnter : true,

	// If we need pagination
	pagination: {
		el: '.swiper-pagination',
	},

	// Navigation arrows
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},

	// And if we need scrollbar
	scrollbar: {
		el: '.swiper-scrollbar',
	},
  });


jQuery('.question').on('click', function (e){
	const question = jQuery(this).parents('.faq').find('.question');
	const answer = jQuery(this).parents('.faq').find('.answer');

	jQuery(this).parents('.faq').find('.question-title').toggleClass('question-title-open');

	jQuery(this).parents('.faq').find('.answer').toggleClass('open');
	jQuery(this).parents('.faq').find('.answer-close').toggleClass('open');
	jQuery(this).parents('.faq').find('.answer-plus').toggleClass('open');

})

jQuery('.portfolio-menu').on('click', function (e){
	const currentItem = jQuery(this);
	jQuery('.portfolio-menu').removeClass('active');
	currentItem.toggleClass('active');
	const category = $(this).data('category')

	if(typeof category === 'undefined'){
		$('.portfolio-card').show();
	}
	else{
		$('.portfolio-card').hide();

		$('.'+ category).show();
	}
})

jQuery('.mobile-open').on('click', function (e){
	const currentItem = jQuery(this);
	const mobileMenu = jQuery(this).parents('.navbar-mobile').find('.mobile-navbar-menus')
	mobileMenu.toggleClass('mobile-open-active');
})

jQuery('.mobile-close').on('click', function (e){
	const currentItem = jQuery(this);
	const mobileMenu = jQuery(this).parents('.navbar-mobile').find('.mobile-navbar-menus')
	mobileMenu.toggleClass('mobile-open-active');
})

jQuery('.new-mobile-open').on('click', function (e){
	const mobileMenu = jQuery(this).parents('.new-navbar-mobile').find('.new-mobile-navbar-menus');
	const notNavbar = jQuery(this).parents('.new-navbar-mobile').find('.not-navbar-menu');
	mobileMenu.toggleClass('new-mobile-open-active');
	notNavbar.toggleClass('active');
})

jQuery('.new-mobile-close').on('click', function (e){
	const mobileMenu = jQuery(this).parents('.new-navbar-mobile').find('.new-mobile-navbar-menus')
	const notNavbar = jQuery(this).parents('.new-navbar-mobile').find('.not-navbar-menu');
	mobileMenu.toggleClass('new-mobile-open-active');
	notNavbar.toggleClass('active');
})

// var isHided = false;
// $('#callUsBlock').hide();
// window.onscroll = function(ev) {
// 	if (((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight - 2) || (window.scrollY<=300)) {
// 		$('#callUsBlock').hide();
// 		isHided = true;
// 	}
// 	else {
// 		if(isHided){
// 			isHided = false;
// 			$('#callUsBlock').show();
// 		}
// 	}
// };
