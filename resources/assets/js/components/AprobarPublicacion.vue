<template>
	<div v-bind:publicacion-id="publicacion" hidden>
		<div class="panel panel-default">
			<div class="contenido panel-heading" hidden>
				<div class="btn-group btn-block">
				<form class="post-action" @submit.prevent="aprobar">
					<button type="submit" class="btn btn-success col-xs-6">Aprobar</button>
				</form>
				<form class="post-action" @submit.prevent="rechazar">
					<button type="submit" class="btn btn-danger col-xs-6">Rechazar</button>
				</form>
				</div>
			</div>
			<div class="panel-body">
				<div class="cargando text-center">
					Cargando...
				</div>
				<div class="contenido" hidden>
					<h3>{{ titulo }}</h3>
					<img class="img-responsive center-block" :src="imagenRuta">
					<p>{{ descripcion }}</p>
				</div>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	export default{
		props: ['publicacion'],
		data(){
			return {
				titulo : '',
				descripcion : '',
				imagenRuta: '',
				publicacionAprobar: ''
			}
		},
		mounted(){
			this.publicacionAprobar = $("div[publicacion-id='" + this.publicacion + "']");
			this.publicacionAprobar.show("fast");
			this.obtenerPublicacion();
		},
		methods: {
			obtenerPublicacion(){
				const _this = this;
				_this.$http.get('/publicacion/' + _this.publicacion)
				.then((response) => {
					const publicacionInfo = response.data;
					_this.titulo = publicacionInfo.titulo;
					_this.descripcion = publicacionInfo.descripcion;
					_this.imagenRuta = publicacionInfo.contenidoRuta;
					_this.mostrarContenido();
				});
			},
			aprobar(){
				/* envíar aprobacion */
        		//const token = new FormData();
        		//token.append('_token', window.Laravel.csrfToken);
				this.$http.post('publicacion/aprobar/' + this.publicacion, this.formToken()).
				then((response) => {
					this.remover();
				});
			},
			rechazar(){
				/* envíar rechazo */
        		//const token = new FormData();
        		//token.append('_token', window.Laravel.csrfToken);
				this.$http.post('publicacion/rechazar/' + this.publicacion, this.formToken()).
				then((response) => {
					this.remover();
				});
			},
			mostrarContenido(){
				const _this = this;
				_this.publicacionAprobar.find('div.contenido > img').on('load', function(){
					_this.publicacionAprobar.find("div.cargando").hide();
					_this.publicacionAprobar.find("div.contenido").show("fast");
				});
			},
			remover(){
				this.publicacionAprobar.hide("fast", function(){
					this.remove();
				});
			},
			formToken(){
        		let token = new FormData();
        		token.append('_token', window.Laravel.csrfToken);
        		return token;
			}
		}
	}
</script>