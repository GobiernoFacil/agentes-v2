<!-- THE TEMPLATES -->
<script id="question-template" type="text">
  <form>
  <div class="row" >
    <div class="col-sm-12">
      <p>
    <p>
    <label><strong>Escribe la pregunta <a class="remove-question" href="#">[ x ]</a></strong> <br>
    {{Form::text('name',null, ["class" => "form-control"])}} </label>
    </p>
    <div class="row">
      <div class="col-sm-12">
    {{Form::submit('Guardar pregunta', ['class' => 'btn gde'])}}
    </div>
    </div>
  </form>
</script>

<script id="real-question-template" type="text">
  <p><a href="#" class="question-name"></a><a href="#" class="remove-question">[ x ]</a></p>
  <ul></ul>
  <p><a href="#" class="add-answer btn xs ev">Agregar respuesta</a></p>

</script>

<script id="answer-template" type="text">
  <form>
  <div class="row" >
    <div class="col-sm-12">
      <p>
    <p>
    <label><strong>Escribe la respuesta <a class="remove-answer" href="#">[ x ]</a></strong> <br>
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
    <a href="#" class="answer-name"></a><a href="#" class="remove-answer">[ x ]</a>
    <p>
    <a href="#" class="switch-answer btn xs ev">Seleccionar como respuesta correcta</a>
    </p>
  <p>
</script>
