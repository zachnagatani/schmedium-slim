$(function() {
    'use strict';

    function signup() {
        var username = document.getElementById('username').value,
            email = document.getElementById('email').value,
            password = document.getElementById('password').value,
            verify = document.getElementById('verify').value;

        if (password !== verify) {
            alert('Passwords do not match.');
            return;
        }

        fetch('/api/auth/signup', {
            method: 'POST',
            body: JSON.stringify({
                username: username,
                email: email,
                password: password
            }),
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(function(res) {
            return res.json();
        }).then(function(token) {
            window.localStorage['jwt'] = token.jwt;
            toggleNav(window.localStorage['jwt']);
        });

        $('#signup-modal').modal('hide');
    }

    function signin() {
        var username = document.getElementById('username--login').value,
            password = document.getElementById('password--login').value;

        fetch('/api/auth/login', {
            method: 'POST',
            body: JSON.stringify({
                username: username,
                password: password
            }),
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(function(res) {
            return res.json();
        }).then(function(token) {
            window.localStorage['jwt'] = token.jwt;
            toggleNav(window.localStorage['jwt']);
        });

        $('#signin-modal').modal('hide');
    }

    var signupBtn = document.getElementById('signup-btn');
    signupBtn.addEventListener('click', function(e) {
        e.preventDefault();
        signup();
    });

    var signinBtn = document.getElementById('signin-btn');
    signinBtn.addEventListener('click', function(e) {
        e.preventDefault();
        signin();
    });


    function createPost() {
        var title = document.getElementById('title').value,
            tagline = document.getElementById('tagline').value,
            imageURL = document.getElementById('image-url').value,
            content = document.getElementById('content').value,
            token = window.localStorage['jwt'];
            console.log(title, tagline, imageURL, content, token);

        if (!token) {
            alert('You must sign up or sign in before publishing your story!');
            return;
        }
        if(!title) {
            alert('Please enter a title');
            return;
        } else if (!content) {
            alert('Please enter a body.');
            return;
        } else if (!tagline) {
            alert('Please enter a tagline.');
            return;
        } else if (!imageURL) {
            alert('Please enter a feature image URL.');
            return;
        }

        fetch('/api/posts/create', {
            method: 'POST',
            body: JSON.stringify({
                title: title,
                tagline: tagline,
                image_url: imageURL,
                content: content
            }),
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token
            }
        }).then(function(res) {
            return res.json();
        }).then(function(json) {
            console.log(json);
            alert('Post added!');
            window.location.href = "/";
        });
    }

    var publishBtn = document.getElementById('btn-publish');
    if (publishBtn) {
        publishBtn.addEventListener('click', function() {
            createPost();
        });
    }

    // Interpret Markdown
    var postContentDiv = $('.post__content')[0];
    if (postContentDiv) {
        postContentDiv.innerHTML = marked(postContentDiv.innerHTML);
    }

    function signOut() {
        window.localStorage.removeItem('jwt');
        toggleNav(window.localStorage['jwt']);
    }

    document.getElementById('nav-link--signout').addEventListener('click', function() {
        signOut();
    });

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

    toggleNav(window.localStorage['jwt']);
});