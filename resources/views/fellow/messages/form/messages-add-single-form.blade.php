{!! Form::open(['url' => url("tablero/$program->slug/mensajes/conversacion/save/".encrypt($conversation->id)), "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información del mensaje</h2>
  </div>
</div>

<!-- situación  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Mensaje</strong> <br>
      {{Form::textarea('message',null, ["class" => "form-control"])}} </label>
      @if($errors->has('message'))
      <strong class="danger">{{$errors->first('message')}}</strong>
      @endif
    </p>
  </div>
</div>



<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Enviar', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
