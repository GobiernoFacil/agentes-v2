{!! Form::open(['url' => url("dashboard/foros/programa/$program->id/pregunta/save/{$forum->id}"), "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información de la pregunta o el tema</h2>
  </div>
</div>
<!-- title -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Pregunta o tema</strong> <br>
      {{Form::text('topic',null, ["class" => "form-control"])}} </label>
      @if($errors->has('topic'))
      <strong class="danger">{{$errors->first('topic')}}</strong>
      @endif
      @if($errors->has('similar_slug'))
      <strong class="danger">Ya existe un tema similar, por favor, selecciona uno diferente</strong>
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
    <p>{{Form::submit('Agregar pregunta o tema', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
