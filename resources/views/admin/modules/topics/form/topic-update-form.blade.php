{!! Form::model($topic,['url' => url("dashboard/sesiones/tematicas/update/$topic->id"), "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información de la temática</h2>
  </div>
</div>
<!-- name -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Nombre</strong> <br>
      {{Form::text('name',null, ["class" => "form-control"])}} </label>
      @if($errors->has('name'))
      <strong class="danger">{{$errors->first('name')}}</strong>
      @endif
    </p>
  </div>
</div>
<!-- orden -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Número de temática</strong> <br>
      {{Form::text('order',null, ["class" => "form-control"])}} </label>
      @if($errors->has('order'))
      <strong class="danger">{{$errors->first('order')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- knowledge  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Conocimientos</strong> <br>
      {{Form::textarea('knowledge',null, ["class" => "form-control"])}} </label>
      @if($errors->has('knowledge'))
      <strong class="danger">{{$errors->first('knowledge')}}</strong>
      @endif
    </p>
  </div>
</div>
<!--values  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Valores</strong> <br>
      {{Form::textarea('values',null, ["class" => "form-control"])}} </label>
      @if($errors->has('values'))
      <strong class="danger">{{$errors->first('values')}}</strong>
      @endif
    </p>
  </div>
</div>
<!-- abilities  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Habilidades</strong> <br>
      {{Form::textarea('abilities',null, ["class" => "form-control"])}} </label>
      @if($errors->has('abilities'))
      <strong class="danger">{{$errors->first('abilities')}}</strong>
      @endif
    </p>
  </div>
</div>
<!-- products  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Productos</strong> <br>
      {{Form::textarea('products',null, ["class" => "form-control"])}} </label>
      @if($errors->has('products'))
      <strong class="danger">{{$errors->first('products')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Guardar temática', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
