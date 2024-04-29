jQuery(document).ready(function ($) {
    "use strict";

    // Preloader
    // ------------------------------------------------------
    $(window).on('load', function () {
        setTimeout(function () {
            $("#loader").fadeOut(200);
        }, 200);
    });

    // Pretty Print
    // ------------------------------------------------------
    window.prettyPrint && prettyPrint();

});