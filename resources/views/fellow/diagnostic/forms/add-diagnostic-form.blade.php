{!! Form::open(['url' => url("tablero/aprendizaje/examen-diagnostico/examen-diagnostico/examen/evaluar/save"), "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Test de conocimientos sobre Gobierno Abierto, Co-Creación e Iniciativas Innovadoras</h2>
  </div>
</div>
<!-- answer_1 -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Describe brevemente el concepto de Gobierno Abierto, así como su relación con la resolución de problemas públicos y la gestión pública gubernamental</strong> <br>
      {{Form::textarea('answer_1',null, ["class" => "form-control"])}} </label>
      @if($errors->has('answer_1'))
      <strong class="danger">{{$errors->first('answer_1')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- answer_2 -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Menciona dos Objetivos de la Agenda de Desarrollo Sostenible y cómo se relaciona cada uno con los mecanismos de Gobierno Abierto.</strong> <br>
      {{Form::textarea('answer_2',null, ["class" => "form-control"])}} </label>
      @if($errors->has('answer_2'))
      <strong class="danger">{{$errors->first('answer_2')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- answer_3 -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Ejemplifica una acción de incidencia en política pública que hayas ejecutado, identificando objetivo(s) de la incidencia, actores relevantes, estrategia para la consecución de dichos objetivos, los resultados obtenidos y deseados, una breve explicación sobre la brecha entre ambos (en caso de existir) y las lecciones aprendidas sobre el proceso</strong> <br>
      {{Form::textarea('answer_3',null, ["class" => "form-control"])}} </label>
      @if($errors->has('answer_3'))
      <strong class="danger">{{$errors->first('answer_3')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- answer_4 -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Menciona los elementos que consideras que integran a una estrategia de comunicación exitosa y sus fases de implementación</strong> <br>
      {{Form::textarea('answer_4',null, ["class" => "form-control"])}} </label>
      @if($errors->has('answer_4'))
      <strong class="danger">{{$errors->first('answer_4')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- answer_5 -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Con respecto al proyecto a generar dentro del marco del fellowship, describe si éste tiene implicaciones presupuestarias para su implementación, así como las potenciales fuentes de financiamiento y la estrategia para la consecución de fondos</strong> <br>
      {{Form::textarea('answer_5',null, ["class" => "form-control"])}} </label>
      @if($errors->has('answer_5'))
      <strong class="danger">{{$errors->first('answer_5')}}</strong>
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
