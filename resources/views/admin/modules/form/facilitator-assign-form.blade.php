
{!! Form::open(['url' => url("dashboard/programas/{$session->module->program->id}/modulos/{$session->module->id}/sesiones-facilitadores/save/$session->id"), "class" => "form-horizontal"]) !!}

@if($facilitators->count()>0)
<ol>
  @foreach($facilitators as $userf)
  <li>
    <label class="control-label">
      <input type="checkbox" name="signed[]" value="{{$userf->id}}"
      {{$session->facilitators->contains("user_id", $userf->id) ? "checked" : ""}}> <strong>{{$userf->name}}</strong> - {{$userf->institution}}
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
