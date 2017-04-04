/**
 * Holds logic dealing with posts (creation. TODO: editing and deleting)
 */
$(function(){
    'use strict';

    app.services.posts = {
        createPost: createPost
    };

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
});