{!! Form::open(['url' => url("tablero/$program->slug/mensajes/conversacion/save/".encrypt($conversation->id)), "class" => "form-horizontal"]) !!}
<div class="divider"></div>

<!-- mensaje  -->
<div class="row">
  <div class="col-sm-12">
	 <label><h3>Mensaje:</h3>
	 {{Form::textarea('message',null, ["class" => "form-control"])}} </label>
    <p>
      @if($errors->has('message'))
      <strong class="danger">{{$errors->first('message')}}</strong>
      @endif
    </p>
  </div>
</div>



<div class="row">
  <div class="col-sm-3 col-sm-offset-9">
    <p>{{Form::submit('Enviar mensaje', ['class' => 'btn view block sessions_l'])}}</p>
  </div>
</div>
{!! Form::close() !!}
