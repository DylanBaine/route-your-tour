<template>
      <v-card>
        <v-card-title class="headline">Register</v-card-title>
		<form action="/register" method="post">

			<v-card-text>

	            <v-text-field
					name="name"
					label="Name"
					id="name-input"
	            ></v-text-field>

	            <v-text-field
					name="email"
					label="Email"
					id="email-input"
	            ></v-text-field>

	            <v-text-field
					name="password"
					label="Password"
					id="password-input"
					type="password"
	            ></v-text-field>

	            <v-text-field
					name="password_confirmation"
					label="Password"
					id="password-input"
					type="password"
	            ></v-text-field>

	        </v-card-text>

	        <v-card-actions>
	          <v-spacer></v-spacer>
	          <v-btn type="submit" color="blue darken-1" flat>Register</v-btn>
	          <v-btn color="red darken-1" flat @click="$emit('closeThis')">Close</v-btn>
	        </v-card-actions>
			
		</form>
      </v-card>
</template>

<script>
	
</script>

<style scoped>
.card{
	width: 50vw;
	z-index: 999;
	background-color: white;
	left: 25vw;
}	
	
</style>