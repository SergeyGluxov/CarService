/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


/**Auth компоненты**/
Vue.component('login-component', require('./components/auth/LoginComponent.vue'));
Vue.component('register-component', require('./components/auth/RegisterComponent.vue'));
/**Общие компоненты**/
Vue.component('yandex-map-component', require('./components/other/YandexMapComponent.vue'));
Vue.component('maps-component', require('./components/other/GoogleMapsComponent.vue'));
Vue.component('paginate-component', require('./components/other/PaginateComponent.vue'));
Vue.component('datapicker-component', require('./components/other/DataPickerComponent.vue'));
Vue.component('example-component', require('./components/other/ExampleComponent.vue'));

/**Компоненты для home**/
Vue.component('passport-car-component', require('./components/home/PassportCarComponent.vue'));
Vue.component('character-car-component', require('./components/home/CharacteristicCarComponent'));

/**Компоненты для home/service/checkup**/
Vue.component('form-checkup-component', require('./components/service/FormCheckupComponent.vue'));


/**Компоненты для /admin**/
Vue.component('admin-table-component', require('./components/admin/AdminTableComponent.vue'));
Vue.component('users-table-component', require('./components/admin/UsersTableComponent.vue'));

/**Компоненты работы с /admin/oauth_settings**/
Vue.component('passport-clients', require('./components/passport/Clients.vue'));
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));


const app = new Vue({
    el: '#app'
});
