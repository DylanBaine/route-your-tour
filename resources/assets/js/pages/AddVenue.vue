<template>
	<v-container>
		<v-card color="white darken-2" class="blue--text">
			<v-card-title primary-title>
				<div class="headline text-xs-center">Lets start setting up your Venue profile.</div>
			</v-card-title> 
			<form @submit.prevent="saveVenue()" id="basic-band-form" v-model="valid">			

				<div class="padded">	

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

			]
		}
	},
	methods: {
		saveVenue: function(){
			axios.post('/api/add-venue',{
				name: this.name,
				location: this.location,
				slug: this.slug,
				_token: this.token
			})
			.then(function(response){
				window.location.href='/home#/profile/add'
			})
			.catch(error => {
				alert(error + ': please fill all of the fields.')
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