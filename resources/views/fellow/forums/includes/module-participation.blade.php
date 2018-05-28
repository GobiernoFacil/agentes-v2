<div class="row table_t">
  <div class="col-sm-offset-7 col-sm-2">
    <p>Fecha límite</p>
  </div>
  <div class="col-sm-3">
    <p>Estatus</p>
  </div>
</div><!--row ends-->
<div class="col-sm-12">
  <div class="divider"></div>
</div>
  @foreach($module->sessions as $session)
  <div class="col-sm-5">
    <h3 class="title">Sesión {{$session->order}}: <strong>{{$session->name}}</strong></h3>
  </div>
  <!--lista evaluaciones-->
  <div class="session_list">
    @if($session->all_forum->count() > 0)
      @foreach($session->all_forum as $forum)
      <div class="row">
        <!--divider-->
        <div class="col-sm-11 col-sm-offset-1">
          <div class="divider b"></div>
        </div>
        <!--- título-->
        <div class="col-sm-4 col-sm-offset-1">
                <p><a href='{{url("tablero/$program->slug/foros/$forum->slug")}}'class="link lists_ev">{{$forum->topic}}</a></p>
              </div>
              <!--fecha-->
              <div class="col-sm-2 col-sm-offset-2">
                <p class="notetime uppercase black"><strong><span>{{!empty($forum->created_at) ? \Carbon\Carbon::createFromTimeStamp(strtotime($forum->created_at))->diffForHumans() : 'Sin fecha'}}</span></strong><br>
                  {{ !empty($forum->created_at) ? date("j/m/Y", strtotime($forum->created_at)) : 'Sin fecha'}}</p>
              </div>
        <!--- status-->
        <div class="col-sm-3">
          @if($session->check_participation($user->id,$forum->id))
            <p><span class="with">Participaste</span></p>
          @else
            <p><span class="without">Sin participar</span></p>
          @endif
        </div>

      </div><!--row ends-->
      @endforeach
    @else
      <div class="row">
        <!--divider-->
        <div class="col-sm-11 col-sm-offset-1">
          <div class="divider"></div>
        </div>
        <!--- título-->
        <div class="col-sm-3 col-sm-offset-5">
                <p>Sin foros</p>
              </div>
      </div>
    @endif
        </div><!--lista ends-->
  @endforeach
