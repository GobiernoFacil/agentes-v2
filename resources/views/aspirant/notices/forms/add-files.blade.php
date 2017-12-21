{!! Form::open(['url' => 'convocatoria/aplicar/registro', "class" => "form-horizontal",'id'=>'filesForm','files'=>true]) !!}


<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Agregar enlace a video (YouTube)</strong></label>
      {{Form::text('video', null, ["class" => "form-control","id"=>"video"])}}
      @if($errors->has('video'))
      <strong class="error">{{$errors->first('video')}}</strong>
      @endif
      <strong class="error" id ="urlError" style="display:none;">Escribe un URL válido</strong>
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Agregar Ensayo</strong></label><br>
      {{Form::file('essay', ['class' => ''])}} (no mayor a 5 cuartillas, documento no mayor a 2.5 Mb, formato .docx, .doc o pdf)
      @if($errors->has('essay'))
      <strong class="error">{{$errors->first('essay')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Agregar perfil curricular</strong></label><br>
      {{Form::file('cv', ['class' => ''])}} (documento no mayor a 2.5 Mb, formato .docx, .doc o pdf)
      @if($errors->has('cv'))
      <strong class="error">{{$errors->first('cv')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Agregar carta membretada </strong></label><br>
      {{Form::file('letter', ['class' => ''])}} (documento no mayor a 2.5 Mb, formato .docx, .doc o pdf)
      @if($errors->has('letter'))
      <strong class="error">{{$errors->first('letter')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Agregar copia de comprobante de domicilio </strong></label><br>
      {{Form::file('proof', ['class' => ''])}} (documento no mayor a 2.5 Mb, formato .docx, .doc o pdf)
      @if($errors->has('proof'))
      <strong class="error">{{$errors->first('proof')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Agregar consentimiento relativo al tratamiento de sus datos personales</strong></label><br>
      {{Form::file('privacy', ['class' => ''])}} (documento no mayor a 2.5 Mb, formato .docx, .doc o pdf)
      @if($errors->has('privacy'))
      <strong class="error">{{$errors->first('privacy')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Guardar', ['class' => 'btn gde'])}}</p>
  </div>
</div>


{!! Form::close() !!}
