
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
    .page_break { page-break-before: always; }
    </style>
  </head>
  <body class ="">
    <section>
      <!--content-->
  		<div class="container">
        <div class="box">
        <div class="row">
        	<div class="col-sm-12">
        		<h1>Exposición de motivos de <strong>{{$aspirant->name.' '.$aspirant->surname.' '.$aspirant->lastname}}</strong></h1>
            <h2>{{date('d-m-Y')}}</h2>
        		<div class="divider top"></div>
        	</div>
        </div>
        <div class="page_break"></div>
        <div class="box">
        	<div class="row">
        		<div class="col-sm-12">
        			<div class="divider top"></div>
                <p>{{$aspirant->AspirantsFile->motives}}</p>
        				<div class="divider"></div>
        		</div>
          </div>
        	</div>
        </div>
      </div>
  </section>
  </body>
</html>
