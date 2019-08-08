<ul>
	<li>Estás en:</li>
	<li><a href="{{url('')}}">Inicio</a></li>
	@if ($__env->yieldContent('body_class') =="programa")
	<li>Programa de Gobierno Abierto</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa aliados" || $__env->yieldContent('body_class') =="programa antecedentes" || $__env->yieldContent('body_class') =="programa alcance" || $__env->yieldContent('body_class') =="programa alcance chihuahua" || $__env->yieldContent('body_class') =="programa alcance sonora" || $__env->yieldContent('body_class') =="programa alcance tabasco"
	|| $__env->yieldContent('body_class') =="programa alcance leon" || $__env->yieldContent('body_class') =="programa alcance oaxaca" || $__env->yieldContent('body_class') =="programa alcance morelos"
	|| $__env->yieldContent('body_class') =="programa 2017" || $__env->yieldContent('body_class') =="testimonios 2017"  || $__env->yieldContent('body_class') =="programa 2018" || $__env->yieldContent('body_class') =="programa alcance campeche" || $__env->yieldContent('body_class') =="programa alcance durango" || $__env->yieldContent('body_class') =="programa alcance edo_mex" || $__env->yieldContent('body_class') =="programa alcance guanajuato" || $__env->yieldContent('body_class') =="programa alcance quintana_roo" || $__env->yieldContent('body_class') =="programa alcance potosi" || $__env->yieldContent('body_class') =="programa alcance sinaloa" || $__env->yieldContent('body_class') =="programa alcance tlaxcala" || $__env->yieldContent('body_class') =="programa alcance veracruz" || $__env->yieldContent('body_class') =="programa 2018 perfil fellow" || $__env->yieldContent('body_class') =="programa 2018 generacion" || $__env->yieldContent('body_class') =="program_content" )
	<li><a href="{{url('programa-gobierno-abierto')}}">Programa de Gobierno Abierto</a></li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa aliados")
	<li>Aliados</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa antecedentes")
	<li>Antecedentes</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance")
	<li>Alcance</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance chihuahua" || $__env->yieldContent('body_class') =="programa alcance sonora" || $__env->yieldContent('body_class') =="programa alcance tabasco"
	|| $__env->yieldContent('body_class') =="programa alcance leon" || $__env->yieldContent('body_class') =="programa alcance oaxaca" || $__env->yieldContent('body_class') =="programa alcance morelos" || $__env->yieldContent('body_class') =="programa alcance campeche" || $__env->yieldContent('body_class') =="programa alcance durango" || $__env->yieldContent('body_class') =="programa alcance edo_mex" || $__env->yieldContent('body_class') =="programa alcance guanajuato" || $__env->yieldContent('body_class') =="programa alcance quintana_roo" || $__env->yieldContent('body_class') =="programa alcance potosi" || $__env->yieldContent('body_class') =="programa alcance sinaloa" || $__env->yieldContent('body_class') =="programa alcance tlaxcala" || $__env->yieldContent('body_class') =="programa alcance veracruz" )
	<li><a href="{{url('programa-gobierno-abierto/alcance')}}">Alcance</a></li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance chihuahua")
	<li>Chihuahua</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance sonora")
	<li>Sonora</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance leon")
	<li>Nuevo León</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance oaxaca")
	<li>Oaxaca</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance morelos")
	<li>Morelos</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance tabasco")
	<li>Tabasco</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance campeche")
	<li>Campeche</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance durango")
	<li>Durango</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance edo_mex")
	<li>Estado de México</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance guanajuato")
	<li>Guanajuato</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance quintana_roo")
	<li>Quintana Roo</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance potosi")
	<li>San Luis Potosí</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance sinaloa")
	<li>Sinaloa</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance tlaxcala")
	<li>Tlaxcala</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa alcance veracruz")
	<li>Veracruz</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa 2017")
	<li>2017</li>
	@endif
	@if ($__env->yieldContent('body_class') =="testimonios 2017")
	<li><a href="{{url('programa-gobierno-abierto/2017')}}">2017</a>
	<li>Testimonios</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa 2018")
	<li>2018</li>
	@endif
	
	@if ($__env->yieldContent('body_class') =="programa 2018 generacion"  )
	<li><a href="{{url('programa-gobierno-abierto/programa-2018')}}">2018</a></li>
	<li>Conoce a los fellows</li>
	@endif
	
	@if ($__env->yieldContent('body_class') =="program_content" )
	<li><a href="{{url('programa-gobierno-abierto/programa-2018')}}">2018</a></li>
	<li>Contenido del programa</li>
	@endif
	@if ($__env->yieldContent('body_class') =="programa 2018 perfil fellow")
	<li><a href="{{url('programa-gobierno-abierto/programa-2018')}}">2018</a></li>
	<li><a href="{{url('programa-gobierno-abierto/programa-2018/ver-generacion')}}">Conoce a los fellows</a></li>
	<li>{{$fellow->name." ".$fellow->fellowData->surname." ".$fellow->fellowData->lastname}}</li>
	@endif
</ul>