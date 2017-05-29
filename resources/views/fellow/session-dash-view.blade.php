<div class="box session_list">
  <div class="row">
  <!--icono-->
  <div class="col-sm-1 right">
    <b class="icon_h session list_s"></b>
  </div>
  <div class="col-sm-9">
    <h3>Sesión {{$session->order}}</h3>
    <h2><a href='{{url("tablero/aprendizaje/{$session->module->slug}/$session->slug")}}'>{{$session->name}}</a></h2>
    <div class="divider"></div>
      <div class="row">
        <div class="col-sm-9">
          <p>{{$session->objective}}</p>
        </div>
        <div class="col-sm-3 notes">
          <p class="right">Fechas:<br>{{date("d-m-Y", strtotime($session->start))}} al {{date('d-m-Y', strtotime($session->end))}}</p>
        </div>
      </div>
    </div>
    <!-- ver sesión-->
            <div class="col-sm-2">
      <a class="btn view block sessions_l" href='{{url("tablero/aprendizaje/{$session->module->slug}/$session->slug")}}'>Ver sesión</a>
    </div>
            <!-- footnote-->
    <div class="footnote">
      <div class="row">
        <div class="col-sm-2">
          <p><b class="icon_h time"></b>{{$session->hours}} h </p>
        </div>
        <div class="col-sm-2">
          <p><b class="icon_h modalidad"></b>{{$session->modality}}</p>
        </div>
        @if($session->facilitators->count()>0)
        <div class="col-sm-6">
          <p><strong>{{$session->facilitators->count() == 1 ? 'Facilitador' : 'Facilitadores' }}:</strong>
          @foreach ($session->facilitators as $facilitator)
            @if($facilitator->user->image)
            <img src='{{url("img/users/{$facilitator->user->image->name}")}}' height="30px">
            @else
            @endif
             {{$facilitator->user->name}} -  {{$facilitator->user->institution}} <br>
          @endforeach
          </p>
        </div>
        @else
        <div class="col-sm-6">
              <p>Sin facilitadores asignados</p>
        </div>
        @endif

        <div class="col-sm-2">
          <p class="right">{{$session->activities->count()}} actividades  </p>
        </div>
      </div>
    </div>