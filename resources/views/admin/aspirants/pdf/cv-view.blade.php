
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
        		<h1>Perfil curricular de <strong>{{$aspirant->name.' '.$aspirant->surname.' '.$aspirant->lastname}}</strong></h1>
            <h2>{{date('d-m-Y')}}</h2>
        		<div class="divider top"></div>
        	</div>
        </div>
        <div class="page_break"></div>
        <div class="box">
        	<div class="row">
        		<div class="col-sm-12">
        			<div class="divider top"></div>
              <ol class="list line">
                <li class="row">
                  <div class="col-sm-9">
                    <h3>Datos Generales</h3>
                    <ul>
                      <li><strong>Correo: </strong>{{$aspirant->email}}</li>
                      <li><strong>Fecha de nacimiento: </strong>{{$aspirant->cv->birthdate}}</li>
                      <li><strong>Teléfono: </strong>{{$aspirant->cv->phone}}</li>
                      <li><strong>Celular: </strong>{{$aspirant->cv->mobile}}</li>
                    </ul>
                  </li>

                <li class="row">
                  <div class="col-sm-9">
                    <h3>Experiencia Laboral</h3>
                        @foreach($aspirant->cv->experiences as $experience)
                        <ul>
                          <li><strong>Empleo: </strong>{{$experience->name}}</li>
                          <li><strong>Empresa: </strong>{{$experience->company}}</li>
                          <li><strong>Sector: </strong>{{$experience->sector}}</li>
                          <li><strong>Fecha de ingreso: </strong>{{$experience->from}}</li>
                          <li><strong>Fecha de término: </strong>{{$experience->to}}</li>
                          <li><strong>Ciudad: </strong>{{$experience->city}}</li>
                          <li><strong>Estado: </strong>{{$experience->state}}</li>
                          <li><strong>Descripción: </strong><p>{{$experience->description}}</p></li>
                        </ul>
                        @endforeach

                  </div>
                </li>

        				<div class="divider"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>Experiencia en Gobierno Abierto</h3>
                        @foreach($aspirant->cv->open_experiences as $experience)
                        <ul>
                          <li><strong>Empresa / Organización civil / Gobierno: </strong>{{$experience->company}}</li>
                          <li><strong>Sector: </strong>{{$experience->sector}}</li>
                          <li><strong>Fecha de ingreso: </strong>{{$experience->from}}</li>
                          <li><strong>Fecha de término: </strong>{{$experience->to}}</li>
                          <li><strong>Ciudad: </strong>{{$experience->city}}</li>
                          <li><strong>Estado: </strong>{{$experience->state}}</li>
                          <li><strong>Descripción: </strong><p>{{$experience->description}}</p></li>
                        </ul>
                        @endforeach

                  </div>
                </li>

                <div class="divider"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>Experiencia académica</h3>
                        @foreach($aspirant->cv->academic_trainings as $study)
                        <ul>
                          <li><strong>Carrera / curso / grado: </strong>{{$study->name}}</li>
                          <li><strong>Universidad / Instituto /Escuela: </strong>{{$study->institution}}</li>
                          <li><strong>Fecha de ingreso: </strong>{{$study->from}}</li>
                          <li><strong>Fecha de término: </strong>{{$study->to}}</li>
                          <li><strong>Ciudad: </strong>{{$study->city}}</li>
                          <li><strong>Estado: </strong>{{$study->state}}</li>
                        </ul>
                        @endforeach

                  </div>
                </li>

                <div class="divider"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>Software</h3>
                        @foreach($aspirant->cv->languages as $language)
                        <ul>
                          <li><strong>Idioma: </strong>{{$language->name}}</li>
                          <li><strong>Nivel: </strong>{{$language->level}}</li>
                        </ul>
                        @endforeach

                  </div>
                </li>

                <div class="divider"></div>
                <li class="row">
                  <div class="col-sm-9">
                    <h3>Idiomas</h3>
                        @foreach($aspirant->cv->softwares as $software)
                        <ul>
                          <li><strong>Idioma: </strong>{{$software->name}}</li>
                          <li><strong>Nivel: </strong>{{$software->level}}</li>
                        </ul>
                        @endforeach

                  </div>
                </li>
                </ol>
        				<div class="divider"></div>
        		</div>
          </div>
        	</div>
        </div>
      </div>
  </section>
  </body>
</html>
