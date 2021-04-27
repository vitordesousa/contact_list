//import Vue from 'vue/dist/vue'
import Vue from 'vue/dist/vue.common.js'
//import Vue from 'vue/dist/vue.esm.js'

window.Vue = Vue
require('./bootstrap');

// vue
//window.Vue = require('vue');

// bootstrap vue
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);

// used with bootstrap-vue
import PortalVue from 'portal-vue'
Vue.use(PortalVue)

// to use mask in fields
import mask from 'vue-the-mask'
Vue.use(mask)
// validate fields form with vue
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

Vue.component('contacts-index', require('./components/contacts/Index.vue').default);
Vue.component('contacts-form', require('./components/contacts/Form.vue').default);
Vue.component('contacts-show', require('./components/contacts/Form.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
	el: '#app',
});