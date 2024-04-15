console.log('main.js loaded')
jQuery(document).ready(function ($) {
    "use strict";



    // Contact Form Validate JS
    // ------------------------------------------------------


    //general (popup one
    if ($('.pr__contact_general').length) {
        $('.pr__contact_general').validate({ // Initialize the plugin
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                subject: {
                    required: true
                },
                message: {
                    required: true
                }
            },

            submitHandler: function (form) {

                grecaptcha.ready(function () {
                    grecaptcha.execute('6Lf9pe4fAAAAAFzPfm85uGtjUYNO8dsg5P65AYtk', { action: 'submit' }).then(function (token) {
                        var data = $(form).serializeArray();
                        data.push({ name: "token", value: token });
                        // Sending values with ajax request
                        $.post($(form).attr('action'), data, function (response) {
                            Swal.fire({
                                title: 'Bien reçu!',
                                text: 'Votre message a bien été envoyé. Nous vous contacterons rapidement !',
                                icon: 'success',
                                confirmButtonText: 'Compris. A bientôt !'
                            })

                            $('.result').append('');
                            $(form).find('input[type="text"]').val('');
                            $(form).find('input[type="email"]').val('');
                            $(form).find('select').val('');
                            $(form).find('textarea').val('');

                        });


                    });
                });



                return false;
            }
        });
    }

    // landing bottom
    if ($('.pr__contact').length) {
        $('.pr__contact').validate({ // Initialize the plugin
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                subject: {
                    required: true
                },
                message: {
                    required: true
                }
            },

            submitHandler: function (form) {

                grecaptcha.ready(function () {
                    grecaptcha.execute('6Lf9pe4fAAAAAFzPfm85uGtjUYNO8dsg5P65AYtk', { action: 'submit' }).then(function (token) {
                        var data = $(form).serializeArray();
                        data.push({ name: "token", value: token });
                        $.post($(form).attr('action'), data, function (response) {
                            Swal.fire({
                                title: 'Bien reçu!',
                                text: 'Votre message a bien été envoyé. Nous vous contacterons rapidement !',
                                icon: 'success',
                                confirmButtonText: 'Compris. A bientôt !'
                            })

                            $('.result').append('');
                            $(form).find('input[type="text"]').val('');
                            $(form).find('input[type="email"]').val('');
                            $(form).find('select').val('');
                            $(form).find('textarea').val('');

                        });
                    });
                });


                return false;
            }
        });
    }

    // landing one
    if ($('.pr__contact-land').length) {
        $('.pr__contact-land').validate({ // Initialize the plugin
            rules: {
                firstname: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                type: {
                    required: true
                },
                message: {
                    required: true
                }
            },

            submitHandler: function (form) {
                grecaptcha.ready(function () {
                    grecaptcha.execute('6Lf9pe4fAAAAAFzPfm85uGtjUYNO8dsg5P65AYtk', { action: 'submit' }).then(function (token) {
                        var data = $(form).serializeArray();
                        data.push({ name: "token", value: token });
                        $.post($(form).attr('action'), data, function (response) {
                            // Swal.fire({
                            //     title: 'Bien reçu!',
                            //     text: 'Votre message a bien été envoyé. Nous vous contacterons rapidement !',
                            //     icon: 'success',
                            //     confirmButtonText: 'Compris. A bientôt !'
                            // });
                            window.location.href = '/confirm';

                            $('.result').append('');
                            $(form).find('input[type="text"]').val('');
                            $(form).find('input[type="email"]').val('');
                            $(form).find('select').val('');
                            $(form).find('textarea').val('');


                        });
                    });
                });

                return false;
            }
        });
    }


    jQuery.extend(jQuery.validator.messages, {
        required: "Ce champ est requis.",
        remote: "Please fix this field.",
        email: "Veuillez entrer un email valide.",
        url: "Please enter a valid URL.",
        date: "Please enter a valid date.",
        dateISO: "Please enter a valid date (ISO).",
        number: "Please enter a valid number.",
        digits: "Please enter only digits.",
        creditcard: "Please enter a valid credit card number.",
        equalTo: "Please enter the same value again.",
        accept: "Please enter a value with a valid extension.",
        maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
        minlength: jQuery.validator.format("Please enter at least {0} characters."),
        rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
        range: jQuery.validator.format("Please enter a value between {0} and {1}."),
        max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
        min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
    });

    // Close navbar menu when menu-item clicked
    $('.mobile-menu').on('click', function (e) {
        const currentItem = jQuery(this);
        const mobileMenu = jQuery(this).parents('.navbar-mobile').find('.mobile-navbar-menus')
        mobileMenu.toggleClass('mobile-open-active');
    })

    /* add animation for the compare table on small devices */
    // let elementAgence = document.querySelector(".without.black-pink");
    // let elementStudio = document.querySelector(".with.black-pink");

    // setInterval(() => {
    //     if (elementAgence.classList.contains("inactive")) {
    //         elementAgence.classList.remove("inactive");
    //         elementStudio.classList.add("inactive");
    //     } else {
    //         elementAgence.classList.add("inactive");
    //         elementStudio.classList.remove("inactive");
    //     }
    // }, 3000);

    /* Toogle show/hidden expertise card */

    // $('.expertise>.box>.cards>.card').on('click', function (e) {
    //     if ($(this).find('.card__icon-plus').hasClass('open')) {
    //         $(this).find('.card__desc').removeClass('open');
    //         $(this).find('.card__icon-plus').removeClass('open');
    //         $(this).find('.card__icon-close').addClass('open');
    //         return;
    //     }
    //     $('.expertise>.box>.cards>.card').find('.card__desc').removeClass('open');
    //     $('.expertise>.box>.cards>.card').find('.card__icon-plus').removeClass('open');
    //     $('.expertise>.box>.cards>.card').find('.card__icon-close').addClass('open');

    //     $(this).find('.card__desc').addClass('open');
    //     $(this).find('.card__icon-plus').addClass('open');
    //     $(this).find('.card__icon-close').removeClass('open');
    // })


    // FORM CONTACT

    const isFormContactPage = window.location.pathname.split('/')[2] === 'form-contact';

    if (isFormContactPage) {
        const toggleDisplay = (divHide, divShow) => {
            $(divHide).removeAttr("style").hide();
            $(divShow).removeAttr("style").show();
        };

        const toggleStyle = (divClassRemove, classRemove, divClassAdd, classAdd) => {
            if (divClassRemove && classRemove) {
                $(divClassRemove).removeClass(classRemove);
            }
            if (divClassAdd && classAdd) {
                $(divClassAdd).addClass(classAdd);
            }
        };

        const backToQuestion = (prevQuestion) => {
            let divQuestionIcon = `#div-question-${prevQuestion + 1}-icon`;
            let divPrevQuestionIcon = `#div-question-${prevQuestion}-icon`;
            let divPrevQuestionIconChecker = `#div-question-${prevQuestion}-icon-checker`;
            let divQuestion = `#div-question-${prevQuestion + 1}-checkbox`;
            let divPrevQuestion = `#div-question-${prevQuestion}-checkbox`;
            let divQuestionText = `#div-question-${prevQuestion}-text`;
            let divQuestionDot = `#div-question-${prevQuestion}-dot`

            // Remove style active
            toggleStyle(divQuestionIcon, 'question-active', divPrevQuestionIcon, 'question-active');
            // Remove style of text
            toggleStyle(divQuestionText, 'question-checked', '', '');
            // Remove style of dot
            toggleStyle(divQuestionDot, 'question-dot-active', '', '');
            // Display number question
            toggleDisplay(divPrevQuestionIconChecker, divPrevQuestionIcon);

            toggleDisplay(divQuestion, divPrevQuestion);
        };

        const selectCheckbox = (currentQuestion, selectedCheckbox) => {

            let divReponses = `.question-${currentQuestion} >.response__checkboxs >.checkbox`;
            let divQuestionText = `#div-question-${currentQuestion}-text`;
            let divQuestionDot = `#div-question-${currentQuestion}-dot`
            // Reset style for all responses
            toggleStyle(divReponses, 'pink-btn', divReponses, 'white-btn');
            // Add style to selected response
            toggleStyle(selectedCheckbox, 'white-btn', selectedCheckbox, 'pink-btn');
            // Add style to text of question selected
            toggleStyle('', '', divQuestionText, 'question-checked');
            // Add style to dot
            toggleStyle('', '', divQuestionDot, 'question-dot-active')
            // Display icon checker
            toggleDisplay(`#div-question-${currentQuestion}-icon`, `#div-question-${currentQuestion}-icon-checker`);

            // Display next question
            toggleDisplay(`#div-question-${currentQuestion}-checkbox`, `#div-question-${currentQuestion + 1}-checkbox`);

            // Change class to question active
            toggleStyle(`#div-question-${currentQuestion}-icon`, 'question-active', `#div-question-${currentQuestion + 1}-icon`, 'question-active');;

            // Set value of checkbox to input hidden
            $(`#question-${currentQuestion}-checkbox`).val($(selectedCheckbox).html());
        };

        const unselectCheckbox = (currentQuestion, selectedCheckbox) => {
            toggleStyle(selectedCheckbox, 'pink-btn', selectedCheckbox, 'white-btn');
            $(`#question-${currentQuestion}-checkbox`).val('');
        }

        // QUESTION 1
        $('.question-1 >.response__checkboxs >.checkbox').on('click', function (e) {
            if ($(this).hasClass('pink-btn')) {
                unselectCheckbox(1, this);
                return;
            }
            let divReponses = '.question-1 >.response__checkboxs >.checkbox';
            // Reset style for all responses
            toggleStyle(divReponses, 'pink-btn', divReponses, 'white-btn');
            // Add style to selected response
            toggleStyle(this, 'white-btn', this, 'pink-btn');
            // Display next question
            toggleDisplay('#div-question-1-checkbox', '#div-question-1-input');
            // Set value of selected response to input hidden
            $('#question-1-checkbox').val($(this).html());
        })

        // Return to question 1 checkbox
        $('#back-question-1-checkbox').on('click', function (e) {
            toggleDisplay('#div-question-1-input', '#div-question-1-checkbox')
        });

        // Pass to question 2
        $('#submit-question-1').on('click', function (e) {
            // Set value of text area to input hidden
            $('#question-1-input').val($("#question-1-input-area").val());
            // Add class to text of question checked
            toggleStyle('', '', '#div-question-1-text', 'question-checked');
            // Add style to dot
            toggleStyle('', '', '#div-question-1-dot', 'question-dot-active')
            // Display icon checker
            toggleDisplay('#div-question-1-icon', '#div-question-1-icon-checker');
            // Display question 2
            toggleDisplay('#div-question-1-input', '#div-question-2-checkbox');
            // Change class to question 2 active
            toggleStyle('#div-question-1-icon', 'question-active', '#div-question-2-icon', 'question-active');
        });

        // QUESTION 2
        // Select checkbox question 2
        $('.question-2 >.response__checkboxs >.checkbox').on('click', function (e) {
            if ($(this).hasClass('pink-btn')) {
                unselectCheckbox(2, this);
                return;
            }
            selectCheckbox(2, this);
        })
        // Return to question 1
        $('#back-question-1').on('click', function (e) {
            backToQuestion(1);
        });

        // QUESTION 3
        // Select checkbox question 3
        $('.question-3 >.response__checkboxs >.checkbox').on('click', function (e) {
            if ($(this).hasClass('pink-btn')) {
                unselectCheckbox(3, this);
                return;
            }
            selectCheckbox(3, this);
        });
        // Return to question 2
        $('#back-question-2').on('click', function (e) {
            backToQuestion(2);
        });

        // QUESTION 4
        // Return to question 3
        $('#back-question-3').on('click', function (e) {
            backToQuestion(3);
        });
        // Display icon checker
        $('#submit-questions').on('click', function (e) {
            let name = $('#name').val().length;
            let email = $('#email').val().length;
            let telNumber = $('#tel-number').val().length;
            let enterprise = $('#enterprise').val().length;
            if (name && email && telNumber && enterprise) {
                toggleDisplay('#div-question-4-icon', '#div-question-4-icon-checker');
            }
        })
    }


    // New nav mobile
    let menu = document.getElementById('new-navbar-mobile');
    let btnBurgermenu = document.getElementById('new-mobile-open');
    let notNavbar = document.getElementById('not-navbar-menu');

    // When the user clicks anywhere outside of the modal, close it
    window.addEventListener('click', function (event) {
        if(menu && btnBurgermenu) {
            if (event.target !== menu && event.target !== btnBurgermenu) {
                if (menu.classList.contains('new-mobile-open-active')) {
                    menu.classList.remove('new-mobile-open-active');
                }
    
                if (notNavbar.classList.contains('active')) {
                    notNavbar.classList.remove('active');
                }
            }
        } 
    })

    // ------------------- Swiper card project --------------------  //


    // Detect the active slide and update the corresponding dot
    const detectActive = () => {
        let active = $("#dp-slider .dp_item:first-child").data("class");
        $("#dp-dots li").removeClass("active");
        $("#dp-dots li[data-class=" + active + "]").addClass("active");
    }

    // Update the position of each slide
    const updatePositions = () => {
        $('.dp_item').each(function (index, dp_item) {
            $(dp_item).attr('data-position', index + 1);
        });
        detectActive();
    }

    // Move the first slide to the last
    const moveLast = () => {
        $("#dp-slider .dp_item:first-child").hide().appendTo("#dp-slider").fadeIn();
        updatePositions();
    }

    // Move the last slide to the first
    const moveFirst = () => {
        $("#dp-slider .dp_item:last-child").hide().prependTo("#dp-slider").fadeIn();
        updatePositions();
    }

    // Event handler for the next button
    $("#dp-next").on("click", function () {
        moveLast();
    });

    // Event handler for the prev button
    $("#dp-prev").on("click", function () {
        moveFirst();
    });

    // Event handler for the dots
    $("#dp-dots li").on("click", function () {
        $("#dp-dots li").removeClass("active");
        $(this).addClass("active");

        let slide = parseInt($(this).attr('data-class'));
        let nbItem = $("#dp-slider .dp_item").length;

        for (let i = 1; i < nbItem; i++) {
            let nextPos = slide + i;
            if (nextPos > nbItem)
                nextPos = nextPos - nbItem;
            $("#dp-slider .dp_item[data-class=" + nextPos + "]").appendTo("#dp-slider");
        }

        $("#dp-slider .dp_item[data-class=" + slide + "]").hide().prependTo("#dp-slider").fadeIn();
        updatePositions();
    });

    // Autoplay
    let autoplay = setInterval(moveLast, 3000);

    // Stop autoplay
    $('.dp_item').each(function () {
        $(this).on("click", function () {
            if (autoplay) {
                clearInterval(autoplay);
                autoplay = null;
                return;
            }
            autoplay = setInterval(moveLast, 3000);
        });
    })


    // ------------------- Kodwallet/Cms Page -------------------  //
    // Get the third segment of the path
    const isKodwalletPath = window.location.pathname.split('/')[2] === 'kodwallet';

    $(window).on("scroll", function (ev) {
        if (isKodwalletPath) {

            const w = $(window).scrollTop();
            const processLine = $('#line-step');
            const processLineLogo = $('#kod-logo');

            const changeStyleLineKod = (elementName) => {
                processLine.removeClass().addClass('line-' + elementName);
                processLineLogo.removeClass().addClass('kod-logo-' + elementName);
            }

            const changeStyle = (elementName) => {
                $('.kodwallet-step > .container > .container__left > .imgs > svg').removeClass("step-active");
                $('#' + elementName).addClass("step-active");
            }

            const changeStyleMobile = (elementName) => {
                $('.kodwallet-step > .container > .container__right > .title-mobile > .img > svg').removeClass("step-active");
                $('#' + elementName).addClass("step-active");
            }

            if (w <= ($('#step-1').offset().top - 300) || w <= ($('#mobile-step-1').offset().top - 100)) {
                changeStyleLineKod("step-1");
                changeStyle("step-1");
                changeStyleMobile("mobile-step-1");
            } else if (w <= ($('#step-2').offset().top - 300) || w <= ($('#mobile-step-2').offset().top - 100)) {
                changeStyleLineKod("step-2");
                changeStyle("step-2");
                changeStyleMobile("mobile-step-2");
            } else {
                changeStyleLineKod("step-3");
                changeStyle("step-3");
                changeStyleMobile("mobile-step-3");
            }
        }
    });
});
