@extends('layouts.master')
@section('content')
<div class="container">
	<div>
		<img src="{{ URL::asset($publicacion->contenidoRuta) }}">
	</div>
	<div>
		@foreach ($comentarios as $comentario)
			<div class="panel">
				<img class="pull-left" src="{{ URL::asset($comentario->avatarMinRuta) }}">
				<h4>{{$comentario->nombreUsuario}}</h4>
				<p>{{$comentario->comentario}}</p>
			</div>
		@endforeach
	</div>
	<div>
		{{ 
			Form::open(
			array(
				{{-- 'novalidate' => 'novalidate', --}}
				'url' => '/comentario/crear',
				'class' => 'form-group'
				))
		}}
		<label class="text-left" for="comentario">Comentar</label>
		{{ 
			Form::textarea('comentario', null, [
			'class' => 'form-control', 
			'placeholder' => 'Comparte algun comentario',
			'maxlength' => '255',
			'required'
			])
		}}
		{{Form::hidden('publicacion', $publicacion->id)}}
		{{Form::submit('Comentar', ['class' => 'btn btn-default'])}}
		{{Form::close()}} 
	</div>
</div>
@endsection