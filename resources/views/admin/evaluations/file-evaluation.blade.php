@extends('layouts.admin.a_master')
@section('title', 'Evaluación de archivos de ' . $fellow->user->name . ' ' . $fellow->user->fellowData->surname )
@section('description', 'Evaluación de archivos de ' . $fellow->user->name . ' ' . $fellow->user->fellowData->surname )
@section('body_class', 'evaluation')
@section('breadcrumb_type', 'evaluation file')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_evaluation')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Evaluación de archivo de: <strong>{{ $fellow->user->name }} {{ $fellow->user->fellowData->surname }} {{ $fellow->user->fellowData->lastname }}</strong></h1>
    <h2>Actividad:  {{$fellow->activity->name}}</h2>
	<div class="divider"></div>
  </div>
  <!--info fellow-->
	<div class="col-sm-1 center">
		@if($fellow->user->image)
		<img src='{{url("img/users/{$fellow->user->image->name}")}}' width="100%">
		@else
		<img src='{{url("img/users/default.png")}}' height="40px">
		@endif
	</div>
	<div class="col-sm-5">
		<p>{{$fellow->user->fellowData->city}}, {{$fellow->user->fellowData->state}}</p>
	</div>
	<div class="col-sm-3">
		<p>{{$fellow->user->fellowData->origin}}</p>
	</div>
	<div class="col-sm-3">
    @if($data)
    <p>Contestado <a title="{{date('d-m-Y H:i', strtotime($fellow->created_at))}}">{{$data->created_at->diffForHumans()}}</a></p>
    @else
		<p>Contestado <a title="{{date('d-m-Y H:i', strtotime($fellow->created_at))}}">{{$fellow->created_at->diffForHumans()}}</a></p>
    @endif
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
