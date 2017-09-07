@extends('layouts.admin.a_master')
@section('title', 'Lista de Fellows con encuesta')
@section('description', 'Lista de Fellows con encuesta de satisfacción')
@section('body_class', '')
@section('breadcrumb_type', 'survey fellow list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_survey')
@section('content')
<div class="row">
	<div class="col-sm-9">
		<h1>Lista de Fellows con encuesta de satisfacción </h1>
	</div>
</div>


@if($fellows->count() > 0)
<div class="row" id ="aspirants">
	<div class="col-sm-12">
		<div class="box">
		<table class="table">
		  <thead>
		    <tr>
		      <th>Nombre / email</th>
		      <th>Ciudad / Estado</th>
		      <th>Acciones</th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach ($fellows as $fellow)
		      <tr>
		        <td><div class="row">
			        <div class="col-sm-2">
				        @if($fellow->user->image)
    						<img src='{{url("img/users/{$fellow->user->image->name}")}}' height="30px">
    						@else
    						<img src='{{url("img/users/default.png")}}' height="30px">
    						@endif
			        </div>
			        <div class="col-sm-10">
			        <h4><a href="{{ url('dashboard/encuestas/encuesta-satisfaccion/fellows/' . $fellow->id) }}">{{$fellow->user->name.' '.$fellow->user->fellowData->surname." ".$fellow->user->fellowData->lastname}}</a></h4>
					{{$fellow->user->email}}<br>
					{{$fellow->user->fellowData->origin}}
			        </div>
		       	 </div>
		        </td>
		        <td>{{$fellow->user->fellowData->city}} <br> <strong>{{$fellow->user->fellowData->state}}</strong></td>
		        <td>
		          <a href="{{ url('dashboard/encuestas/encuesta-satisfaccion/fellows/' . $fellow->id) }}" class="btn xs view">Ver</a>
		         </td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>

		{{ $fellows->links() }}
		</div>
	</div>
</div>
@else
<div class="box">
	<div class="row">
		<div class="col-sm-12 center">
			<h2>Aún no hay fellows con encuestas</h2>
			<h3>:)</h3>
		</div>
	</div>
</div>
@endif

@endsection
