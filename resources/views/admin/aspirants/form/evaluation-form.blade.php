{!! Form::model($evaluation,['url' => url('dashboard/aspirantes/evaluar').'/'.$aspirant->id, "class" => "form-horizontal"]) !!}

<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Experiencia previa en Gobierno Abierto y Desarrollo Sostenible</h2>
	<ol class="list line">
		<li>
    		<p>El aspirante acredita experiencia en proyectos, investigaciones o intervenciones relacionadas con los componentes de Gobierno Abierto (transparencia y participación)?</p>
			<p>
				<label>Sí {{Form::radio('experience[0]','1', $evaluation->experience== 1 ? true : false,['class' => 'form-control experience'])}}</label>
				<label>No {{Form::radio('experience[1]','0', $evaluation->experience== 0 ? true : false,['class' => 'form-control experience'])}}
			</p>
			@if($errors->has('experience'))</label>
				<strong>{{$errors->first('experience')}}</strong>
			@endif
		</li>
		<li>
			<p>En una escala de 0 a 10, donde cero es nada relevante y diez es muy relevante ¿qué tan relevante considera la experiencia del aspirante en el desarrollo de proyectos, investigaciones o intervenciones relacionadas con los componentes de Gobierno Abierto?</p>
			<div class="row">
				<div class="col-sm-6">
					<ul class="inline">
						<li><label><span>0</span> {{Form::radio('experience1[0]','0', $evaluation->experience1 == 0 ? true : false,['class' => 'form-control experience1'])}}</label></li>
						<li><label><span>1</span>{{Form::radio('experience1[1]','1', $evaluation->experience1 == 1 ? true : false,['class' => 'form-control experience1'])}}</label>	</li>
						<li><label><span>2</span>{{Form::radio('experience1[2]','2', $evaluation->experience1 == 2 ? true : false,['class' => 'form-control experience1'])}}</label>	</li>
						<li><label><span>3</span>{{Form::radio('experience1[3]','3', $evaluation->experience1 == 3 ? true : false,['class' => 'form-control experience1'])}}</label>	</li>
						<li><label><span>4</span>{{Form::radio('experience1[4]','4', $evaluation->experience1 == 4 ? true : false,['class' => 'form-control experience1'])}}</label>	</li>
						<li><label><span>5</span>{{Form::radio('experience1[5]','5', $evaluation->experience1 == 5 ? true : false,['class' => 'form-control experience1'])}}</label>	</li>
						<li><label><span>6</span>{{Form::radio('experience1[6]','6', $evaluation->experience1 == 6 ? true : false,['class' => 'form-control experience1'])}}</label>	</li>
						<li><label><span>7</span>{{Form::radio('experience1[7]','7', $evaluation->experience1 == 7 ? true : false,['class' => 'form-control experience1'])}}</label>	</li>
						<li><label><span>8</span>{{Form::radio('experience1[8]','8', $evaluation->experience1 == 8 ? true : false,['class' => 'form-control experience1'])}}</label>	</li>
						<li><label><span>9</span>{{Form::radio('experience1[9]','9', $evaluation->experience1 == 9 ? true : false,['class' => 'form-control experience1'])}}</label>	</li>
						<li><label><span>10</span>{{Form::radio('experience1[10]','10', $evaluation->experience1 == 10 ? true : false,['class' => 'form-control experience1'])}}</label></li>
					</ul>
					@if($errors->has('experience1'))
		  				<strong>{{$errors->first('experience1')}}</strong>
		  			@endif
				</div>
				<div class="col-sm-6">
					<p>
					  <label><strong>Justifique su respuesta:</strong> <br>
					  {{Form::textarea('experienceJ1', null, ["class" => "form-control"])}} </label>
					  @if($errors->has('experienceJ1'))
					  <strong>{{$errors->first('experienceJ1')}}</strong>
					  @endif
					</p>
		  		</div>
			</div>
		</li>
		<li>
			<p>¿El aspirante acredita experiencia en proyectos, investigaciones o intervenciones relacionadas con temas relacionados con el desarrollo sostenible?</p>
			<p><label>Sí  {{Form::radio('experience2[0]','1', $evaluation->experience2 == 1 ? true : false,['class' => 'form-control experience2'])}}</label>
				<label>No {{Form::radio('experience2[1]','0', $evaluation->experience2 == 0 ? true : false,['class' => 'form-control experience2'])}}</label>
				@if($errors->has('experience2'))
				<strong>{{$errors->first('experience2')}}</strong>
				@endif
    		</p>
		</li>
		<li>
			<p>En una escala de 0 a 10, donde cero es nada relevante y diez es muy relevante ¿qué tan relevante considera la experiencia del aspirante en el desarrollo de proyectos, investigaciones o intervenciones relacionadas con el desarrollo sostenible? </p>
			<div class="row">
				<div class="col-sm-6">
					<ul class="inline">
						<li><label><span>0</span>{{Form::radio('experience3[0]','0', $evaluation->experience3 == 0 ? true : false,['class' => 'form-control experience3'])}}	</label></li>
						<li><label><span>1</span>{{Form::radio('experience3[1]','1', $evaluation->experience3 == 1 ? true : false,['class' => 'form-control experience3'])}}	</label></li>
						<li><label><span>2</span>{{Form::radio('experience3[2]','2', $evaluation->experience3 == 2 ? true : false,['class' => 'form-control experience3'])}}	</label></li>
						<li><label><span>3</span>{{Form::radio('experience3[3]','3', $evaluation->experience3 == 3 ? true : false,['class' => 'form-control experience3'])}}	</label></li>
						<li><label><span>4</span>{{Form::radio('experience3[4]','4', $evaluation->experience3 == 4 ? true : false,['class' => 'form-control experience3'])}}	</label></li>
						<li><label><span>5</span>{{Form::radio('experience3[5]','5', $evaluation->experience3 == 5 ? true : false,['class' => 'form-control experience3'])}}	</label></li>
						<li><label><span>6</span>{{Form::radio('experience3[6]','6', $evaluation->experience3 == 6 ? true : false,['class' => 'form-control experience3'])}}	</label></li>
						<li><label><span>7</span>{{Form::radio('experience3[7]','7', $evaluation->experience3 == 7 ? true : false,['class' => 'form-control experience3'])}}	</label></li>
						<li><label><span>8</span>{{Form::radio('experience3[8]','8', $evaluation->experience3 == 8 ? true : false,['class' => 'form-control experience3'])}}	</label></li>
						<li><label><span>9</span>{{Form::radio('experience3[9]','9', $evaluation->experience3 == 9 ? true : false,['class' => 'form-control experience3'])}}	</label></li>
						<li><label><span>10</span>{{Form::radio('experience3[10]','10', $evaluation->experience3 == 10 ? true : false,['class' => 'form-control experience3'])}}</label></li>
      				</ul>
      				@if($errors->has('experience3'))
	  					<strong>{{$errors->first('experience3')}}</strong>
	  				@endif
				</div>
			
				<div class="col-sm-6">
					<p>
    				  <strong>Justifique su respuesta</strong>
    				  {{Form::textarea('experienceJ2', null, ["class" => "form-control"])}}
    				  @if($errors->has('experienceJ2'))
    				  <strong>{{$errors->first('experienceJ2')}}</strong>
    				  @endif
    				</p>
				</div>
      		</div>
	  		
		</li>
	</ol>
  </div>
