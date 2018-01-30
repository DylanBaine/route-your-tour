<template>
	<v-container fluid style="padding: 0;" class="text-xs-center">
		<v-alert value="true" v-if="alert.showing" :color="alert.type" :icon="alert.icon">
			{{alert.message}}
			<v-btn v-if="alert.link" color="primary" :href="alert.link">Go</v-btn>
			<v-btn flat @click="alert.showing = false">Cancel</v-btn>
		</v-alert>
		<v-card class="blue--text card" width="">
			<v-card-title primary-title>
				<div class="headline text-xs-center">Add Band</div>
			</v-card-title> 
			<form @submit.prevent="saveBand()" id="basic-band-form" v-model="valid">			

				<div class="padded">	

					<v-text-field
					name="name"
					label="Whats your band called?"
					v-model="name"
					:rules="nameRules"
					required
					></v-text-field>

					<div class="slug grey--text"><label>Your url will be: </label>www.routeyourtour.com/bands/<span class="yellow lighten-3">{{slug}}</span><input type="hidden" :value="slug" name="slug"></div>

					<br>

					<v-text-field
					name="soudcloud_url"
					label="Do you have a soundcloud account? (if not, leave blank)"
					placeholder="https://soundcloud.com/my-cool-band"
					v-model="soundcloud"
					></v-text-field>
					
					<transition name="drop">
						<iframe v-if="soundcloud" width="97%" height="300" scrolling="no" frameborder="no"
									:src="'https://w.soundcloud.com/player/?url=' + soundcloud">
						</iframe>
					</transition>				

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
			soundcloud: '',
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
		saveBand: function(){
			axios.post('/api/add-band',{
				name: this.name,
				soundcloud_url: this.soundcloud,
				slug: this.slug,
				_token: this.token
			})
			.then(response => 
				window.location.href = '/home#/band/' + this.slug
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
		}
	},
	computed: {
		slug: function(){
			return Slug(this.name + '-') + Math.floor(Math.random() * 500);
		},
	},
	mounted(){

	    var input = document.getElementById('location');

	    var autocomplete = new google.maps.places.Autocomplete(input);    
	    autocomplete.addListener('place_changed', function() {
	      infowindow.close();
	      marker.setVisible(false);
	      var place = autocomplete.getPlace();
	      if (!place.geometry) {
	        window.alert("No details available for input: '" + place.name + "'");
	        return;
	      }
	      
	    })
	}
}
</script>

<style scoped>
	.slug label{
		font-weight: bold;
	}
	.card{
		margin: 20px auto;
		width: 700px;
		max-width: 100vw;
	}
</style>