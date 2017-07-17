@extends('layouts.admin.a_master')
@section('title', 'Evaluación de archivos de ' . $data->user->name . ' ' . $data->user->fellowData->surname )
@section('description', 'Evaluación de archivos de ' . $data->user->name . ' ' . $data->user->fellowData->surname )
@section('body_class', 'evaluation')
@section('breadcrumb_type', 'evaluation file')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_evaluation')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Evaluación de archivo de: <strong>{{ $data->user->name }} {{ $data->user->fellowData->surname }} {{ $data->user->fellowData->lastname }}</strong></h1>
    <h2>Actividad:  {{$data->activity->name}}</h2>
	<div class="divider"></div>
  </div>
  <!--info fellow-->
	<div class="col-sm-1 center">
		@if($data->user->image)
		<img src='{{url("img/users/{$data->user->image->name}")}}' width="100%">
		@else
		<img src='{{url("img/users/default.png")}}' height="40px">
		@endif
	</div>
	<div class="col-sm-5">
		<p>{{$data->user->fellowData->city}}, {{$data->user->fellowData->state}}</p>
	</div>
	<div class="col-sm-3">
		<p>{{$data->user->fellowData->origin}}</p>
	</div>
	<div class="col-sm-3">
		<p>Contestado <a title="{{date('d-m-Y H:i', strtotime($data->created_at))}}">{{$data->created_at->diffForHumans()}}</a></p>
	</div>
</div>

<div class="row">
  <div class="box">
    <div class="col-sm-10 col-sm-offset-1">
      @include('admin.evaluations.forms.files-evaluation-form')
    </div>
    <div class="clearfix"></div>
  </div>
</div>
@endsection
