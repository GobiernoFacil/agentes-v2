
<h2>Perfil curricular</h2>
<div class="separator"></div>
<p>Por favor llena los siguientes campos para crear tu perfil curricular, recuerda mostrar evidencia de tu
experiencia en el desarrollo de proyectos relacionados con los principios de
Gobierno Abierto y Desarrollo Sostenible.</p>


<div class="separator"></div>
<form id="extra-stuff" class="form-horizontal">

<!-- studies -->
<fieldset>
  <h2>Experiencia académica</h2>
  <ul id="studies-list">
    @foreach($cv->academic_trainings as $study)
    <li data-id="{{$study->id}}">
      {{$study->name}} : {{$study->institution}} <br>
      {{ date('m/Y', strtotime($study->from)) }} - {{ date('m/Y', strtotime($study->to)) }}
      <a href="#" class="remove-study">[ x ]</a>
    </li>
    @endforeach
  </ul>

  <p>
    <label><strong>Carrera / curso / Grado</strong></label>
    <input type="text" name="study" id="study" class="form-control">
  </p>
  <p><label><strong>Universidad / Instituto / Escuela</strong></label>
    <input type="text" name="institution" id="institution" class="form-control">
  </p>
  <p><label><strong>Fecha de ingreso</strong></label>
    <input type="text" name="s_from" id="s_from" class="form-control">
  </p>
  <p>
    <label><strong>Fecha de término</strong></label>
    <input type="text" name="s_to" id="s_to" class="form-control">
  </p>
  <p><label><strong>Ciudad</strong></label>
    <input type="text" name="study_city" id="study_city" class="form-control">
  </p>

  <p>
    <a id="add-study" href="#" class="btn gde">Agregar experiencia académica</a>
  </p>
</fieldset>


<!-- experiencies -->
<fieldset>
  <h2>Experiencia laboral</h2>
  <ul id="experiencies-list">
    @foreach($cv->experiences as $experience)
    <li data-id="{{$experience->id}}">
      {{$experience->name}} : {{$experience->company}} <br>
      {{$experience->description}}
      <a href="#" class="remove-experience">[ x ]</a>
    </li>
    @endforeach
  </ul>

  <p>
    <label><strong>Empleo</strong></label>
    <input type="text" name="experience" id="experience" class="form-control">
  </p>
  <p><label><strong>Empresa</strong></label>
    <input type="text" name="company" id="company" class="form-control">
  </p>
  <p><label><strong>Sector</strong></label>
    <input type="text" name="sector" id="sector" class="form-control">
  </p>
  <p><label><strong>Fecha de ingreso</strong></label>
    <input type="text" name="from" id="from" class="form-control">
  </p>
  <p>
    <label><strong>Fecha de término</strong></label>
    <input type="text" name="tod" id="tod" class="form-control">
  </p>
  <p><label><strong>Ciudad</strong></label>
    <input type="text" name="experience_city" id="experience_city" class="form-control">
  </p>
  <p><label><strong>Estado</strong></label>
    <input type="text" name="experience_state" id="experience_state" class="form-control">
  </p>
  <p><label><strong>Descripción</strong></label>
    <textarea type="text" name="experience_description" id="experience_description" class="form-control"></textarea>
  </p>

  <p>
    <a id="add-experience" href="#" class="btn gde">Agregar experiencia</a>
  </p>
</fieldset>
<!-- idiomas -->
<fieldset>
<div class="separator"></div>
  <h2>Idiomas</h2>
  <ul id="languages-list">
    @foreach($cv->languages as $language)
    <li data-id="{{$language->id}}">
      {{$language->name}} : {{$language->level}}
      <a href="#" class="remove-language">[ x ]</a>
    </li>
    @endforeach
  </ul>

  <p><label><strong>Idioma</strong></label> <input type="text" name="language" id="language" class="form-control"></p>
  <p><label><strong>Nivel</strong></label>
    <select name="language_level" id="language_level" class="form-control">
      <option>básico</option>
      <option>intermedio</option>
      <option>avanzado</option>
    </select>
  </p>
  <p>
    <a id="add-language" href="#" class="btn gde">Agregar idioma</a>
  </p>
  <div class="separator"></div>
</fieldset>

<!-- software -->
<fieldset>
  <h2>Software</h2>
  <ul id="softwares-list">
    @foreach($cv->softwares as $software)
    <li data-id="{{$software->id}}">
      {{$software->name}} : {{$software->level}}
      <a href="#" class="remove-software">[ x ]</a>
    </li>
    @endforeach
  </ul>

  <p>
    <label><strong>Programa</strong></label>
    <input type="text" name="software" id="software" class="form-control">
  </p>
  <p><label><strong>Nivel</strong></label>
    <select name="software_level" id="software_level" class="form-control">
      <option>básico</option>
      <option>intermedio</option>
      <option>avanzado</option>
    </select>
  </p>
  <p>
    <a id="add-software" href="#" class="btn gde">Agregar programa</a>
  </p>
</fieldset>
</form>

{!! Form::model($cv,['url' => "tablero-aspirante/convocatorias/$notice->slug/aplicar/agregar-perfil-curricular", "class" => "form-horizontal",'id'=>'filesForm','files'=>true]) !!}
<div class="separator"></div>
<fieldset>
  <h2>Datos en general</h2>
  <div class="row">
    <div class="col-sm-12">
      <p>
        <label><strong>Correo</strong></label>
        {{Form::text('email',null,["class" => "form-control"])}}
        @if($errors->has('email'))
        <strong class="danger">{{$errors->first('email')}}</strong>
        @endif
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <p>
        <label><strong>Edad</strong> </label>
        {{Form::text('age',null,["class" => "form-control"])}}
        @if($errors->has('age'))
        <strong class="danger">{{$errors->first('age')}}</strong>
        @endif
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6">
      <p>
        <label><strong>Teléfono</strong> </label>
        {{Form::text('phone',null,["class" => "form-control"])}}
        @if($errors->has('phone'))
        <strong class="danger">{{$errors->first('phone')}}</strong>
        @endif
      </p>
    </div>

    <div class="col-sm-6">
      <p>
        <label><strong>Celular</strong> </label>
        {{Form::text('mobile',null,["class" => "form-control"])}}
        @if($errors->has('mobile'))
        <strong class="danger">{{$errors->first('mobile')}}</strong>
        @endif
      </p>
    </div>
  </div>


  <div class ="row">
    <div class = "col-sm-6">
      <p>
        <label><strong>Semestre</strong></label>
        {{Form::text('semester',$cv->semester,["class" => "form-control"])}}
        @if($errors->has('semester'))
        <strong class="danger">{{$errors->first('semester')}}</strong>
        @endif
      </p>
    </div>
    <div class = "col-sm-6">
      <p>
        <label><strong>Estatus</strong></label>
        {{Form::select('status',[null => "SELECCIONA UNA OPCIÓN","ESTUDIANTE" => "ESTUDIANTE", "EGRESADO" => "EGRESADO"],$cv->semester,["class" => "form-control"])}}
        @if($errors->has('status'))
        <strong class="danger">{{$errors->first('status')}}</strong>
        @endif
      </p>

    </div>
  </div>



    <div class="row">
      <div class="col-sm-12">
        <p>{{Form::submit('Continuar', ['class' => 'btn gde'])}}</p>
      </div>
    </div>
</fieldset>

    {!! Form::close() !!}