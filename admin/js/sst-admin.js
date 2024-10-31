(function ($) {
    'use strict';
    /**
     * This enables you to define handlers, for when the DOM is ready:
     * $(function() { });
     * When the window is loaded:
     * $( window ).load(function() { }); 
     */

    /**
     * The "Moneyback newsbar" will only be displayed once a month based on the transient flag.
     * 
     * This code block handles the display of a notification bar (newsbar) on the admin dashboard.
     * The bar is only displayed once a month and is hidden when the user clicks the close button.
     * The flag for whether the bar has been displayed is stored in the browser's localStorage.
     */
    const storageKey = 'convsst_is_newsbar_shown';
    const notificationBar = $('.notification-bar');
    const notificationBarCloseButton = $('.notification-bar .close');
    const storageExpirationDate = new Date(localStorage.getItem(storageKey) || 0);
    if (!localStorage.getItem(storageKey) || storageExpirationDate < new Date()) {
        setTimeout(() => {
            notificationBar.slideDown();
        }, 1000);

        notificationBarCloseButton.on('click', () => {
            notificationBar.slideUp();
            const expirationDate = new Date();
            expirationDate.setDate(expirationDate.getDate() + 30);
            localStorage.setItem(storageKey, expirationDate.toISOString());
        });
    }

})(jQuery);


