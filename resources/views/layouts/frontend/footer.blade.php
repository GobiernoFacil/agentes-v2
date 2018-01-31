@if ($__env->yieldContent('body_class') == 'home')
<section class="gab">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-xs-10 col-sm-offset-1 col-xs-offset-1">
				<h2 class="title">¿QUÉ ES ELPROGRAMA DE FORMACIÓN DE <strong>AGENTES LOCALES DE CAMBIO</strong> EN <strong>GOBIERNO ABIERTO</strong> Y <strong>DESARROLLO SOSTENIBLE</strong>?</h2>
				<p>El Programa contribuye al fortalecimiento de una buena gobernanza en México a partir de prácticas de <a href="{{url('gobierno-abierto')}}">Gobierno Abierto</a>, <strong>participación ciudadana</strong>, <strong>transparencia</strong> y <strong>anticorrupción</strong> , con esquemas innovadores de desarrollo de capacidades y de vinculación social que permitan el empoderamiento de agentes de cambio, así como el impulso de espacios de diálogo y cocreaciónn a nivel subnacional.</p>

				<p>Es una iniciativa del <strong>Programa de las Naciones Unidas para el Desarrollo</strong> (PNUD), posible gracias al apoyo de la <strong>Agencia de los Estados Unidos para el Desarrollo Internacional</strong> (USAID por sus siglas en inglés), desarrollada y acompañada por el trabajo conjunto de actores tanto del gobierno como de la sociedad civil: el <strong>Instituto Nacional de Transparencia, Acceso a la información y Protección de Datos Personales</strong> (INAI), <strong>Gestión Social y Cooperación</strong> (GESOC), <strong>Gobierno Fácil</strong> y <strong>ProSociedad</strong>.</p>
					<a href="{{url('programa-gobierno-abierto')}}" class="btn blue center">LEER MÁS ></a>
			</div>
		</div>
	</div>
</section>

@endif
@if ($__env->yieldContent('body_class') == 'home' || $__env->yieldContent('body_class') == 'programa alcance')
<div class="map_container">
	<section>
	<div class="container">
			<div class="col-sm-8 col-sm-offset-2">
				<h2 class="title"><strong>ALCANCE</strong> DEL PROGRAMA DE GOBIERNO ABIERTO DESDE LO LOCAL PARA EL DESARROLLO SOSTENIBLE</h2>
				<p class="center"><b class="y_17"></b> 2017 <b class="y_18"></b> 2018</p>
			</div>
	</div>
	</section>
  <!-- el mapa! -->
  <div id="map"></div>
</div>
@endif
<div class="allies">
	<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2><a href="{{url('programa-gobierno-abierto/aliados')}}">Aliados</a></h2>
			<div class="row">
				<a href="https://www.usaid.gov/mexico" class="usaid">USAID</a>				
				<a href="http://www.mx.undp.org/" class="pnud">PNUD</a>				
				<a href="http://inicio.ifai.org.mx/SitePages/ifai.aspx" class="inai">INAI</a>				
				<a href="http://www.gesoc.org.mx/site/" class="gesoc">GESOC</a>				
				<a href="https://gobiernofacil.com/" class="gf">Gobierno Fácil</a>
				<a href="http://www.prosociedad.org/" class="prosociedad">Prosociedad</a>
			</div>
		</div>
	</div>
	</div>
</div>
<footer>
	<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<p>® 2017-2020 Gobierno Abierto desde lo local para el Desarrollo Sostenible.<br>
					<a href="{{url('aviso-privacidad')}}">Aviso de Privacidad</a></p>
				</div>
				<div class="col-sm-6 right">
					<p>Forjado Artesanalmente por:<br>
					<a href="https://www.gobiernofacil.com" class="gobiernofacil">Gobierno Fácil</a></p>
				</div>
			</div>
	</div>
</footer>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45473222-13', 'auto');
  ga('send', 'pageview');

</script>
<script src="{{url('js/app.js')}}"></script> 
<script src="{{url('js/main.js')}}"></script> 
@if ($__env->yieldContent('body_class') == 'home' || $__env->yieldContent('body_class') == 'programa alcance')
<script src="{{url('js/bower_components/d3/d3.js')}}"></script>
<script src="{{url('js/bower_components/leaflet/dist/leaflet.js')}}"></script>
<script src="{{url('js/libs/classybrew/build/classybrew.min.js')}}"></script>
<script src="{{url('js/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{url('js/main_mapa.js')}}"></script>
@endif