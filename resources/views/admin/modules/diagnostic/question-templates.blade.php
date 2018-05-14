<!-- THE TEMPLATES -->
<script id="question-template" type="text">
  <form>
  <div class="row" >
    <div class="col-sm-12">
        <p>
        <label><strong>Selecciona el tipo de pregunta <a class="remove-question" href="#" title="Eliminar pregunta">x</a></strong> <br>
        {{Form::select('type',[null=>'Selecciona una opción','open'=>'Abierta','answers'=>'Elección Múltiple','radio'=>'Escala'],null, ["class" => "form-control",'id'=>'typeSelector'])}} </label>
        </p>
        <p>
        <label><strong>Esta pregunta es </strong> <br>
        {{Form::select('required',[null=>'Selecciona una opción',0=>'Opcional',1=>'Obligatoria'],null, ["class" => "form-control",'id'=>'requiredSelector'])}} </label>
        </p>
        <p>
        <label><strong>Escribe la pregunta </strong> <br>
        {{Form::text('name',null, ["class" => "form-control"])}} </label>
        </p>
        <div class="row">
          <div class="col-sm-12">
            {{Form::submit('Guardar pregunta', ['class' => 'btn gde'])}}
          </div>
        </div>
    </div>
  </form>
</script>

<script id="real-question-template" type="text">
  <p><a href="#" class="question-name"></a></p> <a href="#" class="remove-question" title="Eliminar pregunta">x</a>
  <ul></ul>
  <p><span class="question-type"></span></p>
  <p>En este tipo de pregunta no es necesario agregar una respuesta correcta.</p>
  <p><a href="#" class="add-answer btn xs view">Agregar respuesta [+]</a></p>
</script>

<script id="question-template-open" type="text">
  <p><a href="#" class="question-name"></a></p> <a href="#" class="remove-question" title="Eliminar pregunta">x</a>
  <ul></ul>
  <p><span class="question-type"></span></p>
  <p>En este tipo de pregunta no es necesario agregar una respuesta.</p>
</script>

<script id="answer-template" type="text">
  <form>
  <div class="row" >
    <div class="col-sm-12">
      <p>
    <p>
    <label><strong>Escribe la respuesta <a class="remove-answer" href="#">x</a></strong> <br>
    {{Form::text('name',null, ["class" => "form-control"])}} </label>
    </p>
    <div class="row">
      <div class="col-sm-12">
    {{Form::submit('Guardar respuesta', ['class' => 'btn gde'])}}
    </div>
    </div>
  </form>
</script>

<script id="real-answer-template" type="text">
  <p>
    <a href="#" class="answer-name"></a> <a href="#" class="remove-answer">x</a>  <a href="#" class="switch-answer btn xs ev">Seleccionar como respuesta correcta</a>
  </p>
</script>

<script id="update-question-template" type="text">
  <form>
    <p>
      <input type="text">
      <input type="submit" value="editar">
    <p>
  </form>
</script>

<script id="real-question-update-template" type="text">
  <a href="#" class="question-name"></a>
</script>
