// import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss';

import 'bootstrap'
import 'slick-carousel'
$(document).ready(function(){
    $('.testimonial-carousel').slick({
        infinite: true,
        slidesToShow: 1, // Number of slides to show at a time
        slidesToScroll: 1,
        dots: true,
        arrows: true,
        prevArrow: '<button type="button" class="testimonial-prev d-none d-md-block btn btn-outline-dark rounded-circle p-1"><img src="https://127.0.0.1:8000/uploads/images/icons/arrow_right.svg" alt="arrow"/></button>',
        nextArrow: '<button type="button" class="testimonial-next d-none d-md-block btn btn-outline-dark rounded-circle p-1"><img src="https://127.0.0.1:8000/uploads/images/icons/arrow_left.svg" alt="arrow"/></button>',
    });
    $('.team-carousel').slick({
        infinite: true,
        slidesToShow: 4, // Number of slides to show at a time
        slidesToScroll: 1,
        dots: true,
        arrows: true,
        prevArrow: '<button type="button" class="team-prev d-none d-md-block btn btn-outline-dark rounded-circle p-1"><img src="https://127.0.0.1:8000/uploads/images/icons/arrow_right.svg" alt="arrow"/></button>',
        nextArrow: '<button type="button" class="team-next d-none d-md-block btn btn-outline-dark rounded-circle p-1"><img src="https://127.0.0.1:8000/uploads/images/icons/arrow_left.svg" alt="arrow"/></button>',
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
    $('.service-team-carousel').slick({
        centerMode: true,
        centerPadding: '60px',
        infinite: true,
        slidesToShow: 3, // Number of slides to show at a time
        slidesToScroll: 1,
        dots: true,
        arrows: true,
        prevArrow: '<button type="button" class="testimonial-prev d-none d-md-block btn btn-outline-dark rounded-circle p-1"><img src="https://127.0.0.1:8000/uploads/images/icons/arrow_right.svg" alt="arrow"/></button>',
        nextArrow: '<button type="button" class="testimonial-next d-none d-md-block btn btn-outline-dark rounded-circle p-1"><img src="https://127.0.0.1:8000/uploads/images/icons/arrow_left.svg" alt="arrow"/></button>',
        responsive: [
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
});
