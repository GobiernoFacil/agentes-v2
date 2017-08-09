{!! Form::model($evaluation,['url' => url('tablero/encuestas/encuesta-satisfaccion'), "class" => "form-horizontal"]) !!}

<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Encuesta de satisfacción Plataforma Apertus</h2>
	<ol class="list line">
    <!--1-->
    <li>
			<p>En una escala de 0 a 10, donde cero es nada adecuada y diez es muy adecuada ¿En qué grado consideras que la estructura de la plataforma (sesión de inicio, módulos, foros, etc.) es adecuada para su uso?</p>
			<div class="row">
				<div class="col-sm-6">
					<ul class="inline">
						<li><label><span>0</span> {{Form::radio('sur_1[0]','0', ($evaluation->sur_1 == 0 && $evaluation->sur_1 != null) ? true : false,['class' => 'form-control sur_1'])}}</label></li>
						<li><label><span>1</span>{{Form::radio('sur_1[1]','1', $evaluation->sur_1 == 1 ? true : false,['class' => 'form-control sur_1'])}}</label>	</li>
						<li><label><span>2</span>{{Form::radio('sur_1[2]','2', $evaluation->sur_1 == 2 ? true : false,['class' => 'form-control sur_1'])}}</label>	</li>
						<li><label><span>3</span>{{Form::radio('sur_1[3]','3', $evaluation->sur_1 == 3 ? true : false,['class' => 'form-control sur_1'])}}</label>	</li>
						<li><label><span>4</span>{{Form::radio('sur_1[4]','4', $evaluation->sur_1 == 4 ? true : false,['class' => 'form-control sur_1'])}}</label>	</li>
						<li><label><span>5</span>{{Form::radio('sur_1[5]','5', $evaluation->sur_1 == 5 ? true : false,['class' => 'form-control sur_1'])}}</label>	</li>
						<li><label><span>6</span>{{Form::radio('sur_1[6]','6', $evaluation->sur_1 == 6 ? true : false,['class' => 'form-control sur_1'])}}</label>	</li>
						<li><label><span>7</span>{{Form::radio('sur_1[7]','7', $evaluation->sur_1 == 7 ? true : false,['class' => 'form-control sur_1'])}}</label>	</li>
						<li><label><span>8</span>{{Form::radio('sur_1[8]','8', $evaluation->sur_1 == 8 ? true : false,['class' => 'form-control sur_1'])}}</label>	</li>
						<li><label><span>9</span>{{Form::radio('sur_1[9]','9', $evaluation->sur_1 == 9 ? true : false,['class' => 'form-control sur_1'])}}</label>	</li>
						<li><label><span>10</span>{{Form::radio('sur_1[10]','10', $evaluation->sur_1 == 10 ? true : false,['class' => 'form-control sur_1'])}}</label></li>
					</ul>
					@if($errors->has('sur_1'))
		  				<strong class="danger">{{$errors->first('sur_1')}}</strong>
		  			@endif
				</div>
				<div class="col-sm-6">
					<p>
					  <label><strong>Justifique su respuesta:</strong> <br>
					  {{Form::textarea('sur_j1', null, ["class" => "form-control"])}} </label>
					  @if($errors->has('sur_j1'))
					  <strong class="danger">{{$errors->first('sur_j1')}}</strong>
					  @endif
					</p>
		  		</div>
			</div>
		</li>
    <!--2-->
		<li>
			<p>En una escala de 0 a 10, donde cero es nada adecuado y diez es muy adecuado ¿En qué grado consideras que el diseño de la plataforma (accesibilidad, navegación en secciones, etc.) es adecuado para su uso?</p>
			<div class="row">
				<div class="col-sm-6">
					<ul class="inline">
						<li><label><span>0</span> {{Form::radio('sur_2[0]','0', ($evaluation->sur_2 == 0 && $evaluation->sur_2 != null) ? true : false,['class' => 'form-control sur_2'])}}</label></li>
						<li><label><span>1</span>{{Form::radio('sur_2[1]','1', $evaluation->sur_2 == 1 ? true : false,['class' => 'form-control sur_2'])}}</label>	</li>
						<li><label><span>2</span>{{Form::radio('sur_2[2]','2', $evaluation->sur_2 == 2 ? true : false,['class' => 'form-control sur_2'])}}</label>	</li>
						<li><label><span>3</span>{{Form::radio('sur_2[3]','3', $evaluation->sur_2 == 3 ? true : false,['class' => 'form-control sur_2'])}}</label>	</li>
						<li><label><span>4</span>{{Form::radio('sur_2[4]','4', $evaluation->sur_2 == 4 ? true : false,['class' => 'form-control sur_2'])}}</label>	</li>
						<li><label><span>5</span>{{Form::radio('sur_2[5]','5', $evaluation->sur_2 == 5 ? true : false,['class' => 'form-control sur_2'])}}</label>	</li>
						<li><label><span>6</span>{{Form::radio('sur_2[6]','6', $evaluation->sur_2 == 6 ? true : false,['class' => 'form-control sur_2'])}}</label>	</li>
						<li><label><span>7</span>{{Form::radio('sur_2[7]','7', $evaluation->sur_2 == 7 ? true : false,['class' => 'form-control sur_2'])}}</label>	</li>
						<li><label><span>8</span>{{Form::radio('sur_2[8]','8', $evaluation->sur_2 == 8 ? true : false,['class' => 'form-control sur_2'])}}</label>	</li>
						<li><label><span>9</span>{{Form::radio('sur_2[9]','9', $evaluation->sur_2 == 9 ? true : false,['class' => 'form-control sur_2'])}}</label>	</li>
						<li><label><span>10</span>{{Form::radio('sur_2[10]','10', $evaluation->sur_2 == 10 ? true : false,['class' => 'form-control sur_2'])}}</label></li>
					</ul>
					@if($errors->has('sur_2'))
		  				<strong class="danger">{{$errors->first('sur_2')}}</strong>
		  			@endif
				</div>
				<div class="col-sm-6">
					<p>
					  <label><strong>Justifique su respuesta:</strong> <br>
					  {{Form::textarea('sur_j2', null, ["class" => "form-control"])}} </label>
					  @if($errors->has('sur_j2'))
					  <strong class="danger">{{$errors->first('sur_j2')}}</strong>
					  @endif
					</p>
		  		</div>
			</div>
		</li>
  <!--3-->
		<li>
			<p>En una escala de 0 a 10, donde cero es nada adecuada y diez es completamente adecuada ¿En qué grado consideras que la estructura organizativa de las siguientes secciones es adecuada? </p>
			<div class="row">
				<div class="col-sm-12">
          <span>Login de la Plataforma</span>
					<ul class="inline">
						<li><label><span>0</span>{{Form::radio('sur_3_1[0]','0', ($evaluation->sur_3_1 == 0 && $evaluation->sur_3_1 != null) ? true : false,['class' => 'form-control sur_3_1'])}}	</label></li>
						<li><label><span>1</span>{{Form::radio('sur_3_1[1]','1', $evaluation->sur_3_1 == 1 ? true : false,['class' => 'form-control sur_3_1'])}}	</label></li>
						<li><label><span>2</span>{{Form::radio('sur_3_1[2]','2', $evaluation->sur_3_1 == 2 ? true : false,['class' => 'form-control sur_3_1'])}}	</label></li>
						<li><label><span>3</span>{{Form::radio('sur_3_1[3]','3', $evaluation->sur_3_1 == 3 ? true : false,['class' => 'form-control sur_3_1'])}}	</label></li>
						<li><label><span>4</span>{{Form::radio('sur_3_1[4]','4', $evaluation->sur_3_1 == 4 ? true : false,['class' => 'form-control sur_3_1'])}}	</label></li>
						<li><label><span>5</span>{{Form::radio('sur_3_1[5]','5', $evaluation->sur_3_1 == 5 ? true : false,['class' => 'form-control sur_3_1'])}}	</label></li>
						<li><label><span>6</span>{{Form::radio('sur_3_1[6]','6', $evaluation->sur_3_1 == 6 ? true : false,['class' => 'form-control sur_3_1'])}}	</label></li>
						<li><label><span>7</span>{{Form::radio('sur_3_1[7]','7', $evaluation->sur_3_1 == 7 ? true : false,['class' => 'form-control sur_3_1'])}}	</label></li>
						<li><label><span>8</span>{{Form::radio('sur_3_1[8]','8', $evaluation->sur_3_1 == 8 ? true : false,['class' => 'form-control sur_3_1'])}}	</label></li>
						<li><label><span>9</span>{{Form::radio('sur_3_1[9]','9', $evaluation->sur_3_1 == 9 ? true : false,['class' => 'form-control sur_3_1'])}}	</label></li>
						<li><label><span>10</span>{{Form::radio('sur_3_1[10]','10', $evaluation->sur_3_1 == 10 ? true : false,['class' => 'form-control sur_3_1'])}}</label></li>
      				</ul>
      				@if($errors->has('sur_3_1'))
	  					<strong class="danger">{{$errors->first('sur_3_1')}}</strong>
	  				@endif
            <span>Módulos</span>
  					<ul class="inline">
  						<li><label><span>0</span>{{Form::radio('sur_3_2[0]','0', ($evaluation->sur_3_2 == 0 && $evaluation->sur_3_2 != null) ? true : false,['class' => 'form-control sur_3_2'])}}	</label></li>
  						<li><label><span>1</span>{{Form::radio('sur_3_2[1]','1', $evaluation->sur_3_2 == 1 ? true : false,['class' => 'form-control sur_3_2'])}}	</label></li>
  						<li><label><span>2</span>{{Form::radio('sur_3_2[2]','2', $evaluation->sur_3_2 == 2 ? true : false,['class' => 'form-control sur_3_2'])}}	</label></li>
  						<li><label><span>3</span>{{Form::radio('sur_3_2[3]','3', $evaluation->sur_3_2 == 3 ? true : false,['class' => 'form-control sur_3_2'])}}	</label></li>
  						<li><label><span>4</span>{{Form::radio('sur_3_2[4]','4', $evaluation->sur_3_2 == 4 ? true : false,['class' => 'form-control sur_3_2'])}}	</label></li>
  						<li><label><span>5</span>{{Form::radio('sur_3_2[5]','5', $evaluation->sur_3_2 == 5 ? true : false,['class' => 'form-control sur_3_2'])}}	</label></li>
  						<li><label><span>6</span>{{Form::radio('sur_3_2[6]','6', $evaluation->sur_3_2 == 6 ? true : false,['class' => 'form-control sur_3_2'])}}	</label></li>
  						<li><label><span>7</span>{{Form::radio('sur_3_2[7]','7', $evaluation->sur_3_2 == 7 ? true : false,['class' => 'form-control sur_3_2'])}}	</label></li>
  						<li><label><span>8</span>{{Form::radio('sur_3_2[8]','8', $evaluation->sur_3_2 == 8 ? true : false,['class' => 'form-control sur_3_2'])}}	</label></li>
  						<li><label><span>9</span>{{Form::radio('sur_3_2[9]','9', $evaluation->sur_3_2 == 9 ? true : false,['class' => 'form-control sur_3_2'])}}	</label></li>
  						<li><label><span>10</span>{{Form::radio('sur_3_2[10]','10', $evaluation->sur_3_2 == 10 ? true : false,['class' => 'form-control sur_3_2'])}}</label></li>
        				</ul>
        				@if($errors->has('sur_3_2'))
  	  					<strong class="danger">{{$errors->first('sur_3_2')}}</strong>
  	  				@endif

              <span>Cursos</span>
              <ul class="inline">
                <li><label><span>0</span>{{Form::radio('sur_3_3[0]','0', ($evaluation->sur_3_3 == 0 && $evaluation->sur_3_3 != null) ? true : false,['class' => 'form-control sur_3_3'])}}	</label></li>
                <li><label><span>1</span>{{Form::radio('sur_3_3[1]','1', $evaluation->sur_3_3 == 1 ? true : false,['class' => 'form-control sur_3_3'])}}	</label></li>
                <li><label><span>2</span>{{Form::radio('sur_3_3[2]','2', $evaluation->sur_3_3 == 2 ? true : false,['class' => 'form-control sur_3_3'])}}	</label></li>
                <li><label><span>3</span>{{Form::radio('sur_3_3[3]','3', $evaluation->sur_3_3 == 3 ? true : false,['class' => 'form-control sur_3_3'])}}	</label></li>
                <li><label><span>4</span>{{Form::radio('sur_3_3[4]','4', $evaluation->sur_3_3 == 4 ? true : false,['class' => 'form-control sur_3_3'])}}	</label></li>
                <li><label><span>5</span>{{Form::radio('sur_3_3[5]','5', $evaluation->sur_3_3 == 5 ? true : false,['class' => 'form-control sur_3_3'])}}	</label></li>
                <li><label><span>6</span>{{Form::radio('sur_3_3[6]','6', $evaluation->sur_3_3 == 6 ? true : false,['class' => 'form-control sur_3_3'])}}	</label></li>
                <li><label><span>7</span>{{Form::radio('sur_3_3[7]','7', $evaluation->sur_3_3 == 7 ? true : false,['class' => 'form-control sur_3_3'])}}	</label></li>
                <li><label><span>8</span>{{Form::radio('sur_3_3[8]','8', $evaluation->sur_3_3 == 8 ? true : false,['class' => 'form-control sur_3_3'])}}	</label></li>
                <li><label><span>9</span>{{Form::radio('sur_3_3[9]','9', $evaluation->sur_3_3 == 9 ? true : false,['class' => 'form-control sur_3_3'])}}	</label></li>
                <li><label><span>10</span>{{Form::radio('sur_3_3[10]','10', $evaluation->sur_3_3 == 10 ? true : false,['class' => 'form-control sur_3_3'])}}</label></li>
                  </ul>
                  @if($errors->has('sur_3_3'))
                  <strong class="danger">{{$errors->first('sur_3_3')}}</strong>
                @endif
                <span>Sesiones</span>
                <ul class="inline">
                  <li><label><span>0</span>{{Form::radio('sur_3_4[0]','0', ($evaluation->sur_3_4 == 0 && $evaluation->sur_3_4 != null) ? true : false,['class' => 'form-control sur_3_4'])}}	</label></li>
                  <li><label><span>1</span>{{Form::radio('sur_3_4[1]','1', $evaluation->sur_3_4 == 1 ? true : false,['class' => 'form-control sur_3_4'])}}	</label></li>
                  <li><label><span>2</span>{{Form::radio('sur_3_4[2]','2', $evaluation->sur_3_4 == 2 ? true : false,['class' => 'form-control sur_3_4'])}}	</label></li>
                  <li><label><span>3</span>{{Form::radio('sur_3_4[3]','3', $evaluation->sur_3_4 == 3 ? true : false,['class' => 'form-control sur_3_4'])}}	</label></li>
                  <li><label><span>4</span>{{Form::radio('sur_3_4[4]','4', $evaluation->sur_3_4 == 4 ? true : false,['class' => 'form-control sur_3_4'])}}	</label></li>
                  <li><label><span>5</span>{{Form::radio('sur_3_4[5]','5', $evaluation->sur_3_4 == 5 ? true : false,['class' => 'form-control sur_3_4'])}}	</label></li>
                  <li><label><span>6</span>{{Form::radio('sur_3_4[6]','6', $evaluation->sur_3_4 == 6 ? true : false,['class' => 'form-control sur_3_4'])}}	</label></li>
                  <li><label><span>7</span>{{Form::radio('sur_3_4[7]','7', $evaluation->sur_3_4 == 7 ? true : false,['class' => 'form-control sur_3_4'])}}	</label></li>
                  <li><label><span>8</span>{{Form::radio('sur_3_4[8]','8', $evaluation->sur_3_4 == 8 ? true : false,['class' => 'form-control sur_3_4'])}}	</label></li>
                  <li><label><span>9</span>{{Form::radio('sur_3_4[9]','9', $evaluation->sur_3_4 == 9 ? true : false,['class' => 'form-control sur_3_4'])}}	</label></li>
                  <li><label><span>10</span>{{Form::radio('sur_3_4[10]','10', $evaluation->sur_3_4 == 10 ? true : false,['class' => 'form-control sur_3_4'])}}</label></li>
                    </ul>
                    @if($errors->has('sur_3_4'))
                    <strong class="danger">{{$errors->first('sur_3_4')}}</strong>
                  @endif
                  <span>Evaluaciones</span>
                  <ul class="inline">
                    <li><label><span>0</span>{{Form::radio('sur_3_5[0]','0', ($evaluation->sur_3_5 == 0 && $evaluation->sur_3_5 != null) ? true : false,['class' => 'form-control sur_3_5'])}}	</label></li>
                    <li><label><span>1</span>{{Form::radio('sur_3_5[1]','1', $evaluation->sur_3_5 == 1 ? true : false,['class' => 'form-control sur_3_5'])}}	</label></li>
                    <li><label><span>2</span>{{Form::radio('sur_3_5[2]','2', $evaluation->sur_3_5 == 2 ? true : false,['class' => 'form-control sur_3_5'])}}	</label></li>
                    <li><label><span>3</span>{{Form::radio('sur_3_5[3]','3', $evaluation->sur_3_5 == 3 ? true : false,['class' => 'form-control sur_3_5'])}}	</label></li>
                    <li><label><span>4</span>{{Form::radio('sur_3_5[4]','4', $evaluation->sur_3_5 == 4 ? true : false,['class' => 'form-control sur_3_5'])}}	</label></li>
                    <li><label><span>5</span>{{Form::radio('sur_3_5[5]','5', $evaluation->sur_3_5 == 5 ? true : false,['class' => 'form-control sur_3_5'])}}	</label></li>
                    <li><label><span>6</span>{{Form::radio('sur_3_5[6]','6', $evaluation->sur_3_5 == 6 ? true : false,['class' => 'form-control sur_3_5'])}}	</label></li>
                    <li><label><span>7</span>{{Form::radio('sur_3_5[7]','7', $evaluation->sur_3_5 == 7 ? true : false,['class' => 'form-control sur_3_5'])}}	</label></li>
                    <li><label><span>8</span>{{Form::radio('sur_3_5[8]','8', $evaluation->sur_3_5 == 8 ? true : false,['class' => 'form-control sur_3_5'])}}	</label></li>
                    <li><label><span>9</span>{{Form::radio('sur_3_5[9]','9', $evaluation->sur_3_5 == 9 ? true : false,['class' => 'form-control sur_3_5'])}}	</label></li>
                    <li><label><span>10</span>{{Form::radio('sur_3_5[10]','10', $evaluation->sur_3_5 == 10 ? true : false,['class' => 'form-control sur_3_5'])}}</label></li>
                      </ul>
                      @if($errors->has('sur_3_5'))
                      <strong class="danger">{{$errors->first('sur_3_5')}}</strong>
                    @endif
				</div>
      </div>

		</li>

    <!--4-->
		<li>
			<p>En una escala de 0 a 10, donde cero es nada claro y diez es completamente claro ¿Consideras que el lenguaje utilizado en la plataforma es claro?, ¿facilita el uso de la misma?</p>
			<div class="row">
				<div class="col-sm-12">
					<ul class="inline">
						<li><label><span>0</span> {{Form::radio('sur_4[0]','0', ($evaluation->sur_4 == 0 && $evaluation->sur_4 != null) ? true : false,['class' => 'form-control sur_4'])}}</label></li>
						<li><label><span>1</span>{{Form::radio('sur_4[1]','1', $evaluation->sur_4 == 1 ? true : false,['class' => 'form-control sur_4'])}}</label>	</li>
						<li><label><span>2</span>{{Form::radio('sur_4[2]','2', $evaluation->sur_4 == 2 ? true : false,['class' => 'form-control sur_4'])}}</label>	</li>
						<li><label><span>3</span>{{Form::radio('sur_4[3]','3', $evaluation->sur_4 == 3 ? true : false,['class' => 'form-control sur_4'])}}</label>	</li>
						<li><label><span>4</span>{{Form::radio('sur_4[4]','4', $evaluation->sur_4 == 4 ? true : false,['class' => 'form-control sur_4'])}}</label>	</li>
						<li><label><span>5</span>{{Form::radio('sur_4[5]','5', $evaluation->sur_4 == 5 ? true : false,['class' => 'form-control sur_4'])}}</label>	</li>
						<li><label><span>6</span>{{Form::radio('sur_4[6]','6', $evaluation->sur_4 == 6 ? true : false,['class' => 'form-control sur_4'])}}</label>	</li>
						<li><label><span>7</span>{{Form::radio('sur_4[7]','7', $evaluation->sur_4 == 7 ? true : false,['class' => 'form-control sur_4'])}}</label>	</li>
						<li><label><span>8</span>{{Form::radio('sur_4[8]','8', $evaluation->sur_4 == 8 ? true : false,['class' => 'form-control sur_4'])}}</label>	</li>
						<li><label><span>9</span>{{Form::radio('sur_4[9]','9', $evaluation->sur_4 == 9 ? true : false,['class' => 'form-control sur_4'])}}</label>	</li>
						<li><label><span>10</span>{{Form::radio('sur_4[10]','10', $evaluation->sur_4 == 10 ? true : false,['class' => 'form-control sur_4'])}}</label></li>
					</ul>
					@if($errors->has('sur_4'))
		  				<strong class="danger">{{$errors->first('sur_4')}}</strong>
		  			@endif
				</div>
			</div>
		</li>

    <!--5-->
  		<li>
  			<p>En una escala de 0 a 10, donde cero es muy deficiente y diez es excelente, con respecto a los contenidos multimedia (vídeos y webinars), ¿cómo calificas su calidad en cuanto a los siguientes aspectos? </p>
  			<div class="row">
  				<div class="col-sm-12">
            <span>Imagen</span>
  					<ul class="inline">
  						<li><label><span>0</span>{{Form::radio('sur_5_1[0]','0', ($evaluation->sur_5_1 == 0 && $evaluation->sur_5_1 != null) ? true : false,['class' => 'form-control sur_5_1'])}}	</label></li>
  						<li><label><span>1</span>{{Form::radio('sur_5_1[1]','1', $evaluation->sur_5_1 == 1 ? true : false,['class' => 'form-control sur_5_1'])}}	</label></li>
  						<li><label><span>2</span>{{Form::radio('sur_5_1[2]','2', $evaluation->sur_5_1 == 2 ? true : false,['class' => 'form-control sur_5_1'])}}	</label></li>
  						<li><label><span>3</span>{{Form::radio('sur_5_1[3]','3', $evaluation->sur_5_1 == 3 ? true : false,['class' => 'form-control sur_5_1'])}}	</label></li>
  						<li><label><span>4</span>{{Form::radio('sur_5_1[4]','4', $evaluation->sur_5_1 == 4 ? true : false,['class' => 'form-control sur_5_1'])}}	</label></li>
  						<li><label><span>5</span>{{Form::radio('sur_5_1[5]','5', $evaluation->sur_5_1 == 5 ? true : false,['class' => 'form-control sur_5_1'])}}	</label></li>
  						<li><label><span>6</span>{{Form::radio('sur_5_1[6]','6', $evaluation->sur_5_1 == 6 ? true : false,['class' => 'form-control sur_5_1'])}}	</label></li>
  						<li><label><span>7</span>{{Form::radio('sur_5_1[7]','7', $evaluation->sur_5_1 == 7 ? true : false,['class' => 'form-control sur_5_1'])}}	</label></li>
  						<li><label><span>8</span>{{Form::radio('sur_5_1[8]','8', $evaluation->sur_5_1 == 8 ? true : false,['class' => 'form-control sur_5_1'])}}	</label></li>
  						<li><label><span>9</span>{{Form::radio('sur_5_1[9]','9', $evaluation->sur_5_1 == 9 ? true : false,['class' => 'form-control sur_5_1'])}}	</label></li>
  						<li><label><span>10</span>{{Form::radio('sur_5_1[10]','10', $evaluation->sur_5_1 == 10 ? true : false,['class' => 'form-control sur_5_1'])}}</label></li>
        				</ul>
        				@if($errors->has('sur_5_1'))
  	  					<strong class="danger">{{$errors->first('sur_5_1')}}</strong>
  	  				@endif
              <span>Audio</span>
    					<ul class="inline">
    						<li><label><span>0</span>{{Form::radio('sur_5_2[0]','0', ($evaluation->sur_5_2 == 0 && $evaluation->sur_5_2 != null) ? true : false,['class' => 'form-control sur_5_2'])}}	</label></li>
    						<li><label><span>1</span>{{Form::radio('sur_5_2[1]','1', $evaluation->sur_5_2 == 1 ? true : false,['class' => 'form-control sur_5_2'])}}	</label></li>
    						<li><label><span>2</span>{{Form::radio('sur_5_2[2]','2', $evaluation->sur_5_2 == 2 ? true : false,['class' => 'form-control sur_5_2'])}}	</label></li>
    						<li><label><span>3</span>{{Form::radio('sur_5_2[3]','3', $evaluation->sur_5_2 == 3 ? true : false,['class' => 'form-control sur_5_2'])}}	</label></li>
    						<li><label><span>4</span>{{Form::radio('sur_5_2[4]','4', $evaluation->sur_5_2 == 4 ? true : false,['class' => 'form-control sur_5_2'])}}	</label></li>
    						<li><label><span>5</span>{{Form::radio('sur_5_2[5]','5', $evaluation->sur_5_2 == 5 ? true : false,['class' => 'form-control sur_5_2'])}}	</label></li>
    						<li><label><span>6</span>{{Form::radio('sur_5_2[6]','6', $evaluation->sur_5_2 == 6 ? true : false,['class' => 'form-control sur_5_2'])}}	</label></li>
    						<li><label><span>7</span>{{Form::radio('sur_5_2[7]','7', $evaluation->sur_5_2 == 7 ? true : false,['class' => 'form-control sur_5_2'])}}	</label></li>
    						<li><label><span>8</span>{{Form::radio('sur_5_2[8]','8', $evaluation->sur_5_2 == 8 ? true : false,['class' => 'form-control sur_5_2'])}}	</label></li>
    						<li><label><span>9</span>{{Form::radio('sur_5_2[9]','9', $evaluation->sur_5_2 == 9 ? true : false,['class' => 'form-control sur_5_2'])}}	</label></li>
    						<li><label><span>10</span>{{Form::radio('sur_5_2[10]','10', $evaluation->sur_5_2 == 10 ? true : false,['class' => 'form-control sur_5_2'])}}</label></li>
          				</ul>
          				@if($errors->has('sur_5_2'))
    	  					<strong class="danger">{{$errors->first('sur_5_2')}}</strong>
    	  				@endif

                <span>Duración</span>
                <ul class="inline">
                  <li><label><span>0</span>{{Form::radio('sur_5_3[0]','0', ($evaluation->sur_5_3 == 0 && $evaluation->sur_5_3 != null) ? true : false,['class' => 'form-control sur_5_3'])}}	</label></li>
                  <li><label><span>1</span>{{Form::radio('sur_5_3[1]','1', $evaluation->sur_5_3 == 1 ? true : false,['class' => 'form-control sur_5_3'])}}	</label></li>
                  <li><label><span>2</span>{{Form::radio('sur_5_3[2]','2', $evaluation->sur_5_3 == 2 ? true : false,['class' => 'form-control sur_5_3'])}}	</label></li>
                  <li><label><span>3</span>{{Form::radio('sur_5_3[3]','3', $evaluation->sur_5_3 == 3 ? true : false,['class' => 'form-control sur_5_3'])}}	</label></li>
                  <li><label><span>4</span>{{Form::radio('sur_5_3[4]','4', $evaluation->sur_5_3 == 4 ? true : false,['class' => 'form-control sur_5_3'])}}	</label></li>
                  <li><label><span>5</span>{{Form::radio('sur_5_3[5]','5', $evaluation->sur_5_3 == 5 ? true : false,['class' => 'form-control sur_5_3'])}}	</label></li>
                  <li><label><span>6</span>{{Form::radio('sur_5_3[6]','6', $evaluation->sur_5_3 == 6 ? true : false,['class' => 'form-control sur_5_3'])}}	</label></li>
                  <li><label><span>7</span>{{Form::radio('sur_5_3[7]','7', $evaluation->sur_5_3 == 7 ? true : false,['class' => 'form-control sur_5_3'])}}	</label></li>
                  <li><label><span>8</span>{{Form::radio('sur_5_3[8]','8', $evaluation->sur_5_3 == 8 ? true : false,['class' => 'form-control sur_5_3'])}}	</label></li>
                  <li><label><span>9</span>{{Form::radio('sur_5_3[9]','9', $evaluation->sur_5_3 == 9 ? true : false,['class' => 'form-control sur_5_3'])}}	</label></li>
                  <li><label><span>10</span>{{Form::radio('sur_5_3[10]','10', $evaluation->sur_5_3 == 10 ? true : false,['class' => 'form-control sur_5_3'])}}</label></li>
                    </ul>
                    @if($errors->has('sur_5_3'))
                    <strong class="danger">{{$errors->first('sur_5_3')}}</strong>
                  @endif
                  <span>Pertinencia del contenido</span>
                  <ul class="inline">
                    <li><label><span>0</span>{{Form::radio('sur_5_4[0]','0', ($evaluation->sur_5_4 == 0 && $evaluation->sur_5_4 != null) ? true : false,['class' => 'form-control sur_5_4'])}}	</label></li>
                    <li><label><span>1</span>{{Form::radio('sur_5_4[1]','1', $evaluation->sur_5_4 == 1 ? true : false,['class' => 'form-control sur_5_4'])}}	</label></li>
                    <li><label><span>2</span>{{Form::radio('sur_5_4[2]','2', $evaluation->sur_5_4 == 2 ? true : false,['class' => 'form-control sur_5_4'])}}	</label></li>
                    <li><label><span>3</span>{{Form::radio('sur_5_4[3]','3', $evaluation->sur_5_4 == 3 ? true : false,['class' => 'form-control sur_5_4'])}}	</label></li>
                    <li><label><span>4</span>{{Form::radio('sur_5_4[4]','4', $evaluation->sur_5_4 == 4 ? true : false,['class' => 'form-control sur_5_4'])}}	</label></li>
                    <li><label><span>5</span>{{Form::radio('sur_5_4[5]','5', $evaluation->sur_5_4 == 5 ? true : false,['class' => 'form-control sur_5_4'])}}	</label></li>
                    <li><label><span>6</span>{{Form::radio('sur_5_4[6]','6', $evaluation->sur_5_4 == 6 ? true : false,['class' => 'form-control sur_5_4'])}}	</label></li>
                    <li><label><span>7</span>{{Form::radio('sur_5_4[7]','7', $evaluation->sur_5_4 == 7 ? true : false,['class' => 'form-control sur_5_4'])}}	</label></li>
                    <li><label><span>8</span>{{Form::radio('sur_5_4[8]','8', $evaluation->sur_5_4 == 8 ? true : false,['class' => 'form-control sur_5_4'])}}	</label></li>
                    <li><label><span>9</span>{{Form::radio('sur_5_4[9]','9', $evaluation->sur_5_4 == 9 ? true : false,['class' => 'form-control sur_5_4'])}}	</label></li>
                    <li><label><span>10</span>{{Form::radio('sur_5_4[10]','10', $evaluation->sur_5_4 == 10 ? true : false,['class' => 'form-control sur_5_4'])}}</label></li>
                      </ul>
                      @if($errors->has('sur_5_4'))
                      <strong class="danger">{{$errors->first('sur_5_4')}}</strong>
                    @endif

  				</div>
        </div>

  		</li>

      <!--6-->
        <li>
          <p>Señala el orden en el que has usado con mayor o menor frecuencia los siguientes recursos, selecciona en un rango de 1 a 3, en donde 1 es el de mayor uso y 3 el de menor uso </p>
          <div class="row">
            <div class="col-sm-12">
              <span>Lecturas</span>
              <ul class="inline">
                <li><label><span>1</span>{{Form::radio('sur_6_1[1]','1', $evaluation->sur_6_1 == 1 ? true : false,['class' => 'form-control sur_6_1','id'=>'sur_6_1_1'])}}	</label></li>
                <li><label><span>2</span>{{Form::radio('sur_6_1[2]','2', $evaluation->sur_6_1 == 2 ? true : false,['class' => 'form-control sur_6_1','id'=>'sur_6_1_2'])}}	</label></li>
                <li><label><span>3</span>{{Form::radio('sur_6_1[3]','3', $evaluation->sur_6_1 == 3 ? true : false,['class' => 'form-control sur_6_1','id'=>'sur_6_1_3'])}}	</label></li>
                </ul>
                  @if($errors->has('sur_6_1'))
                  <strong class="danger">{{$errors->first('sur_6_1')}}</strong>
                @endif
                <span>Videos</span>
                <ul class="inline">
                  <li><label><span>1</span>{{Form::radio('sur_6_2[1]','1', $evaluation->sur_6_2 == 1 ? true : false,['class' => 'form-control sur_6_2','id'=>'sur_6_2_1'])}}	</label></li>
                  <li><label><span>2</span>{{Form::radio('sur_6_2[2]','2', $evaluation->sur_6_2 == 2 ? true : false,['class' => 'form-control sur_6_2','id'=>'sur_6_2_2'])}}	</label></li>
                  <li><label><span>3</span>{{Form::radio('sur_6_2[3]','3', $evaluation->sur_6_2 == 3 ? true : false,['class' => 'form-control sur_6_2','id'=>'sur_6_2_3'])}}	</label></li>
                    </ul>
                    @if($errors->has('sur_6_2'))
                    <strong class="danger">{{$errors->first('sur_6_2')}}</strong>
                  @endif

                  <span>Foros</span>
                  <ul class="inline">
                    <li><label><span>1</span>{{Form::radio('sur_6_3[1]','1', $evaluation->sur_6_3 == 1 ? true : false,['class' => 'form-control sur_6_3','id'=>'sur_6_3_1'])}}	</label></li>
                    <li><label><span>2</span>{{Form::radio('sur_6_3[2]','2', $evaluation->sur_6_3 == 2 ? true : false,['class' => 'form-control sur_6_3','id'=>'sur_6_3_2'])}}	</label></li>
                    <li><label><span>3</span>{{Form::radio('sur_6_3[3]','3', $evaluation->sur_6_3 == 3 ? true : false,['class' => 'form-control sur_6_3','id'=>'sur_6_3_3'])}}	</label></li>
                      </ul>
                      @if($errors->has('sur_6_3'))
                      <strong class="danger">{{$errors->first('sur_6_3')}}</strong>
                    @endif

            </div>
          </div>

        </li>

        <!--7-->
          <li>
            <p>Señala el orden en el que has interactuado con mayor o menor frecuencia con los siguientes usuarios en la plataforma, selecciona en un rango de 1 a 3, en donde 1 es el de mayor uso y 3 el de menor uso </p>
            <div class="row">
              <div class="col-sm-12">
                <span>Otro/a Agente de Cambio</span>
                <ul class="inline">
                  <li><label><span>1</span>{{Form::radio('sur_7_1[1]','1', $evaluation->sur_7_1 == 1 ? true : false,['class' => 'form-control sur_7_1','id'=>'sur_7_1_1'])}}	</label></li>
                  <li><label><span>2</span>{{Form::radio('sur_7_1[2]','2', $evaluation->sur_7_1 == 2 ? true : false,['class' => 'form-control sur_7_1','id'=>'sur_7_1_2'])}}	</label></li>
                  <li><label><span>3</span>{{Form::radio('sur_7_1[3]','3', $evaluation->sur_7_1 == 3 ? true : false,['class' => 'form-control sur_7_1','id'=>'sur_7_1_3'])}}	</label></li>
                  </ul>
                    @if($errors->has('sur_7_1'))
                    <strong class="danger">{{$errors->first('sur_7_1')}}</strong>
                  @endif
                  <span>Con facilitador/a</span>
                  <ul class="inline">
                    <li><label><span>1</span>{{Form::radio('sur_7_2[1]','1', $evaluation->sur_7_2 == 1 ? true : false,['class' => 'form-control sur_7_2','id'=>'sur_7_2_1'])}}	</label></li>
                    <li><label><span>2</span>{{Form::radio('sur_7_2[2]','2', $evaluation->sur_7_2 == 2 ? true : false,['class' => 'form-control sur_7_2','id'=>'sur_7_2_2'])}}	</label></li>
                    <li><label><span>3</span>{{Form::radio('sur_7_2[3]','3', $evaluation->sur_7_2 == 3 ? true : false,['class' => 'form-control sur_7_2','id'=>'sur_7_2_3'])}}	</label></li>
                      </ul>
                      @if($errors->has('sur_7_2'))
                      <strong class="danger">{{$errors->first('sur_7_2')}}</strong>
                    @endif

                    <span>Con soporte técnico</span>
                    <ul class="inline">
                      <li><label><span>1</span>{{Form::radio('sur_7_3[1]','1', $evaluation->sur_7_3 == 1 ? true : false,['class' => 'form-control sur_7_3','id'=>'sur_7_3_1'])}}	</label></li>
                      <li><label><span>2</span>{{Form::radio('sur_7_3[2]','2', $evaluation->sur_7_3 == 2 ? true : false,['class' => 'form-control sur_7_3','id'=>'sur_7_3_2'])}}	</label></li>
                      <li><label><span>3</span>{{Form::radio('sur_7_3[3]','3', $evaluation->sur_7_3 == 3 ? true : false,['class' => 'form-control sur_7_3','id'=>'sur_7_3_3'])}}	</label></li>
                        </ul>
                        @if($errors->has('sur_7_3'))
                        <strong class="danger">{{$errors->first('sur_7_3')}}</strong>
                      @endif

              </div>
            </div>

          </li>
          <!--8-->
          <li>
          		<p>¿Has experimentado dificultades técnicas para acceder a alguno de los recursos de la plataforma?</p>
          <div class ="row">
            <div class="col-sm-6">
        				<label>Sí {{Form::radio('sur_8[0]','1', $evaluation->sur_8== 1 ? true : false,['class' => 'form-control sur_8'])}}</label>
        				<label>No {{Form::radio('sur_8[1]','0', ($evaluation->sur_8 == 0 && $evaluation->sur_8 != null) ? true : false,['class' => 'form-control sur_8'])}}
        			@if($errors->has('sur_8'))</label>
        				<strong class="danger">{{$errors->first('sur_8')}}</strong>
        			@endif
            </div>

              <div class="col-sm-6">
                <p>
                  <label><strong>¿Cuál(es)?</strong> <br>
                  {{Form::textarea('sur_j8', null, ["class" => "form-control"])}} </label>
                  @if($errors->has('sur_j8'))
                  <strong class="danger">{{$errors->first('sur_j8')}}</strong>
                  @endif
                </p>
                </div>
              </div>
      		</li>
          <!--9-->
          <li>
            <p>En una escala de 0 a 10, donde cero es nada de acuerdo y diez es completamente de acuerdo ¿Consideras de utilidad poder visualizar en la plataforma que usuario(s) se encuentran conectados para interactuar?</p>
            <div class="row">
              <div class="col-sm-6">
                <ul class="inline">
                  <li><label><span>0</span> {{Form::radio('sur_9[0]','0', ($evaluation->sur_9 == 0 && $evaluation->sur_9 != null) ? true : false,['class' => 'form-control sur_9'])}}</label></li>
                  <li><label><span>1</span>{{Form::radio('sur_9[1]','1', $evaluation->sur_9 == 1 ? true : false,['class' => 'form-control sur_9'])}}</label>	</li>
                  <li><label><span>2</span>{{Form::radio('sur_9[2]','2', $evaluation->sur_9 == 2 ? true : false,['class' => 'form-control sur_9'])}}</label>	</li>
                  <li><label><span>3</span>{{Form::radio('sur_9[3]','3', $evaluation->sur_9 == 3 ? true : false,['class' => 'form-control sur_9'])}}</label>	</li>
                  <li><label><span>4</span>{{Form::radio('sur_9[4]','4', $evaluation->sur_9 == 4 ? true : false,['class' => 'form-control sur_9'])}}</label>	</li>
                  <li><label><span>5</span>{{Form::radio('sur_9[5]','5', $evaluation->sur_9 == 5 ? true : false,['class' => 'form-control sur_9'])}}</label>	</li>
                  <li><label><span>6</span>{{Form::radio('sur_9[6]','6', $evaluation->sur_9 == 6 ? true : false,['class' => 'form-control sur_9'])}}</label>	</li>
                  <li><label><span>7</span>{{Form::radio('sur_9[7]','7', $evaluation->sur_9 == 7 ? true : false,['class' => 'form-control sur_9'])}}</label>	</li>
                  <li><label><span>8</span>{{Form::radio('sur_9[8]','8', $evaluation->sur_9 == 8 ? true : false,['class' => 'form-control sur_9'])}}</label>	</li>
                  <li><label><span>9</span>{{Form::radio('sur_9[9]','9', $evaluation->sur_9 == 9 ? true : false,['class' => 'form-control sur_9'])}}</label>	</li>
                  <li><label><span>10</span>{{Form::radio('sur_9[10]','10', $evaluation->sur_9 == 10 ? true : false,['class' => 'form-control sur_9'])}}</label></li>
                </ul>
                @if($errors->has('sur_9'))
                    <strong class="danger">{{$errors->first('sur_9')}}</strong>
                  @endif
              </div>
              <div class="col-sm-6">
                <p>
                  <label><strong>Justifique su respuesta:</strong> <br>
                  {{Form::textarea('sur_j9', null, ["class" => "form-control"])}} </label>
                  @if($errors->has('sur_j9'))
                  <strong class="danger">{{$errors->first('sur_j9')}}</strong>
                  @endif
                </p>
                </div>
            </div>
          </li>
          <!--10-->
          <li>
            <p>En una escala de 0 a 10, donde cero es nada de acuerdo y diez es completamente de acuerdo, ¿Consideras que la plataforma, en términos generales, es amigable para el usuario?</p>
            <div class="row">
              <div class="col-sm-6">
                <ul class="inline">
                  <li><label><span>0</span> {{Form::radio('sur_10[0]','0', ($evaluation->sur_10 == 0 && $evaluation->sur_10 != null) ? true : false,['class' => 'form-control sur_10'])}}</label></li>
                  <li><label><span>1</span>{{Form::radio('sur_10[1]','1', $evaluation->sur_10 == 1 ? true : false,['class' => 'form-control sur_10'])}}</label>	</li>
                  <li><label><span>2</span>{{Form::radio('sur_10[2]','2', $evaluation->sur_10 == 2 ? true : false,['class' => 'form-control sur_10'])}}</label>	</li>
                  <li><label><span>3</span>{{Form::radio('sur_10[3]','3', $evaluation->sur_10 == 3 ? true : false,['class' => 'form-control sur_10'])}}</label>	</li>
                  <li><label><span>4</span>{{Form::radio('sur_10[4]','4', $evaluation->sur_10 == 4 ? true : false,['class' => 'form-control sur_10'])}}</label>	</li>
                  <li><label><span>5</span>{{Form::radio('sur_10[5]','5', $evaluation->sur_10 == 5 ? true : false,['class' => 'form-control sur_10'])}}</label>	</li>
                  <li><label><span>6</span>{{Form::radio('sur_10[6]','6', $evaluation->sur_10 == 6 ? true : false,['class' => 'form-control sur_10'])}}</label>	</li>
                  <li><label><span>7</span>{{Form::radio('sur_10[7]','7', $evaluation->sur_10 == 7 ? true : false,['class' => 'form-control sur_10'])}}</label>	</li>
                  <li><label><span>8</span>{{Form::radio('sur_10[8]','8', $evaluation->sur_10 == 8 ? true : false,['class' => 'form-control sur_10'])}}</label>	</li>
                  <li><label><span>9</span>{{Form::radio('sur_10[9]','9', $evaluation->sur_10 == 9 ? true : false,['class' => 'form-control sur_10'])}}</label>	</li>
                  <li><label><span>10</span>{{Form::radio('sur_10[10]','10', $evaluation->sur_10 == 10 ? true : false,['class' => 'form-control sur_10'])}}</label></li>
                </ul>
                @if($errors->has('sur_10'))
                    <strong class="danger">{{$errors->first('sur_10')}}</strong>
                  @endif
              </div>
              <div class="col-sm-6">
                <p>
                  <label><strong>Justifique su respuesta:</strong> <br>
                  {{Form::textarea('sur_j10', null, ["class" => "form-control"])}} </label>
                  @if($errors->has('sur_j10'))
                  <strong class="danger">{{$errors->first('sur_j10')}}</strong>
                  @endif
                </p>
                </div>
            </div>
          </li>
          <!--11-->
      		<li>
      			<p>En una escala de 0 a 10, donde cero es nada satisfecho y diez es completamente satisfecho ¿Qué tan satisfecho te sientes con la experiencia de uso de la Plataforma?</p>
      			<div class="row">
      				<div class="col-sm-12">
      					<ul class="inline">
      						<li><label><span>0</span> {{Form::radio('sur_11[0]','0', ($evaluation->sur_11 == 0 && $evaluation->sur_11 != null) ? true : false,['class' => 'form-control sur_11'])}}</label></li>
      						<li><label><span>1</span>{{Form::radio('sur_11[1]','1', $evaluation->sur_11 == 1 ? true : false,['class' => 'form-control sur_11'])}}</label>	</li>
      						<li><label><span>2</span>{{Form::radio('sur_11[2]','2', $evaluation->sur_11 == 2 ? true : false,['class' => 'form-control sur_11'])}}</label>	</li>
      						<li><label><span>3</span>{{Form::radio('sur_11[3]','3', $evaluation->sur_11 == 3 ? true : false,['class' => 'form-control sur_11'])}}</label>	</li>
      						<li><label><span>4</span>{{Form::radio('sur_11[4]','4', $evaluation->sur_11 == 4 ? true : false,['class' => 'form-control sur_11'])}}</label>	</li>
      						<li><label><span>5</span>{{Form::radio('sur_11[5]','5', $evaluation->sur_11 == 5 ? true : false,['class' => 'form-control sur_11'])}}</label>	</li>
      						<li><label><span>6</span>{{Form::radio('sur_11[6]','6', $evaluation->sur_11 == 6 ? true : false,['class' => 'form-control sur_11'])}}</label>	</li>
      						<li><label><span>7</span>{{Form::radio('sur_11[7]','7', $evaluation->sur_11 == 7 ? true : false,['class' => 'form-control sur_11'])}}</label>	</li>
      						<li><label><span>8</span>{{Form::radio('sur_11[8]','8', $evaluation->sur_11 == 8 ? true : false,['class' => 'form-control sur_11'])}}</label>	</li>
      						<li><label><span>9</span>{{Form::radio('sur_11[9]','9', $evaluation->sur_11 == 9 ? true : false,['class' => 'form-control sur_11'])}}</label>	</li>
      						<li><label><span>10</span>{{Form::radio('sur_11[10]','10', $evaluation->sur_11 == 10 ? true : false,['class' => 'form-control sur_11'])}}</label></li>
      					</ul>
      					@if($errors->has('sur_11'))
      		  				<strong class="danger">{{$errors->first('sur_11')}}</strong>
      		  			@endif
      				</div>
      			</div>
      		</li>

          <!--10-->
          <li>
            <p>¿Qué mejoras consideras que podrían realizarse a la plataforma?</p>
            <div class="row">

              <div class="col-sm-12">
                <p>
                  {{Form::textarea('sur_j12', null, ["class" => "form-control"])}} </label>
                  @if($errors->has('sur_j12'))
                  <strong class="danger">{{$errors->first('sur_j12')}}</strong>
                  @endif
                </p>
                </div>
            </div>
          </li>

	</ol>
  </div>
