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

        /*---BASE ROUTES---*/
  {path: '/', component: require('./pages/AddProfile.vue')},
  {path: '/settings', component: require('./pages/settings.vue')},

        /*---ADD PROFILES---*/
  {path: '/profile/add', component: require('./pages/AddProfile.vue')},
  {path: '/profiles/add/band', component: require('./pages/AddBand.vue')},
  {path: '/profiles/add/venue', component: require('./pages/AddVenue.vue')},
  {path: '/profiles/add/promoter', component: require('./pages/AddPromoter.vue')},
  {path: '/profiles/add/bookingagent', component: require('./pages/AddBookingAgent.vue')},

        /*---SEE PROFILES---*/
  {path: '/band/:slug', component: require('./pages/BandProfile.vue')},
  {path: '/venue/:slug', component: require('./pages/VenueProfile.vue')},
  {path: '/booking-agent/', component: require('./pages/BookingAgentProfile.vue')},
  {path: '/promoter/', component: require('./pages/PromoterProfile.vue')},

        /*---ADD A TOUR TO A BAND---*/
  {path: '/band/:slug/tour', component: require('./pages/RouteBuilder.vue')},

];

Vue.component('welcome-header', require('./components/WelcomeHeader.vue'));
Vue.component('register-form', require('./components/RegisterForm.vue'));
Vue.component('login-form', require('./components/LoginForm.vue'));
Vue.component('application', require('./components/Layout.vue'));
Vue.component('loader', require('./components/Loader.vue'));

const router = new VueRouter({
  routes
});


const app = new Vue({
  el: '#app',
  router,
  data: {
   menu: false,
   loading: false,
   errors: true
 }
});
