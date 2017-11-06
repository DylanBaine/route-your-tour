<template>
<header>
	<div>
		
		<v-tabs dark>

			<v-tabs-bar class="white--text">
				<v-spacer></v-spacer>
				<li><v-btn v-show="!user" @click="showRegister" flat class="white--text">Register</v-btn></li>
				<li><v-btn v-show="!user" @click="showLogin" flat class="white--text">Login</v-btn></li>			
				<li><v-btn v-show="user" href="/home#" flat class="white--text">Go To Dashboard</v-btn></li>
			</v-tabs-bar>

		</v-tabs>
		<transition name="fade">
			<register-form v-show="register" @closeThis="hide">
			</register-form>
		</transition>
		<transition name="fade">
			<login-form v-show="login" @closeThis="hide">
			</login-form>
		</transition>

	</div>
</header>
</template>

<script>
export default{
	data () {
		return{
			login: false,
			register: false,
			user: ''
		}
	},
	methods: {
		showLogin: function(){
			if(this.login == false){
				this.login = true;
			}
			this.register = false;
		},
		showRegister: function(){
			if(this.register == false){
				this.register = true;
			}
			this.login = false;
		},
		hide: function(){
			this.register = false
			this.login = false
		}		
	},
	created () {
	},
    mounted(){
      axios.get('/api/user').then(response => this.user = response.data.name);
    }
}
	
</script>

<style scoped>
header{
	z-index: 9;
	position: fixed;
	width: 100vw;
}
#title{
	display: flex;
	align-items: center;
	position: absolute;
	top: 0;
	height:400px;
	padding: 30px;
	background-color: rgba(0,0,109,.3);
	color: white; 
	width: 100vw;
}
</style>