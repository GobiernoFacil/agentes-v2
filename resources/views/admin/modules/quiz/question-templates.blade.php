<!-- THE TEMPLATES -->
<script id="question-template" type="text">
  <form>
    <p>
      <input type="text">
      <input type="submit" value="agregar" class ="btn gde">
    </p>
    <p><a class="remove-question" href="#">[ x ]</a></p>
  </form>
</script>

<script id="real-question-template" type="text">
  <p><a href="#" class="question-name"></a></p>
  <ul></ul>
  <p><a href="#" class="add-answer">Agregar respuesta</a></p>
  <p><a href="#" class="remove-question">[ x ]</a><p>
</script>

<script id="answer-template" type="text">
  <form>
    <p>
      <input type="text">
      <input type="submit" value="agregar">
      <a class="remove-answer" href="#">[ x ]</a>
    </p>
  </form>
</script>

<script id="real-answer-template" type="text">
  <p>
    <a href="#" class="answer-name"></a>
    <a href="#" class="switch-answer">es respuesta correcta</a>
    <a href="#" class="remove-answer">[ x ]</a>
  <p>
</script>
