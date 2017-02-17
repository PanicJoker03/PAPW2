<template>
	<div class="modal fade" id="crearClubModal" tabindex="-1" role="dialog" aria-labelledby="#crearClubTitulo" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
					<h5 class="modal-title" id="crearClubTitulo">Crear club</h5>
				</div>
				<form class="vue-form" action="/crearClub" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<h5>Información del club</h5>
						<div class="form-group">
							<label for="nombreClub">Nombre</label>
							<input type="text" name="nombreClub" id="nombreClub" class="form-control" placeholder="¿Como te gustaría nombrar al club?" required>
						</div>
						<div class="form-group">
							<label for="descripcion">Descripción</label>
							<input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Cuentanos acerca del club">
						</div>
						<div class="form-group">
							<label for="imagen">Imagen de club</label>
							<input type="file" name="imagen" id="imagen" class="form-control" accept="image/*" required>
							<small>Elige la imagen avatar de tu club</small>
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
            console.log('Component mounted.')
        }
    }
</script>