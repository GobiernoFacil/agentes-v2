<div class="ap_modal-bg" style="display:none;" id='ev_modal'>
	<div class="box">
		<div class="row">
		  <div class="col-sm-12">
		    <?php /*
		    @include('fellow.evaluation.forms.template-form')

		      <p id="GF-PNUD-start-quiz-btn"><a href="#">El botón que inicia el cuestionario</a></p>*/ ?>

		    <div id="GF-PNUD-quiz-texmplate" style="display: none;">
		      <p class="ap_test_count">PREGUNTA
		        <span id="GF-PNUD-quiz-current-question"></span> de
		        <span id="GF-PNUD-quiz-total-questions"></span>
		      </p>

		      <h2 id="GF-PNUD-quiz-question"></h2>
		      <form>
		        <ul id="GF-PNUD-quiz-answers" class="ap_test_answers"></ul>
		      </form>

		      <div id="GF-PNUD-quiz-status-bar">
		        <p style="display: none;" id="GF-PNUD-quiz-good-response">Tu respuesta es correcta</p>
            <p style="display: none;" id="GF-PNUD-quiz-bad-response">Tu respuesta es incorrecta, respuestas correctas: </p>
            <ul style="display: none;" id="GF-PNUD-quiz-correct-answers" >
            </ul>
						<p style="display: none;" id="GF-PNUD-quiz-null-response" >Selecciona una opción</p>
		        <div class="row">
			        <div class="col-sm-2 col-sm-offset-10">
						          <p id="GF-PNUD-quiz-eval-btn"><a href="#" class="btn view block sessions_l">Continuar</a></p>
						          <p style="display: none" id="GF-PNUD-quiz-next-btn"><a class="btn view block sessions_l" href="#">Continuar</a></p>
						          <p style="display: none;" id="GF-PNUD-quiz-end-btn"><a class="btn view block sessions_l" href="{{url("tablero/{$program->slug}/encuestas/$survey->slug/finalizar")}}">Finalizar</a></p>
		        	</div>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</div>
