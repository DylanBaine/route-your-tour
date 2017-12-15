<template>
	<v-container>
		<v-alert v-show="edited" color="success" icon="check_circle">
			<p>Successfully edited...</p>
			<p>Going back home.</p>
		</v-alert>

		<header>
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
				<v-flex xs12 md6 class="flex-center">
					<v-select
						@change="changed = true"
						label="Choose your dashboard theme."
						v-model="user.theme"
						:items="items"
						item-value="text"
						></v-select>
				</v-flex>
			</v-layout>

				<div class="margin-auto">
					<v-chip v-if="user.email_verivied" color="success" text-color="white">
						Your email is verified.
					</v-chip>
					<div class="white--text red padded rounded" v-if="!user.email_verified">
						<header>
							Email not verified.	
						</header>						
						<v-btn @click="verifyEmail">
							Resend verification.
						</v-btn>
					</div>
				</div>

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
				items: [{text: 'dark'},{text: 'light'}]
			}
		},
		mounted(){
			this.getUser();
		},
		methods: {
			getUser: function(){
				axios.get('/api/user').then(response => this.user = response.data);
			},
			editUser: function(){

				axios.put('/api/user', {
					name: this.user.name,
					email: this.user.email,
					password: this.user.password,
					theme: this.user.theme
				}).then(response => this.emitSuccess())
				.catch(error => {
					alert(error = ' errors occured');
				});
			},
			verifyEmail: function(){
				alert('sending email')
			},
			emitSuccess: function(){
				this.edited = true;
				this.changed = false;
				this.user.password = '';
				window.location.href= '/home'
			}
		}
	}
	
</script>

<style>
	
</style>