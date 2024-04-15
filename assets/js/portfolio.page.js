
jQuery(document).ready(function ($) {
    // ------------------- Filter --------------------  //

    // Handle btn show all projects
    const nbCardsDisplayByClick = 4;
    $('.box__project-cards>.card').addClass('card-selected');
    $('.box__project-cards>.card.card-selected').slice(0, nbCardsDisplayByClick).addClass('display');

    $('#all-projects').on('click', function () {
        if (!$(this).hasClass('active')) {
            $(this).addClass('active');
        };

        // Reset all filter
        $('ul.select-techno').each(function (i) {
            let nbProjectsByCat = $(this).children('.all-projects-by-cat').children('.li-icon').children('.projects-count').data('projects-total');
            $(this).children('li').removeClass('li-selected');
            $(this).children('.init').children('.category-name').html($(this).children('.init').data('value'));
            $(this).children('.init').children('.li-icon').children('.projects-count').html(nbProjectsByCat);
        });

        // Reset all cards
        $('.box__project-cards>.card.card-selected').each(function (i) {
            $(this).removeClass('card-selected');
            $(this).removeClass('display');
        });

        //  Add class card-selected to all cards
        $('.box__project-cards>.card').each(function (i) {
            $(this).addClass('card-selected');
        });

        // Display n first cards
        $('.box__project-cards>.card.card-selected').slice(0, nbCardsDisplayByClick).addClass("display");

        $('.select-techno').each(function (i) {
            $(this).prop('selectedIndex', 0);
        });

        // Show btn Load more
        $('#loadMore').css('display', 'flex');
    });


    // Load more portfolio page
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        let hiddenCards = $(".box__project-cards>.card.card-selected:hidden");

        if (hiddenCards.length > nbCardsDisplayByClick) {
            hiddenCards.slice(0, nbCardsDisplayByClick).addClass('display');
        } else {
            hiddenCards.slice(0, hiddenCards.length).addClass('display');
            $(this).css('display', 'none');
        }

        if ($("box__project-cards>.card").hasClass('hidden').length == 0) {
            $("#load").fadeOut('slow');
        }
    });

    // Add or Remove style of li list
    $('ul.select-techno').on('click', function () {
        $(this).children('li').toogleClass('li-display-center');
    });

    // Show list li
    $("ul.select-techno").on("click", ".init", function () {
        if ($(this).parents('ul').children('li').hasClass('li-display-center')) {
            $(this).parents('ul').children('li').removeClass('li-display-center');
        } else {
            $('ul.select-techno').children('li').removeClass('li-display-center');
            $(this).parents('ul').children('li').addClass('li-display-center');
        }
    });

    // Select option
    $("ul.select-techno").on("click", "li:not(.init)", function () {

        let optionValue = $(this).data('value');
        let catId = $(this).parents('ul').data('category-id');

        // Reset all cards displayed => hidden
        $('.box__project-cards>.card').each(function (i) {
            $(this).removeClass('card-selected');
        });

        // Reset unselected select
        $('ul.select-techno').each(function (i) {
            if ($(this).data('category-id') !== catId) {
                let nbProjectsByCat = $(this).children('.all-projects-by-cat').children('.li-icon').children('.projects-count').data('projects-total');
                $(this).children('.init').children('.category-name').html($(this).children('.init').data('value'));
                $(this).children('.init').children('.li-icon').children('.projects-count').html(nbProjectsByCat);
            }
        });

        // Change style btn all project
        $(this).parents('ul').parents('.box__filter').children('#all-projects').removeClass('active');

        // Toogle display project by selected value
        if (optionValue !== 'all') { // Show projects by techno
            $(".box__project-cards>.card").each(function (i) {
                let technos = $(this).data('technologies').split(";");

                if (!technos.includes(optionValue) || $(this).data('category') !== catId) {
                    // $(this).hide();
                    $(this).removeClass('card-selected');
                    $(this).removeClass('display');
                } else {
                    // $(this).show();
                    $(this).addClass('card-selected');
                }
            });
        } else { // Show all projects by category
            $(".box__project-cards>.card").each(function (i) {
                if ($(this).data('category') !== catId) {
                    $(this).removeClass('card-selected');
                    $(this).removeClass('display');
                    // $(this).hide();
                } else {
                    // $(this).show();
                    $(this).addClass('card-selected');
                }
            });
        }

        // Display cards selected
        $(".box__project-cards>.card.card-selected").slice(0, nbCardsDisplayByClick).addClass('display');

        // Replace placeholder
        $(this).parents('ul').children('.init').html($(this).html());

        $('ul.select-techno').children('li').removeClass('li-selected');

        $(this).parents('ul').children('.init').addClass('li-selected');
        $('ul.select-techno').children('li').removeClass('li-display-center');

        // Show btn "Show more"
        if ($(".box__project-cards>.card.card-selected").length <= nbCardsDisplayByClick) {
            $('#loadMore').css('display', 'none');
        } else {
            $('#loadMore').css('display', 'flex');
        }
    });
});