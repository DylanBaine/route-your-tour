<template>
      <v-card color="grey lighten-4" flat>
        <v-card-title class="headline">Login</v-card-title>
		<form action="/login" method="post">
	        <v-card-text>

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

	        </v-card-text>
	        <v-card-actions>
	          <v-spacer></v-spacer>
	          <v-btn type="submit" color="blue darken-1" flat>Login</v-btn>
	          <v-btn color="red darken-1" flat @click="$emit('closeThis')">Close</v-btn>
	        </v-card-actions>
			
		</form>
      </v-card>
</template>

<script>
export default{
	data(){
		return{
			csrf: document.head.getElementByQuerySelector('meta[name=csrf-token]')
		}
	},
	mounted(){
	}
}
	
</script>

<style scoped>
.card{
	width: 50vw;
	position: absolute;
	top: 20vh;
	z-index: 999;
	background-color: white;
	left: 25vw;
}
</style>