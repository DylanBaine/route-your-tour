require('./bootstrap');

require('./maps')

import Vue from 'vue';
import Vuetify from 'vuetify';
import VueRouter from 'vue-router';
import VueGoogleAutocomplete from 'vue-google-autocomplete';

Vue.use(Vuetify);

Vue.use(VueRouter);

Vue.use(VueGoogleAutocomplete);

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
{path: '/band/:slug/tour', component: require('./pages/AddRoute.vue')},
{path: '/band/:bandSlug/:routeSlug', component: require('./pages/AddLocation.vue')},
//{path: '/:routeId/search', component: require('./pages/searchLocation.vue')},
{path: '/add-tour', component: require('./pages/PicBandForRoute.vue')}

];

const router = new VueRouter({
  routes,
});

Vue.component('auth-header', require('./components/AuthHeader.vue'));
Vue.component('register-form', require('./components/RegisterForm.vue'));
Vue.component('login-form', require('./components/LoginForm.vue'));
Vue.component('application', require('./components/Layout.vue'));
Vue.component('loader', require('./components/Loader.vue'));
Vue.component('get-venues', require('./components/GetVenues.vue'));
Vue.component('vue-google-autocomplete', require('./components/AutoFill.vue'));
Vue.component('search-form', require('./components/SearchForm.vue'));


const app = new Vue({
  el: '#app',
  router,
  data: {
    menu: false,
    loading: false,
    errors: true,
    dialog: false,  
    dialogTarget: {},
    e1: '',
    e2: '',
    bands: [],
    routes: [],
    pickedBand: '',
    pickedTour: '',
    nextStep: false,
    token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    geocoder: new google.maps.Geocoder(),
  },
  created() {
    if(window.location.pathname == "/"){
      window.onscroll = function (e) {
        document.getElementById('title').style.top = window.scrollY/3 + 'px';
        document.getElementById('inner').style.backgroundColor = 'rgba(0,0,0,' + Math.max(window.scrollY/500, .3) + ')';
      }
    }
  },
  methods: {
    addThisToTour: function(address, venue){
      this.dialog = true;
      this.dialogTarget.address = address;
      this.dialogTarget.venue = venue;

      axios.get('/api/users-bands')
      .then(response => this.bands = response.data);
    },
    pickTour: function(){
      this.nextStep = true;
      axios.get('/api/' + this.pickedBand + '/routes')
      .then(response => this.routes = response.data);
    },
    reset: function(){
      this.nextStep = false;
    },
    addLocation: function(){
            axios.post('/api/' + this.pickedTour + '/add-location',{
              _token: this.token,
              route_id: this.pickedTour,
              venue: this.dialogTarget.venue,
              address: this.dialogTarget.address
            })
            .then(response => console.log(response));
      
            this.dialog = false;
      
    },
    geocode: function(){
      this.geocoder.geocode({ 'address': this.dialogTarget.address}, function(results, status){
      });
    }
  },
  computed: {
    noVenues: function(){
      if(this.routes.length == 0){
        return true
      }else{
        return false
      }
    },
  }
});
