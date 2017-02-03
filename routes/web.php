<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

/******** Páginas estáticas y de consulta***************/
/*@front Controller */
/*********  INICIO ******** */
Route::get('/', 'Front@index');
Route::get('que-es', 'Front@descripcion');
Route::get('objetivos', 'Front@objetivos');
Route::get('aliados', 'Front@aliados');
Route::get('contacto', 'Front@contacto');
Route::get('politicas-de-privacidad', 'Front@politicas');
Route::get('redes-sociales', 'Front@redes');
/*@NoticeFront Controller */
/*********  Enlaces convocatoria ******** */
Route::get('convocatoria', 'NoticeFront@convocatoria');
Route::get('convocatoria/bases', 'NoticeFront@bases');
Route::get('convocatoria/aplicar', 'NoticeFront@aplicar');
Route::get('convocatoria/resultados', 'NoticeFront@resultados');
/*@RangeFront Controller */
/*********  Enlaces convocatoria ******** */
Route::get('alcance', 'RangeFront@alcance');
Route::get('alcance/{state}', 'RangeFront@descripcion');
Route::get('alcance/{state}/quienes-conforman-el-ejercicio', 'RangeFront@conforman');
Route::get('alcance/{state}/contexto', 'RangeFront@contexto');
Route::get('alcance/{state}/estatus', 'RangeFront@estatus');
/*@GovernmentFront Controller */
/*********  Enlaces Gobierno Abierto ******** */
Route::get('gobierno-abierto', 'GovernmentFront@gobierno');
Route::get('gobierno-abierto/contenido-teorico-del-modelo', 'GovernmentFront@contenido');
Route::get('gobierno-abierto/recursos', 'GovernmentFront@recursos');
Route::get('gobierno-abierto/recursos/videos', 'GovernmentFront@videos');
Route::get('gobierno-abierto/recursos/lecturas', 'GovernmentFront@lecturas');
Route::get('gobierno-abierto/ejercicios-locales', 'GovernmentFront@ejercicios');

/****************** DASHBOARD ***************/
Route::group(['middleware' => ['auth']], function () {
  /*@Suscribe Controller */
  /* Redireccionar a dashboard correspondiente */
  Route::get('guide-me', 'Suscribe@redirectToDashboard');

});
