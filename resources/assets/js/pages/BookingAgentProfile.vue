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
			<h3 class="text-xs-center">You are editing your Booking Agent profile. <br/> Change whatever you would like.</h3>			
		</header>
		</header>

		<section id="editor">
			
			<header class="padded">
				<label for="name"><v-icon>mode_edit</v-icon></label>
				<h1><textarea id="name" class="text-xs-center" v-model="bookingAgent.name"></textarea></h1>
			</header>
			<hr>
			<section id="body" class="padded">

				<header class="padded">
					<h2>Booking Agents Experience</h2>
				</header>
				
				<label for="experience"><v-icon>mode_edit</v-icon></label>
				<textarea id="experience" rows="10" cols="10" v-model="bookingAgent.experience"></textarea>		

			</section>

			<v-btn color="primary" @click="edit" class="fixed-bottom right">
				Save
			</v-btn>

			<v-btn color="error" @click="destroy" class="fixed-bottom left">
				Delete this profile.
			</v-btn>

		</section>

	</v-container>
</template>

<script>
export default{
	data(){
		return {
			url: window.location.protocol + '//' + window.location.host,
			bookingAgent: '',
			token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			edited: false,
			errors: false
		}
	},
	methods: {

	},
	mounted(){

		axios.get(this.url + '/api/booking-agent')
			.then(({data}) => this.bookingAgent = data);

	},
	methods: {
		edit: function(){

			var data = new FormData();
				data.append('_token', this.token);
				data.append('_method', 'put');
				data.append('name', this.bookingAgent.name);
				data.append('experience', this.bookingAgent.experience);
				data.append('slug', this.bookingAgent.slug);

			axios.post('/api/booking-agent/'+ this.bookingAgent.id +'/edit', data)
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

			axios.post('/api/booking-agent/' + this.bookingAgent.id + '/delete', data)
				.catch(errors => console.log(errors))
				.then(window.location.href = '/home#/profile/add');
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
</style>