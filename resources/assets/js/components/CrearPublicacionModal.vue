<template>
	<div class="modal fade" id="crearPublicacionModal" tabindex="-1" role="dialog" aria-labelledby="#crearPublicacionTitulo" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
					<h5 class="modal-title" id="crearPublicacionTitulo">Subir imagen en {{ nombreClub }}</h5>
				</div>
				<form id="crearPublicacionForm" class="post-action" @submit.prevent="crearPublicacion" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<h5>Información de la publicación</h5>
						<div class="form-group">
							<label for="tituloPublicacion">Título</label>
							<input type="text" name="titulo" id="tituloPublicacion" class="form-control" placeholder="¿Como te gustaría nombrar esta publicación?" required>
						</div>
						<div class="form-group">
							<label for="descripcionPublicacion">Descripción</label>
							<input type="text" name="descripcion" id="descripcionPublicacion" class="form-control" placeholder="Cuentanos acerca de esta imagen">
						</div>
						<div class="form-group">
							<label for="imagen">Imagen</label>
							<div class="row">
								<div class="col-xs-3">
									<img class="crop pull-left" id="prevPublicacion" width="100%" height="auto">
								</div>
								<div class="col-xs-9">
									<input type="file" @change="archivoSeleccionado" name="imagen" id="modalPublicacionInput" class="form-control" accept="image/*" required>
									<small>Elige una imagen</small>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="form-group text-center">
							<button type="submit">Crear</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
    export default {										
        mounted() {
            var _this = this;
            $('#prevPublicacion').attr('src', '/images/subir-imagen.png');
        },
        props: ['club', 'nombreClub', 'autorClub'],
        methods: {
            //previsualizar la imagen seleccionada...
            //http://stackoverflow.com/questions/18457340/how-to-preview-selected-image-in-input-type-file-in-popup-using-jquery
        	archivoSeleccionado(input){
            	const files = input.target.files;
            	if(files && files[0]){
            		const reader = new FileReader();
            		reader.onload = function(e){
            			$('#prevPublicacion').attr('src', e.target.result);
            		};
            		reader.readAsDataURL(files[0]);
            	}
                else{
                    $('#prevPublicacion').attr('src', '/images/subir-imagen.png');
                }
        	},
        	crearPublicacion(){
        		const _this = this;
        		const form = document.getElementById('crearPublicacionForm');
        		const datosPublicacion = new FormData(form);
        		datosPublicacion.append('_token', window.Laravel.csrfToken);
                datosPublicacion.append('club', this.club);
        		this.$http.post('/publicacion/crear', datosPublicacion)
        			.then((response) => {
                        $('#crearPublicacionModal').modal('hide');
                        $('#crearPublicacionForm').trigger('reset');
                        if(response.data.autor == _this.autorClub){
                        	_this.concatenarPublicacion(response.data);
                        }
        			});
        	},
        	concatenarPublicacion(_data){
                $("#publicacion-scroller").trigger("crearPublicacion", [{
                	id: _data.id,
                	titulo: _data.titulo,
                	contenidoMinRuta: _data.contenidoMinRuta,
                	megusta:"0", 
                	comentarios:"0", 
                	visitas:"0"
                }]);
        	}
        }
    }
</script>