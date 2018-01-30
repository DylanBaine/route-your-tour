
window._ = require('lodash');

window.axios = require('axios');

axios.defaults.baseURL = window.location.protocol +  '//' + window.location.host;

window.Slug = require('slug');
Slug.defaults.mode = 'rfc3986';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

