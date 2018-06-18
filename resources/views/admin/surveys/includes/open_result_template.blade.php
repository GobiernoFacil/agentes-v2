<!--pregunta-->
<span class="col-sm-12">
	<h2>{{$question->question}}</h2>
	<div class="divider b"></div>
</span>
<span class="col-sm-10 col-sm-offset-1">
	
	<!-- número de respuestas-->
	<h3 class="center">{{$question->answers_fellows->count()}} respuestas</h3>
	<div class="divider b"></div>
	<ol>
		<!-- las respuestas-->
		@foreach($question->answers_fellows as $data)
		<li class="ap_message_f">{{$data->answer}}</li>
		@endforeach
	</ol>
</span>