
<?php $control =0;?>
@foreach($noMessages as $message)
  @if($message->user_id != $user->id)
  <?php $control =1;?>
  	<div class="row">
  		<div class="col-sm-9">
  			<h4 class="type_n notice">Mensaje</h4>
  		</div>
  	</div>
    <h3><a href="{{url('tablero/mensajes/ver/' . $message->conversation_id)}}">{{$message->message->message}}</a></h3>
  	@if($message->message->user->type == "fellow")
    <p class="author">Por {{$message->message->user->name.' '.$message->message->user->fellowData->surname.' '.$message->message->user->fellowData->lastname}} <span>{{$message->message->created_at->diffForHumans()}}</span></p>
  	@else
    <p class="author">Por {{$message->message->user->name}} <span>{{$message->message->created_at->diffForHumans()}}</span></p>
    @endif
  @endif
@endforeach

@if(!$control)
<p>Sin mensajes</p>
@endif
