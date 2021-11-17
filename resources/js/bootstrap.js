window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

import '@popperjs/core'
import axios from 'axios';

const bootstrap = require('bootstrap')

window.bootstrap = bootstrap

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });


axios.interceptors.request.use(
    config => {
        if (config.url.indexOf('sandbox.cscdf.com.br/api') != -1) {
            config.headers['Accept'] = 'application/json';
            let splitCookie = document.cookie.split(';');
            let token = splitCookie.find(indice => {
                return indice.includes('access_token=');
            });
            if (typeof token !== 'undefined') {

                token = token.split('=')[1]
                token = 'Bearer ' + token
                config.headers.Authorization = token
            }
        }
        return config;
    },
    error => {
        return Promise.reject(error);
    }
)

axios.interceptors.response.use(
    response => {
        console.log('Response: ',response)
        return response;
    },
    error => {
        if (error.response.status === 400 || (error.response.status > 401 && error.response.status < 404)) {
            axios.post(route("logoutApi"));
            axios.post("/logout");
            document.location.reload(true);
        }
        return Promise.reject(error)
    }
)
