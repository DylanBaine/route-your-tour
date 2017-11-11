<template>

	<v-container grid-list-md>

		<transition name="fade">
			<div v-if="searching" id="search-area">
					<div id="exit">
						<v-btn @click="openSearchBox" title="Exit the search box." fab flat><v-icon>close</v-icon></v-btn>
					</div>
					<div class="inner padded">
						<header class="search-header">
							<v-layout row wrap>
								<v-flex md9>
									<v-text-field
										@keydown.enter="search"
										v-model="searchParam"
										label="Search by city, genre, or venue name."
									></v-text-field>
								</v-flex>
								<v-flex md1>
									<v-btn color="red darken-2" title="Clear Search" small fab flat @click="clearSearch"><v-icon>close</v-icon></v-btn>
								</v-flex>								
								<v-flex md2>
									<v-btn color="primary" raised @click="search">Search</v-btn>
								</v-flex>
							</v-layout>
						</header>
						<section v-if="totalResults">

							<header class="padded">
								<h4> {{totalResults}} Results</h4>
							</header>
							<v-layout row wrap id="search-results">
								<v-flex xs6 md4 xl3 v-for="searchResult in searchResults" :key="searchResult.id">
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

					<v-btn @click="openSearchBox" color="primary">Search</v-btn> 

					<v-btn @click="showManually" color="primary">
						<span v-if="!manuallyAdding">Mannually Add</span>
						<span v-if="manuallyAdding">Cancel</span>
					</v-btn>
					
					<div class="padded">
						
						<div class="swatch yellow darken-1"></div> <small> = Pending Confimation</small>
						<br>
						<div class="swatch green lighten-1"></div> <small> = Confirmed</small>

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
							v-model="venue"
							label="Venues Name"
						></v-text-field>

						<v-btn flat color="primary darken-1" @click="addVenue(address, venue)">
							Add to tour.
						</v-btn>

					</section>	
				</transition>

				<section id="locations">
					
					<article class="location" v-for="location in locations" :key="id">
						<div v-if="!location.confirmed" class="yellow darken-1 padded">							
							<header>
								<h5>
									{{location.venue}}
								</h5>
							</header>
							<p>
								{{location.address}}
							</p>
							<div class="relative bottom right" style="top:-10px;">
								<v-btn fab small class="red darken-1 white--text" @click="deleteLocation(location.id)" title="Delete this location."><v-icon>delete_forever</v-icon></v-btn>
								<v-btn fab small class="green darken-1 white--text" @click="confirmLocation(location.id)" title="Confirm this location."><v-icon>thumb_up</v-icon></v-btn>
								<v-btn v-if="location.slug" fab small class="blue darken-1 white--text" :href=" 'venues/' + location.slug " target="_blank" title="Visit this venues RYT page."><v-icon>link</v-icon></v-btn>
							</div>
						</div>

						<div v-if="location.confirmed" class="green lighten-1 padded">							
							<header>
								<h5>
									{{location.venue}}
								</h5>
							</header>
							<p>
								{{location.address}}
							</p>
							<div class="relative bottom right" style="top:-10px;">
								<v-btn fab small class="red darken-1 white--text" @click="deleteLocation(location.id)" title="Delete this location."><v-icon>delete_forever</v-icon></v-btn>
								<v-btn v-if="location.slug"  fab small class="blue darken-1 white--text" :href=" 'venues/' + location.slug " target="_blank" title="Visit this venues RYT page."><v-icon>link</v-icon></v-btn>
							</div>
						</div>

					</article>

				</section>

			</div>				
		</aside>

		<main id="map" class="white">
			
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
			locations: '',
			map: '',
			searching: false,
			searchResults: '',
			searchParam: '',
			modal: false,
			id: ''
		}
	},
	mounted(){

		this.getRoute();

		this.getLocations();

		this.initMap();
	},
	methods: {
		getRoute: function(){
			axios.get('/api/band/' + this.$route.params.bandSlug + '/' + this.$route.params.routeSlug)
				.then(response => this.route = response.data);
		},
		getLocations: function(){
			axios.get('/api/' + this.$route.params.bandSlug + '/' + this.$route.params.routeSlug + '/locations')
				.then(response => this.locations = response.data);
		},
		addLocation: function(){

			axios.post('api/', {
			});

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
			this.map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: -34.397, lng: 150.644},
			zoom: 8
			})
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
			axios.get('/api/venues/search=' + this.searchParam)
				.then(response => this.searchResults = response.data);
		},
		clearSearch: function(){

			this.searchParam = '';
			this.searchResults = '';

		},
		addVenue: function(address, name, link){
			axios.post('/api/' + this.route.id + '/add-location', {
              _token: this.token,
              route_id: this.route.id,
              venue: name,
              address: address,
              slug: link
			})
			.then(
				this.address = '',
				this.venue = '',
				this.manuallyAdding = false,
				document.getElementById('location_input').value = '',
				this.getLocations(),
				this.getRoute()
			)

		},
		deleteLocation: function(location_id){
			axios.post('/api/' + location_id + '/delete-location', {
              _token: this.token,
              _method: 'delete'
			})
			.then(
				this.getLocations(),
				this.getRoute()
				)
		},
	    getAddressData: function (addressData, placeResultData) {
            this.address = addressData.street_number + ' ' + addressData.route + ' ' + addressData.locality + ', ' + addressData.administrative_area_level_1 + '. ';
        },
        confirmLocation: function(location_id){
			axios.post('/api/' + location_id + '/confirm-location', {
              _token: this.token,
              _method: 'put',
			})
			.then(
				this.getLocations(),
				this.getRoute()
				);

	
        }

	},
	computed: {
		totalResults: function(){
			return this.searchResults.length;
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
</style>