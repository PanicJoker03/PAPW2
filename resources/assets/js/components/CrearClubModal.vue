<template>
	<div class="modal fade" id="crearClubModal" tabindex="-1" role="dialog" aria-labelledby="#crearClubTitulo" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
					<h5 class="modal-title" id="crearClubTitulo">Crear club</h5>
				</div>
				<form id="crearClubForm" class="post-action" @submit.prevent="crearClub" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<h5>Información del club</h5>
						<div class="form-group">
							<label for="nombreClub">Nombre</label>
							<input type="text" name="nombreClub" id="nombreClub" class="form-control" placeholder="¿Como te gustaría nombrar al club?" required>
						</div>
						<div class="form-group">
							<label for="descripcionClub">Descripción</label>
							<input type="text" name="descripcion" id="descripcionClub" class="form-control" placeholder="Cuentanos acerca del club">
						</div>
						<div class="form-group">
							<label for="imagen">Imagen de club</label>
							<div class="row">
								<div class="col-xs-3">
									<img class="crop pull-left" id="prevClub" width="100" height="100">
								</div>
								<div class="col-xs-9">
									<input type="file" @change="archivoSeleccionado" name="imagen" id="modalClubInput" class="form-control" accept="image/*" required>
									<small>Elige la imagen avatar de tu club</small>
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
    	data(){
    		return {
                cropX : '',
                cropY : '',
                cropW : '',
                cropH : '',
    		}
    	},										
        mounted() {
            //console.log('Component mounted.');
            var _this = this;
            var timeStamp = 0;
            $('#prevClub').attr('src', '/images/subir-imagen.png');
            $('#prevClub')
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
            			$('#prevClub').attr('src', e.target.result);
    					//this.archivo = files[0];
            		};
            		reader.readAsDataURL(files[0]);
            	}
                else{
                    $('#prevClub').attr('src', '/images/subir-imagen.png');
                }
        	},
        	crearClub(){
        		const form = document.getElementById('crearClubForm');
        		const datosClub = new FormData(form);
        		datosClub.append('_token', window.Laravel.csrfToken);
                datosClub.append('cropX', this.cropX);
                datosClub.append('cropY', this.cropY);
                datosClub.append('cropW', this.cropW);
                datosClub.append('cropH', this.cropH);
        		this.$http.post('/club/crear', datosClub)
        			.then((response) => {
                        $('#crearClubModal').modal('hide');
                        $('#crearClubForm').trigger('reset');
        				window.location = '/club/' + response.data.id;
        			});
        	}
        }
    }
</script>