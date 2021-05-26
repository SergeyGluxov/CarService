/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
export const bus = new Vue()

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
Vue.component('client-component', require('./components/client/ClientComponent.vue'));


/**Компоненты для /admin**/
//-----------------------------------------ПОЛЬЗОВАТЕЛИ-----------------------------------------------------------------

Vue.component('auto-table-component', require('./components/admin/auto/AutoComponent.vue'));
Vue.component('auto-model-table-component', require('./components/admin/auto/AutoModelComponent.vue'));
Vue.component('auto-brand-table-component', require('./components/admin/auto/AutoBrandsComponent.vue'));
Vue.component('users-table-component', require('./components/admin/users/AllUserComponent.vue'));
Vue.component('employee-table-component', require('./components/admin/employee/EmployeeTableComponent.vue'));

//-----------------------------------------Авто запчасти----------------------------------------------------------------

Vue.component('detail-type-table-component', require('./components/admin/detail/TypeDetailComponent.vue'));
Vue.component('detail-nomenclature-table-component', require('./components/admin/detail/NomenclatureComponent.vue'));
Vue.component('detail-assortment-table-component', require('./components/admin/detail/AssortmentComponent.vue'));

//-----------------------------------------Поставщики-------------------------------------------------------------------

Vue.component('suppliers-table-component', require('./components/admin/suppliers/SuppliersComponent.vue'));
Vue.component('orders-table-component', require('./components/admin/orders/OrdersComponent.vue'));
Vue.component('reservations-table-component', require('./components/admin/reservations/ReservationsComponent.vue'));


//-----------------------------------------УСЛУГИ-----------------------------------------------------------------------
Vue.component('services-table-component', require('./components/admin/services/AllServicesComponent.vue'));

//-----------------------------------------ПОЛЬЗОВАТЕЛИ-----------------------------------------------------------------
Vue.component('admin-table-component', require('./components/admin/AdminTableComponent.vue'));
Vue.component('top-channels-table-component', require('./components/admin/channels/TopChannelsTableComponent.vue'));
Vue.component('schedules-table-component', require('./components/admin/SchedulesTableComponent.vue'));
Vue.component('form-employee-component', require('./components/admin/FormEmployeeComponent.vue'));
Vue.component('delete-employee-component', require('./components/admin/DeleteEmployeeComponent.vue'));
Vue.component('form-role-component', require('./components/admin/FormRoleComponent.vue'));
Vue.component('delete-role-component', require('./components/admin/DeleteRoleComponent.vue'));
Vue.component('search-master-component', require('./components/admin/SearchMasterComponent.vue'));
Vue.component('free-workers-component', require('./components/admin/FreeWorkersComponent.vue'));

/**Компоненты работы с /admin/oauth_settings**/
Vue.component('passport-clients', require('./components/passport/Clients.vue'));
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));


const app = new Vue({
    el: '#app'
});
