@extends('layouts.master')
@section('content')
<div class="container">
	<editar-usuario-modal 
		nombre-usuario="{{ $usuario->nombreUsuario }}"
		correo-usuario={{ $usuario->correo }}
		genero-usuario={{ $usuario->genero }}
		fecha-usuario={{ $usuario->fechaNacimiento }}
		avatar-ruta={{ $usuario->avatarRuta }}
		token={{csrf_token()}}>
	</editar-usuario-modal>
	<div class="row">
		<div class="col-sm-3 hidden-xs">
			<a class="btn usuario-button" data-toggle="modal" data-target="#editarUsuarioModal" >
				<img class="img-rounded pull-left" src={{ URL::asset($usuario->avatarMinRuta) }}> 
				<p class="pull-right">{{ $usuario->nombreUsuario}}</p>
				<span class="glyphicon glyphicon-edit pull-right"></span>
			</a>
			<div class="sidepanel pull-right">
				<div class=" list-group">
				<li class="list-group-item">Subscripciones</li>
					@foreach ($subscripciones as $club)
					<a href="/club/{{$club->id}}/vista" class="list-group-item">
						<img src="{{ URL::asset($club->avatarMinRuta) }}" class="pull-left" width="40" height="40">
						<h4 class="list-group-item-heading"> {{ str_limit($club->nombreClub, 15, '...') }} </h4>
						<p class="list-group-item-text"> {{ str_limit($club->descripcion, 20,'...') }} </p>
					</a>
					@endforeach
				</div>
			</div>
		</div>
		<div class="col-sm-3 col-sm-push-6 hidden-xs">
			<div class=" list-group">
			<li class="list-group-item">Nuevos clubes</li>
				@foreach ($nuevosClubs as $club)
				<a href="/club/{{$club->id}}/vista" class="list-group-item">
					<img src="{{ URL::asset($club->avatarMinRuta) }}" class="pull-left" width="40" height="40">
					<h4 class="list-group-item-heading"> {{ str_limit($club->nombreClub, 15, '...') }} </h4>
					<p class="list-group-item-text"> {{ str_limit($club->descripcion, 20,'...') }} </p>
				</a>
				@endforeach
			</div>
		</div>
		<div class="col-sm-6 col-sm-pull-3">
			<div class=" list-group">
			<li class="list-group-item">Clubes</li>
				@forelse ($clubsResultado as $club)
				<a href="/club/{{$club->id}}/vista" class="list-group-item">
					<img src="{{ URL::asset($club->avatarMinRuta) }}" class="pull-left" width="40" height="40">
					<h4 class="list-group-item-heading"> {{ str_limit($club->nombreClub, 15, '...') }} </h4>
					<p class="list-group-item-text"> {{ str_limit($club->descripcion, 20,'...') }} </p>
				</a>
				@empty
				<p>Sin resultados de busqueda</p>
				@endforelse
			</div>
			<div class=" list-group">
			<li class="list-group-item">Publicaciones</li>
				@forelse ($publicacionesResultado as $publicacion)
				<a href="/publicacion/{{$publicacion->id}}/vista" class="list-group-item">
					<img src="{{ URL::asset($publicacion->contenidoMinRuta) }}" class="pull-left" width="40" height="40">
					<h4 class="list-group-item-heading"> {{ str_limit($publicacion->titulo, 15, '...') }} </h4>
					<p class="list-group-item-text"> {{ str_limit($publicacion->descripcion, 20,'...') }} </p>
				</a>
				@empty
				<p>Sin resultados de busqueda</p>
				@endforelse
			</div>
		</div>
	</div>
</div>
@endsection