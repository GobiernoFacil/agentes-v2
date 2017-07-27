<div class="box session_list">
	<div class="row">
<!--icono-->
<div class="col-sm-1 right">
  <b class="icon_h session list_s"></b>
</div>
<div class="col-sm-8">
  <h3>Módulo 1</h3>
  <h2><a href='{{url("tablero/aprendizaje/$module_last->slug")}}'>{{$module_last->title}}</a></h2>
  <div class="divider"></div>
    <div class="row">
      <div class="col-sm-9">
        <p>{{$module_last->objective}}</p>
      </div>
      <div class="col-sm-3 notes">
        <p class="right">Fechas:<br>{{date("d-m-Y", strtotime($module_last->start))}} al {{date('d-m-Y', strtotime($module_last->end))}}</p>
      </div>
    </div>
  </div>
  <!-- ver sesión-->
          <div class="col-sm-3">
    <a class="btn view block sessions_l" href='{{url("tablero/aprendizaje/$module_last->slug")}}'>Ver módulo</a>
  </div>
          <!-- footnote-->
  <div class="footnote">
    <div class="row">
      <div class="col-sm-2">
        <p><b class="icon_h time"></b>{{$module_last->number_hours}} h </p>
      </div>
      <div class="col-sm-2">
        <p><b class="icon_h modalidad"></b>{{$module_last->modality}}</p>
      </div>
      <div class="col-sm-2 col-sm-offset-6">
        <p class="right">{{$module_last->sessions->count() > 0 ? $module_last->sessions->count().' sesiones' : 'Sin sesiones' }}  </p>
      </div>
    </div>
  </div>
	</div>
</div>