<!DOCTYPE html>
<html>
<head>
	<title>Inicio de sesión</title>
	<link rel="stylesheet" type="text/css" href="css/app.css">
	<link rel="stylesheet" type="text/css" href="css/diver.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<form class="form-login">
			<h4>Regístrate para subscribirte a todo tipo de clubes</h4>
				<div class="form-group">
					<input type="text" class="form-control" id="usuario" placeholder="Nombre de usuario">
					<input type="text" class="form-control" id="correo" placeholder="Correo electrónico">
					<input type="password" class="form-control" id="contraseña" placeholder="Contraseña">
					<input type="date" class="form-control" id="nacimiento" placeholder="Fecha de nacimiento">
					<h5>Género</h5>
					<div class="form-check">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" name="genero" id="generoHombre" value="hombre">
							Hombre
						</label>
					</div>
					<div class="form-check">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" name="genero" id="generoMujer" value="mujer">
							Mujer
						</label>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>