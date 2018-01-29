
<h2>Perfil curricular</h2>
<p>Por favor llena los siguientes campos para crear tu perfil curricular, recuerda mostrar evidencia de tu
experiencia en el desarrollo de proyectos relacionados con los principios de
Gobierno Abierto y Desarrollo Sostenible.</p>


<div class="divider"></div>
<form id="extra-stuff" class="form-horizontal">
	<div class="row">
		<!-- studies -->
		<fieldset>
			<div class="col-sm-12">
				<h3>Experiencia académica</h3>
				<ul id="studies-list">
				  @foreach($cv->academic_trainings as $study)
				  <li data-id="{{$study->id}}">
				    {{$study->name}} : {{$study->institution}} <br>
				    {{ date('m/Y', strtotime($study->from)) }} - {{ date('m/Y', strtotime($study->to)) }}
				    <a href="#" class="remove-study">[ x ]</a>
				  </li>
				  @endforeach
				</ul>
			</div>
			<div class="col-sm-6">
				<p>
				  <label><strong>Carrera / curso / Grado</strong></label>
				  <input type="text" name="study" id="study" class="form-control">
				</p>
			</div>
			<div class="col-sm-6">
				<p><label><strong>Universidad / Instituto / Escuela</strong></label>
				  <input type="text" name="institution" id="institution" class="form-control">
				</p>
			</div>
			<div class="col-sm-6">
				<p><label><strong>Fecha de ingreso</strong></label>
				  <input type="text" name="s_from" id="s_from" class="form-control">
				</p>
			</div>
		  	<div class="col-sm-6">
				<p>
				  <label><strong>Fecha de término</strong></label>
				  <input type="text" name="s_to" id="s_to" class="form-control">
				</p>
		  	</div>
				<div class="col-sm-6">
				<p><label><strong>Estado</strong></label>
					{{Form::select('study_state',$states,null, ['class' => 'form-control', 'id'=>'study_state'])}}
				</p>
		  	</div>
		  	<div class="col-sm-6">
				<p><label><strong>Ciudad</strong></label>
					{{Form::select('study_city',[null=>"Selecciona un estado"],null, ['class' => 'form-control', 'id'=>'study_city'])}}
				</p>
		  	</div>
		  	<div class="col-sm-12">
					<strong class="danger" id ="maxStudy" style="display:none;">Has alcanzado el límite de experiencias, elimina una si deseas agregar otra.</strong>
		  <p>
		    <a id="add-study" href="#" class="btn gde center">Agregar experiencia académica [+]</a>
		  </p>
		  	</div>
		</fieldset>
	</div>

	<div class="divider"></div>

<!-- experiencies -->
	<div class="row">
		<fieldset>
			<div class="col-sm-12">
				<h3>Experiencia laboral</h3>
				<ul id="experiencies-list">
				  @foreach($cv->experiences as $experience)
				  <li data-id="{{$experience->id}}">
				    {{$experience->name}} : {{$experience->company}} <br>
				    {{$experience->description}}
				    <a href="#" class="remove-experience">[ x ]</a>
				  </li>
				  @endforeach
				</ul>
			</div>
			<div class="col-sm-12">
		  		<p>
		  		  <label><strong>Empleo</strong></label>
		  		  <input type="text" name="experience" id="experience" class="form-control">
		  		</p>
			</div>
			<div class="col-sm-6">
		  		<p><label><strong>Empresa</strong></label>
		  		  <input type="text" name="company" id="company" class="form-control">
		  		</p>
			</div>
			<div class="col-sm-6">
		  		<p><label><strong>Sector</strong></label>
		  		  <input type="text" name="sector" id="sector" class="form-control">
		  		</p>
			</div>
		  	<div class="col-sm-6">
		  		<p><label><strong>Fecha de ingreso</strong></label>
		  		  <input type="text" name="from" id="from" class="form-control">
		  		</p>
		  	</div>
		  	<div class="col-sm-6">
		  		<p>
		  		  <label><strong>Fecha de término</strong></label>
		  		  <input type="text" name="tod" id="tod" class="form-control">
		  		</p>
		  	</div>
		  	<div class="col-sm-6">
		  		<p><label><strong>Estado</strong></label>
						{{Form::select('experience_state',$states,null, ['class' => 'form-control', 'id'=>'experience_state'])}}
		  		</p>
		  	</div>
		  	<div class="col-sm-6">
		  		<p><label><strong>Ciudad</strong></label>
						{{Form::select('experience_city',[null=>"Selecciona un estado"],null, ['class' => 'form-control', 'id'=>'experience_city'])}}
		  		</p>
		  	</div>

		  	<div class="col-sm-6">
		  		<p><label><strong>Descripción</strong></label>
		  		  <textarea type="text" name="experience_description" id="experience_description" class="form-control"></textarea>
		  		</p>
		  	</div>
		  	<div class="col-sm-12">

					<strong class="danger" id ="maxExperience" style="display:none;">Has alcanzado el límite de experiencias, elimina una si deseas agregar otra.</strong>
					<strong class="danger" id ="maxWords" style="display:none;">Has alcanzado el límite de palabras, el limite es de 100 y has escrito <span id="nbwords"></span>.</strong>
		  		<p>
		  		  <a id="add-experience" href="#" class="btn gde center">Agregar experiencia [+]</a>
		  		</p>
		  	</div>
		</fieldset>
	</div>

	<div class="divider"></div>

	<!-- idiomas + Software-->
	<div class="row">
		<!-- idiomas -->
		<div class="col-sm-6">
			<fieldset>
			  <h3>Idiomas</h3>
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
			    <a id="add-language" href="#" class="btn gde">Agregar idioma [+]</a>
			  </p>
			  <div class="separator"></div>
			</fieldset>
		</div>
		<!-- software -->
		<div class="col-sm-6">
			<fieldset>
			  <h3>Software</h3>
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
			    <a id="add-software" href="#" class="btn gde">Agregar programa [+]</a>
			  </p>
			</fieldset>
		</div>
	</div>
</form>

{!! Form::model($cv,['url' => "tablero-aspirante/convocatorias/$notice->slug/aplicar/agregar-perfil-curricular", "class" => "form-horizontal",'id'=>'filesForm','files'=>true]) !!}
<div class="divider"></div>
<fieldset>
  <h3>Datos generales</h3>
  <div class="row">
    <div class="col-sm-12">
      <p>
        <label><strong>Correo</strong></label>
        <input type="text" name="email" value="{{$user->email}}" class="form-control" disabled>
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <p>
        <label><strong>Fecha de nacimiento</strong> </label>
        {{Form::text('birthdate',null,["class" => "form-control", 'id'=>'birthdate'])}}
        @if($errors->has('birthdate'))
        <strong class="danger">{{$errors->first('birthdate')}}</strong>
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


    <div class="row">
      <div class="col-sm-12">
        <p>{{Form::submit('Continuar', ['class' => 'btn gde'])}}</p>
      </div>
    </div>
</fieldset>

    {!! Form::close() !!}
