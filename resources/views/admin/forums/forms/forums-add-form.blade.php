{!! Form::open(['url' => url("dashboard/foros/save"), "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información del foro</h2>
  </div>
</div>
<!-- title -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Tema</strong> <br>
      {{Form::text('topic',null, ["class" => "form-control"])}} </label>
      @if($errors->has('topic'))
      <strong class="danger">{{$errors->first('topic')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- tipo -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Tipo de foro</strong> <br>
      {{Form::select('type',$types,null, ['class' => 'form-control', 'id'=>'types'])}}
      @if($errors->has('type'))
      <strong class="danger">{{$errors->first('type')}}</strong>
      @endif
    </p>
  </div>
</div>

@if($states)
  <!-- state -->
  <div class="row">
    <div class="col-sm-12" style ="display:none;" id = 'state_div'>
      <p>
        <label><strong>Estado</strong> <br>
        {{Form::select('state',$states,0, ['class' => 'form-control'])}}
        @if($errors->has('state'))
        <strong class="danger">{{$errors->first('state')}}</strong>
        @endif
      </p>
    </div>
  </div>
@endif


<!-- expert -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Sesión</strong></label>
      {{Form::select('session_id',$sessions,0, ['class' => 'form-control','id'=>"session"])}}
      @if($errors->has('session_id'))
      <strong class="danger">{{$errors->first('session_id')}}</strong>
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
    <p>{{Form::submit('Guardar', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
