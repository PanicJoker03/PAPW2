@extends('layouts.master')
@section('content')
<div class="container">
	<crear-publicacion-modal 
		club={{ $club->id }}
		nombre-club="{{ $club->nombreClub }}"
		autor-club={{ $club->creador }}>
	</crear-publicacion-modal>
	<div class="club-header one-edge-shadow">
		<img src="{{URL::asset($club->avatarRuta)}}">
		<div class="club-title">
			<p>{{$club->nombreClub}}</p>
		</div>
	</div>
	<div id="options-panel-xs" class="visible-xs-block">
		<p class="club-desc visible-xs-block">{{$club->descripcion}}</p>
		@if ($club->creador != $usuario_id)
			<boton-subscripcion
				@if(isset($subscripcion))
				id={{$subscripcion->id}}
				@else
				id='-1'
				@endif
				club={{ $club->id }}>
			</boton-subscripcion>
		@endif
		<button class="btn btn-default btn-block" data-toggle="modal" data-target="#crearPublicacionModal">
			<span class="glyphicon glyphicon-plus">&nbsp;</span>Compartir imagen
		</button>
		<div class="list-group clubes-list">
				<li class="list-group-item">Actividad</li>
				@forelse ($actividadReciente as $publicacion)
				<a href="/publicacion/{{$publicacion->id}}/vista" class="list-group-item">
					<img src="{{ URL::asset($publicacion->contenidoMinRuta) }}" class="pull-left" width="40" height="40">
					<h4 class="list-group-item-heading"> {{ str_limit($publicacion->titulo, 15, '...') }} </h4>
					<p class="list-group-item-text"> {{ str_limit($publicacion->descripcion, 20,'...') }} </p>
				</a>
				@empty
				<a href="" class="list-group-item">
					<h4>No hay actividad reciente</h4>
				</a>
				@endforelse
			</div>
	</div>
	<div class="row">
		<div id="club-sidepanel" class="col-sm-3 col-sm-push-9 col-xs-12 hidden-xs">
			<p class="club-desc">{{$club->descripcion}}</p>
			<hr>
		@if ($club->creador != $usuario_id)
			<boton-subscripcion
				@if(isset($subscripcion))
				id={{$subscripcion->id}}
				@else
				id='-1'
				@endif
				club={{ $club->id }}>
			</boton-subscripcion>
		@endif
			<button class="btn btn-default btn-block" data-toggle="modal" data-target="#crearPublicacionModal">
				<span class="glyphicon glyphicon-plus">&nbsp;</span>Compartir imagen
			</button>
			<div class="list-group clubes-list">
				<li class="list-group-item">Actividad</li>
				@forelse ($actividadReciente as $publicacion)
				<a href="/publicacion/{{$publicacion->id}}/vista" class="list-group-item">
					<img src="{{ URL::asset($publicacion->contenidoMinRuta) }}" class="pull-left" width="40" height="40">
					<h4 class="list-group-item-heading"> {{ str_limit($publicacion->titulo, 15, '...') }} </h4>
					<p class="list-group-item-text"> {{ str_limit($publicacion->descripcion, 20,'...') }} </p>
				</a>
				@empty
				<a href="" class="list-group-item">
					<h4>No hay actividad reciente</h4>
				</a>
				@endforelse
			</div>
		</div>

		<div class="col-sm-9 col-sm-pull-3">
			<div class="container-fluid container-diver shadow">
				<publicacion-scroller src="/publicacion/club/{{$club->id}}/paginado"></publicacion-scroller>
			</div>
		</div>
	</div>
</div>
@endsection