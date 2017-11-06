<template>
	<v-container>
		<v-card color="white darken-2" class="blue--text">
			<v-card-title primary-title>
				<div class="headline text-xs-center">Lets start setting up your Venue profile.</div>
			</v-card-title> 
			<form @submit.prevent="saveVenue()" id="basic-band-form" v-model="valid">			

				<div class="padded">	

					<v-select
					v-model="category"
					:items="items"
                	label="Select your venue category"
					item-value="text"
					></v-select>
					
					<v-text-field
					name="name"
					label="What do you call your venue?"
					v-model="name"
					:rules="nameRules"
					></v-text-field>

					<div class="slug grey--text"><label>Your url will be: </label>www.routeyourtour.com/venues/<span class="yellow lighten-3">{{slug}}</span><input type="hidden" :value="slug" name="slug"></div>

					<v-text-field
					name="location"
					label="What is your venue's address?"
					v-model="location"
					:rules="locationRules"
					></v-text-field>					

				</div>			

				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn type="submit" color="primary">Save</v-btn>
					<v-btn to="/profile/add" type="submit" class="white--text red darken-2">Cancel</v-btn>
				</v-card-actions>

			</form>
		</v-card>
	</v-container>
</template>

<script>
export default {
	data () {
		return {
			token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			name: '',
			nameRules: [
			(v) => !!v || 'Name is required',
			],
			location: '',
			locationRules: [
				(v) => !!v || 'An address is required',

			],
			items: [
				{text: 'Amphitheater'},
				{text: 'Arena'},
				{text: 'Auditorium'},
				{text: 'Bar'},
				{text: 'Casino'},
				{text: 'Church'},
				{text: 'Club'},
				{text: 'Coffee House'},
				{text: 'Event Center'},
				{text: 'Music Hall'},
				{text: 'Outdoor Festival'},
				{text: 'Restaurant'},
				{text: 'Stadium'}
			],
			category: ''
		}

/*Add "Music Hall", "Restaurant Venue", and "Event Venue" to venue categories. all categories are now "Amphitheater, Arena, Auditorium, Bar Venue, Casino Venue, Church Venue, Club, Coffee House, Event Venue, Music Hall, Restaurant Venue, Outdoor Festival, Stadium Venue"*/

	},
	methods: {
		saveVenue: function(){
			axios.post('/api/add-venue',{
				name: this.name,
				location: this.location,
				slug: this.slug,
				category: this.category,
				_token: this.token
			})
			.then(function(response){
				window.location.href='/home#/profile/add'
			})
			.catch(error => {
				alert(error + error.message)
			})
		}
	},
	computed: {
		slug: function(){
			return Slug(this.name + '-') + Math.floor(Math.random() * 500);
		}
	}
}
</script>

<style scoped>
	.slug label{
		font-weight: bold;
	}
</style>