<template>
	<v-container>

		<v-alert v-show="edited" color="success">
			<div>Successfully edited.</div>
			<v-btn @click="edited = false" color="green darken-4 white--text alert-btn">OK</v-btn>
		</v-alert>	

		<v-alert v-show="errors" color="error">
			<div>Please insure that all fields are filled out.</div>
			<v-btn @click="errors = false" color="red darken-4 white--text alert-btn">OK</v-btn>
		</v-alert>			
		
		<header>
			<h3 class="text-xs-center">You are editing your venue profile. <br/> Change whatever you would like.</h3>			
		</header>
		</header>

		<section id="editor">
			
			<header id="mast-head" v-if="!image" :style="bannerImage">
				<label for="name"><v-icon>mode_edit</v-icon>Title</label>
				<h1><textarea id="name" class="text-xs-center" v-model="venue.name"></textarea></h1>
				<v-layout row>
					<v-flex md6>
						<label for="address"><v-icon>mode_edit</v-icon> Address</label>
						<h4><input id="address" v-model="venue.address" type="text"></h4>
					</v-flex>
					<v-flex md6>
						<label for="country"><v-icon>mode_edit</v-icon> Country</label>
						<h4><input id="country" v-model="venue.country" type="text"></h4>
					</v-flex>
				</v-layout>
				<label for="banner" id="banner-button" class="btn btn-raised white--text blue darken-3 btn--active">Change Banner Image</label>
				<input type="file" @change="onFileChange" id="banner" style="display: none;">
			</header>

			<header id="mast-head" v-if="image" :style="banner">
				<label for="name"><v-icon>mode_edit</v-icon>Title</label>
				<h1><textarea id="name" class="text-xs-center" v-model="venue.name"></textarea></h1>
				<v-layout row>
					<v-flex md6>
						<label for="address"><v-icon>mode_edit</v-icon> Address</label>
						<h4><input id="address" v-model="venue.address" type="text"></h4>
					</v-flex>
					<v-flex md6>
						<label for="country"><v-icon>mode_edit</v-icon> Country</label>
						<h4><input id="country" v-model="venue.country" type="text"></h4>
					</v-flex>
				</v-layout>
				<label for="banner" id="banner-button" class="btn btn-raised white--text blue darken-3 btn--active">Change Banner Image</label>
				<input type="file" @change="onFileChange" id="banner" style="display: none;">
			</header>

			<hr>
			<section id="contacts">
				<header>
					<h2>Contact Info.</h2>
				</header>

				<v-layout row>

					<v-flex md4>

						<div>
							<label for="email"><v-icon>mode_edit</v-icon> Booking Email</label>
							<input id="email" type="text" v-model="venue.booking_email">
						</div>

					</v-flex>

					<v-flex md4>				

						<div>
							<label for="website"><v-icon>mode_edit</v-icon> Website</label>
							<input type="text" id="website" v-model="venue.website">
						</div>

					</v-flex>

					<v-flex md4>				

						<div>
							<label for="phone"><v-icon>mode_edit</v-icon> Phone</label>
							<input type="text" id="phone" v-model="venue.booking_number">
						</div>

					</v-flex>

				</v-layout>

			</section>
				<header>
					<h2>Venues Details</h2>
				</header>
			<v-layout row id="body">

				<v-flex md6>					
					<label for="amenities"><v-icon>mode_edit</v-icon> List all of your amenities separated by a comma.</label>
					<textarea id="amenities" rows="5" v-model="venue.amenities"></textarea>	
				</v-flex>
				
				<v-flex md6>
					<label for="cat"><v-icon>mode_edit</v-icon>Your current category.</label>
					<v-select
					v-model="venue.category"
					:items="items"
					item-value="text"
					></v-select>
				</v-flex>	

			</v-layout>

			<v-btn color="primary" @click="edit" class="fixed-bottom right">
				Save
			</v-btn>

			<v-btn color="error" @click="destroy" class="fixed-bottom left">
				Delete this venue.
			</v-btn>

		</section>

	</v-container>
</template>

<script>
export default{
	data(){
		return {
			venue: '',
			token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			edited: false,
			errors: false,
			image: '',
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

		}
	},
	methods: {

	},
	mounted(){

		axios.get('/api/venue/' + this.$route.params.slug)
			.then(({data}) => this.venue = data);

	},
	methods: {
		edit: function(){

			var data = new FormData();
				data.append('_token', this.token);
				data.append('_method', 'put');
				data.append('name', this.venue.name);
				data.append('amenities', this.venue.amenities);
				data.append('booking_email', this.venue.booking_email);
				data.append('website', this.venue.website);
				data.append('address', this.venue.address);
				data.append('country', this.venue.country);
				data.append('booking_number', this.venue.booking_number);
				data.append('category', this.venue.category);
				data.append('banner', document.getElementById('banner').files[0]);

			axios.post('/api/venue/'+ this.venue.id +'/edit', data)
				.then(response => {
					if(response.statusText = 'OK'){
						this.errors = false
						this.edited = true
					}
				}).catch(errors => this.errors = true)
		},
		destroy: function(){

			var data = new FormData();
				data.append('_token', this.token);
				data.append('_method', 'delete');

			axios.post('/api/venue/' + this.venue.id + '/delete', data)
				.then(window.location.href="/home#/profile/add");
		},
	    onFileChange(e) {
	      var files = e.target.files || e.dataTransfer.files;
	      if (!files.length)
	        return;
	      this.createImage(files[0]);

	    },	
	    createImage(file) {
	      var image = new Image();
	      var reader = new FileReader();
	      var vm = this;

	      reader.onload = (e) => {
	        vm.image = e.target.result;
	      };
	      reader.readAsDataURL(file);
	    }
	},
	computed: {
		bannerImage: function(){
			return 'background-image: url(/storage/' + this.venue.banner_image +' );'
		},
		banner: function(){
			return 'background-image: url(' + this.image +' );'
		}
	}
}
	
</script>

<style scoped>
input, textarea{
	width: 100%;
	padding: 5px;
}
input:focus, textarea:focus{
	background-color: rgba(0,0,0, .05);
}
label{
	cursor: pointer;
}
.alert-btn{
	position: absolute;
	right: 10px;
	top: 0;
}
#mast-head{
	position: relative;
	background-position: center;
	background-size: cover;
}
#banner-button{
	position: absolute;
	right: 5px;
	bottom: 5px;
}
</style>