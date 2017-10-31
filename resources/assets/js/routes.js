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