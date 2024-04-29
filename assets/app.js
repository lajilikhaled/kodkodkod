// any CSS you import will output into a single css file (app.css in this case)
import './styles/style.scss';
import './js/jquery.min';

import './styles/app.scss';
import 'bootstrap'
import 'slick-carousel';
var Toastify = require('toastify-js');

global.Toastify = global.Toastify = Toastify;
import 'toastify-js/src/toastify.css';
// Import Slick styles
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';

jQuery(document).ready(function(){
	const slider= jQuery('.slide-container').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		autoplay: false,
		autoplaySpeed: 2000,
		prevArrow: '<button type="button" class="slick-prev">Previous</button>',
		nextArrow: '<button type="button" class="slick-next">Next</button>',
		responsive: [
			{
				breakpoint: 1350,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 1025,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 652,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});
	jQuery('.arrow-right').click(function() {
		slider.slick('slickNext'); // Move to the next slide
	});

	// Add click event listener to the left arrow icon
	jQuery('.arrow-left').click(function() {
		slider.slick('slickPrev'); // Move to the previous slide
	});

    $('.testimonial-carousel').slick({
        infinite: true,
        slidesToShow: 1, // Number of slides to show at a time
        slidesToScroll: 1,
        dots: true,
        arrows: true,
        prevArrow: '<button type="button" class="testimonial-prev d-none d-md-block btn btn-outline-dark rounded-circle p-1 prev_arrow_btn"><img src="https://kodkodkod.studio/uploads/images/icons/arrow_right.svg" alt="arrow"/></button>',
        nextArrow: '<button type="button" class="testimonial-next d-none d-md-block btn btn-outline-dark rounded-circle p-1 next_arrow_btn"><img src="https://kodkodkod.studio/uploads/images/icons/arrow_left.svg" alt="arrow"/></button>',
    });
});

$('.burger-mobile').on('click', function (e) {
	const mobileMenu = jQuery('.mobile-navbar-menus')
	mobileMenu.toggleClass('mobile-open-active');
})

jQuery('.mobile-close').on('click', function (e){

	const mobileMenu = jQuery('.mobile-navbar-menus')
	mobileMenu.toggleClass('mobile-open-active');
})

jQuery('.mobile-menu a').on('click', function (e){
	const mobileMenu = jQuery('.mobile-navbar-menus')
	mobileMenu.toggleClass('mobile-open-active');
})

$(document).ready(function() {
    $('#contactForm').submit(function(event) {
        event.preventDefault();
        var form = $(this);

        var isValid = true;
        form.find('input, textarea').each(function() {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (isValid) {
            var url = form.data('url');
            var formData = form.serialize();

            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response && response.hasOwnProperty('message')) {
                        var message = response.message;
                        Toastify({
                            text: message,
                            backgroundColor: 'green',
                            duration: 3000
                        }).showToast();
                        form.trigger('reset');
                    } else {
                        console.error(response);
                    }
                    $('#submitButton').prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    var message = xhr.responseJSON.message;
                    Toastify({
                        text: message,
                        backgroundColor: 'red',
                        duration: 3000
                    }).showToast();
                    $('#submitButton').prop('disabled', false);
                }
            });
        }
    });

    $('#contactForm input, #contactForm textarea').on('input', function() {
        var inputId = $(this).attr('id');
        var inputValue = $(this).val().trim();
        var isValid = true;

        switch (inputId) {
            case 'firstName':
                isValid = inputValue.length > 0;
                break;
            case 'email':
                isValid = isValidEmail(inputValue);
                break;
            case 'message':
                isValid = inputValue.length > 0;
                break;
            default:
                break;
        }

        if (isValid) {
            $(this).removeClass('is-invalid');
            $(this).siblings('.error-' + inputId).hide();
        } else {
            $(this).addClass('is-invalid');
            $(this).siblings('.error-' + inputId).show();
        }
    });

    function isValidEmail(email) {
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }

    $('.works-carousel').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true,
		arrows: true,
		prevArrow: '<button type="button" class="works-prev d-none d-md-block btn btn-outline-dark rounded-circle p-1"><img src="https://kodkodkod.studio/uploads/images/icons/arrow_right.svg" alt="arrow"/></button>',
		nextArrow: '<button type="button" class="works-next d-none d-md-block btn btn-outline-dark rounded-circle p-1"><img src="https://kodkodkod.studio/uploads/images/icons/arrow_left.svg" alt="arrow"/></button>',
	});
    $('.benefits-carousel').slick({
		infinite: true,
		slidesToShow: 4,
		slidesToScroll: 1,
		dots: true,
		arrows: false,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 576,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});
    $('.logo-carousel').slick({
		infinite: true,
		slidesToShow: 4,
		slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        pauseOnHover: true,
        arrows: false,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 4
				}
			},
			{
				breakpoint: 576,
				settings: {
					slidesToShow: 4
				}
			}
		]
	});
});
