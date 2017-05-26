<template>
	<div class="modal fade" id="editarUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="#editarUsuarioTitulo" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
					<h5 class="modal-title" id="editarUsuarioTitulo">Editar información personal</h5>
				</div>
				<form id="editarUsuarioForm" class="post-action" @submit.prevent="editarUsuario" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" :value="token">
					<div class="modal-body">
						<h5>Información de usuario</h5>
						<div class="form-group">
							<label class="control-label" for="nombreUsuario">Nombre</label>
							<input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" placeholder="¿Como te gustaría llamarte?" :value="nombreUsuario" required>
                            <label class="control-label" for="correo">Correo electrónico</label>
                            <input type="email" name="correo" id="correoUsuario" class="form-control" placeholder="Dirección de correo electrónico" :value="correoUsuario" required>
                            <label class="control-label">Género</label>
                            <div class="radio">
                                <label><input type="radio" name="genero" id="generoUsuario" value="Hombre" :checked="generoUsuario=='Hombre'" required>Hombre</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="genero" id="generoUsuario" value="Mujer" :checked="generoUsuario=='Mujer'" required>Mujer</label>
                            </div>
                            
                            <label class="control-label" for="fechaNacimiento">Fecha de nacimiento</label>
                            <input type="date" name="fechaNacimiento" id="fechaUsuario" class="form-control" :value="fechaUsuario" required>
						</div>
						<div class="form-group">
							<label for="imagen">Imagen de usuario</label>
							<div class="row">
								<div class="col-xs-3">
									<img class="crop pull-left" id="prevUsuario" width="100" height="100">
								</div>
								<div class="col-sm-9 col-xs-12">
									<input type="file" @change="archivoSeleccionado" name="imagen" id="editarUsuarioInput" class="form-control" accept="image/*">
									<small>Elige la imagen avatar de usuario</small>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="form-group text-center">
							<button type="submit">Editar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
    	data(){
    		return {
                cropX : '',
                cropY : '',
                cropW : '',
                cropH : '',
    		}
    	},			
        props: [
            'nombreUsuario', 
            'correoUsuario', 
            'generoUsuario', 
            'fechaUsuario', 
            'avatarRuta',
            'token'
            ],                         
        mounted() {
            //console.log('Component mounted.');
            var _this = this;
            var timeStamp = 0;
            $('#prevUsuario').attr('src', "/"+this.avatarRuta);
            $('#prevUsuario')
            .crop({
                    width : 100,
                    height: 100,
                    loading: '',
                    controls : ''
                })
            .click(function(e){
                e.preventDefault();
            })
            .on('crop', function(event){
                event.stopImmediatePropagation();
                event.stopPropagation();
                event.preventDefault();
                //El hack más grande en la historia de jquery :(
                if(event.timeStamp - timeStamp > 5)
                {
                    //console.log(event);
                    _this.cropX = event.cropX;
                    _this.cropY = event.cropY;
                    _this.cropW = event.cropW;
                    _this.cropH = event.cropH;
                    timeStamp = event.timeStamp;
                }
                return false;
            });
        },
        methods: {
            //previsualizar la imagen seleccionada...
            //http://stackoverflow.com/questions/18457340/how-to-preview-selected-image-in-input-type-file-in-popup-using-jquery
        	archivoSeleccionado(input){
            	const files = input.target.files;
            	if(files && files[0]){
            		const reader = new FileReader();
            		reader.onload = function(e){
            			$('#prevUsuario').attr('src', e.target.result);
    					//this.archivo = files[0];
            		};
            		reader.readAsDataURL(files[0]);
            	}
                else{
                    $('#prevUsuario').attr('src', "/"+this.avatarRuta);
                }
        	},
        	editarUsuario(){
        		const form = document.getElementById('editarUsuarioForm');
        		const datosUsuario = new FormData(form);
        		//datosClub.append('_token', window.Laravel.csrfToken);
                datosUsuario.append('cropX', this.cropX);
                datosUsuario.append('cropY', this.cropY);
                datosUsuario.append('cropW', this.cropW);
                datosUsuario.append('cropH', this.cropH);
        		this.$http.post('/usuario/editar', datosUsuario)
        			.then((response) => {
                        $('#editaUsuarioModal').modal('hide');
                        //$('#editarUsuarioForm').trigger('reset');
        				window.location = window.location;
        			});
        	}
        }
    }
</script>