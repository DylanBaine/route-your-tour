<template>
	<div class="cont">
		<div class="text-xs-center">
			<v-progress-circular indeterminate v-bind:size="70" v-bind:width="7" color="purple"></v-progress-circular>	
			<h5><slot/></h5>
		</div>	
	</div>
</template>

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
	}
</style>