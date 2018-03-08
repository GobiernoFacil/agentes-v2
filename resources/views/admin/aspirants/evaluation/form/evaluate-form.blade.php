{!! Form::model($ev,['url' => url("dashboard/aspirantes/convocatoria/$notice->id/evaluar-aplicacion/$aspirant->id"), "class" => "form-horizontal"]) !!}

  <div class="row">
    <div class="col-sm-12">
      <h2 class="sa_title">Evaluar exposición de motivos </h2>
      <a href='{{url("dashboard/aspirantes/convocatoria/$notice->id/download/$aspirant->id/motivos")}}'  class="btn view xs"> Descargar exposición de motivos</a>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
          <p>
              <label><strong>Calificación (0 a 10)</strong> <br>
        		 {{Form::text('essayGrade',null, ["class" => "form-control"])}}</label>
        			@if($errors->has('essayGrade'))
        				<strong class="danger">{{$errors->first('essayGrade')}}</strong>
        			@endif
          </p>
          <p>
              <label><strong>Comentarios (opcional)</strong> <br>
             {{Form::textarea('essayComments',null, ["class" => "form-control"])}}</label>
              @if($errors->has('essayComments'))
                <strong class="danger">{{$errors->first('essayComments')}}</strong>
              @endif
          </p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <h2 class="sa_title">Evaluar Perfil Curricular </h2>
      <a href='{{url("dashboard/aspirantes/convocatoria/$notice->id/download/$aspirant->id/cv")}}'  class="btn view xs"> Descargar Perfil Curricular</a>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <p>
          <label><strong>Calificación (0 a 10)</strong> <br>
         {{Form::text('experienceGrade',null, ["class" => "form-control"])}}</label>
          @if($errors->has('experienceGrade'))
            <strong class="danger">{{$errors->first('experienceGrade')}}</strong>
          @endif
      </p>
      <p>
          <label><strong>Comentarios (opcional)</strong> <br>
         {{Form::textarea('experienceComments',null, ["class" => "form-control"])}}</label>
          @if($errors->has('experienceComments'))
            <strong class="danger">{{$errors->first('experienceComments')}}</strong>
          @endif
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <h2 class="sa_title">Evaluar Video</h2>
      <div id='videoB'></div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <p>
          <label><strong>Calificación (0 a 10)</strong> <br>
         {{Form::text('videoGrade',null, ["class" => "form-control"])}}</label>
          @if($errors->has('videoGrade'))
            <strong class="danger">{{$errors->first('videoGrade')}}</strong>
          @endif
      </p>
      <p>
          <label><strong>Comentarios (opcional)</strong> <br>
         {{Form::textarea('videoComments',null, ["class" => "form-control"])}}</label>
          @if($errors->has('videoComments'))
            <strong class="danger">{{$errors->first('videoComments')}}</strong>
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
