<div class="box session_list">
	<div class="row">
<!--icono-->
<div class="col-sm-1 right">
  <b class="icon_h session list_s"></b>
</div>
<div class="col-sm-8">
  <h3>Actividad {{$activity->order}}</h3>
  <h2><a href='{{url("tablero/{$program->slug}/aprendizaje/{$activity->session->module->slug}/{$activity->session->slug}/$activity->slug")}}'>{{$activity->name}}</a></h2>
  <div class="divider"></div>
    <div class="row">
      <div class="col-sm-9">
        <p>{{str_limit($activity->description, $limit = 500, $end = '...')}}</p>
      </div>
    </div>
  </div>
  <!-- ver sesión-->
  <div class="col-sm-3">
    <a class="btn view block sessions_l" href='{{url("tablero/{$program->slug}/aprendizaje/{$activity->session->module->slug}/{$activity->session->slug}/$activity->slug")}}'>Ver actividad</a>
  </div>
          <!-- footnote-->
  <div class="footnote">
    <div class="row">
      <div class="col-sm-2">
        <p><b class="icon_h time"></b>
					{{$activity->measure == 1 ? str_replace(".00", "", (string)number_format($activity->duration, 2, ".", "")).' h.' : str_replace(".00", "", (string)number_format($activity->duration, 2, ".", "")).' min'}}
				</p>
      </div>
    </div>
  </div>
	</div>
</div>
