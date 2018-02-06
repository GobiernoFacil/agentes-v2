{!! Form::open(['url' => 'dashboard/convocatorias/agregar', "class" => "form-horizontal", 'files'=>true]) !!}
<!--title-->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Título</strong></label>
      {{Form::text('title', null, ["class" => "form-control"])}}
      @if($errors->has('title'))
      <strong class="error">{{$errors->first('title')}}</strong>
      @endif
    </p>
  </div>
</div>
<!-- Fechas -->
<div class="row">
  <div class="col-sm-6">
    <p>
      <label><strong>Fecha inicio</strong> <br>
      {{Form::text('start',null, ["class" => "form-control", 'id'=>'startD'])}} </label>
      @if($errors->has('start'))
      <strong class="danger">{{$errors->first('start')}}</strong>
      @endif
    </p>
  </div>
  <div class="col-sm-6">
    <p>
      <label><strong>Fecha cierre</strong> <br>
      {{Form::text('end',null, ["class" => "form-control",'id'=>'startE'])}} </label>
      @if($errors->has('end'))
      <strong class="danger">{{$errors->first('end')}}</strong>
      @endif
    </p>
  </div>
</div>
<!-- upload -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>¿Esta convocatoria cuenta con archivos para ser descargados por los aspirantes?</strong></label>
      {{Form::select('hasfiles',[null => "Selecciona una opción", 1 =>'Sí', 0 => 'No'],null, ['class' => 'form-control'])}}
      @if($errors->has('hasfiles'))
      <strong class="danger">{{$errors->first('hasfiles')}}</strong>
      @endif
    </p>
  </div>
</div>
<!--description-->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Descripción</strong></label>
      {{Form::textarea('description', null, ["class" => "form-control content"])}}
      @if($errors->has('description'))
      <strong class="error">{{$errors->first('description')}}</strong>
      @endif
    </p>
  </div>
</div>
<!--objective-->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Objetivo</strong></label>
      {{Form::textarea('objective', null, ["class" => "form-control content"])}}
      @if($errors->has('objective'))
      <strong class="error">{{$errors->first('objective')}}</strong>
      @endif
    </p>
  </div>
</div>
<!--modality_results-->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Modalidad y resultados esperados</strong></label>
      {{Form::textarea('modality_results', null, ["class" => "form-control content"])}}
      @if($errors->has('modality_results'))
      <strong class="error">{{$errors->first('modality_results')}}</strong>
      @endif
    </p>
  </div>
</div>

<!--term_process-->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Plazo y proceso de postulación</strong></label>
      {{Form::textarea('term_process', null, ["class" => "form-control content"])}}
      @if($errors->has('term_process'))
      <strong class="error">{{$errors->first('term_process')}}</strong>
      @endif
    </p>
  </div>
</div>

<!--unforeseen_cases-->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Casos no previstos</strong></label>
      {{Form::textarea('unforeseen_cases', null, ["class" => "form-control content"])}}
      @if($errors->has('unforeseen_cases'))
      <strong class="error">{{$errors->first('unforeseen_cases')}}</strong>
      @endif
    </p>
  </div>
</div>
<!--contact-->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Contacto</strong></label>
      {{Form::textarea('contact', null, ["class" => "form-control content"])}}
      @if($errors->has('contact'))
      <strong class="error">{{$errors->first('contact')}}</strong>
      @endif
    </p>
  </div>
</div>
<!--profile-->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Perfil de egreso</strong></label>
      {{Form::textarea('profile', null, ["class" => "form-control content"])}}
      @if($errors->has('profile'))
      <strong class="error">{{$errors->first('profile')}}</strong>
      @endif
    </p>
  </div>
</div>
<h2>Perfil y elegibilidad de los participantes</h2>
<!--profile_eligibility_description-->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Descripción</strong></label>
      {{Form::textarea('profile_eligibility_description', null, ["class" => "form-control content"])}}
      @if($errors->has('profile_eligibility_description'))
      <strong class="error">{{$errors->first('profile_eligibility_description')}}</strong>
      @endif
    </p>
  </div>
</div>
<!--profile_eligibility_general-->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Criterios generales</strong></label>
      {{Form::textarea('profile_eligibility_general', null, ["class" => "form-control content"])}}
      @if($errors->has('profile_eligibility_general'))
      <strong class="error">{{$errors->first('profile_eligibility_general')}}</strong>
      @endif
    </p>
  </div>
</div>
<!--profile_eligibility_particular-->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Criterios particulares</strong></label>
      {{Form::textarea('profile_eligibility_particular', null, ["class" => "form-control content"])}}
      @if($errors->has('profile_eligibility_particular'))
      <strong class="error">{{$errors->first('profile_eligibility_particular')}}</strong>
      @endif
    </p>
  </div>
</div>
<!-- upload -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Publicar</strong></label>
      {{Form::select('public',[null => "Selecciona una opción", '1' =>'Sí', '0' => 'No'],null, ['class' => 'form-control'])}}
      @if($errors->has('public'))
      <strong class="danger">{{$errors->first('public')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Crear convocatoria', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
