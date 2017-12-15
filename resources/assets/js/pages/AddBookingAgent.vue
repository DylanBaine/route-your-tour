<template>
	<v-container>
		<v-card class="blue--text">
			<v-card-title primary-title>
				<div class="headline text-xs-center">Fill out the form below to become a booking agent on Route Your Tour.</div>
			</v-card-title> 
			<form @submit.prevent="saveBand()" id="basic-band-form" v-model="valid">			

				<div class="padded">	

					<v-text-field
					name="name"
					label="What do you go by as a booking agent?"
					v-model="name"
					:rules="nameRules"
					></v-text-field>

					<div class="slug grey--text"><label>Your url will be: </label>www.routeyourtour.com/booking-agents/<span class="yellow lighten-3">{{slug}}</span><input type="hidden" :value="slug" name="slug"></div>

					<v-text-field
					name="experience"
					label="In a few words, what are your experiences as a booking agent?"
					v-model="experience"
					multi-line
					:rules="experienceRules"
					:counter="300"
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
				(v) => !!v || 'Name is required.'
			],
			experience: '',
			experienceRules: [
				(v) => !!v || 'You must fill out the experience column.',
				(v) => v.length <= 300 || 'This must be less than 300 charachters'
			]
		}
	},
	methods: {
		saveBand: function(){
			axios.post('/api/add-bookingagent',{
				name: this.name,
				slug: this.slug,
				experience: this.experience,
				_token: this.token
			})
			.then(function(response){
				window.location.href='/home#/booking-agent'
			})
			.catch(error => {
				alert(error + ': please fill in all of the fields.')
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