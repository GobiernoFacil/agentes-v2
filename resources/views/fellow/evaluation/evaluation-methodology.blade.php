@extends('layouts.admin.a_master')
@section('title', 'Calificaciones')
@section('description', 'Calificaciones')
@section('body_class', 'fellow')
@section('breadcrumb_type', 'score methodology')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_score')

@section('content')
<div class="row">
  <div class="col-sm-9">
    <h1>Metodología de las calificaciones</h1>
  </div>

</div>
<div class="box score">
  <div class="row">

    <div class="col-sm-12">
		<table class="table">
			<thead>
				<tr>
					<th>MÓDULO</th>
					<th>EVALUACIÓN</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><h3>SEMINARIO 1	</h3>							  </td>
					<td><ul>
					<li>	Ensayo individual	</li>					  
					<li>Participación			</li>				  
					<li>Trabajo por equipos 1	</li>				  
					</ul>
					</td>
				</tr>
				<tr>
					<td><h3>CURSO 1 VIRTUAL	</h3>						  </td>
					<td>
						<ul>
							<li>Participación en Foros					  </li>
							<li>Exámenes en línea al finalizar cada sesión</li>
							<li>Trabajo por equipos 2					  </li>
						</ul>					  
					</td>
				</tr>
				<tr>
					<td><h3>CURSO 2 VIRTUAL </h3>							  </td>
					<td>
						<ul>
							<li>Participación en Foros					  </li>
							<li>Exámenes en línea al finalizar cada sesión</li>
							<li>Trabajo por equipos 3					  </li>
						</ul>				 
					</td>
				</tr>
				<tr>
					<td><h3>SEMINARIO 2 </h3>							  </td>
					<td>
						<ul>
							<li>Participación			</li>				  
							<li>Trabajo por equipos 4	</li>				
						</ul>  
					</td>
				</tr>
				<tr>
					<td><h3>CURSO 3 VIRTUAL	</h3>						  </td>
					<td>
						<ul>
						<li>Participación en Foros					  </li>
						<li>Exámenes en línea al finalizar cada sesión</li>
						<li>Trabajo por equipos 5					  </li>
						</ul>
					</td>
				</tr>
			</tbody>
		</table>
	   
		<table class="table">
			<thead>
				<tr>
					<th>CONCEPTO	  </th>
					<th>DESCRIPCIÓN	  </th>
					<th>VALOR NUMÉRICO</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><h3>Exámenes</h3></td>
					<td><p>Se refieren a las evaluaciones virtuales que se deben de completar a final de cada sesión virtual. Usualmente son de opción múltiple.</p></td>
					<td><h4>30%</h4></td>
				</tr>
				<tr>
					<td><h3>Trabajos</h3>																												</td>
					<td><p>Se refiere a los trabajos que cada fellow carga dentro de la plataforma. Pueden ser trabajos individuales o por equipo.</p> </td>
					<td><h4>40%	</h4>																													</td>
				</tr>
				<tr>
					<td><h3>Participación</h3></td>
					<td><p>Se refiere a las actividades en donde los fellows muestran su involucramiento con el proceso, ya sea a través de su participación en foros o dentro de los seminarios.</p></td>
					<td><h4>30%</h4></td>
				</tr>
				<tr>
					<td><h3>CALIFICACIÓN APROBATORIA</h3></td>
					<td><p>La calificación aprobatoria para obtener tu diploma del fellowship es del <strong>70%</strong> del total final.</p></td>
				</tr>
			</tbody>
		</table>
		 
    </div>
  </div>
</div>
@endsection
