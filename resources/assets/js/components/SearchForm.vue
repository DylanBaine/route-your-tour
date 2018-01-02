<template>
	<v-container>
		<form :action="url" method="get">
			
			<v-text-field
				name="search"
				placeholder=""
				@keydown.native="getPreview"
				v-model="searchParam"
			></v-text-field>
			<v-list two-line v-if="searchPreviews" id="searchPreviews">
				<v-list-tile v-for="searchPreview in searchPreviews" v-bind:key="searchPreview.title" :href="searchfor + 's/' +searchPreview.slug">
				  <v-list-tile-content>
					<v-list-tile-title>{{searchPreview.name}}</v-list-tile-title>
				  	<v-list-tile-sub-title>{{searchPreview.location || searchPreview.address}}</v-list-tile-sub-title>
				  </v-list-tile-content>
				  <v-list-tile-action>
					{{searchPreview.category || searchPreview.primary_genre}}
				  </v-list-tile-action>
				</v-list-tile>
			</v-list>
			<v-btn color="primary" type="submit">
				{{searchPreviews ? 'See Results Page' : 'Search'}}
			</v-btn>

		</form> 
	</v-container>

</template>

<script>
export default {
	data(){
		return {
			searchParam: '',
			searchPreviews: false,
			loading: true
		}
	},
	props: [
		'searchfor',
		'url'
	],
	mounted(){

	},
	methods: {
		getPreview: function(){
			if(this.searchParam.length >= 3){
				axios.get('/api/' + this.searchfor + '/search/param=' + this.searchParam)
					.then((res) =>{
						this.searchPreviews = res.data;
					});
			}
		}

	}
}
	
</script>

<style scoped>
#searchPreviews{
	max-height: 400px;
	overflow: auto;
}
	
</style>