<template>

	<v-container grid-list-md>

		<loader v-if="updating">Fetching Locations...</loader>

		<loader v-if="loading">Loading your route...</loader>

		<loader v-if="searchingRes">Searching for "{{searchParam}}"</loader>

		<v-alert v-if="promptDelete" value="true" color="error" icon="warning" class="text-xs-center">
			Are you sure you want to delete "{{route.title}}"? 
			<v-btn @click="deleteThis">Yes, Delete</v-btn>
		</v-alert>

	<v-btn @click="promptDelete = true" style="z-index: 999;" class="fixed-bottom left" color="error">
			Delete this route.
		</v-btn>

		<transition name="fade">
			<div v-if="searching" id="search-area">
				<div id="exit">
					<v-btn dark color="grey" @click="openSearchBox" title="Exit the search box." fab flat><v-icon>close</v-icon></v-btn>
				</div>
				<div class="inner padded">
					<header class="search-header">
						<v-layout row wrap>
							<v-flex xs7 md9>
								<v-text-field
									light="true"
									@keydown.enter="search"
									v-model="searchParam"
									label="Search by city, genre, or venue name."
								></v-text-field>
							</v-flex>
							<v-flex md1 xs1>
								<v-btn color="red darken-2" title="Clear Search" small fab flat @click="clearSearch"><v-icon>close</v-icon></v-btn>
							</v-flex>
							<v-flex md2 xs12>
								<v-btn color="primary" raised @click="search">Search</v-btn>
							</v-flex>
						</v-layout>
					</header>

					<section v-if="totalResults">

						<header class="padded xs-hidden">
							<h4> {{totalResults}} Results</h4>
						</header>
						<v-layout row wrap id="search-results">
							<v-flex xs12 md4 xl3 v-for="searchResult in searchResults" :key="searchResult.id">
								<v-card class="blue darken-2 padded text-xs-center card white--text flex-center text-xs-center relative" data-ripple="true">
									<div class="text-xs-center margin-auto">
										<h6>{{searchResult.name}}</h6>
										<br>
										{{searchResult.address}}
										<hr>
										{{searchResult.category}}
									</div>
									<div class="absolute bottom-right">
										<v-btn small :href=" '/venues/' + searchResult.slug + '/' " class="blue darken-4 white--text" target="_blank"> see page </v-btn>
										<v-btn small @click='addVenue(searchResult.address, searchResult.name, searchResult.slug)' fab class="blue darken-4 white--text" title="Add to a tour.">
											<v-icon>add</v-icon>
										</v-btn>
									</div>
								</v-card>
							</v-flex>   
						</v-layout>  
					</section>
				</div>
			</div>
		</transition>

		<aside class="adder grey lighten-4">
			<div class="inner text-xs-center black--text" color="white">

				<header class="padded text-xs-center">
					<h4>Adding stops to "{{route.title}}."</h4>

					<v-btn @click="openSearchBox" color="primary">
						{{searching ? 'Cancel' : 'Search'}}
					</v-btn> 

					<v-btn @click="showManually" color="primary">
						{{manuallyAdding ? 'Cancel' : 'Manually Add'}}
					</v-btn>

					<div class="padded">
						<v-checkbox label="Optimize locations?" v-model="optimizeWaypoints" light color="primary"></v-checkbox>
						<small>(If checked, the map will show locations in the most efficient order.)</small>
					</div>

				</header>     

				<transition name="drop">
					<section v-show="manuallyAdding" id="manually-add" class="padded">

						<header class="padded">
							<h6>Manually add stops</h6>
						</header>

						<p class="text-xs-left">
							<label class="blue--text" for="location_input">Address</label>
							<vue-google-autocomplete
							@placechanged="getAddressData"
							id="location_input"
							></vue-google-autocomplete>
						</p>

						<v-text-field
						light="true"
						v-model="venue"
						label="Venues Name"
						></v-text-field>

						<v-btn flat color="primary darken-1" @click="addVenue(address, venue)">
							Add to tour.
						</v-btn>

					</section>  
				</transition>

				<div class="padded">
					<h6>Give us some more info so we can help you calculate costs.</h6>
					<v-text-field
						light="true"
						placeholder="2"
						v-model="currentGasPrice"
						label="Gas price per gallon? (usd)">
					</v-text-field>
					<v-text-field
						light="true"
						placeholder="12"
						v-model="vehicleMPG"
						label="Your gas mileage.">
					</v-text-field>
				</div>

				<div class="padded">
					<p v-if="distance">Estimated total distance: <b>{{distance}} miles</b></p>
					<p v-if="gasPrice && vehicleMPG">Estimated gas price: <b>${{gasPrice}}</b>.</p>
				</div>


				<div class="padded">
					
					<div class="swatch yellow darken-1"></div> <small> = Pending Confimation</small>
					<br>
					<div class="swatch green lighten-1"></div> <small> = Confirmed</small>
					<br>
					<br>
					<v-btn color="success" @click="confirmAll()">Confirm All</v-btn>

				</div>				

				<section id="locations">
					
					<article class="location" v-for="location in locations" :key="location.id">
						<div v-if="!location.confirmed" class="yellow darken-1 padded">                         
							<header>
								<h5>
									{{location.venue}}
								</h5>
							</header>
							<p class="address-cont">
								{{location.address}}
							</p>
							<div class="relative bottom right" style="top:-10px;">
								<v-btn fab small class="red darken-1 white--text" @click="deleteLocation(location.id)" title="Delete this location."><v-icon>delete_forever</v-icon></v-btn>
								<v-btn fab small class="green darken-1 white--text" @click="confirmLocation(location.id)" title="Confirm this location."><v-icon>thumb_up</v-icon></v-btn>
								<v-btn v-if="location.slug" fab small class="blue darken-1 white--text" :href=" 'venues/' + location.slug " target="_blank" title="Visit this venues RYT page."><v-icon>link</v-icon></v-btn>
							</div>
						</div>

						<div v-if="location.confirmed" class="green lighten-1 padded">
							<header class="text-xs-left">
								<h5>
									{{location.venue}}
								</h5>
							</header>
							<p>
								{{location.address}}
							</p>
							<div class="relative bottom right" style="top:-10px;">
								<v-btn fab small class="red darken-1 white--text" @click="deleteLocation(location.id)" title="Delete this location."><v-icon>delete_forever</v-icon></v-btn>
								<v-btn v-if="location.slug"fab small class="blue darken-1 white--text" :href=" 'venues/' + location.slug " target="_blank" title="Visit this venues RYT page."><v-icon>link</v-icon></v-btn>
							</div>
						</div>

					</article>

				</section>

			</div>
		</aside>

		<main id="map" class="white">

			<div id="directions-panel"></div>
			
		</main>
		<img id="brand" src="/Defaults/logo-black.png" alt="RYT" width="100px">
	</v-container>
	
