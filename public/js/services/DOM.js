/**
 * Holds DOM manipulation logic
 */
$(function() {
    app.services.DOM = {
        toggleNav: toggleNav
    };

    function toggleNav(jwt) {
        var navbarSignedOut = $('#navbar--signedout'),
            navbarSignedIn = $('#navbar--signedin'),
            exp;
        if (jwt) {
            exp = JSON.parse(window.atob(jwt.split('.')[1])).exp;
        } else {
            navbarSignedIn.addClass('hidden');
            navbarSignedOut.removeClass('hidden');
            return;
        }

        // Multiply by 1000 because time is coming from php
        if (new Date() < exp * 1000) {
            navbarSignedOut.addClass('hidden');
            navbarSignedIn.removeClass('hidden');
        } else {
            navbarSignedIn.addClass('hidden');
            navbarSignedOut.removeClass('hidden');
        }
    }
});