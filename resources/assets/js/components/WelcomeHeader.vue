<template>
<header>
	<gmap-map
	  :center="{lat:36.084621, lng:-96.921387}"
	  :zoom="5"
	  style="width: 100vw; height: 400px"
	></gmap-map>

	<div id="title">
		<div>
			<h1>Welcome to Route Your Tour</h1>
			<h3>The visual tour builder for bands</h3>
		</div>
	</div>

	<v-tabs dark centered>

		<v-tabs-bar class="white--text">
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
			console.log(this.login)
		},
		showRegister: function(){
			if(this.register == false){
				this.register = true;
			}
		},
		hide: function(){
			this.register = false
			this.login = false
		}		
	},
	created () {
		window.onscroll = function (e) {
    		document.getElementById('title').style.top = window.scrollY/3 + 'px';
    		console.log(window.scrollY); 
		};
	},
    mounted(){
      axios.get('/api/user').then(response => this.user = response.data.name);
    }
}
	
</script>

<style scoped>
header{
	position: relative;
	overflow-y: hidden;
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