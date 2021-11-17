require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

//Plugins
import RequestApi from './plugins/RequestApi';

//Vuex
import { createStore } from 'vuex'

const store = createStore({
    state() {
        return {
            showAlert: '',
            typeAlert: '',
            msgAlert: '',
            loading: false,
            loadingTable: false,
            routeIndex: '',
            routeShow: '',
            routeDestroy: '',
            routeUpdate: '',
            routeStore: ''
        }
    }
})

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
var VueApp;
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        VueApp = createApp({ render: () => h(app, props) });
        VueApp.use(plugin)
        VueApp.use(RequestApi)
        VueApp.use(store)
        VueApp.mixin({ methods: { route } })
        VueApp.mount(el);
        VueApp.config.compilerOptions.isCustomElement = tag => tag.startsWith('ion-')
        return VueApp;
    },
});

InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 30,

    // The color of the progress bar.
    color: '#2E2EFE',

    // Whether to include the default NProgress styles.
    includeCSS: true,

    // Whether the NProgress spinner will be shown.
    showSpinner: true,
})



