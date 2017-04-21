<nav class="navbar navbar-default navbar-toggleable-sm nav-diver one-edge-shadow">
	<div class="navbar-diver-logo">
		<div class="helper"><img src="{{URL::asset('images/Diver-icon-L.png')}}"></div>
	</div>
	<div class="navbar-header">
		<button class="navbar-toggle navbar-toggler-right" type="button" data-toggle="collapse" data-target="#barraSesion" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
		</button>
		<a href="/" class="navbar-brand">Inicio</a>
	</div>
	<div class="collapse navbar-collapse" id="barraSesion">
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
		<ul class="nav navbar-nav navbar-right nav-diver">
			<li class="nav-item active">
				<a class="nav-link" href="/cerrarSesion">Cerrar sesión</a>
			</li>
		</ul>
	</div>
</nav>
