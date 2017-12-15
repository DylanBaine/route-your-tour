<template>
	<v-container fluid style="padding: 0;">
		<v-card class="blue--text">
			<v-card-title primary-title>
				<div class="headline text-xs-center">We will need a little info about your band.</div>
			</v-card-title> 
			<form @submit.prevent="saveBand()" id="basic-band-form" v-model="valid">			

				<div class="padded">	

					<v-text-field
					name="name"
					label="Whats your band called?"
					v-model="name"
					:rules="nameRules"
					></v-text-field>

					<div class="slug grey--text"><label>Your url will be: </label>www.routeyourtour.com/bands/<span class="yellow lighten-3">{{slug}}</span><input type="hidden" :value="slug" name="slug"></div>

					<br>

					<v-text-field
					name="soudcloud_url"
					label="Do you have a soundcloud account? (if not, leave blank)"
					placeholder="https://soundcloud.com/my-cool-band"
					v-model="soundcloud"
					:rules="soundcloudRules"
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
			soundcloud: '',
			soundcloudRules: [
				(v) => /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/.test(v) || 'Must enter a valid url. Make sure it contains "https://"'
			],
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
				alert(error + ': please fill in all of the fields.')
			})
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
</style>