{!! Form::model($evaluation,['url' => url("dashboard/evaluacion/diagnostico/evaluar/1/{$evaluation->id}/save"), "class" => "form-horizontal"]) !!}

<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Test de conocimientos sobre Gobierno Abierto, Co-Creación e Iniciativas Innovadoras</h2>
    <ol class="list line">
      <li>
        <p>Describe brevemente el concepto de Gobierno Abierto, así como su relación con la resolución de problemas públicos y la gestión pública gubernamental<br>

          <strong>Respuesta</strong><br>
          {{$answers->answer_1}}

        </p>
        <p>¿El concepto de Gobierno Abierto expuesto cuenta con elementos como transparencia, rendición de cuentas, participación ciudadana, uso de la tecnología, co-creación y diálogo entre pares?</p>
        <p>
          <label>Sí {{Form::radio('answer_q1_1[0]','1', $evaluation->answer_q1_1== 1 ? true : false,['class' => 'form-control answer_q1_1'])}}</label>
          <label>No {{Form::radio('answer_q1_1[1]','0', ($evaluation->answer_q1_1 == 0 && $evaluation->answer_q1_1 != null) ? true : false,['class' => 'form-control answer_q1_1'])}}
          </p>
          @if($errors->has('answer_q1_1'))</label>
          <strong class="danger">{{$errors->first('answer_q1_1')}}</strong>
          @endif

          <p>¿Se proporcionó una ejemplificación del Gobierno Abierto para la ejecución de acciones públicas que contribuyan a la resolución de públicos que incluya la incorporación de los elementos conceptuales relativos a apertura gubernamental?</p>
          <p>
            <label>Sí {{Form::radio('answer_q1_2[0]','1', $evaluation->answer_q1_2== 1 ? true : false,['class' => 'form-control answer_q1_2'])}}</label>
            <label>No {{Form::radio('answer_q1_2[1]','0', ($evaluation->answer_q1_2 == 0 && $evaluation->answer_q1_2 != null) ? true : false,['class' => 'form-control answer_q1_2'])}}
            </p>
            @if($errors->has('answer_q1_2'))</label>
            <strong class="danger">{{$errors->first('answer_q1_2')}}</strong>
            @endif

            <p>¿Se describe con claridad las relaciones del Gobierno abierto con las políticas, programas y acciones ejecutadas por el Estado?</p>
            <p>
              <label>Sí {{Form::radio('answer_q1_3[0]','1', $evaluation->answer_q1_3== 1 ? true : false,['class' => 'form-control answer_q1_3'])}}</label>
              <label>No {{Form::radio('answer_q1_3[1]','0', ($evaluation->answer_q1_3 == 0 && $evaluation->answer_q1_3 != null) ? true : false,['class' => 'form-control answer_q1_3'])}}
              </p>
              @if($errors->has('answer_q1_3'))</label>
              <strong class="danger">{{$errors->first('answer_q1_3')}}</strong>
              @endif
              <p>
                <label><strong>Justifique su respuesta:</strong> <br>
                  {{Form::textarea('answer_q1_j', null, ["class" => "form-control"])}} </label>
                  @if($errors->has('answer_q1_j'))
                  <strong class="danger">{{$errors->first('answer_q1_j')}}</strong>
                  @endif
                </p>
              </li>
              <li>
                <p>Menciona dos Objetivos de la Agenda de Desarrollo Sostenible y cómo se relaciona cada uno con los mecanismos de Gobierno Abierto<br>

                  <strong>Respuesta</strong><br>
                  {{$answers->answer_2}}

                </p>
                <p>¿Se identificaron claramente dos Objetivos de la Agenda 2030?</p>
                <p>
                  <label>Sí {{Form::radio('answer_q2_1[0]','1', $evaluation->answer_q2_1== 1 ? true : false,['class' => 'form-control answer_q2_1'])}}</label>
                  <label>No {{Form::radio('answer_q2_1[1]','0', ($evaluation->answer_q2_1 == 0 && $evaluation->answer_q2_1 != null) ? true : false,['class' => 'form-control answer_q2_1'])}}
                  </p>
                  @if($errors->has('answer_q2_1'))</label>
                  <strong class="danger">{{$errors->first('answer_q2_1')}}</strong>
                  @endif

                  <p>¿Se establecen los mecanismos de Gobierno Abierto mediante los cuales se busca la consecución de los Objetivos Mencionados?</p>
                  <p>
                    <label>Sí {{Form::radio('answer_q2_2[0]','1', $evaluation->answer_q2_2== 1 ? true : false,['class' => 'form-control answer_q2_2'])}}</label>
                    <label>No {{Form::radio('answer_q2_2[1]','0', ($evaluation->answer_q2_2 == 0 && $evaluation->answer_q2_2 != null) ? true : false,['class' => 'form-control answer_q2_2'])}}
                    </p>
                    @if($errors->has('answer_q2_2'))</label>
                    <strong class="danger">{{$errors->first('answer_q2_2')}}</strong>
                    @endif
                    <p>
                      <label><strong>Justifique su respuesta:</strong> <br>
                        {{Form::textarea('answer_q2_j', null, ["class" => "form-control"])}} </label>
                        @if($errors->has('answer_q2_j'))
                        <strong class="danger">{{$errors->first('answer_q2_j')}}</strong>
                        @endif
                      </p>
                    </li>
                    <li>
                      <p>Ejemplifica una acción de incidencia en política pública que hayas ejecutado, identificando objetivo(s) de la incidencia, actores relevantes, estrategia para la consecución de dichos objetivos, los resultados obtenidos y deseados, una breve explicación sobre la brecha entre ambos (en caso de existir) y las lecciones aprendidas sobre el proceso<br>

                        <strong>Respuesta</strong><br>
                        {{$answers->answer_3}}

                      </p>
                      <p>¿Se mencionan objetivos de incidencia, concretos, medibles y verificables?</p>
                      <p>
                        <label>Sí {{Form::radio('answer_q3_1[0]','1', $evaluation->answer_q3_1== 1 ? true : false,['class' => 'form-control answer_q3_1'])}}</label>
                        <label>No {{Form::radio('answer_q3_1[1]','0', ($evaluation->answer_q3_1 == 0 && $evaluation->answer_q3_1 != null) ? true : false,['class' => 'form-control answer_q3_1'])}}
                        </p>
                        @if($errors->has('answer_q3_1'))</label>
                        <strong class="danger">{{$errors->first('answer_q3_1')}}</strong>
                        @endif

                        <p>¿Se identificaron actores relevantes para la incidencia (aliados, neutrales, adversarios)?</p>
                        <p>
                          <label>Sí {{Form::radio('answer_q3_2[0]','1', $evaluation->answer_q3_2== 1 ? true : false,['class' => 'form-control answer_q3_2'])}}</label>
                          <label>No {{Form::radio('answer_q3_2[1]','0', ($evaluation->answer_q3_2 == 0 && $evaluation->answer_q3_2 != null) ? true : false,['class' => 'form-control answer_q3_2'])}}
                          </p>
                          @if($errors->has('answer_q3_2'))</label>
                          <strong class="danger">{{$errors->first('answer_q3_2')}}</strong>
                          @endif

                          <p>¿Se mencionan elementos mínimos estratégicos: tipo de incidencia a realizar, identificación de etapas del proceso, temporalidad?</p>
                          <p>
                            <label>Sí {{Form::radio('answer_q3_3[0]','1', $evaluation->answer_q3_3== 1 ? true : false,['class' => 'form-control answer_q3_3'])}}</label>
                            <label>No {{Form::radio('answer_q3_3[1]','0', ($evaluation->answer_q3_3 == 0 && $evaluation->answer_q3_3 != null) ? true : false,['class' => 'form-control answer_q3_3'])}}
                            </p>
                            @if($errors->has('answer_q3_3'))</label>
                            <strong class="danger">{{$errors->first('answer_q3_3')}}</strong>
                            @endif
                            <p>¿Se identifican brechas entre los objetivos iniciales de incidencia y los resultados finales, así como lecciones aprendidas del proceso?</p>
                            <p>
                              <label>Sí {{Form::radio('answer_q3_4[0]','1', $evaluation->answer_q3_4== 1 ? true : false,['class' => 'form-control answer_q3_4'])}}</label>
                              <label>No {{Form::radio('answer_q3_4[1]','0', ($evaluation->answer_q3_4 == 0 && $evaluation->answer_q3_4 != null) ? true : false,['class' => 'form-control answer_q3_4'])}}
                              </p>
                              @if($errors->has('answer_q3_4'))</label>
                              <strong class="danger">{{$errors->first('answer_q3_4')}}</strong>
                              @endif
                            <p>
                              <label><strong>Justifique su respuesta:</strong> <br>
                                {{Form::textarea('answer_q3_j', null, ["class" => "form-control"])}} </label>
                                @if($errors->has('answer_q3_j'))
                                <strong class="danger">{{$errors->first('answer_q3_j')}}</strong>
                                @endif
                              </p>
                            </li>

                          </div>
                        </div>

                        <div class="divider"></div>

                        <div class="row">
                          <div class="col-sm-12">
                            <p>{{Form::submit('Continuar evaluación', ['class' => 'btn gde'])}}</p>
                          </div>
                        </div>
                        {!! Form::close() !!}
