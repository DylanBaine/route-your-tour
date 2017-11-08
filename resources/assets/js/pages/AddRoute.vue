<template>

	<v-container>
		<header class="padded text-xs-center">
			<img src="Defaults/logo-black.png" alt="Route Your Tour" width="300px">
		</header>

		<section class="flex-center height">

			<div class="half-w text-xs-center">
				
				<v-text-field
					v-model="title"
					label="Name this tour"
				></v-text-field>

				<div class="slug grey--text"><label>Your url will be: <br> </label>www.routeyourtour.com/{{band.slug}}/<span class="yellow lighten-3">{{slug}}</span><input type="hidden" :value="slug" name="slug"></div>

				<v-btn flat color="blue lighten-1" @click="newRoute">
					Next Step
				</v-btn>
			

			</div>
			
		</section>

	</v-container>
	
</template>

<script>
export default{
	data(){
		return{
			band: '',
			token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			created: false,
			title: '',
		}
	},
	mounted(){
		axios.get('/api/band/' + this.$route.params.slug)
			.then(response => this.band = response.data);
	},
	methods: {
		newRoute: function(){
			axios.post('api/band/add-route', {
				title: this.title,
				slug: this.slug,
				band_id: this.band.id,
				_token: this.token,
			})
			.then(response => window.location.href ='/home#/band/' + this.band.slug + '/' + this.slug);

		}

	},
	computed: {
		slug: function(){
			return Slug(this.title);
		},
	}
}
	
</script>

<style scoped>
.height{
	height: 50vh;
}
.half-w{
	width: 500px;
	margin: 0 auto;
	max-width: 90vw;
}
	
</style>