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
    $('.works-carousel').slick({
        infinite: true,
        slidesToShow: 1, // Number of slides to show at a time
        slidesToScroll: 1,
        dots: true,
        arrows: true,
        prevArrow: '<button type="button" class="works-prev d-none d-md-block btn btn-outline-dark rounded-circle p-1"><img src="https://127.0.0.1:8000/uploads/images/icons/arrow_right.svg" alt="arrow"/></button>',
        nextArrow: '<button type="button" class="works-next d-none d-md-block btn btn-outline-dark rounded-circle p-1"><img src="https://127.0.0.1:8000/uploads/images/icons/arrow_left.svg" alt="arrow"/></button>',
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
    $('#submitButton').click(function(e) {
        e.preventDefault();

        let form = $('#contactForm');
        let url = form.data('url');
        let formData = form.serialize();
        // Check if required fields are empty
        let firstname = $('#firstname').val().trim();
        let email = $('#email').val().trim();
        let description = $('#description').val().trim();

        if (firstname === '' || email === '' || description === '') {
            // Display error toast for empty fields
            $('.toast-error .toast-body').text('Please fill in all required fields.');
            $('.toast-error').toast('show');
            return; // Exit function if fields are empty
        }
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Handle success, for example, show a success message
                $('.toast-success .toast-body').text('Message sent successfully!');
                $('.toast-success').toast('show');
                form.trigger('reset');  // Reset the form
            },
            error: function(xhr, status, error) {
                // Handle errors, for example, show an error message
                $('.toast-error .toast-body').text('Error sending message. Please try again.');
                $('.toast-error').toast('show');
            }
        });
    });

    // Initialize Bootstrap Toasts
    $('.toast').toast({
        delay: 3000  // Auto hide after 3 seconds
    });
});


