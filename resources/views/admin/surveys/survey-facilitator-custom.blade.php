@extends('layouts.admin.a_master')
@section('title', 'Resultados de encuesta por sesión de ' . $facilitatorData->name)
@section('description', 'Resultados de encuesta por sesión de ' . $facilitatorData->name.' sesión '.$session->name)
@section('body_class', '')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Resultados de encuesta de <strong>{{$facilitatorData->name}}</strong></h1>
    <h2>Sesión <strong>{{$session->name}}</strong></h2>
		<div class="divider top"></div>
	</div>
	<!--info fellow-->
	<div class="col-sm-1 center">
		@if($facilitatorData->image)
		<img src='{{url("img/users/{$facilitatorData->image->name}")}}' width="1000">
		@else
		<img src='{{url("img/users/default.png")}}' height="40px">
		@endif
	</div>
</div>

<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<div class="divider top"></div>
			<div class="row">
				<span class="col-sm-4 col-sm-offset-8" id ="general_div" style="display:none;">
					<strong>Promedio General: <span id ="general"></span></strong>
				</span>
			</div>

      <ol class="list line">
        @foreach($questionnaire->questions as $question)
    				<li class="row">
    					<span class="col-sm-9">
    						<h3>{{$question->question}}</h3>
                    @if($question->options_rows_number>1)
                        <small><strong>Respuestas: {{$question->answers_fellows_facilitator($session->id,$facilitatorData->id)->count()/$question->options_rows_number}}</strong></small>
                    @else

        						      <small><strong>Respuestas: {{$question->answers_fellows_facilitator($session->id,$facilitatorData->id)->count()}}</strong></small>
                    @endif
    					</span>
                @if($question->type ==='radio')
                  @if($question->options_rows_number >1)
                    @foreach($question->answers as $answer)
                      <span class="col-sm-9">{{$answer->answer}}</span>
                      <svg width="1000" height="500" style ="padding-left:50px; padding-top:20px" id ="question_{{$question->id}}_{{$answer->id}}"></svg>
                      <span class="col-sm-9">
                        <strong>Promedio: <span id ="{{$question->id}}_{{$answer->id}}_av"></span></strong>
                      </span>
                    @endforeach
                  @else
            					<svg width="1000" height="500" style ="padding-left:50px; padding-top:20px" id ="question_{{$question->id}}"></svg>
            					<span class="col-sm-9">
            						<strong>Promedio: <span id ="{{$question->id}}_av"></span></strong>
            					</span>
                  @endif
                @elseif($question->type==='open')
                  <span class="col-sm-9">
                        @foreach($question->answers_fellows_facilitator($session->id,$facilitatorData->id) as $answers)
                        		<p>{{$answers->answer}}</p>
                         @endforeach
                  </span>
                @endif
    				</li>
        @endforeach
      </ol>
    </div>
  </div>
</div>
@endsection


@section('js-content')
<style>

.bar {
  fill: #187fad;;
}

.bar:hover {
  fill: #0a3345;
}

.d3-tip {
      line-height: 1;
      padding: 6px;
      background: rgba(0, 0, 0, 0.8);
      color: #fff;
      border-radius: 4px;
      font-size: 12px;
    }

    /* Creates a small triangle extender for the tooltip */
    .d3-tip:after {
      box-sizing: border-box;
      display: inline;
      font-size: 10px;
      width: 100%;
      line-height: 1;
      color: rgba(0, 0, 0, 0.8);
      content: "\25BC";
      position: absolute;
      text-align: center;
    }

    /* Style northward tooltips specifically */
    .d3-tip.n:after {
      margin: -2px 0 0 0;
      top: 100%;
      left: 0;
    }




