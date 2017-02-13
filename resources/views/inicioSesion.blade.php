<!DOCTYPE html>
<html>
<head>
	<title>Inicio de sesión</title>
	<link rel="stylesheet" type="text/css" href="css/app.css">
	<link rel="stylesheet" type="text/css" href="css/diver.css">
</head>
<body>
	<div class="container">
		<h1 class="text-center">Diver</h1>
		<div class="row">
			<div class="panel panel-default form-login margin-auto">
				<div class="panel-heading text-center">
					Regístrate para seguir a todo tipo de clubes
				</div>
				<h4></h4>
				<div class="panel-body">
					{{ Form::open(
						array(
							{{-- 'novalidate' => 'novalidate', --}}
							'url' => '/usuario',
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
						{{ Form::submit('Registrarse'), ['class' => 'btn btn-default'] }}
					</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</body>
</html>