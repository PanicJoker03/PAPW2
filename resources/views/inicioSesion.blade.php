<!DOCTYPE html>
<html>
<head>
	<title>Inicio de sesión</title>
	{{-- <link rel="stylesheet" type="text/css" href="css/theme.min.css"> --}}
	<link rel="stylesheet" type="text/css" href="css/app.css">
	<link rel="stylesheet" type="text/css" href="css/diver.css">
</head>
<body>
	<nav class="navbar navbar-default navbar-toggleable-sm">
		<div class="navbar-header">
			<button class="navbar-toggle navbar-toggler-right" type="button" data-toggle="collapse" data-target="#barraInicioSesion" aria-expanded="false" aria-label="Toggle navigation">
				Inicio de sesión
			</button>
		</div>
		<div class="collapse navbar-collapse navbar-collapse text-right" id="barraInicioSesion">
			{{ Form::open(
				array(
					{{-- 'novalidate' => 'novalidate', --}}
					'url' => '/iniciarSesion',
					'class' => 'navbar-form'
					))
			}}
			{{ Form::text('usuario', null, ['class' => 'form-control', 'placeholder' => 'Nombre de usuario'])}}
			{{ Form::password('contraseña', ['class' => 'form-control', 'placeholder' => 'Contraseña']) }}
			{{ Form::submit('Iniciar sesión', ['class' => 'btn btn-default']) }}
			{{ Form::close() }}
		</div>
	</nav>
	<div class="container">
		<h1 class="text-center">Diver</h1>
		<div class="row">
			<div class="panel panel-default form-login margin-auto">
				<div class="panel-heading text-center">
					Regístrate para seguir clubes y ver todo tipo de contenido
				</div>
				<h4></h4>
				<div class="panel-body">
					{{ Form::open(
						array(
							{{-- 'novalidate' => 'novalidate', --}}
							'url' => '/registrar',
							'files' => true
							))
					}}
					<div class="form-group">
						{{ Form::text('usuario', null, ['class' => 'form-control', 'placeholder' => 'Nombre de usuario', 'required' => 'required']) }}
						{{ Form::email('correo', null, ['class' => 'form-control', 'placeholder' => 'Correo electrónico', 'required' => 'required']) }}
						{{ Form::password('contraseña', ['class' => 'form-control', 'placeholder' => 'Contraseña', 'required' => 'required']) }}
					</div>
					<div class="form-group">
						<h5>Fecha de nacimiento</h5>
						{{ Form::date('nacimiento', null, ['class' => 'form-control', 'required' => 'required']) }}
					</div>
					<div class="form-group">
						<h5>Género</h5>
						<div class="form-check">
							<label class="form-check-label">
								{{ Form::radio('genero','Hombre', null, ['class' => 'form-check-input', 'required' => 'required']) }}
								Hombre
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								{{ Form::radio('genero','Mujer', null, ['class' => 'form-check-input', 'required' => 'required']) }}
								Mujer
							</label>
						</div>
					</div>
					<div class="form-group text-center">
						{{ Form::submit('Registrarse', ['class' => 'btn btn-default']) }}
					</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</body>
<!-- Scripts -->
<script type="text/javascript" src="js/app.js"></script>
</html>