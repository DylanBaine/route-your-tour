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
			<h3 class="text-xs-center">You are editing your promoter profile. <br/> Change whatever you would like.</h3>			
		</header>
		</header>

		<section id="editor">
			
			<header class="padded">
				<label for="name"><v-icon>mode_edit</v-icon></label>
				<h1><textarea id="name" class="text-xs-center" v-model="promoter.name"></textarea></h1>
			</header>
			<hr>
			<section id="body" class="padded">

				<header class="padded">
					<h2>Promoters Experience</h2>
				</header>
				
				<label for="experience"><v-icon>mode_edit</v-icon></label>
				<textarea id="experience" rows="10" cols="10" v-model="promoter.experience"></textarea>		

			</section>

			<v-btn color="primary" @click="edit" class="fixed-bottom right">
				Save
			</v-btn>

			<div class="fixed-bottom left">
				<v-menu offset-y v-model="showMenu" absolute full-width>
					<v-btn fab raised color="primary" slot="activator" title="Toolbar">
						<v-icon color="white">more_vert</v-icon>
					</v-btn>
					<v-list style="background-color: transparent;">
						<v-list-tile>
							<v-btn @click="promptDestroy = true" color="error">Delete this Profile.</v-btn>
						</v-list-tile>
						<v-list-tile>
							<v-btn :href="'/promoters/' + promoter.slug" color="success">See public page.</v-btn>
						</v-list-tile>
					</v-list>
				</v-menu>
			</div>

		</section>

		<v-alert color="error" value="true" v-if="promptDestroy" icon="warning">
			Are you sure you want to delete this profile and all of its data?
			<v-btn flat @click="destroy" >Yes</v-btn> <v-btn flat @click="promptDestroy = false" color="white">Nevermind</v-btn>
		</v-alert>
	</v-container>
</template>

<script>
export default{
	data(){
		return {
			promoter: '',
			token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			edited: false,
			errors: false,
			promptDestroy: false
		}
	},
	methods: {

	},
	mounted(){

		axios.get('/api/promoter')
			.then(({data}) => this.promoter = data);

	},
	methods: {
		edit: function(){

			var data = new FormData();
				data.append('_token', this.token);
				data.append('_method', 'put');
				data.append('name', this.promoter.name);
				data.append('experience', this.promoter.experience);
				data.append('slug', this.promoter.slug);

			axios.post('/api/promoter/'+ this.promoter.id +'/edit', data)
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

			axios.post('/api/promoter/' + this.promoter.id + '/delete', data)
				.then(window.location.href="/home#/profile/add");
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
.list > li {
	margin: 10px 0;
}
.list .list__tile {
	color: white !important;
}
</style>