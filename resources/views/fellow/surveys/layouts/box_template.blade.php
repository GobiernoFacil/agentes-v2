<div class="ap_modal-bg" style="display:none;" id='ev_modal'>
	<div class="box">
		<div class="row">
		  <div class="col-sm-12">

		    <div id="GF-PNUD-quiz-texmplate" style="display: none;">
		      <p class="ap_test_count">PREGUNTA
		        <span id="GF-PNUD-quiz-current-question"></span> de
		        <span id="GF-PNUD-quiz-total-questions"></span>
		      </p>

		      <h2 id="GF-PNUD-quiz-question"></h2>

		      <form id = "GF-multiple" style ="display:none;">
		        <ul id="GF-PNUD-quiz-answers" class="ap_test_answers"></ul>
		      </form>

					<form id = "GF-open" style ="display:none;">
		        <ul id="GF-PNUD-quiz-open" class="ap_test_answers"></ul>
		      </form>

					<form id = "GF-scale" style ="display:none;">
		        <ul id="GF-PNUD-quiz-radio" class=" inline"></ul>
		      </form>

		      <div id="GF-PNUD-quiz-status-bar">
		        @include('fellow.surveys.layouts.messages_template')
		        @include('fellow.surveys.layouts.buttons_template')
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</div>
