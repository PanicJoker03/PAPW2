@extends('layouts.master')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Publicaciones por aprobar
				</div>
				<div class="panel-body">
					@foreach ($publicacionesPorAprobar as $publicacion)
						<aprobar-publicacion publicacion="{{$publicacion->id}}"></aprobar-publicacion>
					@endforeach
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class=" list-group">
			<li class="list-group-item">Mis clubs</li>
			@foreach ($clubs as $club)
			<a href="/club/{{$club->id}}" class="list-group-item">
				<img src="{{ URL::asset($club->avatarMinRuta) }}" class="pull-left" width="40" height="40">
				<h4 class="list-group-item-heading"> {{ str_limit($club->nombreClub, 15, '...') }} </h4>
				<p class="list-group-item-text"> {{ str_limit($club->descripcion, 20,'...') }} </p>
			</a>
			@endforeach
			</div>
		</div>
	</div>
</div>
@endsection