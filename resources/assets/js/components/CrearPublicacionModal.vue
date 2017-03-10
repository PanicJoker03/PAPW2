<template>
	<div class="modal fade" id="crearPublicacionModal" tabindex="-1" role="dialog" aria-labelledby="#crearPublicacionTitulo" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
					<h5 class="modal-title" id="crearPublicacionTitulo">Subir imagen</h5>
				</div>
				<form id="crearPublicacionForm" class="vue-form" @submit.prevent="crearPublicacion" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<h5>Información de la publicación</h5>
						<div class="form-group">
							<label for="tituloPublicacion">Título</label>
							<input type="text" name="tituloPublicacion" id="tituloPublicacion" class="form-control" placeholder="¿Como te gustaría nombrar esta publicación?" required>
						</div>
						<div class="form-group">
							<label for="descripcion">Descripción</label>
							<input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Cuentanos acerca de esta imagen">
						</div>
						<div class="form-group">
							<label for="imagen">Imagen</label>
							<div class="row">
								<div class="col-xs-3">
									<img class="crop pull-left" id="prevPublicacion" width="100" height="100">
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
            console.log('Component mounted.');
            var _this = this;
            //var timeStamp = 0;
        },
        methods: {
            //previsualizar la imagen seleccionada...
            //http://stackoverflow.com/questions/18457340/how-to-preview-selected-image-in-input-type-file-in-popup-using-jquery
        	archivoSeleccionado(input){
            	const files = input.target.files;
            	if(files && files[0]){
            		const reader = new FileReader();
            		reader.onload = function(e){
            			$('#prevPublicacion').attr('src', e.target.result);
    					//this.archivo = files[0];
            		};
            		reader.readAsDataURL(files[0]);
            	}
        	},
        	crearPublicacion(){
        		const form = document.getElementById('crearPublicacionForm');
        		const datosPublicacion = new FormData(form);
        		datosPublicacion.append('_token', window.Laravel.csrfToken);
        		this.$http.post('/publicacion/crear', datosPublicacion)
        			.then((response) => {
                        //ocultar modal
        				//window.location.replace('./Publicacion/' + response.data.id);
        			});
        	}
        }
    }
</script>