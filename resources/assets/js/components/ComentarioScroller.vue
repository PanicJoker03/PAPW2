<template>
	<div id="publicacion-scroller">
		<!-- SECCION DE COMENTAR -->
		<form class="form-group" id="form-comentar" @submit.prevent="crearEntrada" method="post">
			<input type="hidden" name="usuario" :value="usuario">
			<input type="hidden" name="publicacion" :value="publicacion">
			<label class="control-label" for="comentario">Comentar</label>
			<textarea id="comentario-textarea" class="form-control" name="comentario" form="form-comentar" required></textarea>
			<button type="submit">Comentar</button>
		</form>
		<!-- SECCION DE COMENTARIOS -->
		<ul class="list-group">
			<template v-for="item in items">
				<!-- Aquí puedes escribir todo el formato que quieras para los comentarios -->
				<!-- Es importante que todo este dentro de un li con un atributo :comentario="item.id" -->
				<li class="list-group-item" :comentario="item.id">
					<img class="img-rounded pull-left" :src="'/'+item.avatarMinRuta">
					<h4 class="list-group-item-heading">{{item.nombreUsuario}}<small>&emsp;{{item.created_at}}</small>
						<!-- Esta parte solo se va a generar si el usuario es autor del comentario -->
						<!-- Es importante que el botón tenga el atributo :comentario="item.id" -->
						<a v-if="item.usuario == usuario" :comentario="item.id" class=" badge btn btn-default pull-right" v-on:click="borrarEntrada"><span class="glyphicon glyphicon glyphicon-trash"></span></a>
						<a v-if="item.usuario == usuario" :comentario="item.id" class="botonEditar badge btn btn-default pull-right" v-on:click="abrirEdicion(item.id)"><span class="glyphicon glyphicon glyphicon-pencil"></span></a>
					</h4>
					<p id="comentarioTexto" :comentario="item.id" class="list-group-item-text">{{item.comentario}}</p>
					<form v-if="item.usuario == usuario" :comentario="item.id" @submit.prevent="editarEntrada(item.id)" class="form-editarComentario" method="post" hidden>
						<input type="text" class="form-control" name="comentario" :value="item.comentario">
						<button type="submit">Editar</button>
						<a class="btn btn-default botonCancelar" :comentario="item.id" v-on:click="cerrarEdicion(item.id)">Cancelar</a>
					</form>
				</li>
			</template>
		</ul>
	</div>
</template>
<script type="text/javascript">
	export default{
		props: ['src', 'usuario', 'publicacion'],
		data(){
			return{
				parametroOrdenamiento: 'created_at',
				paramGuia: Number.MAX_SAFE_INTEGER,
				items: [],
				entradasPorPaginacion: 5,
				cargandoEntradas: false
			}
		},
		mounted(){
			const _this = this;
			_this.cargarEntradas();
			//Registramos el evento de cuando terminamos de desplazar la página
			//código cortesía de http://stackoverflow.com/questions/3898130/check-if-a-user-has-scrolled-to-the-bottom
			var _window = $(window);
			var _document = $(document);
			_window.scroll(function(){
				if(_window.scrollTop() + _window.height() == _document.height()){
					if(!_this.cargandoEntradas)
						_this.cargarEntradas();
				}
			});
		},
		methods: {
			cargarEntradas()
			{
        		const _this = this;
        		_this.cargandoEntradas = true;
				_this.$http.get(_this.src, {params: {paramGuia : _this.paramGuia, cantidad : _this.entradasPorPaginacion }})
				.then((response) => {
					const _data = response.data;
					for(var object in _data){
						_this.items.push(_data[object]);
					}
					_this.paramGuia = _this.ultimo(_data)[_this.parametroOrdenamiento];
					_this.cargandoEntradas = false;
				});
			},
			ultimo(_objeto)
			{
				return _objeto[Object.keys(_objeto)[Object.keys(_objeto).length - 1]];
			},
			borrarEntrada(event)
			{
				const comentario = $(event.target).closest('a').attr("comentario");
				const items = this.items;
				this.$http.post('/comentario/'+ comentario +'/borrar', this.formToken())
				.then((response) => {
					//selecciona el contenedor del comentario
					const selector = "li[comentario="+ comentario +"]";
					$(selector).hide("fast");
				});
				//console.log(comentario);
			},
			crearEntrada()
			{
				const items = this.items;
        		const form = document.getElementById('form-comentar');
        		const datosComentario = new FormData(form);
        		datosComentario.append('_token', window.Laravel.csrfToken);
				this.$http.post('/comentario/crear', datosComentario)
				.then((response) => {
					$('#comentario-textarea').val('');
					items.unshift(response.data[0]);
				});
			},
			abrirEdicion(comentario)
			{
				$(".botonEditar[comentario='"+ comentario +"']").hide("fast");
				$(".form-editarComentario[comentario='"+ comentario +"']").show("fast");
			},
			cerrarEdicion(comentario)
			{
				$(".botonEditar[comentario='"+ comentario +"']").show("fast");
				$(".form-editarComentario[comentario='"+ comentario +"']").hide("fast");
			},
			editarEntrada(comentario)
			{
        		const comentarioText = $(".form-editarComentario[comentario='"+ comentario +"'] input[type='text']").val();
        		const datosComentario = this.formToken();
        		datosComentario.append('comentario', comentarioText);
				this.$http.post('/comentario/'+ comentario +'/editar', datosComentario)
				.then((response) => {
					$("#comentarioTexto[comentario='"+comentario+"']").text(comentarioText);
				});
				this.cerrarEdicion(comentario);
			},
			formToken(){
        		let token = new FormData();
        		token.append('_token', window.Laravel.csrfToken);
        		return token;
			}
		}
	}
</script>