<template>
	<v-container>
		<loader v-if="loading">Loading your settings...</loader>
		<v-alert v-show="edited" color="success" icon="check_circle">
			<p>Successfully edited...</p>
			<p>Going back home.</p>
		</v-alert>

		<header class="padded">
			<h1>Settings</h1>
		</header>
		<hr>
		<section id="forms">
			<v-layout row wrap>
				<v-flex xs12 md6>
					<div class="padded">
						<v-text-field
							@keydown="changed = true"
							v-model="user.name"
							label="Change your name."
							></v-text-field>
					</div>
				</v-flex>
				<v-flex xs12 md6>
					<div class="padded">
						<v-text-field
							@keydown="changed = true"
							v-model="user.email"
							label="Change your email."
							></v-text-field>
					</div>
				</v-flex>								
			</v-layout>
			<v-layout row wrap>
				<v-flex xs12 md6>
					<div class="padded">
						<v-text-field
							@keydown="changed = true"
							v-model="user.password"
							label="Change your password."
							></v-text-field>
					</div>
				</v-flex>
				<v-flex xs12 md6 class="flex-center padded">
					<v-select
						@change="changed = true"
						label="Choose your dashboard theme."
						v-model="user.theme"
						:items="items"
						item-value="text"
						></v-select>
				</v-flex>
				<v-flex xs12 md7>
					<v-layout row wrap class="padded pos-ref">	
						<v-flex md6 sm12 class="text-xs-center">
							<v-avatar v-if="!image" size="200px" slot="activator" title="Choose a profile image.">
								<img :src="'/storage/'+ user.avatar" alt="Upload Avatar">
							</v-avatar>

							<v-avatar v-if="image" size="200px" slot="activator" title="Choose a profile image.">
								<img :src="image" :alt="user.name">
							</v-avatar>
						</v-flex>

						<v-flex sm12 md6>
							<label for="image" class="btn btn-raised white--text blue darken-2 btn--active" id="img-btn" data-ripple="true">Choose an image</label>
							<input name="avatar" type="file" @change="promptProfilePic" id="image" style="display: none">
						</v-flex> 
					</v-layout>

				</v-flex>
				<v-flex xs1 md1></v-flex>
				<v-flex xs10 md3 class="flex-center padded-lg">
					<div>
						<label>Subscribed to newsletter</label>
						<v-switch @change="changed=true" color="primary" v-model="user.newsletter"></v-switch>
					</div>
				</v-flex> 
			</v-layout>

		</section>

		<div class="fixed-bottom right">
			<transition name="fade">
				<v-btn v-if="changed" color="primary" @click="editUser">
					Update Profile
				</v-btn>
			</transition>
		</div>
	</v-container>
</template>

<script>
	export default {
		data(){
			return {
				user: {},
				changed: false,
				token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
				edited: false,
				items: [{text: 'dark'},{text: 'light'}],
				loading: true,
				img: '',
				avatarPreview: ''
			}
		},
		mounted(){
			this.getUser();
			console.log(this.$parent.$parent.$parent.image)
		},
		updated(){
			this.loading = false;
		},
		methods: {
			promptProfilePic: function(){
				this.$parent.onFileChange();
			},
			getUser: function(){
				axios.get('/api/user').then(response => this.user = response.data);
			},
			editUser: function(){
				axios.put('/api/user', {
					name: this.user.name,
					email: this.user.email,
					password: this.user.password,
					theme: this.user.theme,
					newsletter: this.user.newsletter
				}).then(response => this.emitSuccess())
				.catch(error => {
					alert(error = ' errors occured');
				});
			},
			emitSuccess: function(){	
				this.edited = true;
				this.changed = false;
				this.user.password = '';
				window.location.href= '/home'
			}
		},
		computed: {
			image: function(){
				return this.$parent.$parent.$parent.image;
			}
		}
	}
	
</script>

<style scoped>
	#img-btn{
		position: absolute;
		bottom: 10px;
		left: 50%;
	}
</style>