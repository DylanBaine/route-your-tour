<template>
      <v-card>
        <v-card-title class="headline">
        	Register
        	<v-spacer></v-spacer>
        	<small>Already a member? <a href="/login">Login here.</a></small>

        </v-card-title>
		<v-form action="/register" method="post" v-model="valid">

			<v-card-text>

	            <v-text-field
					name="name"
					label="Name"
					id="name-input"
					:rules="nameRules"
					v-model="name"
					required
	            ></v-text-field>

	            <v-text-field
					name="email"
					label="Email"
					id="email-input"
					:rules="emailRules"
					v-model="email"
					required
	            ></v-text-field>

	            <v-text-field
					name="password"
					label="Password"
					id="password-input"
					type="password"
					:rules="passwordRules"
					v-model="password"
					required
	            ></v-text-field>

	            <v-text-field
					name="password_confirmation"
					label="Password"
					id="password-input"
					type="password"
					:rules="confirmPasswordRules"
					v-model="confirmPassword"
					required
	            ></v-text-field>

	        </v-card-text>

	        <v-card-actions>
	          <v-spacer></v-spacer>
	          <v-btn type="submit" color="green darken-1" flat>Register</v-btn>
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
			name: '',
			email: '',
			password: '',
			confirmPassword: '',
			nameRules: [
				(v) => !!v || 'Name is required',
			],
			emailRules: [
				(v) => !!v || 'E-mail is required',
				(v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be a valid email'
			],
			passwordRules: [
				(v) => !!v || "You must enter a password.",
				(v) => v.length > 8 || 'Email must be more than 8 characters'
			],
			confirmPasswordRules: [
				(v) => !!v || "Must match.",
				(v) => v == this.password || "Passwords must match."
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