@extends('layouts.admin.a_master')
@section('title', 'Lista de Aspirantes')
@section('description', 'Lista de Aspirantes')
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirantes evaluar')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')

@section('content')
<h1>El aspirante ya ha sido evaluado</h1>
<div class="box">
  <p>{{ $aspirant->name }} {{ $aspirant->surname }} {{ $aspirant->lastname }} ya cuenta con una evaluación previa, por lo que no puede ser evaluado.</p>
  <p><a href='{{ url("dashboard/aspirantes/ver/{$aspirant->id}") }}' class="btn">Ver perfil de aspirante.</a></p>
  <p><a href="{{ url('dashboard/aspirantes') }}" class="btn">&lt;&lt; Regresar a lista de aspirantes.</a></p>
</div>
@endsection
