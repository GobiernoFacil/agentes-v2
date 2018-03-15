<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="programs list")
	<li>Programas</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="program view" || $__env->yieldContent('breadcrumb_type') =="program update" || $__env->yieldContent('breadcrumb_type') =="program add" || $__env->yieldContent('breadcrumb_type') =="module add" || $__env->yieldContent('breadcrumb_type') =="module view" || $__env->yieldContent('breadcrumb_type') =="module edit" || $__env->yieldContent('breadcrumb_type') =="module session view" || $__env->yieldContent('breadcrumb_type') =="module session topic add" || $__env->yieldContent('breadcrumb_type') =="module session topic edit" || $__env->yieldContent('breadcrumb_type') =="module session expert add" || $__env->yieldContent('breadcrumb_type') =="module session add activity" || $__env->yieldContent('breadcrumb_type') == "module session view activity" || $__env->yieldContent('breadcrumb_type') == "module session add monitoring" || $__env->yieldContent('breadcrumb_type') == "module session add requirement" || $__env->yieldContent('breadcrumb_type') == "module session update requirement" || $__env->yieldContent('breadcrumb_type') == "module session add files" || $__env->yieldContent('breadcrumb_type') == "module session update files" || $__env->yieldContent('breadcrumb_type') == "module session assign" || $__env->yieldContent('breadcrumb_type') == "module session update" || $__env->yieldContent('breadcrumb_type') == "module session add" ||$__env->yieldContent('breadcrumb_type') =="module session update activity" )
	<li><a href="{{url('dashboard/programas')}}">Programas</a></li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="program view")
	<li>{{ $program->title }}</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="program add")
	<li>Agregar Programa</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="program update")
	<li><a href="{{ url('dashboard/programas/ver/' . $program->id) }}">{{ $program->title }}</a></li>
	<li>Actualizar Programa</li>
	@endif
	
	
	
	
	@if ($__env->yieldContent('breadcrumb_type') =="module add")
	<li><a href="{{ url('dashboard/programas/ver/' . $program->id) }}">{{ $program->title }}</a></li>
	<li>Agregar módulo</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module session assign")
	<li><a href="{{ url('dashboard/programas/ver/' . $program->id) }}">{{ $program->title }}</a></li>
	<li>Sesiones asignadas</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module view")
	<li><a href="{{ url('dashboard/programas/ver/' . $program->id) }}">{{ $program->title }}</a></li>
	<li>{{ $module->title }}</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="module edit")
	<li><a href="{{ url('dashboard/programas/ver/' . $program->id) }}">{{ $program->title }}</a></li>
	<li><a href="{{url('dashboard/programas/' . $program->id . '/modulos/ver/' . $module->id)}}">{{$module->title}}</a></li>
	<li>Editar módulo</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module session view" || $__env->yieldContent('breadcrumb_type') =="module session topic add" || $__env->yieldContent('breadcrumb_type') == "module session expert add" || $__env->yieldContent('breadcrumb_type') =="module session add activity" || $__env->yieldContent('breadcrumb_type') == "module session view activity" || $__env->yieldContent('breadcrumb_type') == "module session add monitoring" || $__env->yieldContent('breadcrumb_type') == "module session add requirement" || $__env->yieldContent('breadcrumb_type') == "module session update requirement" || $__env->yieldContent('breadcrumb_type') == "module session add files" || $__env->yieldContent('breadcrumb_type') == "module session update files" || $__env->yieldContent('breadcrumb_type') == "module session update" )	
	<li><a href="{{ url('dashboard/programas/ver/' . $session->module->program->id) }}">{{ $session->module->program->title }}</a></li>
	<!-- módulo --->
	<li><a href="{{url('dashboard/programas/' . $session->module->program->id . '/modulos/ver/' . $session->module->id)}}">{{$session->module->title}}</a></li>	
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module session view")
	<!-- sesión --->
	<li>Ver sesión {{$session->order}}</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module session add")
	<!-- agregar sesión --->
	<li>Agregar sesión</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="module session update")
	<!-- actualizar sesión --->
	<li>Actualizar sesión: {{$session->name}}</li>
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
	<li>{{$activity->name}}</li>
	@endif
	<!-- actualizar ctividad --->
	@if ( $__env->yieldContent('breadcrumb_type') =="module session update activity" )	
	<li><a href="{{ url('dashboard/programas/ver/' . $activity->session->module->program->id) }}">{{ $activity->session->module->program->title }}</a></li>
	<!-- módulo --->
	<li><a href="{{url('dashboard/programas/' . $activity->session->module->program->id . '/modulos/ver/' . $activity->session->module->id)}}">{{$activity->session->module->title}}</a></li>
	<li><a href="{{ url('dashboard/sesiones/actividades/ver/' . $activity->id) }}">{{$activity->name}}</a></li>
	<li>Actualizar actividad</li>
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