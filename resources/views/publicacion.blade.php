@extends('layouts.master')
@section('content')
<div class="container container-post">
	<div class="post shadow">
			<div class="club-thumbnail">
				<p>
					<a href="/club/{{$club->id}}/vista"><img class="img-thumbnail" src="{{ URL::asset($club->avatarMinRuta) }}"></a>
					<a href="/club/{{$club->id}}/vista">{{ $club->nombreClub}}</a>
				</p>
				<hr>
			</div>
		<div class="horizontal">
			<div class="vertical">
				<p class="post-title">{{$publicacion->titulo}}</p>
				<img src="{{ URL::asset($publicacion->contenidoRuta) }}" class="post-img one-edge-shadow">
				<p class="post-description">{{$publicacion->descripcion}}</p>
				<boton-megusta
					@if(isset($megusta))
					id={{$megusta->id}}
					@else
					id='-1'
					@endif
					publicacion={{ $publicacion->id }}>
				</boton-megusta>
				<p class="post-desc">{{$publicacion->descripcion}}</p>
			</div>
		</div>
	</div>
	<div class="comment-helper">
		<comentario-scroller 
			src="/comentario/publicacion/{{$publicacion->id}}/paginado" 
			usuario="{{Auth::user()->id}}"
			publicacion="{{$publicacion->id}}">		
		</comentario-scroller>
	</div>
</div>
@endsection