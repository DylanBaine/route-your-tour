<template>
<div id="cont">
	
	<div id="pages">
		
		<v-tabs dark>

			<v-tabs-bar class="white--text">
				<v-spacer></v-spacer>
				<li><v-btn href="/bands" flat class="white--text">All Bands</v-btn></li>
				<li><v-btn href="/venues" flat class="white--text">All Venues</v-btn></li>
				<li><v-btn href="/tours" flat class="white--text">Upcoming Tours</v-btn></li>
				<li><v-btn href="/promoters" flat class="white--text">All Promoters</v-btn></li>
				<li><v-btn href="/booking-agents" flat class="white--text">All Booking Agents</v-btn></li>
			</v-tabs-bar>

		</v-tabs>

	</div>

	<v-btn id="button" icon color="primary" @click="showPages">
		<v-icon color="white">{{active ? 'keyboard_arrow_right' : 'keyboard_arrow_left'}}</v-icon>
	</v-btn>
</div>

</template>

<script>
	export default{
		data(){
			return{
				active: false

			}
		},
		methods: {
			showPages: function(){

				if(!this.active){
					document.querySelector('#pages').style.marginLeft = 0;
					document.querySelector('#button').style.left = '10px';
					this.active = true;
				}else{
					document.querySelector('#pages').style.marginLeft = '100vw';
					document.querySelector('#button').style.left = 'auto';
					document.querySelector('#button').style.right = '5px';
					document.querySelector('#button').style.top = '-1px'
					this.active = false
				}

			}
		}
	}
</script>

<style scoped>
	#pages{
		margin-left: 100vw;
		transition: all .3s;
		position: relative;
		width: 100vw;
		box-sizing: border-box;
		border-top: solid 2px rgba(0,0,0,.5);
		background-color: #7f7de3;
	}
	#cont{
		position: relative;
		overflow-x: hidden;
	}
	#button{
		transition: all .2s;
	    position: absolute;
	    right: 5px;
	    top: -1px
	}
</style>