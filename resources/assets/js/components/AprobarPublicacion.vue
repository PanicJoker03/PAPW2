<template>
	<div v-bind:publicacion-id="publicacion">
		Cargando...
	</div>
</template>
<script type="text/javascript">
	export default{
		data(){
			return {
				titulo : '',
				descripcion : '',
			}
		},
		mounted(){
			this.$http.get('/publicacion/' + this.publicacion)
			.then((response) => {
				$("div[publicacion-id='" + this.publicacion + "']").text(response.data.id);
			});
		},
		props: ['publicacion'],
		methods: {
			aprobar(){

			},
			desaprobar(){

			}
		}
	}
</script>