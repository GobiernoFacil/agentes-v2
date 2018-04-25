{!! Form::open(['url' => url("tablero/$program->slug/mensajes/save"), "class" => "form-horizontal"]) !!}
<div class="divider bg"></div>

<!-- title -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Asunto</strong> <br>
      {{Form::text('title',null, ["class" => "form-control"])}} </label>
      @if($errors->has('title'))
      <strong class="danger">{{$errors->first('title')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <!-- destinatario -->
      <label><strong>Destinatario</strong><br>
      {{Form::select('to_id',$users,null,["class" => "form-control"])}}</label>
      @if($errors->has('to_id'))
      <strong class="danger">{{$errors->first('to_id')}}</strong>
      @endif
    </p>
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
  <div class="col-sm-3 col-sm-offset-9">
    <p>{{Form::submit('Enviar mensaje', ['class' => 'btn view block sessions_l'])}}</p>
  </div>
</div>
{!! Form::close() !!}
