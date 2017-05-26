<editar-usuario-modal 
	nombre-usuario="{{ $usuario->nombreUsuario }}"
	correo-usuario={{ $usuario->correo }}
	genero-usuario={{ $usuario->genero }}
	fecha-usuario={{ $usuario->fechaNacimiento }}
	avatar-ruta={{ $usuario->avatarRuta }}
	token={{csrf_token()}}>
</editar-usuario-modal>
<nav class="navbar navbar-default navbar-toggleable-sm nav-diver one-edge-shadow">
	<div class="navbar-diver-logo">
		<div class="helper"><img src="{{URL::asset('images/Diver-icon-L.png')}}"></div>
	</div>
	<div class="navbar-header">
		<button class="navbar-toggle navbar-toggler-right btn-default" type="button" data-toggle="collapse" data-target="#barraSesion" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
		</button>
		<button class="pull-right navbar-nav btn-default visible-xs-inline">
			<span class="glyphicon glyphicon-user" aria-hidden="true" data-toggle="modal" data-target="#editarUsuarioModal"></span>
		</button>
		<a href="/" class="navbar-brand">Inicio</a>
	</div>
	<div class="collapse navbar-collapse" id="barraSesion">
		@if (!isset($esconderBarraUsuario))
		<ul class="nav navbar-nav hidden-xs">
			<li class="nav-item active">
				<a class="nav-link" data-toggle="modal" data-target="#editarUsuarioModal">
					<span class="glyphicon glyphicon-user"></span>
					{{$usuario->nombreUsuario }}
				</a>
			</li>
		</ul>
		@endif
		<ul class="nav navbar-nav">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Mis clubes
				@if($solicitudes > 0)
					<span class="glyphicon glyphicon-exclamation-sign"></span>
				@endif 
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
				@if ($clubsCount > 0)
					<li><a href="/administrar">
						Administrar
						@if($solicitudes > 0)
							({{$solicitudes}})
						@endif 
						</a>
					</li>
				@endif
					<li><a data-toggle="modal" data-target="#crearClubModal">Crear club</a></li>
				</ul>
			</li>
		</ul>
		<ul class="nav navbar-nav">
			<li class="nav-item active">
				<form class="navbar-form" action="/buscar">
					<input class="form-control" type="text" name="busquedaInput" placeholder="Busca clubes o publicaciones" required>
					<button class="btn btn-default" type="submit">Buscar</button>
				</form>
			</li>	
		</ul>
		<ul class="nav navbar-nav navbar-right nav-diver">
			<li class="nav-item active">
				<a class="nav-link" href="/cerrarSesion">Cerrar sesión</a>
			</li>
		</ul>
	</div>
</nav>