</style>
<script src="https://d3js.org/d3.v4.js"></script>
<script src="{{url('js/survey/d3-tip.js')}}"></script>
<script>
var total = {{$questionnaire->questions->count()}};
var average_total = 0;
var answers       = 0;

  @foreach($questionnaire->questions as $question)
      @if($question->type === 'radio')
        @if($question->options_rows_number >1)
		            @foreach($question->answers as $answer)
										var data_{{$question->id.'_'.$answer->id}} = <?php echo json_encode($question->data_to_graph_rows($answer->id,$session->id,$facilitatorData->id)); ?>;
										var max_value = {{$question->options_columns_number}};
										var svg_{{$question->id.'_'.$answer->id}} = d3.select("#question_{{$question->id}}_{{$answer->id}}"),
											margin = {top: 50, right: 40, bottom: 30, left: 40},
											width = +svg_{{$question->id.'_'.$answer->id}}.attr("width") - margin.left - margin.right,
											height = +svg_{{$question->id.'_'.$answer->id}}.attr("height") - margin.top - margin.bottom,
											aspect = width / height;

										var x = d3.scaleBand().rangeRound([0, width]).padding(0.1),
											y = d3.scaleLinear().rangeRound([height, 0]);

											var tool_tip = d3.tip()
													 .attr("class", "d3-tip")
													 .offset([-8, 0])
													 .html(function(d) { return "Total: " + d.values +"</br>"+ ((d.values*100)/total).toFixed(2) +"%" });
												 svg_{{$question->id.'_'.$answer->id}}.call(tool_tip);

										var g = svg_{{$question->id.'_'.$answer->id}}.append("g")
											.attr("transform", "translate(" + margin.left + "," + margin.top + ")");


												var data = data_{{$question->id.'_'.$answer->id}};
												// format the data
												data.forEach(function(d) {
													d.values = +d.values;
												});

												var average = 0;
												var total   = 0;
												data.forEach(function(all) {
													average = (all.values*parseInt(all.options)) + average;
													total   = total + all.values;

												});

													if((((average/total)*100)/max_value)){
														average_total = average_total +(((average/total)*100)/max_value);
													}


												// Scale the range of the data in the domains
												x.domain(data.map(function(d) { return d.options; }));
												y.domain([0, d3.max(data, function(d) { return d.values; })]);

												// append the rectangles for the bar chart
												svg_{{$question->id.'_'.$answer->id}}.selectAll(".bar")
														.data(data)
													.enter().append("rect")
														.attr("class", "bar")
														.attr("x", function(d) { return x(d.options); })
														.attr("width", x.bandwidth())
														.attr("y", function(d) { return y(d.values); })
														.attr("height", function(d) { return height - y(d.values); })
														.on('mouseover', tool_tip.show)
														.on('mouseout', tool_tip.hide);

												// add the x Axis
												svg_{{$question->id.'_'.$answer->id}}.append("g")
														.attr("transform", "translate(0," + height + ")")
														.call(d3.axisBottom(x));

														// text label for the x axis
												svg_{{$question->id.'_'.$answer->id}}.append("text")
														.attr("transform",
																	"translate(" + (width/2) + " ," +
																								 (height + margin.top + 20) + ")")
														.style("text-anchor", "middle")
														.text("{{$question->min_label.' - '.$question->max_label}}");

												// add the y Axis
												svg_{{$question->id.'_'.$answer->id}}.append("g")
														.call(d3.axisLeft(y));

														// text label for the y axis
													  svg_{{$question->id.'_'.$answer->id}}.append("text")
													      .attr("transform", "rotate(-90)")
													      .attr("y", -10 - margin.left)
													      .attr("x",0 - (height / 2))
													      .attr("dy", "1em")
													      .style("text-anchor", "middle")
													      .text("Respuestas");


												var name  = "<?php echo $question->id.'_'.$answer->id.'_av';?>";
											  document.getElementById(name).textContent=(((average/total)*100)/max_value).toFixed(2);
												document.getElementById("{{'question_'.$question->id.'_'.$answer->id}}").style.height =600;
												answers++;
            @endforeach

        @else
          var data_{{$question->id}} = <?php echo json_encode($question->data_to_graph_facilitator($session->id,$facilitatorData->id)); ?>;
					var max_value = {{$question->options_columns_number}};
          var svg_{{$question->id}} = d3.select("#question_{{$question->id}}"),
            margin = {top: 50, right: 40, bottom: 30, left: 40},
            width = +svg_{{$question->id}}.attr("width") - margin.left - margin.right,
            height = +svg_{{$question->id}}.attr("height") - margin.top - margin.bottom,
            aspect = width / height;

          var x = d3.scaleBand().rangeRound([0, width]).padding(0.1),
            y = d3.scaleLinear().rangeRound([height, 0]);

            var tool_tip = d3.tip()
                 .attr("class", "d3-tip")
                 .offset([-8, 0])
                 .html(function(d) { return "Total: " + d.values +"</br>"+ ((d.values*100)/total).toFixed(2) +"%" });
               svg_{{$question->id}}.call(tool_tip);

          var g = svg_{{$question->id}}.append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

              var data = data_{{$question->id}};
              // format the data
              data.forEach(function(d) {
                d.values = +d.values;
              });

              var average = 0;
              var total   = 0;
              data.forEach(function(all) {
                average = (all.values*parseInt(all.options)) + average;
                total   = total + all.values;

              });

							if((((average/total)*100)/max_value)){
								average_total = average_total +(((average/total)*100)/max_value);
							}


              // Scale the range of the data in the domains
              x.domain(data.map(function(d) { return d.options; }));
              y.domain([0, d3.max(data, function(d) { return d.values; })]);

              // append the rectangles for the bar chart
              svg_{{$question->id}}.selectAll(".bar")
                  .data(data)
                .enter().append("rect")
                  .attr("class", "bar")
                  .attr("x", function(d) { return x(d.options); })
                  .attr("width", x.bandwidth())
                  .attr("y", function(d) { return y(d.values); })
                  .attr("height", function(d) { return height - y(d.values); })
                  .on('mouseover', tool_tip.show)
                  .on('mouseout', tool_tip.hide);

              // add the x Axis
              svg_{{$question->id}}.append("g")
                  .attr("transform", "translate(0," + height + ")")
                  .call(d3.axisBottom(x));
									// text label for the x axis
						  svg_{{$question->id}}.append("text")
						      .attr("transform",
						            "translate(" + (width/2) + " ," +
						                           (height + margin.top + 20) + ")")
						      .style("text-anchor", "middle")
									.text("{{$question->min_label.' - '.$question->max_label}}");

									// text label for the y axis
								  svg_{{$question->id}}.append("text")
								      .attr("transform", "rotate(-90)")
								      .attr("y", -10 - margin.left)
								      .attr("x",0 - (height / 2))
								      .attr("dy", "1em")
								      .style("text-anchor", "middle")
								      .text("Respuestas");


              // add the y Axis
              svg_{{$question->id}}.append("g")
                  .call(d3.axisLeft(y));
                  var name  = "<?php echo $question->id.'_av';?>";
                  document.getElementById(name).textContent=(((average/total)*100)/max_value).toFixed(2);
							    document.getElementById('question_'+{{$question->id}}).style.height =600;
							answers++;
        @endif
      @endif
  @endforeach

	var interval = setInterval(function() {
	    if(document.readyState === 'complete') {
	        clearInterval(interval);
					document.getElementById('general').textContent=(average_total/answers).toFixed(2);
					document.getElementById('general_div').style.display = "block" ;
	    }
	}, 7000);
</script>
@endsection
