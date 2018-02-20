@if(!empty($single))
	<?php $notice = $single->notice;?>
@endif

{!! Form::model($aspirantFile,['url' => "tablero-aspirante/convocatorias/$notice->slug/aplicar", "class" => "form-horizontal",'id'=>'filesForm','files'=>true]) !!}


<div class="row">
  <div class="col-sm-12">
    <p>
      <p>Realiza un escrito en donde expongas las razones por las cuales estes
        interesado en participar en el programa de formación de Agentes Locales
        de Cambio, así como las aportaciones que puedes brindar a su contexto
        local como resultado de su participación en este programa (max 400
        palabras ).</p>
      {{Form::textarea('motives', $aspirantFile->motives, ["class" => "form-control","id"=>"motives"])}}
      @if($errors->has('motives'))
      <strong class="error">{{$errors->first('motives')}}</strong>
      @endif
      @if($errors->has('motivesMax'))
      <strong class="error">{{$errors->first('motivesMax')}}</strong>
      @endif
			<strong class="danger" id ="maxWords" style="display:none;">Has alcanzado el límite de palabras, el límite es de 400 y has escrito <span id="nbwords"></span>.</strong>
    </p>
  </div>
</div>


<div class="row">
  <div class="col-sm-3 col-sm-offset-9">
    <p>{{Form::submit('Continuar', ['class' => 'btn gde'])}}</p>
  </div>
</div>


{!! Form::close() !!}
