<template>

	<v-container fluid grid-list-xl>
		<loader v-if="loading">Loading over 10,000 venues. Patience is a virtue.</loader>
		<v-paginator :resource_url="resource_url" @update="getVenues"></v-paginator>
<v-layout row wrap>

	<v-flex md4 xs12 v-for="venue in venues" :key="venue.id">
		<v-card :href="'venues/' + venue.slug" color="blue" class="card text-xs-center flexed white--text padded" data-ripple='true'>
			<h3>{{venue.name}}</h3>
			<br>
			<h4>{{venue.address}}</h4>
		</v-card>
	</v-flex>		
	
</v-layout>

	</v-container>
	
</template>

<script>
export default{
	data(){
		return{
			venues: '',
			resource_url: 'http://localhost:8000/api/all-venues'
		}
	},
	beforeMount: function(){
	},
	mounted(){
		//this.getVenues();	
		console.log(this.venueLength + ' ' + this.loading)
	},
	methods: {
		getVenues: function(){
			axios.get('/api/all-venues')
				.then(response => this.venues = response.data);			
		},
		updateResource: function(data){
			this.venues = data;
		}
	},
	computed: {
		venueLength: function(){
			return this.venues.length
		},
		loading: function(){	
			if(this.venueLength > 0){
				return false
			}else{
				return true
			}
		}
	}
}
	
</script>

<style scoped>
	
</style>