/**
 * Holds authorization logic. Signup, signin, signout
 */
$(function() {
    'use strict';

    app.services.auth = {
        signup: signup,
        signin: signin,
        signout: signout
    };

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
            app.services.DOM.toggleNav(window.localStorage['jwt']);
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
            app.services.DOM.toggleNav(window.localStorage['jwt']);
        });

        $('#signin-modal').modal('hide');
    }

    function signout() {
        window.localStorage.removeItem('jwt');
        app.services.DOM.toggleNav(window.localStorage['jwt']);
    }
});