<template>

	<v-container>
			<aside class="adder cyan lighten-2">
				<div class="inner text-xs-center black--text" color="white">

					<header class="padded text-xs-center">
						<h4>Adding stops to "{{route.title}}."</h4>
						<hr>
					</header>		

					<v-btn href="/venues">Search</v-btn> <v-btn @click="showManually">
						<span v-if="!manuallyAdding">Mannually Add</span>
						<span v-if="manuallyAdding">Cancel</span>
					</v-btn>	
					
					<section v-if="manuallyAdding" id="manually-add" class="padded">
						<header class="padded">
							<h6>Manually add stops</h6>
						</header>
						<v-text-field
							v-model="address"
							label="Address"
						></v-text-field>

						<v-text-field
							v-model="venue_name"
							label="Venues Name"
						></v-text-field>

						<v-text-field
							v-model="ticketLink"
							label="Tickets Link"
						></v-text-field>

						<v-btn flat color="white darken-1" @click="addLocation">
							Add to tour.
						</v-btn>

					</section>	

					<section id="locations">
						
						<article class="location padded" v-for="location in locations" :key="location.id">
							<header>
								<h5>
									{{location.venue}}
								</h5>
							</header>
							<p>
								{{location.address}}
							</p>
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
			route: '',
			band: '',
			search: '',
			manuallyAdding: false,
			locations: '',
			map: ''
		}
	},
	mounted(){
		axios.get('/api/band/' + this.$route.params.bandSlug + '/' + this.$route.params.routeSlug)
			.then(response => this.route = response.data);

		axios.get('/api/' + this.$route.params.bandSlug + '/' + this.$route.params.routeSlug + '/locations')
			.then(response => this.locations = response.data);

		this.initMap();
	},
	methods: {
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
		},

		initMap: function(){
			this.map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: -34.397, lng: 150.644},
			zoom: 8
			})
		},


	},
	computed: {

	}
}
/*
      function initMap() {

*/
	
</script>

<style scoped>
.adder{
	height: 100vh;
	position: absolute;
	top: 0;
	left: 0;
	overflow: auto;
	z-index: 1;
	width: 25vw;
	border-right: solid 1px black;
}	
#map{
	position: absolute;
	right: 0;
	top: 0;
	width: 75vw;
	height: 100vh;
	z-index: 1;
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
</style>