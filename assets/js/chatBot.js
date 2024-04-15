
jQuery(document).ready(function ($) {
    const iconToggle = $('#customize-chatbot-icon');
    const overlay = $('#customize-chatbot-overlay');
    const iconClose = $('#customize-chatbot-icon-close');

    if (iconToggle && overlay) {
        iconToggle.on("click", function () {
            (overlay.hasClass('--is-opened'))
                ? overlay.removeClass('--is-opened')
                : overlay.addClass('--is-opened')
        });
    }

    if (iconClose) {
        iconClose.on("click", function () {
            overlay.hasClass('--is-opened') && overlay.removeClass('--is-opened');
        });
    }
});
