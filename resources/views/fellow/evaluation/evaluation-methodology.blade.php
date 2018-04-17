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
	    <p>A continuación se exponen los productos de evaluación categorizados por cada uno de los  módulos con la finalidad de que los participantes puedan visualizar el tipo de actividades y la carga de trabajo aproximada. A manera general la evaluación consta de exámenes en línea, trabajos individuales, participación en los foros y trabajos por equipo.</p>
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
		<div class="divider"></div>
		<p>Para obtener la calificación final se deberá de obtener al menos el 70 puntos de 100 posibles, los cuales corresponden a los exámenes (30%), los trabajos (40%), y la participación presencial y virtual en los foros. </p>
	   
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
					<td><p>Se refiere a los trabajos que cada fellow carga dentro de la plataforma. Pueden ser trabajos individuales o por equipo<a href="#note1"><sup>1</sup></a>.</p> </td>
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
		<div class="divider"></div>
    </div>
    <a id="note1"></a>
    <div class="col-sm-10 col-sm-offset-1">
	    <div class="notes">
		 <p><sup>1</sup> 
			 Cuando exista un retraso en la entrega de trabajos, desde el primer día se calificará sobre 8. Si el retraso es mayor a una semana (más de 7 días), se reconsiderará el caso.
		 </p>
		</div>
    </div>
  </div>
</div>
@endsection
