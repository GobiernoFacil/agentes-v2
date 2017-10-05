@extends('layouts.admin.a_master')
@section('title', 'Percepción positiva en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Percepción positiva en Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')

@section('content')
<?php
$total_female  = 0;
$total_male  = 0;
$index = [
                     'sur_1',
                     'sur_2',
                     'sur_3_1',
                     'sur_3_2',
                     'sur_3_3',
                     'sur_3_4',
                     'sur_3_5',
                     'sur_4',
                     'sur_5_1',
                     'sur_5_2',
                     'sur_5_3',
                     'sur_5_4',
                     'sur_9',
                     'sur_10',
                     'sur_11',
                   ];
  foreach($male as $m){
    if($m->user->fellow_survey){
      $count = 0;
      foreach ($index as $i) {
          $count = $count + $m->user->fellow_survey->{$i};
      }
      if(($count/15)>=8){
        $total_male = $total_male+1;
      }

    }
  }

  foreach($female as $f){
    if($f->user->fellow_survey){
      $count = 0;
      foreach ($index as $i) {
          $count = $count + $m->user->fellow_survey->{$i};
      }
      if(($count/15)>=8){
        $total_female = $total_female+1;
      }

    }
  }

  ?>


  <div class="row">
  	<div class="col-sm-9">
  		<h1>Percepción de fellows</h1>
      <p>Porcentaje de agentes de cambio que tienen una percepción positiva de la plataforma web</p>
  	</div>
  </div>
  <div class="box">
  	<div class="row">
  		<div class="col-sm-12">
  			<table class="table">
  			  <thead>
  			    <tr>
  			      <th>Género</th>
              <th>Total</th>
  			      <th>Percepción Positiva</th>
  			      <th>Porcentaje</th>
  			    </tr>
  			  </thead>
  			  <tbody>
  			      <tr>
  			        <td><h4>Femenino</h4></td>
                <td>{{$female->count()}}</td>
  			        <td>{{$total_female}}</td>
  			        <td>{{($total_female*100)/$female->count()}}%</td>
  			    </tr>
            <tr>
              <td><h4>Masculino</h4></td>
                <td>{{$male->count()}}</td>
              <td>{{$total_male}}</td>
              <td>{{round(($total_male*100)/$male->count())}}%</td>
          </tr>

          <tr>
            <td><h4>Total</h4></td>
            <td>{{$female->count() + $male->count() }}</td>
            <td>{{$total_male + $total_female}}</td>
            <td>{{round((($total_male + $total_female)*100)/($male->count()+$female->count()))}}%</td>
        </tr>


  			  </tbody>
  			</table>
  		</div>
  	</div>
  </div>
  <?php
  $total_female_content  = 0;
  $total_male_content  = 0;
  $index = [
            'sur_13_1',
            'sur_13_2',
            'sur_13_3',
            'sur_13_4',
            'sur_14_1',
            'sur_14_2',
            'sur_14_3',
            'sur_14_4',
            'sur_15_1',
            'sur_15_2',
            'sur_15_3',
            'sur_15_4',
            'sur_16_1',
            'sur_16_2',
            'sur_16_3',
            'sur_16_4'
                     ];
    foreach($male as $m){
      if($m->user->fellow_survey){
        $count = 0;
        foreach ($index as $i) {
            $count = $count + $m->user->fellow_survey->{$i};
        }
        if(($count/16)>=8){
          $total_male_content = $total_male_content+1;
        }

      }
    }

    foreach($female as $f){
      if($f->user->fellow_survey){
        $count = 0;
        foreach ($index as $i) {
            $count = $count + $m->user->fellow_survey->{$i};
        }
        if(($count/16)>=8){
          $total_female_content = $total_female_content+1;
        }

      }
    }

    ?>

<p>Porcentaje de agentes de cambio que tienen una percepción positiva del contenido en la plataforma web</p>
  <div class="box">
  	<div class="row">
  		<div class="col-sm-12">
  			<table class="table">
  			  <thead>
  			    <tr>
  			      <th>Género</th>
              <th>Total</th>
  			      <th>Percepción Positiva</th>
  			      <th>Porcentaje</th>
  			    </tr>
  			  </thead>
  			  <tbody>
  			      <tr>
  			        <td><h4>Femenino</h4></td>
                <td>{{$female->count()}}</td>
  			        <td>{{$total_female_content}}</td>
  			        <td>{{($total_female_content*100)/$female->count()}}%</td>
  			    </tr>
            <tr>
              <td><h4>Masculino</h4></td>
                <td>{{$male->count()}}</td>
              <td>{{$total_male_content}}</td>
              <td>{{round(($total_male_content*100)/$male->count())}}%</td>
          </tr>

          <tr>
            <td><h4>Total</h4></td>
            <td>{{$female->count() + $male->count() }}</td>
            <td>{{$total_male_content + $total_female_content}}</td>
            <td>{{round((($total_male_content + $total_female_content)*100)/($male->count()+$female->count()))}}%</td>
        </tr>


  			  </tbody>
  			</table>
  		</div>
  	</div>
  </div>
@endsection
