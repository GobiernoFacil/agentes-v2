<!--icono-->
<div class="col-sm-1 right">
  <b class="icon_h session list_s"></b>
</div>
<?php $module = $program->fellow_modules()->orderBy('start','asc')->first(); ?>
<div class="col-sm-8">
  <h3>Módulo 1</h3>
  @if((strtotime($module->start) <= strtotime(date('Y-m-d'))) && $module->public && $user->check_progress($module->id,0))
    <h2><a href='{{url("tablero/{$module->program->slug}/aprendizaje/$module->slug")}}'>{{$module->title}}</a></h2>
  @else
    <h2>{{$module->title}}</h2>
  @endif
  <div class="divider"></div>
    <div class="row">
      <div class="col-sm-9">
        <p>{{$module->objective}}</p>
      </div>
      <div class="col-sm-3 notes">
        <p class="right">Fechas:<br>{{date("d-m-Y", strtotime($module->start))}} al {{date('d-m-Y', strtotime($module->end))}}</p>
      </div>
    </div>
  </div>
  <!-- ver sesión-->
  @if((strtotime($module->start) <= strtotime(date('Y-m-d'))) && $module->public && $user->check_progress($module->id,0))
    <div class="col-sm-3">
      <a class="btn view block sessions_l" href='{{url("tablero/{$module->program->slug}/aprendizaje/$module->slug")}}'>Ver módulo</a>
    </div>
  @endif
          <!-- footnote-->
  <div class="footnote">
    <div class="row">
      <div class="col-sm-2">

        <p><b class="icon_h time"></b>{{$module->duration_hours() < 1 ? str_replace(".00", "", (string)number_format($module->duration_minutes(), 2, ".", "")).' min.' : str_replace(".00", "", (string)number_format($module->duration_hours(), 2, ".", "")).' h'}} </p>
      </div>
      <div class="col-sm-2">
        <p><b class="icon_h modalidad"></b>{{$module->modality}}</p>
      </div>
      <div class="col-sm-2 col-sm-offset-6">
        <p class="right">{{$module->sessions->count() > 0 ? $module->sessions->count().' sesiones' : 'Sin sesiones' }}  </p>
      </div>
    </div>
  </div>
