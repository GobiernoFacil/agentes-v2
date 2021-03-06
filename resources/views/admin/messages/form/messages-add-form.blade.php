{!! Form::open(['url' => url("dashboard/mensajes/programa/$program->id/save"), "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información del mensaje</h2>
  </div>
</div>
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
  <div class="col-sm-12">
    <p>{{Form::submit('Enviar', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
