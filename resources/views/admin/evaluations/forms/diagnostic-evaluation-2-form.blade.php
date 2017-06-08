{!! Form::model($evaluation,['url' => url("dashboard/evaluacion/diagnostico/evaluar/2/{$evaluation->id}/save"), "class" => "form-horizontal"]) !!}

<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Test de conocimientos sobre Gobierno Abierto, Co-Creación e Iniciativas Innovadoras</h2>
    <ol class="list line">
      <li>
        <p>Menciona los elementos que consideras que integran a una estrategia de comunicación exitosa y sus fases de implementación<br>

          <strong>Respuesta</strong><br>
          {{$answers->answer_4}}

        </p>
        <p>¿Se señalan elementos como identificación de audiencias, identificación de aliados clave para su implementación (medios, comunicadores, actores sociales relevantes), generación de mensajes clave, adaptabilidad de la estrategia a cambios en el contexto, medición del grado de aceptación de mensajes clave por audiencias?</p>
        <p>
          <label>Sí {{Form::radio('answer_q4_1[0]','1', $evaluation->answer_q4_1== 1 ? true : false,['class' => 'form-control answer_q4_1'])}}</label>
          <label>No {{Form::radio('answer_q4_1[1]','0', ($evaluation->answer_q4_1 == 0 && $evaluation->answer_q4_1 != null) ? true : false,['class' => 'form-control answer_q4_1'])}}
          </p>
          @if($errors->has('answer_q4_1'))</label>
          <strong class="danger">{{$errors->first('answer_q4_1')}}</strong>
          @endif

          <p>¿Se identifican elementos de la fase de implementación como selección de audiencias, creación y emisión de mensajes clave, selección de medios para emisión de mensajes, seguimiento a comunicaciones de audiencias, retroalimentación de mensajes, medición de impacto sobre audiencias?</p>
          <p>
            <label>Sí {{Form::radio('answer_q4_2[0]','1', $evaluation->answer_q4_2== 1 ? true : false,['class' => 'form-control answer_q4_2'])}}</label>
            <label>No {{Form::radio('answer_q4_2[1]','0', ($evaluation->answer_q4_2 == 0 && $evaluation->answer_q4_2 != null) ? true : false,['class' => 'form-control answer_q4_2'])}}
            </p>
            @if($errors->has('answer_q4_2'))</label>
            <strong class="danger">{{$errors->first('answer_q4_2')}}</strong>
            @endif
              <p>
                <label><strong>Justifique su respuesta:</strong> <br>
                  {{Form::textarea('answer_q4_j', null, ["class" => "form-control"])}} </label>
                  @if($errors->has('answer_q4_j'))
                  <strong class="danger">{{$errors->first('answer_q4_j')}}</strong>
                  @endif
                </p>
              </li>
              <li>
                <p>Con respecto al proyecto a generar dentro del marco del fellowship, describe si éste tiene implicaciones presupuestarias para su implementación, así como las potenciales fuentes de financiamiento y la estrategia para la consecución de fondos<br>

                  <strong>Respuesta</strong><br>
                  {{$answers->answer_5}}

                </p>
                <p>¿Se identifican costos presupuestarios para la implementación del proyecto por parte del fellow?</p>
                <p>
                  <label>Sí {{Form::radio('answer_q5_1[0]','1', $evaluation->answer_q5_1== 1 ? true : false,['class' => 'form-control answer_q5_1'])}}</label>
                  <label>No {{Form::radio('answer_q5_1[1]','0', ($evaluation->answer_q5_1 == 0 && $evaluation->answer_q5_1 != null) ? true : false,['class' => 'form-control answer_q5_1'])}}
                  </p>
                  @if($errors->has('answer_q5_1'))</label>
                  <strong class="danger">{{$errors->first('answer_q5_1')}}</strong>
                  @endif

                  <p>¿Se proponen fuentes de financiamiento públicas y/o privadas para la implementación del proyecto?</p>
                  <p>
                    <label>Sí {{Form::radio('answer_q5_2[0]','1', $evaluation->answer_q5_2== 1 ? true : false,['class' => 'form-control answer_q5_2'])}}</label>
                    <label>No {{Form::radio('answer_q5_2[1]','0', ($evaluation->answer_q5_2 == 0 && $evaluation->answer_q5_2 != null) ? true : false,['class' => 'form-control answer_q5_2'])}}
                    </p>
                    @if($errors->has('answer_q5_2'))</label>
                    <strong class="danger">{{$errors->first('answer_q5_2')}}</strong>
                    @endif
                    <p>¿Se identificaron de elementos estratégicos para la consecución de fondos relacionados con la implementación del proyecto: actores clave, identificación de requerimientos técnicos o legales, restricciones presupuestarias?</p>
                    <p>
                      <label>Sí {{Form::radio('answer_q5_3[0]','1', $evaluation->answer_q5_3== 1 ? true : false,['class' => 'form-control answer_q5_3'])}}</label>
                      <label>No {{Form::radio('answer_q5_3[1]','0', ($evaluation->answer_q5_3 == 0 && $evaluation->answer_q5_3 != null) ? true : false,['class' => 'form-control answer_q5_3'])}}
                      </p>
                      @if($errors->has('answer_q5_3'))</label>
                      <strong class="danger">{{$errors->first('answer_q5_3')}}</strong>
                      @endif
                    <p>
                      <label><strong>Justifique su respuesta:</strong> <br>
                        {{Form::textarea('answer_q5_j', null, ["class" => "form-control"])}} </label>
                        @if($errors->has('answer_q5_j'))
                        <strong class="danger">{{$errors->first('answer_q5_j')}}</strong>
                        @endif
                      </p>
                    </li>
                          </div>
                        </div>

                        <div class="divider"></div>

                        <div class="row">
                          <div class="col-sm-12">
                            <p>{{Form::submit('Guardar evaluación', ['class' => 'btn gde'])}}</p>
                          </div>
                        </div>
                        {!! Form::close() !!}
