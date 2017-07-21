{!! Form::open(['url' => url("tablero-facilitador/foros/pregunta/save/{$forum->id}"), "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información del tema o la pregunta</h2>
  </div>
</div>
<!-- title -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Tema o pregunta</strong> <br>
      {{Form::text('topic',null, ["class" => "form-control"])}} </label>
      @if($errors->has('topic'))
      <strong class="danger">{{$errors->first('topic')}}</strong>
      @endif
      @if($errors->has('similar_slug'))
      <strong class="danger">Escriba una pregunta o tema único</strong>
      @endif
    </p>
  </div>
</div>

<!-- situación  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Descripción</strong> <br>
      {{Form::textarea('description',null, ["class" => "form-control"])}} </label>
      @if($errors->has('description'))
      <strong class="danger">{{$errors->first('description')}}</strong>
      @endif
    </p>
  </div>
</div>



<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Agregar tema o pregunta', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
