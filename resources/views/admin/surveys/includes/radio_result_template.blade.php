<span class="col-sm-12">
	<h2>{{$question->question}}</h2>
	<div class="divider b"></div>
</span>
<span class="col-sm-6">
	<!-- número de respuestas-->
	<h3 class="center">{{$question->answers_fellows->count()}} respuestas</h3>
</span>
<span class="col-sm-6">
	<!-- número de respuestas-->
	<h3 class="center">Media: <span id ="{{$question->id}}_med">{{$question->answers_fellows()->pluck('answer')->median()}}</span></h3>
</span>
<span class="col-sm-12">
	<div class="divider b"></div>
	<svg width="1000" height="500" style ="padding-left:50px; padding-top:20px" id ="question_{{$question->id}}"></svg>
</span> 
