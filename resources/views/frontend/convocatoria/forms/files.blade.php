{!! Form::open(['url' => 'convocatoria/aplicar/registro', "class" => "form-horizontal",'files'=>true]) !!}


<p>
  <label>Agregar CV</label>
  {{Form::file('cv', null, ["class" => "form-control"])}}
  @if($errors->has('cv'))
    <strong>{{$errors->first('cv')}}</strong>
  @endif
</p>

<p>
  <label>Agregar Ensayo</label>
  {{Form::file('essay', null, ["class" => "form-control"])}}
  @if($errors->has('essay'))
    <strong>{{$errors->first('essay')}}</strong>
  @endif
</p>

<p>
  <label>Enlace a video</label>
  {{Form::text('video', null, ["class" => "form-control"])}}
  @if($errors->has('video'))
    <strong>{{$errors->first('video')}}</strong>
  @endif
</p>
<p>{{Form::submit('Guardar', ['class' => 'btn'])}}</p>

{!! Form::close() !!}
