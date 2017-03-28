@extends('layouts.admin.a_master')
@section('title', 'Lista de Aspirantes')
@section('description', 'Lista de Aspirantes')
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirantes evaluar')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_aspirantes')

@section('content')
<h1>Los archivos del aspirante ya han sido evaluados</h1>
<div class="box">
  <p>{{ $aspirant->name }} {{ $aspirant->surname }} {{ $aspirant->lastname }} ya cuenta con una evaluación previa de documentos.</p>

  @if($files)
  	@if($files->hasCv && $files->hasVideo &&$files->hasEssay &&$files->hasProof &&$files->hasPrivacy &&$files->hasLetter)
      <ul>
        <li>Todos los archivos son válidos</li>
      </ul>
      <p><a href="{{ url('dashboard/aspirantes/evaluar/'.$aspirant->id) }}" class="btn">&gt;&gt; Continuar.</a></p>
    @else
    <h1>El aspirante no cumple con los requisitos para ser evaluado</h1>
  	<div class="box">
  		<p>{{ $aspirant->name }} {{ $aspirant->surname }} {{ $aspirant->lastname }} , no puede ser evaluado ya que su documentación no es válida.</p>
  		<ul>
  			@if(!$files->hasCv)
  			<li>El <strong>Perfil Curricular</strong> no es válido</li>
  			@endif
  			@if(!$files->hasEssay)
  			<li>El <strong>Ensayo</strong> no es válido</li>
  			@endif
  			@if(!$files->hasVideo)
  			<li>El <strong>video</strong> no es válido</li>
  			@endif
  			@if(!$files->hasPrivacy)
  			<li>El <strong>Consentimiento Relativo Al Tratamiento de sus Datos Personales</strong> no es válido</li>
  			@endif
  			@if(!$files->hasProof)
  			<li>El <strong>Comprobante de Domicilio</strong> no es válido</li>
  			@endif
  			@if(!$files->hasLetter)
  			<li>La <strong>Carta de Membretada</strong> no es válida</li>
  			@endif
  		</ul>
  		<p><a href="{{ url('dashboard/aspirantes') }}" class="btn">&lt;&lt; Regresar a lista de aspirantes.</a></p>
  	</div>
    @endif
  @endif
</div>
@endsection