</template>

<script>
export default{
	data(){
		return{
			token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			address: '',
			venue: '',
			ticketLink: '',
			route: '',
			band: '',
			manuallyAdding: false,
			locations: false,
			map: '',
			searching: false,
			searchResults: '',
			searchParam: '',
			modal: false,
			id: '',
			mapAddresses: '',
			start: '',
			end: '',
			optimizeWaypoints: true,
			start: '',
			end: '',
			distance: '',
			currentGasPrice: 2.75,
			vehicleMPG: 12,
			loading: true,
			searchingRes: false,
			promptDelete: false
		}
	},
	mounted(){

		this.getRoute();

		this.$nextTick(function(){

			this.getLocations();  

		});
	},
	updated(){
		this.loading = false;
	},
	methods: {
		deleteThis: function(){
			axios.post('api/' + this.route.id + '/delete', {
				_method: 'delete',
				_token: this.token
			}).then(window.location.href = '/home');
		},
		getRoute: function(){
			axios.get('/api/band/' + this.$route.params.bandSlug + '/' + this.$route.params.routeSlug)
			.then(response => this.route = response.data);
		},
		getLocations: function(){
			this.updating = true;
			this.locations = "";
			axios.get('/api/' + this.$route.params.bandSlug + '/' + this.$route.params.routeSlug + '/locations')
			.then((response) => {
				if(response.data.length > 0){
					this.locations = response.data;
					this.updating = false;
				}else{
					this.locations = false;
				}
			});
		},
		getAddress: function(){
			axios.get('/api/' + this.$route.params.bandSlug + '/' + this.$route.params.routeSlug + '/locations-address')
			.then(response => this.mapAddresses = response.data);
		},
		showManually: function(){
			if(!this.manuallyAdding){
				this.manuallyAdding = true;             
			}else{
				this.manuallyAdding = false;
			}
			this.searching = false;
		},

		initMap: function(){

			var totalLength = 0;

			var directionsService = new google.maps.DirectionsService;
			var directionsDisplay = new google.maps.DirectionsRenderer;
			var geocoder = new google.maps.Geocoder();

			var v = this;

			var map = new google.maps.Map(document.getElementById('map'), {
			  zoom: 6,
			  center: {lat: 41.85, lng: -87.65}
			});
			directionsDisplay.setMap(map);
			if(this.locations.length > 0)
				this.calcRoute(directionsService, directionsDisplay);

			for(var ii = 0; ii < this.locations.length; ii++){

				geocoder.geocode( { 'address': v.markerSpot[ii].address}, function(results, status) {

					var iconLocation = results[0].geometry.location;

					var shape = {
					  coords: [1, 1, 1, 20, 18, 20, 18, 1],
					  type: 'poly'
					};
					var iconImage = {
						url: "Defaults/marker.gif"
					};

					var marker = new google.maps.Marker({
						position: iconLocation,
						map: map,
						icon: iconImage,
						shape: shape,
						zIndex: 999
					})

				});

			}


			var distanceService = new google.maps.DistanceMatrixService();

			var distanceDestinations = [];

			for(var d = 0; d < this.locations.length; d++){
				distanceDestinations.push(this.locations[d].address);
			}

			distanceService.getDistanceMatrix({
				origins: [distanceDestinations[0]],
				destinations: distanceDestinations,
				travelMode: 'DRIVING',
				unitSystem: google.maps.UnitSystem.IMPERIAL,
			}, callback);

			function callback(response, status) {
			  if (status == 'OK') {
				var origins = response.originAddresses;
				var destinations = response.destinationAddresses;
				var distanceRes = response.rows[0].elements;

				var rawDistance = [];

				for(var a = 0; a < distanceRes.length; a++){
					// rawDistance.push();
					
					totalLength += distanceRes[a].distance.value;
				}

				console.log(totalLength)

				v.distance = Math.round(totalLength/1609.344, 1);

				console.log(v.distance)

				for (var ii = 0; ii < origins.length; ii++) {
				  var results = response.rows[ii].elements;
				  for (var j = 0; j < results.length; j++) {
					var element = results[j];
					var distance = element.distance.text;
					var duration = element.duration.text;	
					var from = origins[ii];
					var to = destinations[j];
				  }
				}
			  }
			}		

		},
		calcRoute: function(directionsService, directionsDisplay){

			var waypts = [];
			for (var i = 0; i < this.locations.length; i++) {
				if(this.locations[i].confirmed)
					waypts.push({
					  location: this.locations[i].address,
					  stopover: true
					});

			}

			directionsService.route({
			  origin: waypts[0].location,
			  destination: waypts[0].location,
			  waypoints: waypts,
			  optimizeWaypoints: this.optimizeWaypoints,
			  travelMode: 'DRIVING'
			}, function(response, status) {
			  if (status === 'OK') {
				directionsDisplay.setDirections(response);
				var route = response.routes[0];
			} else {
				window.alert('Directions request failed due to ' + status);
			  }
			});
		},
		openSearchBox: function(){
			if(!this.searching){
				this.searching = true
			}else{
				this.searching = false
			}
			this.manuallyAdding = false
		},
		search : function(){
			this.searchingRes = true;
			this.searchResults = '';
			axios.get('/api/venues/search=' + this.searchParam)
			.then(response => {
					if(response.data.length > 0){
						this.searchResults = response.data;
						this.searchingRes = false;	

					}else{
						this.searchingRes = false;
					}
				}
				);
		},
		clearSearch: function(){

			this.searchParam = '';
			this.searchResults = '';

		},
		confirmAll: function(){
			axios.post('/api/' + this.route.id + '/confirm-all')
			.then(res => this.getLocations())

			
		},
		addVenue: function(address, name, link){
			axios.post('/api/' + this.route.id + '/add-location', {
				_token: this.token,
				route_id: this.route.id,
				band_id: this.route.band_id,
				venue: name,
				address: address,
				slug: link
			});
			this.address = '';
			this.venue = '';
			this.manuallyAdding = false;
			document.getElementById('location_input').value = '';

			this.$nextTick(function(){
				this.getLocations();
			}) 
			
		},
		deleteLocation: function(location_id){
			axios.post('/api/' + location_id + '/delete-location', {
				_token: this.token,
				_method: 'delete'
			});

			this.$nextTick(function(){

				this.getLocations();  

			}) 
		},
		getAddressData: function (addressData, placeResultData) {
			this.address = addressData.street_number + ' ' + addressData.route + ' ' + addressData.locality + ', ' + addressData.administrative_area_level_1 + '. ';
		},
		confirmLocation: function(location_id){
			axios.post('/api/' + location_id + '/confirm-location', {
				_token: this.token,
				_method: 'put',
			});

			this.$nextTick(function(){

				this.getLocations();  

			})  
		}

	},
	computed: {
		totalResults: function(){
			return this.searchResults.length;
		},
		markerSpot: function(){
			return this.locations;
		},
		gasPrice: function(){
			return Math.round((this.distance / this.vehicleMPG) * this.currentGasPrice)
		},
		updating: function(){
			return this.locations === "" ? true : false ;
		}
	}, 
	watch: {
		locations: function(){
			this.initMap();
		},
		optimizeWaypoints: function(){
			this.initMap();
		}
	}
}

