@extends('layouts.admin.a_master')
@section('title', 'Crear nuevo foro')
@section('description', 'Crear nuevo foro')
@section('body_class', 'foros')
@section('breadcrumb_type', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Crear nuevo foro</h1>
    <h2>Programa "{{$program->title}}"</h2>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.forums.forms.forums-add-form')
    </div>
  </div>
</div>
@endsection

@section('js-content')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>

$('#types').change(function(){
  var type = $(this).val();
  if(type === 'state'){
    $('#state_div').show();
    $('#session_div').hide();
    $('#activity_div').hide();
  }else if(type === 'activity'){
    $('#state_div').hide();
    $('#session_div').show();
    $('#activity_div').hide();
  }else{
    $('#state_div').hide();
    $('#session_div').hide();
    $('#activity_div').hide();
  }

});

var session  = document.getElementById('session'),
activity = document.getElementById('activity');

session.onchange = function(e){

    $('#activity_div').show();
  if(!this.value){
    activity.innerHTML = "";
    return;
  }

  var request = new XMLHttpRequest();
  request.open('GET', '/dashboard/foros/session?session=' + this.value, true);

  request.onload = function(){
    if (request.status >= 200 && request.status < 400) {
      var data = JSON.parse(request.responseText);
      activity.innerHTML = "";
      var opt = document.createElement('option');
      opt.value = null;
      opt.innerHTML = "Selecciona una opción";
      activity.appendChild(opt);
      data.forEach(function(activityD){
        var opt = document.createElement('option');
       opt.value = activityD.id;
       opt.innerHTML = activityD.name;
        activity.appendChild(opt);
      });
    }
    else{
      // nope
    }
  };

  request.onerror = function(){
    // nope
  };
  request.send();
}

 </script>
@endsection
