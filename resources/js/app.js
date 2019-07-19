
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('passport-component', require('./components/PassportComponent.vue'));
Vue.component('form-checkup-component', require('./components/FormCheckupComponent.vue'));
Vue.component('datapicker-component', require('./components/DataPickerComponent.vue'));
Vue.component('maps-component', require('./components/GoogleMapsComponent.vue'));
Vue.component('yandex-map-component', require('./components/YandexMapComponent.vue'));
Vue.component('admin-table-component', require('./components/AdminTableComponent.vue'));
Vue.component('users-table-component', require('./components/UsersTableComponent.vue'));

/**Компоненты работы с PASSPORT**/
Vue.component('passport-clients', require('./components/passport/Clients.vue'));
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));

const app = new Vue({
    el: '#app'
});
