<template>
	<div id="publicacion-scroller">
		<template v-for="item in items">
			<!-- Aquí puedes escribir todo el formato que quieras para las entradas de las publicaciones -->
			<div class="col-sm-4">
				<a :href="'/publicacion/' + item.id + '/vista'">
					<img :src="'/'+item.contenidoMinRuta">
				</a>
				<p>Titulo: {{item.titulo}}</p>
				<p>Comentarios: {{item.comentarios}}</p>
			</div>
		</template>
	</div>
</template>
<script type="text/javascript">
	export default{
		props: ['src'],
		data(){
			return{
				parametroOrdenamiento: 'id',
				paramGuia: Number.MAX_SAFE_INTEGER,
				items: [],
				entradasPorPaginacion: 15,
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
			}
		}
	}
</script>