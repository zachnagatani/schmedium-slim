var app = {
    services: {}
};

$(function() {
    'use strict';

    /**
     * Initializes app with event listeners and proper view state
     */
    app.init =
        (function() {
            // Grab elements that need event listners
            var signupBtn = document.getElementById('signup-btn'),
                signinBtn = document.getElementById('signin-btn'),
                signoutBtn = document.getElementById('nav-link--signout'),
                publishBtn = document.getElementById('btn-publish'),
                postContentDiv = $('.post__content')[0];


            // Add various event listeners to elements that call their respective
            // service functions
            signupBtn.addEventListener('click', function(e) {
                e.preventDefault();
                app.services.auth.signup();
            });

            signinBtn.addEventListener('click', function(e) {
                e.preventDefault();
                app.services.auth.signin();
            });

            signoutBtn.addEventListener('click', function() {
                app.services.auth.signout();
            });

            if (publishBtn) {
                publishBtn.addEventListener('click', function() {
                    app.services.posts.createPost();
                });
            }

            // Interprets Markdown
            if (postContentDiv) {
                postContentDiv.innerHTML = marked(postContentDiv.innerHTML);
            }

            // Set the initial state of the navigation
            app.services.DOM.toggleNav(window.localStorage['jwt']);
        })();
});