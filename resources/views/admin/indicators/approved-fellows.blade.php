@extends('layouts.admin.a_master')
@section('title', 'Percepción positiva en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Percepción positiva en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')

@section('content')

  <div class="row">
  	<div class="col-sm-9">
  		<h1>Agentes de cambio aprobados</h1>
      <p>Porcentaje de agentes de cambio que aprobaron el programa "{{$program->title}}"</p>
  	</div>
  </div>
  <div class="box">
  	<div class="row">
  		<div class="col-sm-12">
        <?php $today =  date('Y-m-d');?>
        @if($program->end <= $today)
  			<table class="table">
  			  <thead>
  			    <tr>
  			      <th>Género</th>
              <th>Total</th>
  			      <th>Aprobados</th>
  			      <th>Porcentaje</th>
  			    </tr>
  			  </thead>
  			  <tbody>
  			      <tr>
  			        <td><h4>Femenino</h4></td>
                <td>{{$female->count()}}</td>
  			        <td>{{$total_female}}</td>
  			        <td>{{$score_female}}%</td>
  			    </tr>
            <tr>
              <td><h4>Masculino</h4></td>
              <td>{{$male->count()}}</td>
              <td>{{$total_male}}</td>
              <td>{{$score_male}}%</td>
          </tr>

          <tr>
            <td><h4>Total</h4></td>
            <td>{{$female->count() + $male->count() }}</td>
            <td>{{$total_male + $total_female}}</td>
            <td>{{round((($total_male + $total_female)*100)/($male->count()+$female->count()))}}%</td>
        </tr>


  			  </tbody>
  			</table>
        @else
        <p><strong>El programa aún no termina.</strong></p>
        @endif
  		</div>
  	</div>
  </div>
@endsection
