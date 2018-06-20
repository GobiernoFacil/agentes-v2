{!! Form::open(['url' => url("dashboard/encuestas/programa/$program->id/save"), "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información general de la evaluación</h2>
  </div>
</div>
<!-- title -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Nombre</strong> <br>
      {{Form::text('title',null, ["class" => "form-control"])}} </label>
      @if($errors->has('title'))
      <strong class="danger">{{$errors->first('title')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- title -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Tipo de encuesta</strong> <br>
      {{Form::select('type',[null=>'Selecciona una opción','facilitator'=>'Facilitadores','general'=>'General',],null, ["class" => "form-control", "id"=>"type"])}} </label>
      @if($errors->has('type'))
      <strong class="danger">{{$errors->first('type')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- facilitator -->
<div class="row">
  <div class="col-sm-12" id = "facilitator_name" style = "{{old('type') === 'facilitator' ? "" : 'display:none;'}}">
    <p>
      <label><strong>Facilitador</strong> <br>
      {{Form::select('facilitator_id',$facilitators,null, ["class" => "form-control","id"=>'facilitator'])}} </label>
      @if($errors->has('facilitator_id'))
      <strong class="danger">{{$errors->first('facilitator_id')}}</strong>
      @endif
    </p>
  </div>
</div>



<!-- descripción  -->
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
    <p>{{Form::submit('Continuar', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
