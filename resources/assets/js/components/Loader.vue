<template>
	<transition name="fade">
		<div class="cont">
			<div class="text-xs-center">
				<v-progress-circular indeterminate :size="size" :width="width" color="primary"></v-progress-circular>	
				<h5 class="black--text"><slot/></h5>
			</div>	
		</div>
	</transition>
</template>

<script>
	export default {
		data(){
			return {
				width: 3,
				size: 70
			}
		}
	}
</script>

<style scoped>
	.cont{
		height: 100vh;
		width: 100vw;
		left: 0;
		top: 0;
		position: fixed;
		display: flex;
		justify-content: center;
		align-items: center;
		background-color: rgba(255, 255, 255, .9);
		z-index: 999;
	}
	h5{
		min-height: 28px;
	}
</style>