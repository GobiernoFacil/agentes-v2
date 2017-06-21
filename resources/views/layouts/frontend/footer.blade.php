@if ($__env->yieldContent('body_class') == 'home')
<section class="gab">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<h2 class="title">¿QUÉ ES <strong>GOBIERNO ABIERTO</strong>?</h2>
				<p>Gobierno Abierto es un enfoque que propone una forma particular de entender los procesos de gobierno, a partir de principios como los de la transparencia y la participación ciudadana.</p>
					<a href="{{url('gobierno-abierto')}}" class="btn blue">LEER MÁS ></a>
			</div>
		</div>
	</div>
</section>
@endif
@if ($__env->yieldContent('body_class') == 'home' || $__env->yieldContent('body_class') == 'programa alcance')
<div class="map_container">
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