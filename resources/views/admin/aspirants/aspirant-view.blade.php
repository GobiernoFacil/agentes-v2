<ul>
<li><span>Nombre:</span> {{$aspirant->name." ".$aspirant->surname." ".$aspirant->lastname}}</li>
<li><span>Email:</span> {{$aspirant->email}}</li>
<li><span>Ciudad:</span> {{$aspirant->city}}</li>
<li><span>Estado:</span> {{$aspirant->state}}</li>
<li><span>Video:</span> {{$aspirant->AspirantsFile->video}}</li>
<li class="download"><a href='{{url("dashboard/archivo/download/{$aspirant->AspirantsFile->cv}/CV")}}'  class="btn view xs"> Descargar CV</a></li>
<li class="download"><a href='{{url("dashboard/archivo/download/{$aspirant->AspirantsFile->essay}/ensayo")}}'  class="btn view xs"> Descargar Ensayo</a></li>
</ul>
