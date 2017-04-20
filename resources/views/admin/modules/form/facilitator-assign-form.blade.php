
{!! Form::open(['url' => url('dashboard/sesiones/facilitadores/save').'/'.$session->id, "class" => "form-horizontal"]) !!}

@if($facilitators->count()>0)
<ol>
  @foreach($facilitators as $user)
  <li>
    <label class="control-label">
      <input type="checkbox" name="signed[]" value="{{$user->id}}"
      {{$session->facilitators->contains("user_id", $user->id) ? "checked" : ""}}>{{$user->name}}
    </label>
  </li>
  @endforeach
</ol>
<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Guardar', ['class' => 'btn gde'])}}</p>
  </div>
</div>
@else
<p>No existen facilitadores.</p>
@endif
{!! Form::close() !!}
