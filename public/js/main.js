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
            console.log(token);
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
});