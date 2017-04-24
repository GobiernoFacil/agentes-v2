<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="module list")
	<li>Módulos</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module add" || $__env->yieldContent('breadcrumb_type') =="module view" || $__env->yieldContent('breadcrumb_type') =="module session view" || $__env->yieldContent('breadcrumb_type') =="module session topic add" || $__env->yieldContent('breadcrumb_type') =="module session topic edit" || $__env->yieldContent('breadcrumb_type') =="module session expert add" || $__env->yieldContent('breadcrumb_type') =="module session add activity" || $__env->yieldContent('breadcrumb_type') == "module session view activity")
	<li><a href="{{url('dashboard/modulos')}}">Módulos</a></li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module add")
	<li>Agregar módulo</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module view")
	<li>{{ $module->title }}</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="module edit")
	<li><a href="{{url('dashboard/modulo')}}">Ver módulo</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="module edit")
	<li>Editar módulo</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module session view" || $__env->yieldContent('breadcrumb_type') =="module session topic add" || $__env->yieldContent('breadcrumb_type') == "module session expert add" || $__env->yieldContent('breadcrumb_type') =="module session add activity" || $__env->yieldContent('breadcrumb_type') == "module session view activity")	
	<!-- módulo --->
	<li><a href="{{ url('dashboard/modulos/ver/'.$session->module->id)}}">{{$session->module->title}}</a></li>	
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module session view")
	<!-- sesión --->
	<li>Ver sesión {{$session->order}}</li>
	@endif
	
	<?php /*  
	////////////// Objetivos particulares	 
	*/?>
	@if ($__env->yieldContent('breadcrumb_type') =="module session topic add" || $__env->yieldContent('breadcrumb_type') == "module session topic edit" || $__env->yieldContent('breadcrumb_type') == "module session expert add" || $__env->yieldContent('breadcrumb_type') =="module session add activity" || $__env->yieldContent('breadcrumb_type') == "module session view activity" )
	<!-- objetivos particulares --->
	<li><a href="{{ url('dashboard/sesiones/ver/'. $session->id) }}">Sesión {{$session->order}}</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="module session topic add")
	<li>Agregar objetivos particulares</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') == "module session topic edit")
	<!-- objetivos particulares --->
	<li>Actualizar objetivos particulares</li>
	@endif
	
	<?php /*////////////// facilitadores*/?>
	@if ( $__env->yieldContent('breadcrumb_type') == "module session expert add" )	
	<!-- facilitador --->
	<li>Asignar facilitadores</li>
	@endif
	<?php /*////////////// actividades */?>
	<!-- actividades --->
	@if ( $__env->yieldContent('breadcrumb_type') =="module session view activity" )	
	<li>Ver actividad</li>
	@endif
	@if ( $__env->yieldContent('breadcrumb_type') =="module session add activity" )	
	<!-- agregar actividades --->
	<li>Agregar actividad</li>
	@endif
</ul>