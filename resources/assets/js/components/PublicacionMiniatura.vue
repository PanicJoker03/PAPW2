<template>
	<div v-bind:publicacion-id="publicacion">
		<img class="img-responsive center-block" v-bind:img-source="src">
	</div>
</template>
<script type="text/javascript">
	export default{
		props: ['publicacion', 'img-source'],
		mounted(){

		},
		methods: {
		}
	}
</script>