</script>

<style scoped>
.swatch{
	width: 10px;
	height: 10px;
	display: inline-block;
}
#location_input{
	width: 100%;
	border-bottom: solid 2px lightgrey;
}
#exit{
	position: absolute;
	top: 10px;
	left: 10px;
}
.adder{
	height: 100vh;
	position: absolute;
	top: 0;
	left: 0;
	overflow: auto;
	z-index: 1;
	width: 25vw;
	box-shadow: inset -4px -4px 32px rgba(0,0,0,.2);
	overflow-x: hidden;
}   
#map, #search-area{
	position: absolute;
	right: 0;
	top: 0;
	width: 75vw;
	height: 100vh;
	z-index: 1;
}
#search-area{
	display: flex;
	align-items: center;
	justify-content: center;
	z-index: 2;
	background-color: rgba(255, 255, 255, .7);
}
.search-header{
	min-width: 400px;
	max-width: 60%;
	margin: 0 auto;
}
#search-results{
	overflow-y: auto;
	overflow-x: hidden;
	max-height: 65vh;
	max-width: 99%;
	margin: 0 auto;
}
#brand{
	position: fixed; 
	bottom: 10px;
	right: 10px;
	opacity:.7;
	z-index: 99;
}
hr{
	border: solid 1px white;
}
.location:first-of-type{
	margin-top: 30px;
	border-top: solid 1px black;
}
.location{
	border-bottom: solid 1px black;
}
.card{
	height: 220px !important;
}
.bottom-right{
	bottom: 0px;
}

@media screen and (max-width: 730px) {
	.adder{
		width: 100%;
		height: auto;
		position: static;
	}
	#map{
		width: 100%;
		height: 100vh;
		position: static;
	}
	#search-area{
		position: fixed;
		left: 0;
		width: 100vw;
	}
	.xs-hidden{
		display: none;
	}
}

</style>