
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="{{url($__env->yieldContent('css-custom')) }}">
  	<link rel="stylesheet" href="{{url('css/admin_styles.css')}}">
  </head>
  <body>
    <div class="row">
    	<div class="col-sm-12">
    		<h1>Resultados de encuesta de <strong>{{$facilitatorData->facilitator->name}}</strong></h1>
        <h2>Sesión <strong>{{$facilitatorData->session->name}}</strong></h2>
    		<div class="divider top"></div>
    	</div>
    	<!--info fellow-->
    	<div class="col-sm-1 center">
    		@if($facilitatorData->facilitator->image)
    		<img src='{{url("img/users/{$facilitatorData->facilitator->image->name}")}}' width="1000">
    		@else
    		<img src='{{url("img/users/default.png")}}' height="40px">
    		@endif
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
                <svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="fac_1"></svg>
    					</li>
              <li class="row">
    						<span class="col-sm-9">
    						<h3>El facilitador motiva y despierta interés en los agentes de cambio a través de su exposición</h3>
    						<small><strong>Respuestas: {{$all->count()}}</strong></small>
    						<svg width="1000" height="500"style ="padding-left:40px; padding-top:20px"  id ="fac_2"></svg>
    						</span>
    					</li>
              <li class="row">
    						<span class="col-sm-9">
    						<h3>El facilitador da retroalimentación a los estudiantes</h3>
    						<small><strong>Respuestas: {{$all->count()}}</strong></small>
    						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="fac_3"></svg>
    						</span>
    					</li>
              <li class="row">
                <span class="col-sm-9">
                <h3>El facilitador responde con claridad a las preguntas de los estudiantes</h3>
    						<small><strong>Respuestas: {{$all->count()}}</strong></small>
    						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px"  id ="fac_4"></svg>
                </span>
              </li>
              <li class="row">
                <span class="col-sm-9">
                <h3>En el desarrollo de su exposición el facilitador presenta ejemplos relevantes sobre los temas tratados</h3>
    						<small><strong>Respuestas: {{$all->count()}}</strong></small>
    						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="fac_5"></svg>
                </span>
              </li>
              <li class="row">
                <span class="col-sm-9">
                <h3>El facilitador presentó de forma organizada los contenidos abordados</h3>
    						<small><strong>Respuestas: {{$all->count()}}</strong></small>
                </span>
    						<span class="col-sm-12">
    							<svg width="1000" height="500"  style ="padding-left:40px; padding-top:20px"id ="fac_6"></svg>
    					  </span>
              </li>
              <li class="row">
                <span class="col-sm-9">
                <h3>¿Qué fortalezas identificas en el facilitador?</h3>
    						<small>Comentarios: {{$all->count()}}</small>
    						@foreach($all as $data)
    							<p>{{$data->fa_7}}</p>
    						@endforeach
                </span>
              </li>
              <li class="row">
                <span class="col-sm-9">
                <h3>¿Qué áreas de mejora identificas en el facilitador?</h3>
    						<small><strong>Comentarios: {{$all->count()}}</strong></small>
    							@foreach($all as $data)
    								<p>{{$data->fa_8}}</p>
    							@endforeach
                </span>
              </li>
              <li class="row">
                <span class="col-sm-9">
                <h3>¿Propondría a este facilitador para que dirigiera otro curso de este programa de formación?</h3>
    						<small><strong>Respuestas: {{$all->count()}}</strong></small>
    						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="fac_9"></svg>
                </span>
              </li>
    				</ol>
    				<div class="divider"></div>
    		</div>
    	</div>
    </div>
  </body>
</html>