</div>


<div class="divider"></div>

<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Valoración de cada sesión del Curso 1 “Gobierno Abierto y los ODS”</h2>
	<p>En una escala de 0 a 10, donde 0 es nada  y 10 es mucho, señala en qué grado cada elemento ha contruibuido a tu aprendizaje para la siguientes sesiones</p>

	<ol class="list line">
    <!--13-->
		<li>
			<p>Sesión “Los ejes del Gobierno Abierto, la gobernanza y la atención de la corrupción”</p>
      <div class="row">
        <div class="col-sm-12">
          <span>Lecturas</span>
          <ul class="inline">
            <li><label><span>0</span>{{Form::radio('sur_13_1[0]','0', ($evaluation->sur_13_1 == 0 && $evaluation->sur_13_1 != null) ? true : false,['class' => 'form-control sur_13_1'])}}	</label></li>
            <li><label><span>1</span>{{Form::radio('sur_13_1[1]','1', $evaluation->sur_13_1 == 1 ? true : false,['class' => 'form-control sur_13_1'])}}	</label></li>
            <li><label><span>2</span>{{Form::radio('sur_13_1[2]','2', $evaluation->sur_13_1 == 2 ? true : false,['class' => 'form-control sur_13_1'])}}	</label></li>
            <li><label><span>3</span>{{Form::radio('sur_13_1[3]','3', $evaluation->sur_13_1 == 3 ? true : false,['class' => 'form-control sur_13_1'])}}	</label></li>
            <li><label><span>4</span>{{Form::radio('sur_13_1[4]','4', $evaluation->sur_13_1 == 4 ? true : false,['class' => 'form-control sur_13_1'])}}	</label></li>
            <li><label><span>5</span>{{Form::radio('sur_13_1[5]','5', $evaluation->sur_13_1 == 5 ? true : false,['class' => 'form-control sur_13_1'])}}	</label></li>
            <li><label><span>6</span>{{Form::radio('sur_13_1[6]','6', $evaluation->sur_13_1 == 6 ? true : false,['class' => 'form-control sur_13_1'])}}	</label></li>
            <li><label><span>7</span>{{Form::radio('sur_13_1[7]','7', $evaluation->sur_13_1 == 7 ? true : false,['class' => 'form-control sur_13_1'])}}	</label></li>
            <li><label><span>8</span>{{Form::radio('sur_13_1[8]','8', $evaluation->sur_13_1 == 8 ? true : false,['class' => 'form-control sur_13_1'])}}	</label></li>
            <li><label><span>9</span>{{Form::radio('sur_13_1[9]','9', $evaluation->sur_13_1 == 9 ? true : false,['class' => 'form-control sur_13_1'])}}	</label></li>
            <li><label><span>10</span>{{Form::radio('sur_13_1[10]','10', $evaluation->sur_13_1 == 10 ? true : false,['class' => 'form-control sur_13_1'])}}</label></li>
              </ul>
              @if($errors->has('sur_13_1'))
              <strong class="danger">{{$errors->first('sur_13_1')}}</strong>
            @endif
            <span>Cápsulas de expertos</span>
            <ul class="inline">
              <li><label><span>0</span>{{Form::radio('sur_13_2[0]','0', ($evaluation->sur_13_2 == 0 && $evaluation->sur_13_2 != null) ? true : false,['class' => 'form-control sur_13_2'])}}	</label></li>
              <li><label><span>1</span>{{Form::radio('sur_13_2[1]','1', $evaluation->sur_13_2 == 1 ? true : false,['class' => 'form-control sur_13_2'])}}	</label></li>
              <li><label><span>2</span>{{Form::radio('sur_13_2[2]','2', $evaluation->sur_13_2 == 2 ? true : false,['class' => 'form-control sur_13_2'])}}	</label></li>
              <li><label><span>3</span>{{Form::radio('sur_13_2[3]','3', $evaluation->sur_13_2 == 3 ? true : false,['class' => 'form-control sur_13_2'])}}	</label></li>
              <li><label><span>4</span>{{Form::radio('sur_13_2[4]','4', $evaluation->sur_13_2 == 4 ? true : false,['class' => 'form-control sur_13_2'])}}	</label></li>
              <li><label><span>5</span>{{Form::radio('sur_13_2[5]','5', $evaluation->sur_13_2 == 5 ? true : false,['class' => 'form-control sur_13_2'])}}	</label></li>
              <li><label><span>6</span>{{Form::radio('sur_13_2[6]','6', $evaluation->sur_13_2 == 6 ? true : false,['class' => 'form-control sur_13_2'])}}	</label></li>
              <li><label><span>7</span>{{Form::radio('sur_13_2[7]','7', $evaluation->sur_13_2 == 7 ? true : false,['class' => 'form-control sur_13_2'])}}	</label></li>
              <li><label><span>8</span>{{Form::radio('sur_13_2[8]','8', $evaluation->sur_13_2 == 8 ? true : false,['class' => 'form-control sur_13_2'])}}	</label></li>
              <li><label><span>9</span>{{Form::radio('sur_13_2[9]','9', $evaluation->sur_13_2 == 9 ? true : false,['class' => 'form-control sur_13_2'])}}	</label></li>
              <li><label><span>10</span>{{Form::radio('sur_13_2[10]','10', $evaluation->sur_13_2 == 10 ? true : false,['class' => 'form-control sur_13_2'])}}</label></li>
                </ul>
                @if($errors->has('sur_13_2'))
                <strong class="danger">{{$errors->first('sur_13_2')}}</strong>
              @endif

              <span>Facilitador</span>
              <ul class="inline">
                <li><label><span>0</span>{{Form::radio('sur_13_3[0]','0', ($evaluation->sur_13_3 == 0 && $evaluation->sur_13_3 != null) ? true : false,['class' => 'form-control sur_13_3'])}}	</label></li>
                <li><label><span>1</span>{{Form::radio('sur_13_3[1]','1', $evaluation->sur_13_3 == 1 ? true : false,['class' => 'form-control sur_13_3'])}}	</label></li>
                <li><label><span>2</span>{{Form::radio('sur_13_3[2]','2', $evaluation->sur_13_3 == 2 ? true : false,['class' => 'form-control sur_13_3'])}}	</label></li>
                <li><label><span>3</span>{{Form::radio('sur_13_3[3]','3', $evaluation->sur_13_3 == 3 ? true : false,['class' => 'form-control sur_13_3'])}}	</label></li>
                <li><label><span>4</span>{{Form::radio('sur_13_3[4]','4', $evaluation->sur_13_3 == 4 ? true : false,['class' => 'form-control sur_13_3'])}}	</label></li>
                <li><label><span>5</span>{{Form::radio('sur_13_3[5]','5', $evaluation->sur_13_3 == 5 ? true : false,['class' => 'form-control sur_13_3'])}}	</label></li>
                <li><label><span>6</span>{{Form::radio('sur_13_3[6]','6', $evaluation->sur_13_3 == 6 ? true : false,['class' => 'form-control sur_13_3'])}}	</label></li>
                <li><label><span>7</span>{{Form::radio('sur_13_3[7]','7', $evaluation->sur_13_3 == 7 ? true : false,['class' => 'form-control sur_13_3'])}}	</label></li>
                <li><label><span>8</span>{{Form::radio('sur_13_3[8]','8', $evaluation->sur_13_3 == 8 ? true : false,['class' => 'form-control sur_13_3'])}}	</label></li>
                <li><label><span>9</span>{{Form::radio('sur_13_3[9]','9', $evaluation->sur_13_3 == 9 ? true : false,['class' => 'form-control sur_13_3'])}}	</label></li>
                <li><label><span>10</span>{{Form::radio('sur_13_3[10]','10', $evaluation->sur_13_3 == 10 ? true : false,['class' => 'form-control sur_13_3'])}}</label></li>
                  </ul>
                  @if($errors->has('sur_13_3'))
                  <strong class="danger">{{$errors->first('sur_13_3')}}</strong>
                @endif
                <span>Contenido en general</span>
                <ul class="inline">
                  <li><label><span>0</span>{{Form::radio('sur_13_4[0]','0', ($evaluation->sur_13_4 == 0 && $evaluation->sur_13_4 != null) ? true : false,['class' => 'form-control sur_13_4'])}}	</label></li>
                  <li><label><span>1</span>{{Form::radio('sur_13_4[1]','1', $evaluation->sur_13_4 == 1 ? true : false,['class' => 'form-control sur_13_4'])}}	</label></li>
                  <li><label><span>2</span>{{Form::radio('sur_13_4[2]','2', $evaluation->sur_13_4 == 2 ? true : false,['class' => 'form-control sur_13_4'])}}	</label></li>
                  <li><label><span>3</span>{{Form::radio('sur_13_4[3]','3', $evaluation->sur_13_4 == 3 ? true : false,['class' => 'form-control sur_13_4'])}}	</label></li>
                  <li><label><span>4</span>{{Form::radio('sur_13_4[4]','4', $evaluation->sur_13_4 == 4 ? true : false,['class' => 'form-control sur_13_4'])}}	</label></li>
                  <li><label><span>5</span>{{Form::radio('sur_13_4[5]','5', $evaluation->sur_13_4 == 5 ? true : false,['class' => 'form-control sur_13_4'])}}	</label></li>
                  <li><label><span>6</span>{{Form::radio('sur_13_4[6]','6', $evaluation->sur_13_4 == 6 ? true : false,['class' => 'form-control sur_13_4'])}}	</label></li>
                  <li><label><span>7</span>{{Form::radio('sur_13_4[7]','7', $evaluation->sur_13_4 == 7 ? true : false,['class' => 'form-control sur_13_4'])}}	</label></li>
                  <li><label><span>8</span>{{Form::radio('sur_13_4[8]','8', $evaluation->sur_13_4 == 8 ? true : false,['class' => 'form-control sur_13_4'])}}	</label></li>
                  <li><label><span>9</span>{{Form::radio('sur_13_4[9]','9', $evaluation->sur_13_4 == 9 ? true : false,['class' => 'form-control sur_13_4'])}}	</label></li>
                  <li><label><span>10</span>{{Form::radio('sur_13_4[10]','10', $evaluation->sur_13_4 == 10 ? true : false,['class' => 'form-control sur_13_4'])}}</label></li>
                    </ul>
                    @if($errors->has('sur_13_4'))
                    <strong class="danger">{{$errors->first('sur_13_4')}}</strong>
                  @endif

        </div>
      </div>
		</li>

    <!--14-->
    <li>
      <p>Sesión “Panorama internacional y el papel de los ODS en el Gobierno Abierto”</p>
      <div class="row">
        <div class="col-sm-12">
          <span>Lecturas</span>
          <ul class="inline">
            <li><label><span>0</span>{{Form::radio('sur_14_1[0]','0', ($evaluation->sur_14_1 == 0 && $evaluation->sur_14_1 != null) ? true : false,['class' => 'form-control sur_14_1'])}}	</label></li>
            <li><label><span>1</span>{{Form::radio('sur_14_1[1]','1', $evaluation->sur_14_1 == 1 ? true : false,['class' => 'form-control sur_14_1'])}}	</label></li>
            <li><label><span>2</span>{{Form::radio('sur_14_1[2]','2', $evaluation->sur_14_1 == 2 ? true : false,['class' => 'form-control sur_14_1'])}}	</label></li>
            <li><label><span>3</span>{{Form::radio('sur_14_1[3]','3', $evaluation->sur_14_1 == 3 ? true : false,['class' => 'form-control sur_14_1'])}}	</label></li>
            <li><label><span>4</span>{{Form::radio('sur_14_1[4]','4', $evaluation->sur_14_1 == 4 ? true : false,['class' => 'form-control sur_14_1'])}}	</label></li>
            <li><label><span>5</span>{{Form::radio('sur_14_1[5]','5', $evaluation->sur_14_1 == 5 ? true : false,['class' => 'form-control sur_14_1'])}}	</label></li>
            <li><label><span>6</span>{{Form::radio('sur_14_1[6]','6', $evaluation->sur_14_1 == 6 ? true : false,['class' => 'form-control sur_14_1'])}}	</label></li>
            <li><label><span>7</span>{{Form::radio('sur_14_1[7]','7', $evaluation->sur_14_1 == 7 ? true : false,['class' => 'form-control sur_14_1'])}}	</label></li>
            <li><label><span>8</span>{{Form::radio('sur_14_1[8]','8', $evaluation->sur_14_1 == 8 ? true : false,['class' => 'form-control sur_14_1'])}}	</label></li>
            <li><label><span>9</span>{{Form::radio('sur_14_1[9]','9', $evaluation->sur_14_1 == 9 ? true : false,['class' => 'form-control sur_14_1'])}}	</label></li>
            <li><label><span>10</span>{{Form::radio('sur_14_1[10]','10', $evaluation->sur_14_1 == 10 ? true : false,['class' => 'form-control sur_14_1'])}}</label></li>
              </ul>
              @if($errors->has('sur_14_1'))
              <strong class="danger">{{$errors->first('sur_14_1')}}</strong>
            @endif
            <span>Cápsulas de expertos</span>
            <ul class="inline">
              <li><label><span>0</span>{{Form::radio('sur_14_2[0]','0', ($evaluation->sur_14_2 == 0 && $evaluation->sur_14_2 != null) ? true : false,['class' => 'form-control sur_14_2'])}}	</label></li>
              <li><label><span>1</span>{{Form::radio('sur_14_2[1]','1', $evaluation->sur_14_2 == 1 ? true : false,['class' => 'form-control sur_14_2'])}}	</label></li>
              <li><label><span>2</span>{{Form::radio('sur_14_2[2]','2', $evaluation->sur_14_2 == 2 ? true : false,['class' => 'form-control sur_14_2'])}}	</label></li>
              <li><label><span>3</span>{{Form::radio('sur_14_2[3]','3', $evaluation->sur_14_2 == 3 ? true : false,['class' => 'form-control sur_14_2'])}}	</label></li>
              <li><label><span>4</span>{{Form::radio('sur_14_2[4]','4', $evaluation->sur_14_2 == 4 ? true : false,['class' => 'form-control sur_14_2'])}}	</label></li>
              <li><label><span>5</span>{{Form::radio('sur_14_2[5]','5', $evaluation->sur_14_2 == 5 ? true : false,['class' => 'form-control sur_14_2'])}}	</label></li>
              <li><label><span>6</span>{{Form::radio('sur_14_2[6]','6', $evaluation->sur_14_2 == 6 ? true : false,['class' => 'form-control sur_14_2'])}}	</label></li>
              <li><label><span>7</span>{{Form::radio('sur_14_2[7]','7', $evaluation->sur_14_2 == 7 ? true : false,['class' => 'form-control sur_14_2'])}}	</label></li>
              <li><label><span>8</span>{{Form::radio('sur_14_2[8]','8', $evaluation->sur_14_2 == 8 ? true : false,['class' => 'form-control sur_14_2'])}}	</label></li>
              <li><label><span>9</span>{{Form::radio('sur_14_2[9]','9', $evaluation->sur_14_2 == 9 ? true : false,['class' => 'form-control sur_14_2'])}}	</label></li>
              <li><label><span>10</span>{{Form::radio('sur_14_2[10]','10', $evaluation->sur_14_2 == 10 ? true : false,['class' => 'form-control sur_14_2'])}}</label></li>
                </ul>
                @if($errors->has('sur_14_2'))
                <strong class="danger">{{$errors->first('sur_14_2')}}</strong>
              @endif

              <span>Facilitador</span>
              <ul class="inline">
                <li><label><span>0</span>{{Form::radio('sur_14_3[0]','0', ($evaluation->sur_14_3 == 0 && $evaluation->sur_14_3 != null) ? true : false,['class' => 'form-control sur_14_3'])}}	</label></li>
                <li><label><span>1</span>{{Form::radio('sur_14_3[1]','1', $evaluation->sur_14_3 == 1 ? true : false,['class' => 'form-control sur_14_3'])}}	</label></li>
                <li><label><span>2</span>{{Form::radio('sur_14_3[2]','2', $evaluation->sur_14_3 == 2 ? true : false,['class' => 'form-control sur_14_3'])}}	</label></li>
                <li><label><span>3</span>{{Form::radio('sur_14_3[3]','3', $evaluation->sur_14_3 == 3 ? true : false,['class' => 'form-control sur_14_3'])}}	</label></li>
                <li><label><span>4</span>{{Form::radio('sur_14_3[4]','4', $evaluation->sur_14_3 == 4 ? true : false,['class' => 'form-control sur_14_3'])}}	</label></li>
                <li><label><span>5</span>{{Form::radio('sur_14_3[5]','5', $evaluation->sur_14_3 == 5 ? true : false,['class' => 'form-control sur_14_3'])}}	</label></li>
                <li><label><span>6</span>{{Form::radio('sur_14_3[6]','6', $evaluation->sur_14_3 == 6 ? true : false,['class' => 'form-control sur_14_3'])}}	</label></li>
                <li><label><span>7</span>{{Form::radio('sur_14_3[7]','7', $evaluation->sur_14_3 == 7 ? true : false,['class' => 'form-control sur_14_3'])}}	</label></li>
                <li><label><span>8</span>{{Form::radio('sur_14_3[8]','8', $evaluation->sur_14_3 == 8 ? true : false,['class' => 'form-control sur_14_3'])}}	</label></li>
                <li><label><span>9</span>{{Form::radio('sur_14_3[9]','9', $evaluation->sur_14_3 == 9 ? true : false,['class' => 'form-control sur_14_3'])}}	</label></li>
                <li><label><span>10</span>{{Form::radio('sur_14_3[10]','10', $evaluation->sur_14_3 == 10 ? true : false,['class' => 'form-control sur_14_3'])}}</label></li>
                  </ul>
                  @if($errors->has('sur_14_3'))
                  <strong class="danger">{{$errors->first('sur_14_3')}}</strong>
                @endif
                <span>Contenido en general</span>
                <ul class="inline">
                  <li><label><span>0</span>{{Form::radio('sur_14_4[0]','0', ($evaluation->sur_14_4 == 0 && $evaluation->sur_14_4 != null) ? true : false,['class' => 'form-control sur_14_4'])}}	</label></li>
                  <li><label><span>1</span>{{Form::radio('sur_14_4[1]','1', $evaluation->sur_14_4 == 1 ? true : false,['class' => 'form-control sur_14_4'])}}	</label></li>
                  <li><label><span>2</span>{{Form::radio('sur_14_4[2]','2', $evaluation->sur_14_4 == 2 ? true : false,['class' => 'form-control sur_14_4'])}}	</label></li>
                  <li><label><span>3</span>{{Form::radio('sur_14_4[3]','3', $evaluation->sur_14_4 == 3 ? true : false,['class' => 'form-control sur_14_4'])}}	</label></li>
                  <li><label><span>4</span>{{Form::radio('sur_14_4[4]','4', $evaluation->sur_14_4 == 4 ? true : false,['class' => 'form-control sur_14_4'])}}	</label></li>
                  <li><label><span>5</span>{{Form::radio('sur_14_4[5]','5', $evaluation->sur_14_4 == 5 ? true : false,['class' => 'form-control sur_14_4'])}}	</label></li>
                  <li><label><span>6</span>{{Form::radio('sur_14_4[6]','6', $evaluation->sur_14_4 == 6 ? true : false,['class' => 'form-control sur_14_4'])}}	</label></li>
                  <li><label><span>7</span>{{Form::radio('sur_14_4[7]','7', $evaluation->sur_14_4 == 7 ? true : false,['class' => 'form-control sur_14_4'])}}	</label></li>
                  <li><label><span>8</span>{{Form::radio('sur_14_4[8]','8', $evaluation->sur_14_4 == 8 ? true : false,['class' => 'form-control sur_14_4'])}}	</label></li>
                  <li><label><span>9</span>{{Form::radio('sur_14_4[9]','9', $evaluation->sur_14_4 == 9 ? true : false,['class' => 'form-control sur_14_4'])}}	</label></li>
                  <li><label><span>10</span>{{Form::radio('sur_14_4[10]','10', $evaluation->sur_14_4 == 10 ? true : false,['class' => 'form-control sur_14_4'])}}</label></li>
                    </ul>
                    @if($errors->has('sur_14_4'))
                    <strong class="danger">{{$errors->first('sur_14_4')}}</strong>
                  @endif

        </div>
      </div>
    </li>
    <!--15-->
    <li>
      <p>Sesión “ODS en la Agenda Nacional de Gobierno Abierto”</p>
      <div class="row">
        <div class="col-sm-12">
          <span>Lecturas</span>
          <ul class="inline">
            <li><label><span>0</span>{{Form::radio('sur_15_1[0]','0', ($evaluation->sur_15_1 == 0 && $evaluation->sur_15_1 != null) ? true : false,['class' => 'form-control sur_15_1'])}}	</label></li>
            <li><label><span>1</span>{{Form::radio('sur_15_1[1]','1', $evaluation->sur_15_1 == 1 ? true : false,['class' => 'form-control sur_15_1'])}}	</label></li>
            <li><label><span>2</span>{{Form::radio('sur_15_1[2]','2', $evaluation->sur_15_1 == 2 ? true : false,['class' => 'form-control sur_15_1'])}}	</label></li>
            <li><label><span>3</span>{{Form::radio('sur_15_1[3]','3', $evaluation->sur_15_1 == 3 ? true : false,['class' => 'form-control sur_15_1'])}}	</label></li>
            <li><label><span>4</span>{{Form::radio('sur_15_1[4]','4', $evaluation->sur_15_1 == 4 ? true : false,['class' => 'form-control sur_15_1'])}}	</label></li>
            <li><label><span>5</span>{{Form::radio('sur_15_1[5]','5', $evaluation->sur_15_1 == 5 ? true : false,['class' => 'form-control sur_15_1'])}}	</label></li>
            <li><label><span>6</span>{{Form::radio('sur_15_1[6]','6', $evaluation->sur_15_1 == 6 ? true : false,['class' => 'form-control sur_15_1'])}}	</label></li>
            <li><label><span>7</span>{{Form::radio('sur_15_1[7]','7', $evaluation->sur_15_1 == 7 ? true : false,['class' => 'form-control sur_15_1'])}}	</label></li>
            <li><label><span>8</span>{{Form::radio('sur_15_1[8]','8', $evaluation->sur_15_1 == 8 ? true : false,['class' => 'form-control sur_15_1'])}}	</label></li>
            <li><label><span>9</span>{{Form::radio('sur_15_1[9]','9', $evaluation->sur_15_1 == 9 ? true : false,['class' => 'form-control sur_15_1'])}}	</label></li>
            <li><label><span>10</span>{{Form::radio('sur_15_1[10]','10', $evaluation->sur_15_1 == 10 ? true : false,['class' => 'form-control sur_15_1'])}}</label></li>
              </ul>
              @if($errors->has('sur_15_1'))
              <strong class="danger">{{$errors->first('sur_15_1')}}</strong>
            @endif
            <span>Cápsulas de expertos</span>
            <ul class="inline">
              <li><label><span>0</span>{{Form::radio('sur_15_2[0]','0', ($evaluation->sur_15_2 == 0 && $evaluation->sur_15_2 != null) ? true : false,['class' => 'form-control sur_15_2'])}}	</label></li>
              <li><label><span>1</span>{{Form::radio('sur_15_2[1]','1', $evaluation->sur_15_2 == 1 ? true : false,['class' => 'form-control sur_15_2'])}}	</label></li>
              <li><label><span>2</span>{{Form::radio('sur_15_2[2]','2', $evaluation->sur_15_2 == 2 ? true : false,['class' => 'form-control sur_15_2'])}}	</label></li>
              <li><label><span>3</span>{{Form::radio('sur_15_2[3]','3', $evaluation->sur_15_2 == 3 ? true : false,['class' => 'form-control sur_15_2'])}}	</label></li>
              <li><label><span>4</span>{{Form::radio('sur_15_2[4]','4', $evaluation->sur_15_2 == 4 ? true : false,['class' => 'form-control sur_15_2'])}}	</label></li>
              <li><label><span>5</span>{{Form::radio('sur_15_2[5]','5', $evaluation->sur_15_2 == 5 ? true : false,['class' => 'form-control sur_15_2'])}}	</label></li>
              <li><label><span>6</span>{{Form::radio('sur_15_2[6]','6', $evaluation->sur_15_2 == 6 ? true : false,['class' => 'form-control sur_15_2'])}}	</label></li>
              <li><label><span>7</span>{{Form::radio('sur_15_2[7]','7', $evaluation->sur_15_2 == 7 ? true : false,['class' => 'form-control sur_15_2'])}}	</label></li>
              <li><label><span>8</span>{{Form::radio('sur_15_2[8]','8', $evaluation->sur_15_2 == 8 ? true : false,['class' => 'form-control sur_15_2'])}}	</label></li>
              <li><label><span>9</span>{{Form::radio('sur_15_2[9]','9', $evaluation->sur_15_2 == 9 ? true : false,['class' => 'form-control sur_15_2'])}}	</label></li>
              <li><label><span>10</span>{{Form::radio('sur_15_2[10]','10', $evaluation->sur_15_2 == 10 ? true : false,['class' => 'form-control sur_15_2'])}}</label></li>
                </ul>
                @if($errors->has('sur_15_2'))
                <strong class="danger">{{$errors->first('sur_15_2')}}</strong>
              @endif

              <span>Facilitador</span>
              <ul class="inline">
                <li><label><span>0</span>{{Form::radio('sur_15_3[0]','0', ($evaluation->sur_15_3 == 0 && $evaluation->sur_15_3 != null) ? true : false,['class' => 'form-control sur_15_3'])}}	</label></li>
                <li><label><span>1</span>{{Form::radio('sur_15_3[1]','1', $evaluation->sur_15_3 == 1 ? true : false,['class' => 'form-control sur_15_3'])}}	</label></li>
                <li><label><span>2</span>{{Form::radio('sur_15_3[2]','2', $evaluation->sur_15_3 == 2 ? true : false,['class' => 'form-control sur_15_3'])}}	</label></li>
                <li><label><span>3</span>{{Form::radio('sur_15_3[3]','3', $evaluation->sur_15_3 == 3 ? true : false,['class' => 'form-control sur_15_3'])}}	</label></li>
                <li><label><span>4</span>{{Form::radio('sur_15_3[4]','4', $evaluation->sur_15_3 == 4 ? true : false,['class' => 'form-control sur_15_3'])}}	</label></li>
                <li><label><span>5</span>{{Form::radio('sur_15_3[5]','5', $evaluation->sur_15_3 == 5 ? true : false,['class' => 'form-control sur_15_3'])}}	</label></li>
                <li><label><span>6</span>{{Form::radio('sur_15_3[6]','6', $evaluation->sur_15_3 == 6 ? true : false,['class' => 'form-control sur_15_3'])}}	</label></li>
                <li><label><span>7</span>{{Form::radio('sur_15_3[7]','7', $evaluation->sur_15_3 == 7 ? true : false,['class' => 'form-control sur_15_3'])}}	</label></li>
                <li><label><span>8</span>{{Form::radio('sur_15_3[8]','8', $evaluation->sur_15_3 == 8 ? true : false,['class' => 'form-control sur_15_3'])}}	</label></li>
                <li><label><span>9</span>{{Form::radio('sur_15_3[9]','9', $evaluation->sur_15_3 == 9 ? true : false,['class' => 'form-control sur_15_3'])}}	</label></li>
                <li><label><span>10</span>{{Form::radio('sur_15_3[10]','10', $evaluation->sur_15_3 == 10 ? true : false,['class' => 'form-control sur_15_3'])}}</label></li>
                  </ul>
                  @if($errors->has('sur_15_3'))
                  <strong class="danger">{{$errors->first('sur_15_3')}}</strong>
                @endif
                <span>Contenido en general</span>
                <ul class="inline">
                  <li><label><span>0</span>{{Form::radio('sur_15_4[0]','0', ($evaluation->sur_15_4 == 0 && $evaluation->sur_15_4 != null) ? true : false,['class' => 'form-control sur_15_4'])}}	</label></li>
                  <li><label><span>1</span>{{Form::radio('sur_15_4[1]','1', $evaluation->sur_15_4 == 1 ? true : false,['class' => 'form-control sur_15_4'])}}	</label></li>
                  <li><label><span>2</span>{{Form::radio('sur_15_4[2]','2', $evaluation->sur_15_4 == 2 ? true : false,['class' => 'form-control sur_15_4'])}}	</label></li>
                  <li><label><span>3</span>{{Form::radio('sur_15_4[3]','3', $evaluation->sur_15_4 == 3 ? true : false,['class' => 'form-control sur_15_4'])}}	</label></li>
                  <li><label><span>4</span>{{Form::radio('sur_15_4[4]','4', $evaluation->sur_15_4 == 4 ? true : false,['class' => 'form-control sur_15_4'])}}	</label></li>
                  <li><label><span>5</span>{{Form::radio('sur_15_4[5]','5', $evaluation->sur_15_4 == 5 ? true : false,['class' => 'form-control sur_15_4'])}}	</label></li>
                  <li><label><span>6</span>{{Form::radio('sur_15_4[6]','6', $evaluation->sur_15_4 == 6 ? true : false,['class' => 'form-control sur_15_4'])}}	</label></li>
                  <li><label><span>7</span>{{Form::radio('sur_15_4[7]','7', $evaluation->sur_15_4 == 7 ? true : false,['class' => 'form-control sur_15_4'])}}	</label></li>
                  <li><label><span>8</span>{{Form::radio('sur_15_4[8]','8', $evaluation->sur_15_4 == 8 ? true : false,['class' => 'form-control sur_15_4'])}}	</label></li>
                  <li><label><span>9</span>{{Form::radio('sur_15_4[9]','9', $evaluation->sur_15_4 == 9 ? true : false,['class' => 'form-control sur_15_4'])}}	</label></li>
                  <li><label><span>10</span>{{Form::radio('sur_15_4[10]','10', $evaluation->sur_15_4 == 10 ? true : false,['class' => 'form-control sur_15_4'])}}</label></li>
                    </ul>
                    @if($errors->has('sur_15_4'))
                    <strong class="danger">{{$errors->first('sur_15_4')}}</strong>
                  @endif

        </div>
      </div>
      </li>

      <!--16-->
      <li>
        <p>Sesión “Debates principales en Gobierno Abierto y Objetivo 16 "Paz Justicia e Instituciones Fuertes”</p>
        <div class="row">
          <div class="col-sm-12">
            <span>Lecturas</span>
            <ul class="inline">
              <li><label><span>0</span>{{Form::radio('sur_16_1[0]','0', ($evaluation->sur_16_1 == 0 && $evaluation->sur_16_1 != null) ? true : false,['class' => 'form-control sur_16_1'])}}	</label></li>
              <li><label><span>1</span>{{Form::radio('sur_16_1[1]','1', $evaluation->sur_16_1 == 1 ? true : false,['class' => 'form-control sur_16_1'])}}	</label></li>
              <li><label><span>2</span>{{Form::radio('sur_16_1[2]','2', $evaluation->sur_16_1 == 2 ? true : false,['class' => 'form-control sur_16_1'])}}	</label></li>
              <li><label><span>3</span>{{Form::radio('sur_16_1[3]','3', $evaluation->sur_16_1 == 3 ? true : false,['class' => 'form-control sur_16_1'])}}	</label></li>
              <li><label><span>4</span>{{Form::radio('sur_16_1[4]','4', $evaluation->sur_16_1 == 4 ? true : false,['class' => 'form-control sur_16_1'])}}	</label></li>
              <li><label><span>5</span>{{Form::radio('sur_16_1[5]','5', $evaluation->sur_16_1 == 5 ? true : false,['class' => 'form-control sur_16_1'])}}	</label></li>
              <li><label><span>6</span>{{Form::radio('sur_16_1[6]','6', $evaluation->sur_16_1 == 6 ? true : false,['class' => 'form-control sur_16_1'])}}	</label></li>
              <li><label><span>7</span>{{Form::radio('sur_16_1[7]','7', $evaluation->sur_16_1 == 7 ? true : false,['class' => 'form-control sur_16_1'])}}	</label></li>
              <li><label><span>8</span>{{Form::radio('sur_16_1[8]','8', $evaluation->sur_16_1 == 8 ? true : false,['class' => 'form-control sur_16_1'])}}	</label></li>
              <li><label><span>9</span>{{Form::radio('sur_16_1[9]','9', $evaluation->sur_16_1 == 9 ? true : false,['class' => 'form-control sur_16_1'])}}	</label></li>
              <li><label><span>10</span>{{Form::radio('sur_16_1[10]','10', $evaluation->sur_16_1 == 10 ? true : false,['class' => 'form-control sur_16_1'])}}</label></li>
                </ul>
                @if($errors->has('sur_16_1'))
                <strong class="danger">{{$errors->first('sur_16_1')}}</strong>
              @endif
              <span>Cápsulas de expertos</span>
              <ul class="inline">
                <li><label><span>0</span>{{Form::radio('sur_16_2[0]','0', ($evaluation->sur_16_2 == 0 && $evaluation->sur_16_2 != null) ? true : false,['class' => 'form-control sur_16_2'])}}	</label></li>
                <li><label><span>1</span>{{Form::radio('sur_16_2[1]','1', $evaluation->sur_16_2 == 1 ? true : false,['class' => 'form-control sur_16_2'])}}	</label></li>
                <li><label><span>2</span>{{Form::radio('sur_16_2[2]','2', $evaluation->sur_16_2 == 2 ? true : false,['class' => 'form-control sur_16_2'])}}	</label></li>
                <li><label><span>3</span>{{Form::radio('sur_16_2[3]','3', $evaluation->sur_16_2 == 3 ? true : false,['class' => 'form-control sur_16_2'])}}	</label></li>
                <li><label><span>4</span>{{Form::radio('sur_16_2[4]','4', $evaluation->sur_16_2 == 4 ? true : false,['class' => 'form-control sur_16_2'])}}	</label></li>
                <li><label><span>5</span>{{Form::radio('sur_16_2[5]','5', $evaluation->sur_16_2 == 5 ? true : false,['class' => 'form-control sur_16_2'])}}	</label></li>
                <li><label><span>6</span>{{Form::radio('sur_16_2[6]','6', $evaluation->sur_16_2 == 6 ? true : false,['class' => 'form-control sur_16_2'])}}	</label></li>
                <li><label><span>7</span>{{Form::radio('sur_16_2[7]','7', $evaluation->sur_16_2 == 7 ? true : false,['class' => 'form-control sur_16_2'])}}	</label></li>
                <li><label><span>8</span>{{Form::radio('sur_16_2[8]','8', $evaluation->sur_16_2 == 8 ? true : false,['class' => 'form-control sur_16_2'])}}	</label></li>
                <li><label><span>9</span>{{Form::radio('sur_16_2[9]','9', $evaluation->sur_16_2 == 9 ? true : false,['class' => 'form-control sur_16_2'])}}	</label></li>
                <li><label><span>10</span>{{Form::radio('sur_16_2[10]','10', $evaluation->sur_16_2 == 10 ? true : false,['class' => 'form-control sur_16_2'])}}</label></li>
                  </ul>
                  @if($errors->has('sur_16_2'))
                  <strong class="danger">{{$errors->first('sur_16_2')}}</strong>
                @endif

                <span>Facilitador</span>
                <ul class="inline">
                  <li><label><span>0</span>{{Form::radio('sur_16_3[0]','0', ($evaluation->sur_16_3 == 0 && $evaluation->sur_16_3 != null) ? true : false,['class' => 'form-control sur_16_3'])}}	</label></li>
                  <li><label><span>1</span>{{Form::radio('sur_16_3[1]','1', $evaluation->sur_16_3 == 1 ? true : false,['class' => 'form-control sur_16_3'])}}	</label></li>
                  <li><label><span>2</span>{{Form::radio('sur_16_3[2]','2', $evaluation->sur_16_3 == 2 ? true : false,['class' => 'form-control sur_16_3'])}}	</label></li>
                  <li><label><span>3</span>{{Form::radio('sur_16_3[3]','3', $evaluation->sur_16_3 == 3 ? true : false,['class' => 'form-control sur_16_3'])}}	</label></li>
                  <li><label><span>4</span>{{Form::radio('sur_16_3[4]','4', $evaluation->sur_16_3 == 4 ? true : false,['class' => 'form-control sur_16_3'])}}	</label></li>
                  <li><label><span>5</span>{{Form::radio('sur_16_3[5]','5', $evaluation->sur_16_3 == 5 ? true : false,['class' => 'form-control sur_16_3'])}}	</label></li>
                  <li><label><span>6</span>{{Form::radio('sur_16_3[6]','6', $evaluation->sur_16_3 == 6 ? true : false,['class' => 'form-control sur_16_3'])}}	</label></li>
                  <li><label><span>7</span>{{Form::radio('sur_16_3[7]','7', $evaluation->sur_16_3 == 7 ? true : false,['class' => 'form-control sur_16_3'])}}	</label></li>
                  <li><label><span>8</span>{{Form::radio('sur_16_3[8]','8', $evaluation->sur_16_3 == 8 ? true : false,['class' => 'form-control sur_16_3'])}}	</label></li>
                  <li><label><span>9</span>{{Form::radio('sur_16_3[9]','9', $evaluation->sur_16_3 == 9 ? true : false,['class' => 'form-control sur_16_3'])}}	</label></li>
                  <li><label><span>10</span>{{Form::radio('sur_16_3[10]','10', $evaluation->sur_16_3 == 10 ? true : false,['class' => 'form-control sur_16_3'])}}</label></li>
                    </ul>
                    @if($errors->has('sur_16_3'))
                    <strong class="danger">{{$errors->first('sur_16_3')}}</strong>
                  @endif
                  <span>Contenido en general</span>
                  <ul class="inline">
                    <li><label><span>0</span>{{Form::radio('sur_16_4[0]','0', ($evaluation->sur_16_4 == 0 && $evaluation->sur_16_4 != null) ? true : false,['class' => 'form-control sur_16_4'])}}	</label></li>
                    <li><label><span>1</span>{{Form::radio('sur_16_4[1]','1', $evaluation->sur_16_4 == 1 ? true : false,['class' => 'form-control sur_16_4'])}}	</label></li>
                    <li><label><span>2</span>{{Form::radio('sur_16_4[2]','2', $evaluation->sur_16_4 == 2 ? true : false,['class' => 'form-control sur_16_4'])}}	</label></li>
                    <li><label><span>3</span>{{Form::radio('sur_16_4[3]','3', $evaluation->sur_16_4 == 3 ? true : false,['class' => 'form-control sur_16_4'])}}	</label></li>
                    <li><label><span>4</span>{{Form::radio('sur_16_4[4]','4', $evaluation->sur_16_4 == 4 ? true : false,['class' => 'form-control sur_16_4'])}}	</label></li>
                    <li><label><span>5</span>{{Form::radio('sur_16_4[5]','5', $evaluation->sur_16_4 == 5 ? true : false,['class' => 'form-control sur_16_4'])}}	</label></li>
                    <li><label><span>6</span>{{Form::radio('sur_16_4[6]','6', $evaluation->sur_16_4 == 6 ? true : false,['class' => 'form-control sur_16_4'])}}	</label></li>
                    <li><label><span>7</span>{{Form::radio('sur_16_4[7]','7', $evaluation->sur_16_4 == 7 ? true : false,['class' => 'form-control sur_16_4'])}}	</label></li>
                    <li><label><span>8</span>{{Form::radio('sur_16_4[8]','8', $evaluation->sur_16_4 == 8 ? true : false,['class' => 'form-control sur_16_4'])}}	</label></li>
                    <li><label><span>9</span>{{Form::radio('sur_16_4[9]','9', $evaluation->sur_16_4 == 9 ? true : false,['class' => 'form-control sur_16_4'])}}	</label></li>
                    <li><label><span>10</span>{{Form::radio('sur_16_4[10]','10', $evaluation->sur_16_4 == 10 ? true : false,['class' => 'form-control sur_16_4'])}}</label></li>
                      </ul>
                      @if($errors->has('sur_16_4'))
                      <strong class="danger">{{$errors->first('sur_16_4')}}</strong>
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
