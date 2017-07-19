<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="module list")
	<li>Módulos</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module add" || $__env->yieldContent('breadcrumb_type') =="module view" || $__env->yieldContent('breadcrumb_type') =="module session view" || $__env->yieldContent('breadcrumb_type') =="module session topic add" || $__env->yieldContent('breadcrumb_type') =="module session topic edit" || $__env->yieldContent('breadcrumb_type') =="module session expert add" || $__env->yieldContent('breadcrumb_type') =="module session add activity" || $__env->yieldContent('breadcrumb_type') == "module session view activity" || $__env->yieldContent('breadcrumb_type') == "module session add monitoring" || $__env->yieldContent('breadcrumb_type') == "module session add requirement" || $__env->yieldContent('breadcrumb_type') == "module session update requirement" || $__env->yieldContent('breadcrumb_type') == "module session add files" || $__env->yieldContent('breadcrumb_type') == "module session update files" || $__env->yieldContent('breadcrumb_type') == "module session assign")
	<li><a href="{{url('dashboard/modulos')}}">Módulos</a></li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module add")
	<li>Agregar módulo</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module session assign")
	<li>Sesiones asignadas</li>
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
	
	@if ($__env->yieldContent('breadcrumb_type') =="module session view" || $__env->yieldContent('breadcrumb_type') =="module session topic add" || $__env->yieldContent('breadcrumb_type') == "module session expert add" || $__env->yieldContent('breadcrumb_type') =="module session add activity" || $__env->yieldContent('breadcrumb_type') == "module session view activity" || $__env->yieldContent('breadcrumb_type') == "module session add monitoring" || $__env->yieldContent('breadcrumb_type') == "module session add requirement" || $__env->yieldContent('breadcrumb_type') == "module session update requirement" || $__env->yieldContent('breadcrumb_type') == "module session add files" || $__env->yieldContent('breadcrumb_type') == "module session update files")	
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
	@if ($__env->yieldContent('breadcrumb_type') =="module session topic add" || $__env->yieldContent('breadcrumb_type') == "module session topic edit" || $__env->yieldContent('breadcrumb_type') == "module session expert add" || $__env->yieldContent('breadcrumb_type') =="module session add activity" || $__env->yieldContent('breadcrumb_type') == "module session view activity" || $__env->yieldContent('breadcrumb_type') == "module session add monitoring" || $__env->yieldContent('breadcrumb_type') == "module session add requirement" || $__env->yieldContent('breadcrumb_type') == "module session update requirement" || $__env->yieldContent('breadcrumb_type') == "module session add files" || $__env->yieldContent('breadcrumb_type') == "module session update files")
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
	<!-- ver ctividad --->
	@if ( $__env->yieldContent('breadcrumb_type') =="module session view activity" )	
	<li>Ver actividad</li>
	@endif
	@if ( $__env->yieldContent('breadcrumb_type') =="module session add activity" )	
	<!-- agregar actividades --->
	<li>Agregar actividad</li>
	@endif
	<?php /*////////////// monitoreo */?>
	<!-- ver ctividad --->
	@if ( $__env->yieldContent('breadcrumb_type') == "module session add monitoring")	
	<li>Agregar mecanismo de monitoreo</li>
	@endif
	
	<?php /*////////////// requerimiento */?>
	@if ( $__env->yieldContent('breadcrumb_type') == "module session add requirement" || $__env->yieldContent('breadcrumb_type') == "module session update requirement" || $__env->yieldContent('breadcrumb_type') == "module session add files" || $__env->yieldContent('breadcrumb_type') == "module session update files")	
	<!-- ver actividad --->
	<li><a href="{{ url('dashboard/sesiones/actividades/ver/' . $activity->id ) }}">{{$activity->name}}</a></li>
	@endif
	
	@if ( $__env->yieldContent('breadcrumb_type') == "module session add requirement" )	
	<!-- agregar requerimiento o recurso-->
	<li>Agregar requerimiento</li>
	@endif
	@if ( $__env->yieldContent('breadcrumb_type') == "module session update requirement")	
	<!--actualizar requerimiento o recurso-->
	<li>Actualizar requerimiento</li>
	@endif
	
	@if ( $__env->yieldContent('breadcrumb_type') == "module session add files" )	
	<!-- agregar archivo-->
	<li>Agregar archivo</li>
	@endif
	
	
	@if ( $__env->yieldContent('breadcrumb_type') == "module session update files" )	
	<!-- actualizar archivo-->
	<li>Actualizar archivo</li>
	@endif
	
</ul>