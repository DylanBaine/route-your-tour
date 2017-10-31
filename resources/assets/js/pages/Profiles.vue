<template>
	<v-container grid-list-xl>
		<header class="padded">
			<h1>All of your current profiles.</h1>
		</header>

		<hr>

		<section id="profiles" class="padded">
			
			<v-layout row wrap id="bands">
				<v-flex xs4 v-for="profile in profiles" :key="profile.id" >
					<v-card :to="'/profile/' + profile.slug" color="primary" class="card text-xs-center flexed white--text">
						{{profile.name}}
					</v-card>
				</v-flex>
			</v-layout>

		</section>

	</v-container>
</template>

<script>
export default{
	data(){
		return{
			profiles: [],			
		}

	},
	mounted(){
		axios.get('api/users-profiles/')
			.then(response => this.profiles = response.data);

	}
}
	
</script>

<style scoped>
	.card{
		height: 300px !important;
	}
	.flexed{
		display: flex;
		justify-content: center;
		align-items: center;
	}
</style>