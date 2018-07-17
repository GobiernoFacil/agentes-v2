<div class="row">
  <div class="col-sm-2 col-sm-offset-10">
          <p id="GF-PNUD-quiz-eval-btn"><a href="#" class="btn view block sessions_l">Continuar</a></p>
          <p style="display: none" id="GF-PNUD-quiz-next-btn"><a class="btn view block sessions_l" href="#">Continuar</a></p>
          @if(isset($activity))
            <p style="display: none;" id="GF-PNUD-quiz-end-btn"><a class="btn view block sessions_l" href="{{url("tablero/{$activity->session->module->program->slug}/encuestas/$activity->slug/gracias")}}">Finalizar</a></p>
          @else
            <p style="display: none;" id="GF-PNUD-quiz-end-btn"><a class="btn view block sessions_l" href="{{url("tablero/{$program->slug}/encuestas/$survey->slug/gracias")}}">Finalizar</a></p>
          @endif

  </div>
</div>