</div>


<div class="divider"></div>
	
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Valoración de ensayo</h2>
	<p>En una escala de 0 a 10, donde 0 es nada de acuerdo y 10 es muy de acuerdo, evalúe las siguientes afirmaciones con base en el análisis del ensayo y el video enviado por el aspirante</p>
	
	<ol class="list line">
		<li>
			<p>El aspirante expresa con claridad las razones para participar en el programa</p>
      		<ul class="inline">
	  			<li><label><span>0</span>{{Form::radio('essay[0]','0', $evaluation->essay == 0 ? true : false,['class' => 'form-control essay'])}}   </label>	  </li>
	  			<li><label><span>1</span>{{Form::radio('essay[1]','1', $evaluation->essay == 1 ? true : false,['class' => 'form-control essay'])}}   </label>	  </li>
	  			<li><label><span>2</span>{{Form::radio('essay[2]','2', $evaluation->essay == 2 ? true : false,['class' => 'form-control essay'])}}   </label>	  </li>
	  			<li><label><span>3</span>{{Form::radio('essay[3]','3', $evaluation->essay == 3 ? true : false,['class' => 'form-control essay'])}}   </label>	  </li>
	  			<li><label><span>4</span>{{Form::radio('essay[4]','4', $evaluation->essay == 4 ? true : false,['class' => 'form-control essay'])}}   </label>	  </li>
	  			<li><label><span>5</span>{{Form::radio('essay[5]','5', $evaluation->essay == 5 ? true : false,['class' => 'form-control essay'])}}   </label>	  </li>
	  			<li><label><span>6</span>{{Form::radio('essay[6]','6', $evaluation->essay == 6 ? true : false,['class' => 'form-control essay'])}}   </label>	  </li>
	  			<li><label><span>7</span>{{Form::radio('essay[7]','7', $evaluation->essay == 7 ? true : false,['class' => 'form-control essay'])}}   </label>	  </li>
	  			<li><label><span>8</span>{{Form::radio('essay[8]','8', $evaluation->essay == 8 ? true : false,['class' => 'form-control essay'])}}   </label>	  </li>
	  			<li><label><span>9</span>{{Form::radio('essay[9]','9', $evaluation->essay == 9 ? true : false,['class' => 'form-control essay'])}}   </label>	  </li>
	  			<li><label><span>10</span>{{Form::radio('essay[10]','10', $evaluation->essay == 10 ? true : false,['class' => 'form-control essay'])}}</label></li>
      		</ul>
      				
	  		@if($errors->has('essay'))
	  		<strong>{{$errors->first('essay')}}</strong>
	  		@endif
		</li>
		<li>
			<p>El aspirante expresa con claridad las aportaciones que puede brindar a la agenda de gobierno abierto y desarrollo sostenible en su entidad</p>
      		<ul class="inline">
	  			<li><label><span>0</span>{{Form::radio('essay1[0]','0', $evaluation->essay1 == 0 ? true : false,['class' => 'form-control essay1'])}}	  </label></li>
	  			<li><label><span>1</span>{{Form::radio('essay1[1]','1', $evaluation->essay1 == 1 ? true : false,['class' => 'form-control essay1'])}}	  </label></li>
	  			<li><label><span>2</span>{{Form::radio('essay1[2]','2', $evaluation->essay1 == 2 ? true : false,['class' => 'form-control essay1'])}}	  </label></li>
	  			<li><label><span>3</span>{{Form::radio('essay1[3]','3', $evaluation->essay1 == 3 ? true : false,['class' => 'form-control essay1'])}}	  </label></li>
	  			<li><label><span>4</span>{{Form::radio('essay1[4]','4', $evaluation->essay1 == 4 ? true : false,['class' => 'form-control essay1'])}}	  </label></li>
	  			<li><label><span>5</span>{{Form::radio('essay1[5]','5', $evaluation->essay1 == 5 ? true : false,['class' => 'form-control essay1'])}}	  </label></li>
	  			<li><label><span>6</span>{{Form::radio('essay1[6]','6', $evaluation->essay1 == 6 ? true : false,['class' => 'form-control essay1'])}}	  </label></li>
	  			<li><label><span>7</span>{{Form::radio('essay1[7]','7', $evaluation->essay1 == 7 ? true : false,['class' => 'form-control essay1'])}}	  </label></li>
	  			<li><label><span>8</span>{{Form::radio('essay1[8]','8', $evaluation->essay1 == 8 ? true : false,['class' => 'form-control essay1'])}}	  </label></li>
	  			<li><label><span>9</span>{{Form::radio('essay1[9]','9', $evaluation->essay1 == 9 ? true : false,['class' => 'form-control essay1'])}}	  </label></li>
	  			<li><label><span>10</span>{{Form::radio('essay1[10]','10', $evaluation->essay1 == 10 ? true : false,['class' => 'form-control essay1'])}}</label></li>
      		</ul>
	  		@if($errors->has('essay1'))
	  		<strong>{{$errors->first('essay1')}}</strong>
	  		@endif
		</li>
		<li>
			<p>El aspirante es capaz de presentar ideas y argumentos escritos de forma eficaz</p>
      		<ul class="inline">
				<li><label><span>0</span>{{Form::radio('essay2[0]','0', $evaluation->essay2 == 0 ? true : false,['class' => 'form-control essay2'])}}	</label></li>
				<li><label><span>1</span>{{Form::radio('essay2[1]','1', $evaluation->essay2 == 1 ? true : false,['class' => 'form-control essay2'])}}	</label></li>
				<li><label><span>2</span>{{Form::radio('essay2[2]','2', $evaluation->essay2 == 2 ? true : false,['class' => 'form-control essay2'])}}	</label></li>
				<li><label><span>3</span>{{Form::radio('essay2[3]','3', $evaluation->essay2 == 3 ? true : false,['class' => 'form-control essay2'])}}	</label></li>
				<li><label><span>4</span>{{Form::radio('essay2[4]','4', $evaluation->essay2 == 4 ? true : false,['class' => 'form-control essay2'])}}	</label></li>
				<li><label><span>5</span>{{Form::radio('essay2[5]','5', $evaluation->essay2 == 5 ? true : false,['class' => 'form-control essay2'])}}	</label></li>
				<li><label><span>6</span>{{Form::radio('essay2[6]','6', $evaluation->essay2 == 6 ? true : false,['class' => 'form-control essay2'])}}	</label></li>
				<li><label><span>7</span>{{Form::radio('essay2[7]','7', $evaluation->essay2 == 7 ? true : false,['class' => 'form-control essay2'])}}	</label></li>
				<li><label><span>8</span>{{Form::radio('essay2[8]','8', $evaluation->essay2 == 8 ? true : false,['class' => 'form-control essay2'])}}	</label></li>
				<li><label><span>9</span>{{Form::radio('essay2[9]','9', $evaluation->essay2 == 9 ? true : false,['class' => 'form-control essay2'])}}	</label></li>
				<li><label><span>10</span>{{Form::radio('essay2[10]','10', $evaluation->essay2 == 10 ? true : false,['class' => 'form-control essay2'])}}</label></li>
      		</ul>
			@if($errors->has('essay2'))
			<strong>{{$errors->first('essay2')}}</strong>
			@endif
		</li>
		<li>
			<p>El aspirante muestra un conocimiento amplio de los debates actuales sobre gobierno abierto y desarrollo sostenible</p>
      		<ul class="inline">
	  			<li><label><span>0</span>{{Form::radio('essay3[0]','0', $evaluation->essay3 == 0 ? true : false,['class' => 'form-control essay3'])}}	  </label></li>
	  			<li><label><span>1</span>{{Form::radio('essay3[1]','1', $evaluation->essay3 == 1 ? true : false,['class' => 'form-control essay3'])}}	  </label></li>
	  			<li><label><span>2</span>{{Form::radio('essay3[2]','2', $evaluation->essay3 == 2 ? true : false,['class' => 'form-control essay3'])}}	  </label></li>
	  			<li><label><span>3</span>{{Form::radio('essay3[3]','3', $evaluation->essay3 == 3 ? true : false,['class' => 'form-control essay3'])}}	  </label></li>
	  			<li><label><span>4</span>{{Form::radio('essay3[4]','4', $evaluation->essay3 == 4 ? true : false,['class' => 'form-control essay3'])}}	  </label></li>
	  			<li><label><span>5</span>{{Form::radio('essay3[5]','5', $evaluation->essay3 == 5 ? true : false,['class' => 'form-control essay3'])}}	  </label></li>
	  			<li><label><span>6</span>{{Form::radio('essay3[6]','6', $evaluation->essay3 == 6 ? true : false,['class' => 'form-control essay3'])}}	  </label></li>
	  			<li><label><span>7</span>{{Form::radio('essay3[7]','7', $evaluation->essay3 == 7 ? true : false,['class' => 'form-control essay3'])}}	  </label></li>
	  			<li><label><span>8</span>{{Form::radio('essay3[8]','8', $evaluation->essay3 == 8 ? true : false,['class' => 'form-control essay3'])}}	  </label></li>
	  			<li><label><span>9</span>{{Form::radio('essay3[9]','9', $evaluation->essay3 == 9 ? true : false,['class' => 'form-control essay3'])}}	  </label></li>
	  			<li><label><span>10</span>{{Form::radio('essay3[10]','10', $evaluation->essay3 == 10 ? true : false,['class' => 'form-control essay3'])}}</label></li>
      		</ul>
	  		@if($errors->has('essay3'))
	  			<strong>{{$errors->first('essay3')}}</strong>
	  		@endif
		</li>
		<li>
			<p>El aspirante muestra conocimiento y sensibilidad sobre los principales desafíos de desarrollo que enfrenta su entidad federativa</p>
      		<ul class="inline">
	  			<li><label><span>0</span>{{Form::radio('essay4[0]','0', $evaluation->essay4 == 0 ? true : false,['class' => 'form-control essay4'])}}	</label></li>
	  			<li><label><span>1</span>{{Form::radio('essay4[1]','1', $evaluation->essay4 == 1 ? true : false,['class' => 'form-control essay4'])}}	</label></li>
	  			<li><label><span>2</span>{{Form::radio('essay4[2]','2', $evaluation->essay4 == 2 ? true : false,['class' => 'form-control essay4'])}}	</label></li>
	  			<li><label><span>3</span>{{Form::radio('essay4[3]','3', $evaluation->essay4 == 3 ? true : false,['class' => 'form-control essay4'])}}	</label></li>
	  			<li><label><span>4</span>{{Form::radio('essay4[4]','4', $evaluation->essay4 == 4 ? true : false,['class' => 'form-control essay4'])}}	</label></li>
	  			<li><label><span>5</span>{{Form::radio('essay4[5]','5', $evaluation->essay4 == 5 ? true : false,['class' => 'form-control essay4'])}}	</label></li>
	  			<li><label><span>6</span>{{Form::radio('essay4[6]','6', $evaluation->essay4 == 6 ? true : false,['class' => 'form-control essay4'])}}	</label></li>
	  			<li><label><span>7</span>{{Form::radio('essay4[7]','7', $evaluation->essay4 == 7 ? true : false,['class' => 'form-control essay4'])}}	</label></li>
	  			<li><label><span>8</span>{{Form::radio('essay4[8]','8', $evaluation->essay4 == 8 ? true : false,['class' => 'form-control essay4'])}}	</label></li>
	  			<li><label><span>9</span>{{Form::radio('essay4[9]','9', $evaluation->essay4 == 9 ? true : false,['class' => 'form-control essay4'])}}	</label></li>
	  			<li><label><span>10</span>{{Form::radio('essay4[10]','10', $evaluation->essay4 == 10 ? true : false,['class' => 'form-control essay4'])}}</label></li>
      		</ul>
      @if($errors->has('essay4'))
      <strong>{{$errors->first('essay4')}}</strong>
      @endif
		</li>
	</ol>
  </div>
