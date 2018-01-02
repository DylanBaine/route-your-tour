<template>
	<v-card>
	<v-card-title class="headline">
		Login
		<v-spacer></v-spacer>
		<small>Not a member? <a href="/register">Register</a></small>
		
	</v-card-title>
	<v-form action="/login" method="post" v-model="valid">

		<input type="hidden" :value="csrf" name="_token">

			<div class="padded">
				
				<v-text-field
					name="email"
					label="Email"
					id="email-input"
					:rules="emailRules"
					required
					v-model="email"
				></v-text-field>

				<v-text-field
					name="password"
					label="Password"
					id="password-input"
					type="password"
					:rules="passwordRules"
					required
					v-model="password"
				></v-text-field>

				<input type="checkbox" name="remember">
				<label for="">Remember me.</label>

			 </div>   
		<v-card-actions>
		  <v-spacer></v-spacer>
		  <v-btn type="submit" color="green darken-1" flat>Login</v-btn>
		</v-card-actions>
		
	</v-form>
	</v-card>
</template>

<script>
export default{
	data(){
		return{
			csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			valid: false,
			email: '',
			password: '',
			emailRules: [
				(v) => !!v || 'E-mail is required',
				(v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be a valid email'
			],
			passwordRules: [
				(v) => !!v || "You must enter a password."
			]
		}
	}
}
	
</script>

<style scoped>
.card{
	background-color: white;
	margin: 0 auto;
}
</style>