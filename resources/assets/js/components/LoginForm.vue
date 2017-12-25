<template>
      <v-card>
        <v-card-title class="headline">Login</v-card-title>
		<form action="/login" method="post">

        	<input type="hidden" :value="csrf" name="_token">

				<div class="padded">
					
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

		            <input type="checkbox" name="remember">
		            <label for="">Remember me.</label>

		         </div>   
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
			csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
		}
	},
	mounted(){
		console.log(document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
	}
}
	
</script>

<style scoped>
.card{
	z-index: 999;
	background-color: white;
	margin: 0 auto;
}
</style>