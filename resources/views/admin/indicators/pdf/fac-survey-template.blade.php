
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <main class="main-content">
      <!--content-->
  		<div class="container">
        <div class="row">
        	<div class="col-sm-12">
        		<h1>Resultados de encuesta de <strong>{{$facilitatorData->facilitator->name}}</strong></h1>
            <h2>Sesión <strong>{{$facilitatorData->session->name}}</strong></h2>
        		<div class="divider top"></div>
        	</div>
        	<!--info fellow-->
        	<div class="col-sm-1 center">
            <span>
          		@if($facilitatorData->facilitator->image)
              <?php $image_path = public_path()."/img/users/".$facilitatorData->facilitator->image->name;?>
          		<img src='{{$image_path}}'>
          		@else
          		<img src='{{public_path()."/img/users/default.png"}}' height="40px">
          		@endif
           </span>
        	</div>
        	<div class="col-sm-3">
        		<p>{{$facilitatorData->facilitator->facilitatorData->institution}}</p>
        	</div>
        </div>
        <div class="box">
        	<div class="row">
        		<div class="col-sm-12">
        			<div class="divider top"></div>
              <ol class="list line">
                <li class="row">
                  <span class="col-sm-9">
                  <h3>La claridad de exposición del facilitador fue</h3>
                  <small><strong>Respuestas: {{$all->count()}}</strong></small>
                  </span>
                  <img src='{{base_path()."/csv/survey_images_facilitator/mo_{$session->module->id}_sess_{$session->id}_fac_{$facilitatorData->facilitator->id}_fa_1.jpg"}}' width="1000">
                </li>
                <li class="row">
                  <span class="col-sm-9">
                  <h3>El facilitador motiva y despierta interés en los agentes de cambio a través de su exposición</h3>
                  <small><strong>Respuestas: {{$all->count()}}</strong></small>
                  <img src='{{base_path()."/csv/survey_images_facilitator/mo_{$session->module->id}_sess_{$session->id}_fac_{$facilitatorData->facilitator->id}_fa_2.jpg"}}' width="1000">
                  </span>
                </li>
                <li class="row">
                  <span class="col-sm-9">
                  <h3>El facilitador da retroalimentación a los estudiantes</h3>
                  <small><strong>Respuestas: {{$all->count()}}</strong></small>
                  <img src='{{base_path()."/csv/survey_images_facilitator/mo_{$session->module->id}_sess_{$session->id}_fac_{$facilitatorData->facilitator->id}_fa_3.jpg"}}' width="1000">
                  </span>
                </li>
                <li class="row">
                  <span class="col-sm-9">
                  <h3>El facilitador responde con claridad a las preguntas de los estudiantes</h3>
                  <small><strong>Respuestas: {{$all->count()}}</strong></small>
                  <img src='{{base_path()."/csv/survey_images_facilitator/mo_{$session->module->id}_sess_{$session->id}_fac_{$facilitatorData->facilitator->id}_fa_4.jpg"}}' width="1000">
                  </span>
                </li>
                <li class="row">
                  <span class="col-sm-9">
                  <h3>En el desarrollo de su exposición el facilitador presenta ejemplos relevantes sobre los temas tratados</h3>
                  <small><strong>Respuestas: {{$all->count()}}</strong></small>
                  <img src='{{base_path()."/csv/survey_images_facilitator/mo_{$session->module->id}_sess_{$session->id}_fac_{$facilitatorData->facilitator->id}_fa_5.jpg"}}' width="1000">
                  </span>
                </li>
                <li class="row">
                  <span class="col-sm-9">
                  <h3>El facilitador presentó de forma organizada los contenidos abordados</h3>
                  <small><strong>Respuestas: {{$all->count()}}</strong></small>
                  </span>
                  <span class="col-sm-12">
                    <img src='{{base_path()."/csv/survey_images_facilitator/mo_{$session->module->id}_sess_{$session->id}_fac_{$facilitatorData->facilitator->id}_fa_6.jpg"}}' width="1000">
                  </span>
                </li>
                <li class="row">
                  <span class="col-sm-9">
                  <h3>¿Qué fortalezas identificas en el facilitador?</h3>
                  <small>Comentarios: {{$all->count()}}</small>
                  @foreach($all as $data)
                      @if($data->fa_7)
                        <p>{{$data->fa_7}}</p>
                      @endif
                  @endforeach
                  </span>
                </li>
                <li class="row">
                  <span class="col-sm-9">
                  <h3>¿Qué áreas de mejora identificas en el facilitador?</h3>
                  <small><strong>Comentarios: {{$all->count()}}</strong></small>
                    @foreach($all as $data)
                      @if($data->fa_8)
                              <p>{{$data->fa_8}}</p>
                      @endif
                    @endforeach
                  </span>
                </li>
                <li class="row">
                  <span class="col-sm-9">
                  <h3>¿Propondría a este facilitador para que dirigiera otro curso de este programa de formación?</h3>
                  <small><strong>Respuestas: {{$all->count()}}</strong></small>
                  <img src='{{base_path()."/csv/survey_images_facilitator/mo_{$session->module->id}_sess_{$session->id}_fac_{$facilitatorData->facilitator->id}_fa_9.jpg"}}' width="1000">
                  </span>
                </li>
              </ol>
        				<div class="divider"></div>
        		</div>
        	</div>
        </div>
      </div>
  </main>
  </body>
</html>
