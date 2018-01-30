<template>
	<v-container>
		<form :action="url" method="get">
			
			<v-text-field
				name="search"
				placeholder="Start typing..."
				@keydown="getPreview"
				v-model="searchParam"
				:rules="paramRules"
			></v-text-field>

			<div v-if="loading.showing" class="text-xs-center">
				{{loading.message}}
			</div>

			<transition name="drop">
				<v-list two-line v-if="searchPreviews" id="searchPreviews">
					<v-list-tile v-for="searchPreview in searchPreviews" v-bind:key="searchPreview.title" :href="'/' + searchfor + 's/' +searchPreview.slug">
					  <v-list-tile-content>
						<v-list-tile-title>{{searchPreview.name}}</v-list-tile-title>
					  	<v-list-tile-sub-title>{{searchPreview.location || searchPreview.address}}</v-list-tile-sub-title>
					  </v-list-tile-content>
					  <v-list-tile-action>
						{{searchPreview.category || searchPreview.primary_genre}}
					  </v-list-tile-action>
					</v-list-tile>
				</v-list>
			</transition>
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
			loading: {
				showing: false,
				message: 'Looking....'
			},
			paramRules: [
				(v) => v.length > 3 || 'Must have 4 characthers to search with.'
			]
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
			if(this.searchReady){
				this.loading.showing = true;
				this.loading.message = 'Looking...';				
				this.searchPreviews = [];
				axios.get('/api/' + this.searchfor + '/search/param=' + this.searchParam)
					.then((res) =>{
						if(res.data.length > 0){
							this.searchPreviews = res.data;
							this.loading.showing = false;
						}else{
							this.searchPreviews = false;				
							this.loading = {
								showing: true,
								message: 'No results for "' + this.searchParam + '."'
							};
						}
					});
			}else{
				this.loading.showing = false;
				this.loading.message = false;
				this.searchPreviews = false;
			}
		}

	},
	computed: {
		searchReady: function(){
			return this.searchParam.length > 2 ? true : false;
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