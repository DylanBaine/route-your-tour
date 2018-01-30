<template>
<header>
	<div>		
		<v-tabs dark>
			<v-tabs-bar class="white--text">
				<v-spacer></v-spacer>
				<li><v-btn flat class="white--text hidden-sm-and-up"><small>Swipe this to the left to see more pages.</small></v-btn></li>
				<li v-if="!frontPage"><v-btn href="/" flat class="white--text">Front Page</v-btn></li>
				<li><v-btn v-show="!user" href="/register" flat class="white--text">Register</v-btn></li>
				<li><v-btn v-show="!user" href="/login" flat class="white--text">Login</v-btn></li>
				<li><v-btn v-show="user" href="/home#" flat class="white--text">Go To Dashboard</v-btn></li>
				<li v-if="!pricingPage"><v-btn href="/pricing" flat class="white--text">Pricing</v-btn></li>

			</v-tabs-bar>
		</v-tabs>
	</div>
	<pages-nav></pages-nav>
</header>
</template>

<script>
export default{
	data () {
		return{
			login: false,
			register: false,
			user: '',
			frontPage: window.location.pathname == '/' ? true : false,
			pricingPage: window.location.pathname == '/pricing' ? true : false,
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
      axios.get('/api/user').then(response => this.user = response.data.name);9
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