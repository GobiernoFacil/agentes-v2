@foreach($next_activities as $activity)
	<div class="box session_list">
		<div class="row">
	<!--icono-->
	<div class="col-sm-1 right">
	  <b class="icon_h session list_s"></b>
	</div>
	<div class="col-sm-9">
	  <h3>Actividad {{$activity->order}}</h3>
	  <h2><a href='{{url("tablero/aprendizaje/{$activity->session->slug}/{$activity->session->slug}/$activity->id")}}'>{{$activity->name}}</a></h2>
	  <div class="divider"></div>
	    <div class="row">
	      <div class="col-sm-9">
	        <p>{{$activity->description}}</p>
	      </div>
	    </div>
	  </div>
	  <!-- ver sesión-->
	  <div class="col-sm-2">
	    <a class="btn view block sessions_l" href='{{url("tablero/aprendizaje/{$activity->session->slug}/{$activity->session->slug}/$activity->id")}}'>Ver actividad</a>
	  </div>
	          <!-- footnote-->
	  <div class="footnote">
	    <div class="row">
	      <div class="col-sm-2">
	        <p><b class="icon_h time"></b>{{$activity->duration}} h </p>
	      </div>
	      <div class="col-sm-3">
		      <p>Fecha límite: <strong>{{ !empty($activity->end) ? date("j/m/Y", strtotime($activity->end)) : 'Sin fecha'}}</strong></p>
	      </div>
	    </div>
	  </div>
		</div>
	</div>
@endforeach
