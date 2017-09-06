
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
    .page_break { page-break-before: always; }
    </style>
  </head>
  <body class ="">
    <section>
      <!--content-->
  		<div class="container">
        <div class="box">
        <div class="row">
        	<div class="col-sm-12">
        		<h1>Respuestas de Cuestionario diagnóstico</h1>
            <h2><strong>{{$questionnaire->title}}</strong></h2>
        		<div class="divider top"></div>
        	</div>
        </div>
        <div class="page_break"></div>
        <div class="box">
        	<div class="row">
        		<div class="col-sm-12">
        			<div class="divider top"></div>
              <ol class="list line">
                @foreach($questionnaire->questions as $question)
                <li class="row">
                  <span class="col-sm-9">
                  <h3>{{$question->question}}</h3>
      						<small>Respuestas: {{$question->answers_fellows->count()}}</small>
      						@foreach($question->answers_fellows as $answer)
      							<p>{{$answer->answer}}</p>
      						@endforeach
                  </span>
                </li>
                <div class="page_break"></div>
                @endforeach
              </ol>
        				<div class="divider"></div>
        		</div>
          </div>
        	</div>
        </div>
      </div>
  </section>
  </body>
</html>
