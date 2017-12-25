<template>
	<transition name="fade">
		<div class="cont">
			<div class="text-xs-center">
				<v-progress-circular indeterminate size="70" width=7 color="primary"></v-progress-circular>	
				<h5 class="black--text"><slot/></h5>
			</div>	
		</div>
	</transition>
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
		background-color: rgba(255, 255, 255, .9);
		z-index: 999;
	}
	h5{
		min-height: 28px;
	}
</style>