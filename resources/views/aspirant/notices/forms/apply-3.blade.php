{!! Form::model($aspirantFile,['url' => "tablero-aspirante/convocatorias/$notice->slug/aplicar/agregar-video", "class" => "form-horizontal",'id'=>'filesForm','files'=>true]) !!}


<div class="row">
  <div class="col-sm-12">
	  <h2>Video Youtube</h2>
	  <p>Elabora un vídeo breve – alrededor de 1 minuto– en donde te presente y destaques las cualidades que te distinguen como un candidato idóneo para participar en el Programa de Formación.</p>
	  <p>El video puede realizarse con cualquier dispositivo (teléfono móvil, tableta o cámara
digital), y deberá ser subido a la plataforma en línea <a href="http://www.youtube.com">YouTube</a>.</p>
      <p><label>Agrega el url de tu video en Youtube
      {{Form::text('video', null, ["class" => "form-control","id"=>"video"])}}
      @if($errors->has('video'))
      <strong class="error">{{$errors->first('video')}}</strong>
      @endif
      </label>
      <strong class="error" id ="urlError" style="display:none;">Escribe un URL válido</strong>
    </p>
  </div>
</div>


<div class="row">
  <div class="col-sm-3 col-sm-offset-9">
    <p>{{Form::submit('Continuar', ['class' => 'btn gde'])}}</p>
  </div>
</div>


{!! Form::close() !!}
