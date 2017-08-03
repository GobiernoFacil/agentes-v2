@extends('layouts.admin.a_master')
@section('title', '' )
@section('description', '')
@section('body_class', 'fellow')

@section('content')
<div class="box">
  <div class ="row">
    <div class= "col-sm-12">
      @include('fellow.surveys.forms.satisfaction-form-1')
    </div>
  </div>
</div>
@endsection

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
$(document).ready(function() {
  $('.sur_1').click(function(event) {
     $('.sur_1').not(this).attr('checked', false);
     $(this).attr('checked', true);
   });
  $('.sur_2').click(function(event) {
     $('.sur_2').not(this).attr('checked', false);
     $(this).attr('checked', true); });

  $('.sur_3_1').click(function(event) {
     $('.sur_3_1').not(this).attr('checked', false);
     $(this).attr('checked', true); });

   $('.sur_3_2').click(function(event) {
      $('.sur_3_2').not(this).attr('checked', false);
      $(this).attr('checked', true); });

  $('.sur_3_3').click(function(event) {
     $('.sur_3_3').not(this).attr('checked', false);
     $(this).attr('checked', true); });

  $('.sur_3_4').click(function(event) {
     $('.sur_3_4').not(this).attr('checked', false);
     $(this).attr('checked', true); });

  $('.sur_3_5').click(function(event) {
     $('.sur_3_5').not(this).attr('checked', false);
     $(this).attr('checked', true); });

   $('.sur_4').click(function(event) {
      $('.sur_4').not(this).attr('checked', false);
      $(this).attr('checked', true); });

      $('.sur_5_1').click(function(event) {
         $('.sur_5_1').not(this).attr('checked', false);
         $(this).attr('checked', true); });

       $('.sur_5_2').click(function(event) {
          $('.sur_5_2').not(this).attr('checked', false);
          $(this).attr('checked', true); });

      $('.sur_5_3').click(function(event) {
         $('.sur_5_3').not(this).attr('checked', false);
         $(this).attr('checked', true); });

      $('.sur_5_4').click(function(event) {
         $('.sur_5_4').not(this).attr('checked', false);
         $(this).attr('checked', true); });

      $('.sur_6_1').click(function(event) {
          $('.sur_6_1').not(this).attr('checked', false);
          if($('.sur_6_1:checked').attr('id')==='sur_6_1_1'){
            if($('#sur_6_2_1').is(":checked")){
              $('#sur_6_2_1').attr('checked', false);
            }
            if($('#sur_6_3_1').is(":checked")){
              $('#sur_6_3_1').attr('checked', false);
            }
          }else if($('.sur_6_1:checked').attr('id')==='sur_6_1_2'){
            if($('#sur_6_2_2').is(":checked")){
              $('#sur_6_2_2').attr('checked', false);
            }
            if($('#sur_6_3_2').is(":checked")){
              $('#sur_6_3_2').attr('checked', false);
            }
          }else{
            if($('#sur_6_2_3').is(":checked")){
              $('#sur_6_2_3').attr('checked', false);
            }
            if($('#sur_6_3_3').is(":checked")){
              $('#sur_6_3_3').attr('checked', false);
            }
          }
          $(this).attr('checked', true);
      });

      $('.sur_6_2').click(function(event) {
          $('.sur_6_2').not(this).attr('checked', false);
          if($('.sur_6_2:checked').attr('id')==='sur_6_2_1'){
            if($('#sur_6_1_1').is(":checked")){
              $('#sur_6_1_1').attr('checked', false);
            }
            if($('#sur_6_3_1').is(":checked")){
              $('#sur_6_3_1').attr('checked', false);
            }
          }else if($('.sur_6_2:checked').attr('id')==='sur_6_2_2'){
            if($('#sur_6_1_2').is(":checked")){
              $('#sur_6_1_2').attr('checked', false);
            }
            if($('#sur_6_3_2').is(":checked")){
              $('#sur_6_3_2').attr('checked', false);
            }
          }else{
            if($('#sur_6_1_3').is(":checked")){
              $('#sur_6_1_3').attr('checked', false);
            }
            if($('#sur_6_3_3').is(":checked")){
              $('#sur_6_3_3').attr('checked', false);
            }
          }
          $(this).attr('checked', true); });

      $('.sur_6_3').click(function(event) {
          $('.sur_6_3').not(this).attr('checked', false);
          if($('.sur_6_3:checked').attr('id')==='sur_6_3_1'){
            if($('#sur_6_2_1').is(":checked")){
              $('#sur_6_2_1').attr('checked', false);
            }
            if($('#sur_6_1_1').is(":checked")){
              $('#sur_6_1_1').attr('checked', false);
            }
          }else if($('.sur_6_3:checked').attr('id')==='sur_6_3_2'){
            if($('#sur_6_2_2').is(":checked")){
              $('#sur_6_2_2').attr('checked', false);
            }
            if($('#sur_6_1_2').is(":checked")){
              $('#sur_6_1_2').attr('checked', false);
            }
          }else{
            if($('#sur_6_2_3').is(":checked")){
              $('#sur_6_2_3').attr('checked', false);
            }
            if($('#sur_6_1_3').is(":checked")){
              $('#sur_6_1_3').attr('checked', false);
            }
          }
          $(this).attr('checked', true); });

      $('.sur_7_1').click(function(event) {
          $('.sur_7_1').not(this).attr('checked', false);
          if($('.sur_7_1:checked').attr('id')==='sur_7_1_1'){
            if($('#sur_7_2_1').is(":checked")){
              $('#sur_7_2_1').attr('checked', false);
            }
            if($('#sur_7_3_1').is(":checked")){
              $('#sur_7_3_1').attr('checked', false);
            }
          }else if($('.sur_7_1:checked').attr('id')==='sur_7_1_2'){
            if($('#sur_7_2_2').is(":checked")){
              $('#sur_7_2_2').attr('checked', false);
            }
            if($('#sur_7_3_2').is(":checked")){
              $('#sur_7_3_2').attr('checked', false);
            }
          }else{
            if($('#sur_7_2_3').is(":checked")){
              $('#sur_7_2_3').attr('checked', false);
            }
            if($('#sur_7_3_3').is(":checked")){
              $('#sur_7_3_3').attr('checked', false);
            }
          }
          $(this).attr('checked', true); });

      $('.sur_7_2').click(function(event) {
          $('.sur_7_2').not(this).attr('checked', false);
          if($('.sur_7_2:checked').attr('id')==='sur_7_2_1'){
            if($('#sur_7_1_1').is(":checked")){
              $('#sur_7_1_1').attr('checked', false);
            }
            if($('#sur_7_3_1').is(":checked")){
              $('#sur_7_3_1').attr('checked', false);
            }
          }else if($('.sur_7_2:checked').attr('id')==='sur_7_2_2'){
            if($('#sur_7_1_2').is(":checked")){
              $('#sur_7_1_2').attr('checked', false);
            }
            if($('#sur_7_3_2').is(":checked")){
              $('#sur_7_3_2').attr('checked', false);
            }
          }else{
            if($('#sur_7_1_3').is(":checked")){
              $('#sur_7_1_3').attr('checked', false);
            }
            if($('#sur_7_3_3').is(":checked")){
              $('#sur_7_3_3').attr('checked', false);
            }
          }
          $(this).attr('checked', true); });

      $('.sur_7_3').click(function(event) {
          $('.sur_7_3').not(this).attr('checked', false);
          if($('.sur_7_3:checked').attr('id')==='sur_7_3_1'){
            if($('#sur_7_2_1').is(":checked")){
              $('#sur_7_2_1').attr('checked', false);
            }
            if($('#sur_7_1_1').is(":checked")){
              $('#sur_7_1_1').attr('checked', false);
            }
          }else if($('.sur_7_3:checked').attr('id')==='sur_7_3_2'){
            if($('#sur_7_2_2').is(":checked")){
              $('#sur_7_2_2').attr('checked', false);
            }
            if($('#sur_7_1_2').is(":checked")){
              $('#sur_7_1_2').attr('checked', false);
            }
          }else{
            if($('#sur_7_2_3').is(":checked")){
              $('#sur_7_2_3').attr('checked', false);
            }
            if($('#sur_7_1_3').is(":checked")){
              $('#sur_7_1_3').attr('checked', false);
            }
          }
          $(this).attr('checked', true); });

      $('.sur_8').click(function(event) {
          $('.sur_8').not(this).attr('checked', false);
          $(this).attr('checked', true); });


                  $('.sur_9').click(function(event) {
                     $('.sur_9').not(this).attr('checked', false);
                     $(this).attr('checked', true); });

                     $('.sur_10').click(function(event) {
                       $('.sur_10').not(this).attr('checked', false);
                       $(this).attr('checked', true); });

                   $('.sur_11').click(function(event) {
                     $('.sur_11').not(this).attr('checked', false);
                     $(this).attr('checked', true); });
                     $('.sur_13_1').click(function(event) {
                        $('.sur_13_1').not(this).attr('checked', false);
                        $(this).attr('checked', true); });

                      $('.sur_13_2').click(function(event) {
                         $('.sur_13_2').not(this).attr('checked', false);
                         $(this).attr('checked', true); });

                     $('.sur_13_3').click(function(event) {
                        $('.sur_13_3').not(this).attr('checked', false);
                        $(this).attr('checked', true); });

                     $('.sur_13_4').click(function(event) {
                        $('.sur_13_4').not(this).attr('checked', false);
                        $(this).attr('checked', true); });

                        $('.sur_14_1').click(function(event) {
                           $('.sur_14_1').not(this).attr('checked', false);
                           $(this).attr('checked', true); });

                         $('.sur_14_2').click(function(event) {
                            $('.sur_14_2').not(this).attr('checked', false);
                            $(this).attr('checked', true); });

                        $('.sur_14_3').click(function(event) {
                           $('.sur_14_3').not(this).attr('checked', false);
                           $(this).attr('checked', true); });

                        $('.sur_14_4').click(function(event) {
                           $('.sur_14_4').not(this).attr('checked', false);
                           $(this).attr('checked', true); });

                           $('.sur_15_1').click(function(event) {
                              $('.sur_15_1').not(this).attr('checked', false);
                              $(this).attr('checked', true); });

                            $('.sur_15_2').click(function(event) {
                               $('.sur_15_2').not(this).attr('checked', false);
                               $(this).attr('checked', true); });

                           $('.sur_15_3').click(function(event) {
                              $('.sur_15_3').not(this).attr('checked', false);
                              $(this).attr('checked', true); });

                           $('.sur_15_4').click(function(event) {
                              $('.sur_15_4').not(this).attr('checked', false);
                              $(this).attr('checked', true); });

                              $('.sur_16_1').click(function(event) {
                                 $('.sur_16_1').not(this).attr('checked', false);
                                 $(this).attr('checked', true); });

                               $('.sur_16_2').click(function(event) {
                                  $('.sur_16_2').not(this).attr('checked', false);
                                  $(this).attr('checked', true); });

                              $('.sur_16_3').click(function(event) {
                                 $('.sur_16_3').not(this).attr('checked', false);
                                 $(this).attr('checked', true); });

                              $('.sur_16_4').click(function(event) {
                                 $('.sur_16_4').not(this).attr('checked', false);
                                 $(this).attr('checked', true); });



});

</script>
