<template>
	<v-container grid-list-md>

		<loader v-if="loading"></loader>

		<v-alert v-show="edited" color="success">
			<div>Successfully edited.</div>
			<v-btn @click="edited = false" color="green darken-4 white--text alert-btn">OK</v-btn>
		</v-alert>	

		<v-alert v-show="errors" color="error">
			<div>Please insure that all fields are filled out.</div>
			<v-btn @click="errors = false" color="red darken-4 white--text alert-btn">OK</v-btn>
		</v-alert>			
		
		<header>
			<h3 class="text-xs-center">You are editing your band profile. <br/> Change whatever you would like.</h3>			
		</header>
	</header>

	<section id="editor">

		<header v-if="!image" id="mast-head" :style="bannerImage">
			<label for="name"><v-icon>mode_edit</v-icon>Title</label>
			<h1><textarea id="name" class="text-xs-center" v-model="band.name"></textarea></h1>
			<v-layout row>
				<v-flex md6>
					<label for="location"><v-icon>mode_edit</v-icon> Location</label>
					<h4>{{band.location}}</h4>
						<vue-google-autocomplete
							id="location"
						    placeholder="Change Location?"
						    @placechanged="getAddressData"
						>
						</vue-google-autocomplete>		
				</v-flex>
			</v-layout>
			<label for="banner" id="banner-button" class="btn btn-raised white--text blue darken-3 btn--active">Change Banner Image</label>
			<input type="file" @change="onFileChange" id="banner" style="display: none;">
		</header>

		<header v-if="image" id="mast-head" :style="banner">
			<label for="name"><v-icon>mode_edit</v-icon>Title</label>
			<h1><textarea id="name" class="text-xs-center" v-model="band.name"></textarea></h1>
			<v-layout row>
				<v-flex md6>
					<label for="location"><v-icon>mode_edit</v-icon> Location</label>
					<h4>{{band.location}}</h4>
						<vue-google-autocomplete
						    id="location"
						    classname="place-input"
						    placeholder="Change Location?"
						    @placechanged="getAddressData"
						></vue-google-autocomplete>						
					
				</v-flex>
			</v-layout>
			<label for="banner" id="banner-button" class="btn btn-raised white--text blue darken-3 btn--active">Change Banner Image</label>
			<input type="file" @change="onFileChange" id="banner" style="display: none;">
		</header>

		<hr>

		<section id="tours">
			<header>
				<h2>Booked Tours</h2>
			</header>
			<v-layout row>
				<v-flex xs6 md3>
					<v-card :to=" '/band/' + band.slug + '/tour' " color="success" class="card white--text" data-ripple="true">
						<div class="text-xs-center">
							<v-icon color="white">add</v-icon>
							<br>
							Add a Route.
						</div>
					</v-card>
				</v-flex>

				<v-flex xs6 md3 v-for="route in routes" :key="route.id">
					<v-card :to="'/band/' + band.slug + '/' +route.slug" color="primary" class="card white--text" data-ripple="true">
						<div class="text-xs-center">
							{{route.title}}
						</div>
					</v-card>
				</v-flex>

			</v-layout>
		</section>

		<br>
		<hr>

		<section id="contacts">
			<header>
				<h2>Band Info.</h2>
			</header>

			<v-layout row>

				<v-flex md6>

					<aside>
						<header>
							<h5>Soundcloud</h5>
						</header>
						<section>						
							<label for="soundcloud"><v-icon>mode_edit</v-icon> What is your Soundcloud url?</label>
							<input id="soundcloud" type="text" v-model="band.soundcloud_url">

								<iframe width="97%" height="300" scrolling="no" frameborder="no"
		  								:src="'https://w.soundcloud.com/player/?url=' + this.band.soundcloud_url">
								</iframe>

						</section>
					</aside>
					<div>
					</div>


				</v-flex>

				<v-flex md6>				

					<aside>
						<header>
							<h5>Bio</h5>
						</header>

						<label for="bio"><v-icon>mode_edit</v-icon> Let Venues, Booking Agents, Promoters, and your fans get to know you.</label>
						<textarea id="bio" rows="5" v-model="band.bio"></textarea>

					</aside>

				</v-flex>

			</v-layout>

		</section>

		<v-btn color="primary" @click="edit" class="fixed-bottom right crazy-btn">
			Save
		</v-btn>
		<div class="fixed-bottom left">
			<v-menu offset-y v-model="showMenu" absolute full-width>
				<v-btn fab raised color="primary" slot="activator" title="Toolbar">
					<v-icon color="white">more_vert</v-icon>
				</v-btn>
				<v-list style="background-color: transparent;">
					<v-list-tile>
						<v-btn @click="promptDestroy = true" color="error">Delete this band.</v-btn>
					</v-list-tile>
					<v-list-tile>
						<v-btn :href="'/bands/' + band.slug" color="success">See public page.</v-btn>
					</v-list-tile>
				</v-list>
			</v-menu>
		</div>

	</section>
	<v-alert color="error" value="true" v-if="promptDestroy" icon="warning">
		Are you sure you want to delete this band and all of its data?
		<v-btn flat @click="destroy" >Yes</v-btn> <v-btn flat @click="promptDestroy = false" color="white">Nevermind</v-btn>
	</v-alert>
</v-container>
</template>


<script>

export default{

	data(){
		return {
			band: '',
			token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			edited: false,
			errors: false,
			routes: '',
			image: '',
			loading: true,
			promptDestroy: false
		}
	},
	mounted(){
		axios.get('/api/band/' + this.$route.params.slug)
			.then(response => this.band = response.data);

		this.$nextTick(function(){
			axios.get('api/' + this.$route.params.slug + '/routes')
				.then(response => this.routes = response.data);		
		});

	},
	updated(){
		this.loading = false;
	},
	methods: {
		edit: function(){

			var data = new FormData();
			data.append('_token', this.token);
			data.append('_method', 'put');
			data.append('name', this.band.name);
			data.append('bio', this.band.bio);
			data.append('soundcloud_url', this.band.soundcloud_url);
			data.append('location', this.band.location);
	     	data.append('banner', document.getElementById('banner').files[0]);

			var config = {
		        headers: {'Content-Type': 'multipart/FormData'}
	      	};

			axios.post('/api/band/'+ this.band.id +'/edit', data, config)
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

			axios.post('/api/band/' + this.band.id + '/delete', data)
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
	    },
	    getAddressData: function (addressData, placeResultData) {
            this.band.location = addressData.locality + ', ' + addressData.administrative_area_level_1 + '. ' + addressData.country;

	    }
	},
	computed: {
		soundCloud: function(){
			return this.band.soundcloud_url
		},
		bannerImage: function(){
			return 'background-image: url(/storage/' + this.band.banner +' );'
		},
		banner: function(){
			return 'background-image: url(' + this.image +' );'
		}
	}
}

</script>

<style scoped>
textarea{
	resize: none;
	overflow: hidden;
}
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
.card{
	height: 200px !important;
	display: flex;
	justify-content: center;
	align-items: center;
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
.list > li {
	margin: 10px 0;
}
.list .list__tile {
	color: white !important;
}
</style>