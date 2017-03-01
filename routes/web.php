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
Route::get('programa-gobierno-abierto', 'Front@descripcion');
Route::get('programa-gobierno-abierto/aliados', 'Front@aliados');
Route::get('contacto', 'Front@contacto');
Route::get('politica-privacidad', 'Front@politicas');
Route::get('redes-sociales', 'Front@redes');
/*@NoticeFront Controller */
/*********  Enlaces convocatoria ******** */
Route::get('convocatoria', 'NoticeFront@convocatoria');
//Route::get('convocatoria/proceso-de-seleccion', 'NoticeFront@bases'); oculto por acuerdo del equipo
Route::get('convocatoria/aplicar', 'NoticeFront@aplicar');
Route::post('convocatoria/aplicar', 'NoticeFront@saveAspirant');
Route::get('convocatoria/aplicar/registro', 'NoticeFront@aspirantFiles');
Route::post('convocatoria/aplicar/registro', 'NoticeFront@saveFiles');
Route::get('convocatoria/aplicar/confirmacion/{token}', 'NoticeFront@aspirantActivation');
Route::get('convocatoria/resultados', 'NoticeFront@resultados');
Route::get('cities', 'NoticeFront@cities');
/*@RangeFront Controller */
/*********  Enlaces convocatoria ******** */
Route::get('programa-gobierno-abierto/alcance', 'RangeFront@alcance');
Route::get('programa-gobierno-abierto/alcance/{state}', 'RangeFront@descripcion');
/*
Route::get('programa-gobierno-abierto/alcance/{state}/quienes-conforman-el-ejercicio', 'RangeFront@conforman');
Route::get('programa-gobierno-abierto/alcance/{state}/contexto', 'RangeFront@contexto');
Route::get('programa-gobierno-abierto/alcance/{state}/estatus', 'RangeFront@estatus');*/
/*@GovernmentFront Controller */
/*********  Enlaces Gobierno Abierto ******** */
Route::get('gobierno-abierto', 'GovernmentFront@gobierno');
Route::get('gobierno-abierto/contenido-teorico-del-modelo', 'GovernmentFront@contenido');
Route::get('gobierno-abierto/recursos', 'GovernmentFront@recursos');
Route::get('gobierno-abierto/recursos/videos', 'GovernmentFront@videos');
Route::get('gobierno-abierto/recursos/lecturas', 'GovernmentFront@lecturas');
Route::get('gobierno-abierto/ejercicios-locales', 'GovernmentFront@ejercicios');

/****************** USUARIOS REGISTRADOS ***************/
Route::group(['middleware' => ['auth']], function () {
  /*@Suscribe Controller */
  /* Redireccionar a dashboard correspondiente */
  Route::get('guide-me', 'Suscribe@redirectToDashboard');

  /* R U T A S  UNICAS DEL  SUPER A D M I N
   --------------------------------------------------------------------------------*/
  Route::group(['middleware' => 'type:superAdmin' ], function(){
    /*@SuAdmin Controller */
    //Dashboard
    Route::get('sa/dashboard', 'SuAdmin@dashboard');
    // Rutas CRUD super admin
    Route::get('sa/dashboard/super-administradores', 'SuAdmin@index');
    Route::get('sa/dashboard/super-administradores/agregar', 'SuAdmin@add');
    Route::post('sa/dashboard/super-administradores/crear', 'SuAdmin@save');
    Route::get('sa/dashboard/super-administradores/editar/{id}', 'SuAdmin@edit');
    Route::post('sa/dashboard/super-administradores/editar/{id}', 'SuAdmin@update');
    Route::get('sa/dashboard/super-administradores/deshabilitar/{id}', 'SuAdmin@delete');
    Route::get('sa/dashboard/super-administradores/ver/{id}', 'SuAdmin@view');
    // Perfil super administrador
    Route::get('sa/dashboard/perfil', 'SuAdmin@profile');
    Route::get('sa/dashboard/perfil/editar', 'SuAdmin@editProfile');
    Route::post('sa/dashboard/perfil/save', 'SuAdmin@saveProfile');
    /*@Admin Controller */
    // Rutas CRUD admin
    Route::get('sa/dashboard/administradores', 'Admin@index');
    Route::get('sa/dashboard/administradores/agregar', 'Admin@add');
    Route::post('sa/dashboard/administradores/crear', 'Admin@save');
    Route::get('sa/dashboard/administradores/editar/{id}', 'Admin@edit');
    Route::post('sa/dashboard/administradores/editar/{id}', 'Admin@update');
    Route::get('sa/dashboard/administradores/deshabilitar/{id}', 'Admin@delete');
    Route::get('sa/dashboard/administradores/ver/{id}', 'Admin@view');
  });

  /* R U T A S  UNICAS DEL A D M I N
   --------------------------------------------------------------------------------*/
  Route::group(['middleware' => 'type:admin' ], function(){
    /*@Admin Controller */
    //Dashboard
    Route::get('dashboard', 'Admin@dashboard');
    // Perfil  administrador
    Route::get('dashboard/perfil', 'Admin@profile');
    Route::get('dashboard/perfil/editar', 'Admin@editProfile');
    /*@Applications Controller */
    Route::get('dashboard/aplicaciones', 'Applications@index');
    Route::get('dashboard/aplicaciones/buscar', 'Applications@search');
    Route::get('dashboard/aplicaciones/ver/{id}', 'Applications@view');
    Route::get('dashboard/aplicaciones/evaluar/{id}', 'Applications@evaluate');
    /*@Aspirants Controller */
    Route::get('dashboard/aspirantes', 'Aspirants@index');
    Route::get('dashboard/aspirantes/ver/{id}', 'Aspirants@view');
    Route::get('dashboard/archivo/download/{file}/{type}', 'Aspirants@download');


  });



});
