require('bootstrap');

import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';

window.Vue = require('vue');

Vue.use(VueInternationalization);

const lang = document.documentElement.lang.substr(0, 2);

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});

Vue.component('gadgets-output-component', require('./components/GadgetsOutputComponent.vue').default);
Vue.component('add-form-component', require('./components/AddFormComponent.vue').default);
Vue.config.silent = true

const app = new Vue({
    el: '#app',
    i18n
});
