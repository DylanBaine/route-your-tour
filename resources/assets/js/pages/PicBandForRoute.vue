<template>
	<v-container grid-lis-xl>
		<loader v-if="loading">Looking for bands...</loader>
		<header class="padded text-xs-center">
			<h2>Choose A Band</h2>
		</header>
		<section id="add" class="padded text-xs-center">
			<v-btn color="primary" to="profiles/add/band" class="padded">
				Add band <v-icon>add</v-icon>
			</v-btn>
		</section>		

		<v-layout row wrap id="bands">
			<v-flex md4 xs12 v-for="band in bands" :key="band.id" >
				<v-card data-ripple="true" :to="'/band/' + band.slug + '/tour'" color="orange" class="card text-xs-center flexed white--text">
					{{band.name}}
				</v-card>
			</v-flex>
		</v-layout>
	</v-container>
</template>

<script>
	export default {
		data(){
			return {
				bands: '',
				loading: true
			}
		},
		mounted(){
			axios.get('/api/users-bands')
				.then(response => this.bands = response.data);			
		},
		updated(){
			this.loading = false;
		}
	}
	
</script>

<style scoped>
	.card{
		height: 220px !important;
	}
	.flexed{
		display: flex;
		justify-content: center;
		align-items: center;
	}	
</style>