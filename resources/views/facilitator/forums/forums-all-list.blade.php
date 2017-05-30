@extends('layouts.admin.a_master')
@section('title', 'Foros' )
@section('description','Foros del Programa de Gobierno Abierto desde lo local' )
@section('body_class', 'facilitator foros')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Foros</h1>
	</div>
</div>


@if($forums->count()>0)
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th>Tema</th>
						<th>Sesión</th>
			      <th>Descripción</th>
			      <th>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach ($forums as $forum)
						@if($forum->session)
				      <tr>
				        <td><h4> <a href="{{ url('tablero/foros/'.$forum->session->slug.'/'.$forum->slug.'/ver') }}">{{$forum->topic}}</a></h4></td>
							  <td>{{$forum->session->name}}</td>
	              <td>{{str_limit($forum->description, $limit = 20, $end = '...')}}</td>
				        <td>
				          <a href="{{ url('tablero/foros/' .$forum->session->slug.'/'.$forum->slug.'/ver') }}" class="btn xs view">Ver</a>
						</tr>
						@else
						<tr>
							<td><h4> <a href='{{url("tablero/foros/{$forum->state_name}")}}'>{{$forum->topic}}</a></h4></td>
							<td>Sin sesión</td>
							<td>{{str_limit($forum->description, $limit = 20, $end = '...')}}</td>
							<td>
								<a href='{{url("tablero/foros/{$forum->state_name}")}}' class="btn xs view">Ver</a>
					</tr>
						@endif
			    @endforeach
			  </tbody>
			</table>

			{{ $forums->links() }}
		</div>
	</div>
</div>
@else
<div class="row">
  <div class="col-sm-12">
    <p>Sin foros</p>
  </div>
</div>
@endif
@endsection
