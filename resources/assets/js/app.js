require('./bootstrap');

import Vue from 'vue';
import Vuetify from 'vuetify';
import * as VueGoogleMaps from 'vue2-google-maps';
import VueRouter from 'vue-router';

Vue.use(Vuetify);

Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyBvWE_sIwKbWkiuJQOf8gSk9qzpO96fhfY',
    libraries: 'places',
	},
});

Vue.use(VueRouter);

const routes = [
	{path: '/home', component: require('./pages/Dashboard.vue')},
	{path: '/home/tour', component: require('./pages/RouteBuilder.vue')},
	{path: '/home/profiles', component: require('./pages/Profiles.vue')},
	{path: '/home/profiles/add', component: require('./pages/AddProfile.vue')},
	{path: '/home/profiles/add/band', component: require('./pages/AddBand.vue')},
	{path: '/home/profiles/add/venue', component: require('./pages/AddVenue.vue')},
	{path: '/home/profiles/add/promoter', component: require('./pages/AddPromoter.vue')},
	{path: '/home/profiles/add/booking-agent', component: require('./pages/AddBookingAgent.vue')},

];

Vue.component('welcome-header', require('./components/WelcomeHeader.vue'));
Vue.component('register-form', require('./components/RegisterForm.vue'));
Vue.component('login-form', require('./components/LoginForm.vue'));
Vue.component('application', require('./components/Layout.vue'));

const router = new VueRouter({
  mode: 'history',
  routes
});


const app = new Vue({
    el: '#app',
    router,
    data: {
    	menu: false,
    	loading: false
    }
});
