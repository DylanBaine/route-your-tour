<template>
	<v-container>
		<v-alert value="true" v-if="alert.showing" :color="alert.type" :icon="alert.icon">
			{{alert.message}}
			<v-btn v-if="alert.link" color="primary" :href="alert.link">Go</v-btn>
			<v-btn flat @click="alert.showing = false">Cancel</v-btn>
		</v-alert>		
		<v-card class="blue--text">
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

					<vue-google-autocomplete
					    id="location"
					    classname="location-input"
					    placeholder="Your venues address."
					    @placechanged="getAddressData"
					>
					</vue-google-autocomplete>						

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
				{text: 'Bar Venue'},
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
			category: '',
			country: '',
			alert: {
				showing: false,
				message: '',
				type: '',
				link: '',
				icon: ''
			}
		}
	},
	methods: {
		saveVenue: function(){
			axios.post('/api/add-venue',{
				name: this.name,
				location: this.location,
				slug: this.slug,
				category: this.category,
				country: this.country,
				_token: this.token
			})
			.then(response => 
				window.location.href = '/home#/venue/' + this.slug
			)
			.catch(error => {
				this.alert.showing = true;
				this.alert.message = error.response.data.message;
				this.alert.type = 'error';
				this.alert.icon = 'error';
				this.alert.link = '/signup/premium';
				if(error.response.data.message == 'You already have one band... To add more, sign up for a Premium Account.'){
					this.alert.link = '/signup/premium'
				}
			});
		},
	    getAddressData: function (addressData, placeResultData) {
            this.location = addressData.street_number + ' ' + addressData.route + ' ' + addressData.locality + ', ' + addressData.administrative_area_level_1 + '. ';
            this.country = addressData.country;

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