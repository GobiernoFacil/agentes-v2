@extends('layouts.admin.a_master')
@section('title', '' )
@section('description', '')
@section('body_class', 'fellow aprendizaje')
@section('breadcrumb_type', 'module list')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_modules')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Módulos de aprendizaje</h1>
  </div>
</div>
<div class="row">
  <div class = "col-sm-12">
    @foreach($modules as $module)
    <span>{{$module->title}}</span>
    @endforeach
  </div>
</div>

<div class="row">
  @foreach($modules as $module)
  <div class = "col-sm-3">
    <p>{{$module->title}}</br>
    {{$module->objective}}</br>
    @if($module->public)
    <a href='{{ url("tablero/aprendizaje/{$module->slug}") }}' class="btn xs view">Ir al Módulo</a></li>
    @endif
    {{$module->public ? 'Activo' : 'Candado'}}</p>

  </div>
  @endforeach
</div>
@endsection
