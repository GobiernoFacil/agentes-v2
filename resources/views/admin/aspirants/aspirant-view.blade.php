<ul>
<li><span>Nombre:</span> {{$aspirant->name." ".$aspirant->surname." ".$aspirant->lastname}}</li>
<li><span>Email:</span> {{$aspirant->email}}</li>
<li><span>Ciudad:</span> {{$aspirant->city}}</li>
<li><span>Estado:</span> {{$aspirant->state}}</li>
@if($aspirant->AspirantsFile)
@if($aspirant->AspirantsFile->video)
<li><span>Video:</span> {{$aspirant->AspirantsFile->video}}</li>
@endif
@if($aspirant->AspirantsFile->cv)
<li class="download"><a href='{{url("dashboard/archivo/download/{$aspirant->AspirantsFile->cv}/CV")}}'  class="btn view xs"> Descargar Perfil Curricular</a></li>
@endif
@if($aspirant->AspirantsFile->essay)
<li class="download"><a href='{{url("dashboard/archivo/download/{$aspirant->AspirantsFile->essay}/ensayo")}}'  class="btn view xs"> Descargar Ensayo</a></li>
@endif
@if($aspirant->AspirantsFile->letter)
<li class="download"><a href='{{url("dashboard/archivo/download/{$aspirant->AspirantsFile->letter}/carta")}}'  class="btn view xs"> Descargar Carta de Membretada</a></li>
@endif
@if($aspirant->AspirantsFile->proof)
<li class="download"><a href='{{url("dashboard/archivo/download/{$aspirant->AspirantsFile->proof}/comprobante")}}'  class="btn view xs"> Descargar Comprobante de Domicilio</a></li>
@endif
@if($aspirant->AspirantsFile->privacy)
<li class="download"><a href='{{url("dashboard/archivo/download/{$aspirant->AspirantsFile->privacy}/privacidad")}}'  class="btn view xs"> Descargar Consentimiento Relativo Al Tratamiento de sus Datos Personales</a></li>
@endif
@endif
@if($aspirant->aspirantEvaluation)
<li><span>Experiencia previa:</span> {{($aspirant->aspirantEvaluation->experienceGrade*10).'%'}}</li>
<li><span>Valoración ensayo:</span> {{($aspirant->aspirantEvaluation->essayGrade*10).'%'}}</li>
<li><span>Valoración video:</span> {{($aspirant->aspirantEvaluation->videoGrade*10).'%'}}</li>
<li><span>Evaluación:</span> {{($aspirant->aspirantEvaluation->grade*10).'%'}}</li>
@else
<li><a href="{{ url('dashboard/aspirantes/evaluar/' . $aspirant->id) }}" class="btn xs view">Evaluar</a></li>
@endif
</ul>