</div>

<div class="divider"></div>

<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Valoración de video</h2>
    <p>En una escala de 0 a 10, donde 0 es nada de acuerdo y 10 es muy de acuerdo, evalúe las siguientes afirmaciones con base en el análisis del ensayo y el video enviado por el aspirante</p>
	<ol class="list line">
		<li>
			<p>El aspirante presenta una idea de proyecto que integra adecuadamente las perspectivas de gobierno abierto y desarrollo sostenible</p>
      		<ul class="inline">
	  			<li><label><span>0</span>{{Form::radio('video[0]','0', $evaluation->video == 0 ? true : false,['class' => 'form-control video'])}}   </label></li>
	  			<li><label><span>1</span>{{Form::radio('video[1]','1', $evaluation->video == 1 ? true : false,['class' => 'form-control video'])}}   </label></li>
	  			<li><label><span>2</span>{{Form::radio('video[2]','2', $evaluation->video == 2 ? true : false,['class' => 'form-control video'])}}   </label></li>
	  			<li><label><span>3</span>{{Form::radio('video[3]','3', $evaluation->video == 3 ? true : false,['class' => 'form-control video'])}}   </label></li>
	  			<li><label><span>4</span>{{Form::radio('video[4]','4', $evaluation->video == 4 ? true : false,['class' => 'form-control video'])}}   </label></li>
	  			<li><label><span>5</span>{{Form::radio('video[5]','5', $evaluation->video == 5 ? true : false,['class' => 'form-control video'])}}   </label></li>
	  			<li><label><span>6</span>{{Form::radio('video[6]','6', $evaluation->video == 6 ? true : false,['class' => 'form-control video'])}}   </label></li>
	  			<li><label><span>7</span>{{Form::radio('video[7]','7', $evaluation->video == 7 ? true : false,['class' => 'form-control video'])}}   </label></li>
	  			<li><label><span>8</span>{{Form::radio('video[8]','8', $evaluation->video == 8 ? true : false,['class' => 'form-control video'])}}   </label></li>
	  			<li><label><span>9</span>{{Form::radio('video[9]','9', $evaluation->video == 9 ? true : false,['class' => 'form-control video'])}}   </label></li>
	  			<li><label><span>10</span>{{Form::radio('video[10]','10', $evaluation->video == 10 ? true : false,['class' => 'form-control video'])}}</label></li>
      		</ul>
	  		@if($errors->has('video'))
	  			<strong>{{$errors->first('video')}}</strong>
	  		@endif
		</li>
		<li>
			<p>La idea desarrollada por el aspirante cuenta con el potencial de transformar una problemática relevante de su entidad federativa</p>
      		<ul class="inline">
	  			<li><label><span>0</span>{{Form::radio('video1[0]','0', $evaluation->video1 == 0 ? true : false,['class' => 'form-control video1'])}}	</label></li>
	  			<li><label><span>1</span>{{Form::radio('video1[1]','1', $evaluation->video1 == 1 ? true : false,['class' => 'form-control video1'])}}	</label></li>
	  			<li><label><span>2</span>{{Form::radio('video1[2]','2', $evaluation->video1 == 2 ? true : false,['class' => 'form-control video1'])}}	</label></li>
	  			<li><label><span>3</span>{{Form::radio('video1[3]','3', $evaluation->video1 == 3 ? true : false,['class' => 'form-control video1'])}}	</label></li>
	  			<li><label><span>4</span>{{Form::radio('video1[4]','4', $evaluation->video1 == 4 ? true : false,['class' => 'form-control video1'])}}	</label></li>
	  			<li><label><span>5</span>{{Form::radio('video1[5]','5', $evaluation->video1 == 5 ? true : false,['class' => 'form-control video1'])}}	</label></li>
	  			<li><label><span>6</span>{{Form::radio('video1[6]','6', $evaluation->video1 == 6 ? true : false,['class' => 'form-control video1'])}}	</label></li>
	  			<li><label><span>7</span>{{Form::radio('video1[7]','7', $evaluation->video1 == 7 ? true : false,['class' => 'form-control video1'])}}	</label></li>
	  			<li><label><span>8</span>{{Form::radio('video1[8]','8', $evaluation->video1 == 8 ? true : false,['class' => 'form-control video1'])}}	</label></li>
	  			<li><label><span>9</span>{{Form::radio('video1[9]','9', $evaluation->video1 == 9 ? true : false,['class' => 'form-control video1'])}}	</label></li>
	  			<li><label><span>10</span>{{Form::radio('video1[10]','10', $evaluation->video1 == 10 ? true : false,['class' => 'form-control video1'])}}</label></li>
      		</ul>
	  		@if($errors->has('video1'))
	  		<strong>{{$errors->first('video1')}}</strong>
	  		@endif
		</li>
		<li>
			<p>La idea desarrollada por el aspirante es factible de ser implementada en el mediano plazo en el marco de los ejercicios locales de gobierno abierto</p>
      		<ul class="inline">
	  			<li><label><span>0</span>{!!Form::radio('video2[1]','0', $evaluation->video2 == 0 ? true : false,['class' => 'form-control video2'])!!}	</label></li>
	  			<li><label><span>1</span>{!!Form::radio('video2[2]','1', $evaluation->video2 == 1 ? true : false,['class' => 'form-control video2'])!!}	</label></li>
	  			<li><label><span>2</span>{!!Form::radio('video2[3]','2', $evaluation->video2 == 2 ? true : false,['class' => 'form-control video2'])!!}	</label></li>
	  			<li><label><span>3</span>{!!Form::radio('video2[4]','3', $evaluation->video2 == 3 ? true : false,['class' => 'form-control video2'])!!}	</label></li>
	  			<li><label><span>4</span>{!!Form::radio('video2[5]','4', $evaluation->video2 == 4 ? true : false,['class' => 'form-control video2'])!!}	</label></li>
	  			<li><label><span>5</span>{!!Form::radio('video2[6]','5', $evaluation->video2 == 5 ? true : false,['class' => 'form-control video2'])!!}	</label></li>
	  			<li><label><span>6</span>{!!Form::radio('video2[7]','6', $evaluation->video2 == 6 ? true : false,['class' => 'form-control video2'])!!}	</label></li>
	  			<li><label><span>7</span>{!!Form::radio('video2[8]','7', $evaluation->video2 == 7 ? true : false,['class' => 'form-control video2'])!!}	</label></li>
	  			<li><label><span>8</span>{!!Form::radio('video2[9]','8', $evaluation->video2 == 8 ? true : false,['class' => 'form-control video2'])!!}	</label></li>
	  			<li><label><span>9</span>{!!Form::radio('video2[10]','9', $evaluation->video2 == 9 ? true : false,['class' => 'form-control video2'])!!}	</label></li>
	  			<li><label><span>10</span>{!!Form::radio('video2[11]','10', $evaluation->video2 == 10 ? true : false,['class' => 'form-control video2'])!!}</label></li>
      		</ul>
	  		@if($errors->has('video2'))
	  		<strong>{{$errors->first('video2')}}</strong>
	  		@endif
		</li>
		<li>
			<p>El aspirante explica de forma clara y con soltura su idea frente a la cámara</p>
      		<ul class="inline">
	  			<li><label><span>0</span>{{Form::radio('video3[0]','0', $evaluation->video3 == 0 ? true : false,['class' => 'form-control video3'])}}	</label></li>
	  			<li><label><span>1</span>{{Form::radio('video3[1]','1', $evaluation->video3 == 1 ? true : false,['class' => 'form-control video3'])}}	</label></li>
	  			<li><label><span>2</span>{{Form::radio('video3[2]','2', $evaluation->video3 == 2 ? true : false,['class' => 'form-control video3'])}}	</label></li>
	  			<li><label><span>3</span>{{Form::radio('video3[3]','3', $evaluation->video3 == 3 ? true : false,['class' => 'form-control video3'])}}	</label></li>
	  			<li><label><span>4</span>{{Form::radio('video3[4]','4', $evaluation->video3 == 4 ? true : false,['class' => 'form-control video3'])}}	</label></li>
	  			<li><label><span>5</span>{{Form::radio('video3[5]','5', $evaluation->video3 == 5 ? true : false,['class' => 'form-control video3'])}}	</label></li>
	  			<li><label><span>6</span>{{Form::radio('video3[6]','6', $evaluation->video3 == 6 ? true : false,['class' => 'form-control video3'])}}	</label></li>
	  			<li><label><span>7</span>{{Form::radio('video3[7]','7', $evaluation->video3 == 7 ? true : false,['class' => 'form-control video3'])}}	</label></li>
	  			<li><label><span>8</span>{{Form::radio('video3[8]','8', $evaluation->video3 == 8 ? true : false,['class' => 'form-control video3'])}}	</label></li>
	  			<li><label><span>9</span>{{Form::radio('video3[9]','9', $evaluation->video3 == 9 ? true : false,['class' => 'form-control video3'])}}	</label></li>
	  			<li><label><span>10</span>{{Form::radio('video3[10]','10', $evaluation->video3 == 10 ? true : false,['class' => 'form-control video3'])}}</label></li>
      		</ul>
	  		@if($errors->has('video3'))
	  		<strong>{{$errors->first('video3')}}</strong>
	  		@endif
		</li>
		<li>
			<p>El aspirante logra persuadir con respecto a la importancia y relevancia de su idea</p>
      		<ul class="inline">
	  			<li><label><span>0</span>{{Form::radio('video4[0]','0', $evaluation->video4 == 0 ? true : false,['class' => 'form-control video4'])}}	  </label></li>
	  			<li><label><span>1</span>{{Form::radio('video4[1]','1', $evaluation->video4 == 1 ? true : false,['class' => 'form-control video4'])}}	  </label></li>
	  			<li><label><span>2</span>{{Form::radio('video4[2]','2', $evaluation->video4 == 2 ? true : false,['class' => 'form-control video4'])}}	  </label></li>
	  			<li><label><span>3</span>{{Form::radio('video4[3]','3', $evaluation->video4 == 3 ? true : false,['class' => 'form-control video4'])}}	  </label></li>
	  			<li><label><span>4</span>{{Form::radio('video4[4]','4', $evaluation->video4 == 4 ? true : false,['class' => 'form-control video4'])}}	  </label></li>
	  			<li><label><span>5</span>{{Form::radio('video4[5]','5', $evaluation->video4 == 5 ? true : false,['class' => 'form-control video4'])}}	  </label></li>
	  			<li><label><span>6</span>{{Form::radio('video4[6]','6', $evaluation->video4 == 6 ? true : false,['class' => 'form-control video4'])}}	  </label></li>
	  			<li><label><span>7</span>{{Form::radio('video4[7]','7', $evaluation->video4 == 7 ? true : false,['class' => 'form-control video4'])}}	  </label></li>
	  			<li><label><span>8</span>{{Form::radio('video4[8]','8', $evaluation->video4 == 8 ? true : false,['class' => 'form-control video4'])}}	  </label></li>
	  			<li><label><span>9</span>{{Form::radio('video4[9]','9', $evaluation->video4 == 9 ? true : false,['class' => 'form-control video4'])}}	  </label></li>
	  			<li><label><span>10</span>{{Form::radio('video4[10]','10', $evaluation->video4 == 10 ? true : false,['class' => 'form-control video4'])}}</label></li>
      		</ul>
	  		@if($errors->has('video4'))
	  			<strong>{{$errors->first('video4')}}</strong>
	  		@endif
		</li>
    </div>
</div>

<div class="divider"></div>

<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Guardar evaluación', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}