{!! Form::model($survey,['url' => url("tablero/encuestas/facilitadores-sesiones/{$session->slug}/{$facilitator->name}"), "class" => "form-horizontal"]) !!}

<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Encuesta de {{$facilitator->name}}</h2>
    <p>En una escala de 0 a 10, donde 0 es muy deficiente y 10 es muy bueno, evalúe las siguientes oraciones</p>
	<ol class="list line">
    <!--1-->
    <li>
			<p>La claridad de exposición del facilitador fue</p>
			<div class="row">
				<div class="col-sm-12">
					<ul class="inline">
						<li><label><span>0</span> {{Form::radio('fa_1[0]','0', ($survey->fa_1 == 0 && $survey->fa_1 != null) ? true : false,['class' => 'form-control fa_1'])}}</label></li>
						<li><label><span>1</span>{{Form::radio('fa_1[1]','1', $survey->fa_1 == 1 ? true : false,['class' => 'form-control fa_1'])}}</label>	</li>
						<li><label><span>2</span>{{Form::radio('fa_1[2]','2', $survey->fa_1 == 2 ? true : false,['class' => 'form-control fa_1'])}}</label>	</li>
						<li><label><span>3</span>{{Form::radio('fa_1[3]','3', $survey->fa_1 == 3 ? true : false,['class' => 'form-control fa_1'])}}</label>	</li>
						<li><label><span>4</span>{{Form::radio('fa_1[4]','4', $survey->fa_1 == 4 ? true : false,['class' => 'form-control fa_1'])}}</label>	</li>
						<li><label><span>5</span>{{Form::radio('fa_1[5]','5', $survey->fa_1 == 5 ? true : false,['class' => 'form-control fa_1'])}}</label>	</li>
						<li><label><span>6</span>{{Form::radio('fa_1[6]','6', $survey->fa_1 == 6 ? true : false,['class' => 'form-control fa_1'])}}</label>	</li>
						<li><label><span>7</span>{{Form::radio('fa_1[7]','7', $survey->fa_1 == 7 ? true : false,['class' => 'form-control fa_1'])}}</label>	</li>
						<li><label><span>8</span>{{Form::radio('fa_1[8]','8', $survey->fa_1 == 8 ? true : false,['class' => 'form-control fa_1'])}}</label>	</li>
						<li><label><span>9</span>{{Form::radio('fa_1[9]','9', $survey->fa_1 == 9 ? true : false,['class' => 'form-control fa_1'])}}</label>	</li>
						<li><label><span>10</span>{{Form::radio('fa_1[10]','10', $survey->fa_1 == 10 ? true : false,['class' => 'form-control fa_1'])}}</label></li>
					</ul>
					@if($errors->has('fa_1'))
		  				<strong class="danger">{{$errors->first('fa_1')}}</strong>
		  			@endif
				</div>
			</div>
		</li>
    <!--2-->
		<li>
			<p>El facilitador motiva y despierta interés en los agentes de cambio a través de su exposición</p>
			<div class="row">
				<div class="col-sm-12">
					<ul class="inline">
						<li><label><span>0</span> {{Form::radio('fa_2[0]','0', ($survey->fa_2 == 0 && $survey->fa_2 != null) ? true : false,['class' => 'form-control fa_2'])}}</label></li>
						<li><label><span>1</span>{{Form::radio('fa_2[1]','1', $survey->fa_2 == 1 ? true : false,['class' => 'form-control fa_2'])}}</label>	</li>
						<li><label><span>2</span>{{Form::radio('fa_2[2]','2', $survey->fa_2 == 2 ? true : false,['class' => 'form-control fa_2'])}}</label>	</li>
						<li><label><span>3</span>{{Form::radio('fa_2[3]','3', $survey->fa_2 == 3 ? true : false,['class' => 'form-control fa_2'])}}</label>	</li>
						<li><label><span>4</span>{{Form::radio('fa_2[4]','4', $survey->fa_2 == 4 ? true : false,['class' => 'form-control fa_2'])}}</label>	</li>
						<li><label><span>5</span>{{Form::radio('fa_2[5]','5', $survey->fa_2 == 5 ? true : false,['class' => 'form-control fa_2'])}}</label>	</li>
						<li><label><span>6</span>{{Form::radio('fa_2[6]','6', $survey->fa_2 == 6 ? true : false,['class' => 'form-control fa_2'])}}</label>	</li>
						<li><label><span>7</span>{{Form::radio('fa_2[7]','7', $survey->fa_2 == 7 ? true : false,['class' => 'form-control fa_2'])}}</label>	</li>
						<li><label><span>8</span>{{Form::radio('fa_2[8]','8', $survey->fa_2 == 8 ? true : false,['class' => 'form-control fa_2'])}}</label>	</li>
						<li><label><span>9</span>{{Form::radio('fa_2[9]','9', $survey->fa_2 == 9 ? true : false,['class' => 'form-control fa_2'])}}</label>	</li>
						<li><label><span>10</span>{{Form::radio('fa_2[10]','10', $survey->fa_2 == 10 ? true : false,['class' => 'form-control fa_2'])}}</label></li>
					</ul>
					@if($errors->has('fa_2'))
		  				<strong class="danger">{{$errors->first('fa_2')}}</strong>
		  			@endif
				</div>
			</div>
		</li>
  <!--3-->
  <li>
    <p>El facilitador da retroalimentación a los estudiantes</p>
    <div class="row">
      <div class="col-sm-12">
        <ul class="inline">
          <li><label><span>0</span> {{Form::radio('fa_3[0]','0', ($survey->fa_3 == 0 && $survey->fa_3 != null) ? true : false,['class' => 'form-control fa_3'])}}</label></li>
          <li><label><span>1</span>{{Form::radio('fa_3[1]','1', $survey->fa_3 == 1 ? true : false,['class' => 'form-control fa_3'])}}</label>	</li>
          <li><label><span>2</span>{{Form::radio('fa_3[2]','2', $survey->fa_3 == 2 ? true : false,['class' => 'form-control fa_3'])}}</label>	</li>
          <li><label><span>3</span>{{Form::radio('fa_3[3]','3', $survey->fa_3 == 3 ? true : false,['class' => 'form-control fa_3'])}}</label>	</li>
          <li><label><span>4</span>{{Form::radio('fa_3[4]','4', $survey->fa_3 == 4 ? true : false,['class' => 'form-control fa_3'])}}</label>	</li>
          <li><label><span>5</span>{{Form::radio('fa_3[5]','5', $survey->fa_3 == 5 ? true : false,['class' => 'form-control fa_3'])}}</label>	</li>
          <li><label><span>6</span>{{Form::radio('fa_3[6]','6', $survey->fa_3 == 6 ? true : false,['class' => 'form-control fa_3'])}}</label>	</li>
          <li><label><span>7</span>{{Form::radio('fa_3[7]','7', $survey->fa_3 == 7 ? true : false,['class' => 'form-control fa_3'])}}</label>	</li>
          <li><label><span>8</span>{{Form::radio('fa_3[8]','8', $survey->fa_3 == 8 ? true : false,['class' => 'form-control fa_3'])}}</label>	</li>
          <li><label><span>9</span>{{Form::radio('fa_3[9]','9', $survey->fa_3 == 9 ? true : false,['class' => 'form-control fa_3'])}}</label>	</li>
          <li><label><span>10</span>{{Form::radio('fa_3[10]','10', $survey->fa_3 == 10 ? true : false,['class' => 'form-control fa_3'])}}</label></li>
        </ul>
        @if($errors->has('fa_3'))
            <strong class="danger">{{$errors->first('fa_3')}}</strong>
          @endif
      </div>
    </div>
  </li>


    <!--4-->
    <li>
			<p>El facilitador responde con claridad a las preguntas de los estudiantes</p>
			<div class="row">
				<div class="col-sm-12">
					<ul class="inline">
						<li><label><span>0</span> {{Form::radio('fa_4[0]','0', ($survey->fa_4 == 0 && $survey->fa_4 != null) ? true : false,['class' => 'form-control fa_4'])}}</label></li>
						<li><label><span>1</span>{{Form::radio('fa_4[1]','1', $survey->fa_4 == 1 ? true : false,['class' => 'form-control fa_4'])}}</label>	</li>
						<li><label><span>2</span>{{Form::radio('fa_4[2]','2', $survey->fa_4 == 2 ? true : false,['class' => 'form-control fa_4'])}}</label>	</li>
						<li><label><span>3</span>{{Form::radio('fa_4[3]','3', $survey->fa_4 == 3 ? true : false,['class' => 'form-control fa_4'])}}</label>	</li>
						<li><label><span>4</span>{{Form::radio('fa_4[4]','4', $survey->fa_4 == 4 ? true : false,['class' => 'form-control fa_4'])}}</label>	</li>
						<li><label><span>5</span>{{Form::radio('fa_4[5]','5', $survey->fa_4 == 5 ? true : false,['class' => 'form-control fa_4'])}}</label>	</li>
						<li><label><span>6</span>{{Form::radio('fa_4[6]','6', $survey->fa_4 == 6 ? true : false,['class' => 'form-control fa_4'])}}</label>	</li>
						<li><label><span>7</span>{{Form::radio('fa_4[7]','7', $survey->fa_4 == 7 ? true : false,['class' => 'form-control fa_4'])}}</label>	</li>
						<li><label><span>8</span>{{Form::radio('fa_4[8]','8', $survey->fa_4 == 8 ? true : false,['class' => 'form-control fa_4'])}}</label>	</li>
						<li><label><span>9</span>{{Form::radio('fa_4[9]','9', $survey->fa_4 == 9 ? true : false,['class' => 'form-control fa_4'])}}</label>	</li>
						<li><label><span>10</span>{{Form::radio('fa_4[10]','10', $survey->fa_4 == 10 ? true : false,['class' => 'form-control fa_4'])}}</label></li>
					</ul>
					@if($errors->has('fa_4'))
		  				<strong class="danger">{{$errors->first('fa_4')}}</strong>
		  			@endif
				</div>
			</div>
		</li>

    <!--5-->
    <li>
      <p>En el desarrollo de su exposición el facilitador presenta ejemplos relevantes sobre los temas tratados</p>
      <div class="row">
        <div class="col-sm-12">
          <ul class="inline">
            <li><label><span>0</span> {{Form::radio('fa_5[0]','0', ($survey->fa_5 == 0 && $survey->fa_5 != null) ? true : false,['class' => 'form-control fa_5'])}}</label></li>
            <li><label><span>1</span>{{Form::radio('fa_5[1]','1', $survey->fa_5 == 1 ? true : false,['class' => 'form-control fa_5'])}}</label>	</li>
            <li><label><span>2</span>{{Form::radio('fa_5[2]','2', $survey->fa_5 == 2 ? true : false,['class' => 'form-control fa_5'])}}</label>	</li>
            <li><label><span>3</span>{{Form::radio('fa_5[3]','3', $survey->fa_5 == 3 ? true : false,['class' => 'form-control fa_5'])}}</label>	</li>
            <li><label><span>4</span>{{Form::radio('fa_5[4]','4', $survey->fa_5 == 4 ? true : false,['class' => 'form-control fa_5'])}}</label>	</li>
            <li><label><span>5</span>{{Form::radio('fa_5[5]','5', $survey->fa_5 == 5 ? true : false,['class' => 'form-control fa_5'])}}</label>	</li>
            <li><label><span>6</span>{{Form::radio('fa_5[6]','6', $survey->fa_5 == 6 ? true : false,['class' => 'form-control fa_5'])}}</label>	</li>
            <li><label><span>7</span>{{Form::radio('fa_5[7]','7', $survey->fa_5 == 7 ? true : false,['class' => 'form-control fa_5'])}}</label>	</li>
            <li><label><span>8</span>{{Form::radio('fa_5[8]','8', $survey->fa_5 == 8 ? true : false,['class' => 'form-control fa_5'])}}</label>	</li>
            <li><label><span>9</span>{{Form::radio('fa_5[9]','9', $survey->fa_5 == 9 ? true : false,['class' => 'form-control fa_5'])}}</label>	</li>
            <li><label><span>10</span>{{Form::radio('fa_5[10]','10', $survey->fa_5 == 10 ? true : false,['class' => 'form-control fa_5'])}}</label></li>
          </ul>
          @if($errors->has('fa_5'))
              <strong class="danger">{{$errors->first('fa_5')}}</strong>
            @endif
        </div>
      </div>
    </li>
      <!--6-->
      <li>
        <p>El facilitador presentó de forma organizada los contenidos abordados</p>
        <div class="row">
          <div class="col-sm-12">
            <ul class="inline">
              <li><label><span>0</span> {{Form::radio('fa_6[0]','0', ($survey->fa_6 == 0 && $survey->fa_6 != null) ? true : false,['class' => 'form-control fa_6'])}}</label></li>
              <li><label><span>1</span>{{Form::radio('fa_6[1]','1', $survey->fa_6 == 1 ? true : false,['class' => 'form-control fa_6'])}}</label>	</li>
              <li><label><span>2</span>{{Form::radio('fa_6[2]','2', $survey->fa_6 == 2 ? true : false,['class' => 'form-control fa_6'])}}</label>	</li>
              <li><label><span>3</span>{{Form::radio('fa_6[3]','3', $survey->fa_6 == 3 ? true : false,['class' => 'form-control fa_6'])}}</label>	</li>
              <li><label><span>4</span>{{Form::radio('fa_6[4]','4', $survey->fa_6 == 4 ? true : false,['class' => 'form-control fa_6'])}}</label>	</li>
              <li><label><span>5</span>{{Form::radio('fa_6[5]','5', $survey->fa_6 == 5 ? true : false,['class' => 'form-control fa_6'])}}</label>	</li>
              <li><label><span>6</span>{{Form::radio('fa_6[6]','6', $survey->fa_6 == 6 ? true : false,['class' => 'form-control fa_6'])}}</label>	</li>
              <li><label><span>7</span>{{Form::radio('fa_6[7]','7', $survey->fa_6 == 7 ? true : false,['class' => 'form-control fa_6'])}}</label>	</li>
              <li><label><span>8</span>{{Form::radio('fa_6[8]','8', $survey->fa_6 == 8 ? true : false,['class' => 'form-control fa_6'])}}</label>	</li>
              <li><label><span>9</span>{{Form::radio('fa_6[9]','9', $survey->fa_6 == 9 ? true : false,['class' => 'form-control fa_6'])}}</label>	</li>
              <li><label><span>10</span>{{Form::radio('fa_6[10]','10', $survey->fa_6 == 10 ? true : false,['class' => 'form-control fa_6'])}}</label></li>
            </ul>
            @if($errors->has('fa_6'))
                <strong class="danger">{{$errors->first('fa_6')}}</strong>
              @endif
          </div>
        </div>
      </li>

        <!--7-->
        <li>
          <p>¿Qué fortalezas identificas en el facilitador?</p>
          <div class="row">

            <div class="col-sm-12">
              <p>
                {{Form::textarea('fa_7', null, ["class" => "form-control"])}} </label>
                @if($errors->has('fa_7'))
                <strong class="danger">{{$errors->first('fa_7')}}</strong>
                @endif
              </p>
              </div>
          </div>
        </li>
          <!--8-->
          <li>
            <p>¿Qué áreas de mejora identificas en el facilitador?</p>
            <div class="row">

              <div class="col-sm-12">
                <p>
                  {{Form::textarea('fa_8', null, ["class" => "form-control"])}} </label>
                  @if($errors->has('fa_8'))
                  <strong class="danger">{{$errors->first('fa_8')}}</strong>
                  @endif
                </p>
                </div>
            </div>
          </li>
          <!--9-->
          <li>
              <p>¿Propondría a este facilitador para que dirigiera otro curso de este programa de formación?</p>
          <div class ="row">
            <div class="col-sm-12">
                <label>Sí {{Form::radio('fa_9[0]','1', $survey->fa_9== 1 ? true : false,['class' => 'form-control fa_9'])}}</label>
                <label>No {{Form::radio('fa_9[1]','0', ($survey->fa_9 == 0 && $survey->fa_9 != null) ? true : false,['class' => 'form-control fa_9'])}}
              @if($errors->has('fa_9'))</label>
                <strong class="danger">{{$errors->first('fa_9')}}</strong>
              @endif
            </div>
              </div>
          </li>

	</ol>
  </div>
</div>

<div class="divider"></div>

<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Guardar encuesta', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
