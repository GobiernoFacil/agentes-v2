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
Route::get('contacto', 'Front@contacto');
Route::get('aviso-privacidad', 'Front@politicas');
Route::get('redes-sociales', 'Front@redes');
/*@NoticeFront Controller */
/*********  Enlaces convocatoria ******** */
Route::get('convocatoria', 'NoticeFront@convocatoria');
//Route::get('convocatoria/proceso-de-seleccion', 'NoticeFront@bases'); oculto por acuerdo del equipo
Route::get('convocatoria/aplicar', 'NoticeFront@aplicar');
Route::post('convocatoria/aplicar', 'NoticeFront@saveAspirant');
Route::get('convocatoria/aplicar/registro', 'NoticeFront@aspirantFiles');
Route::post('convocatoria/aplicar/registro', 'NoticeFront@saveFiles');
Route::get('convocatoria/aplicar/fin', 'NoticeFront@end');
Route::get('convocatoria/aplicar/confirmacion/{token}', 'NoticeFront@aspirantActivation');
Route::get('convocatoria/resultados', 'NoticeFront@resultados');
Route::get('cities', 'NoticeFront@cities');
/*@RangeFront Controller */
/*********  Enlaces programa ******** */
Route::get('programa-gobierno-abierto/antecedentes', 'Front@antecedentes');
Route::get('programa-gobierno-abierto/aliados', 'Front@aliados');
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
//Route::get('gobierno-abierto/recursos', 'GovernmentFront@recursos');
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
    // @Aspirants Controller
    Route::get('dashboard/aspirantes', 'Aspirants@index');
    Route::get('dashboard/aspirantes/ver/{id}', 'Aspirants@view');
    Route::get('dashboard/aspirantes/evaluar-archivos/{id}', 'Aspirants@evaluateFiles');
    Route::post('dashboard/aspirantes/evaluar-archivos/{id}', 'Aspirants@SaveEvaluationFiles');
    Route::get('dashboard/aspirantes/evaluar/{id}', 'Aspirants@evaluation');
    Route::post('dashboard/aspirantes/evaluar/{id}', 'Aspirants@SaveEvaluation');
    Route::get('dashboard/archivo/download/{file}/{type}', 'Aspirants@download');
    Route::post('dashboard/aspirantes/buscar', 'Aspirants@search');
    // Perfil  administrador
    Route::get('dashboard/perfil', 'Admin@viewProfile');
    Route::get('dashboard/perfil/editar', 'Admin@editProfile');
    Route::post('dashboard/perfil/save', 'Admin@saveProfile');
    /******************** CMS routes *******************************/
    /*@Modules Controller */
    //CRUD Modules
    Route::get('dashboard/modulos', 'Modules@index');
    Route::get('dashboard/modulos/agregar', 'Modules@add');
    Route::post('dashboard/modulos/save', 'Modules@save');
    Route::get('dashboard/modulos/editar/{id}', 'Modules@edit');
    Route::post('dashboard/modulos/update/{id}', 'Modules@update');
    Route::get('dashboard/modulos/deshabilitar/{id}', 'Modules@delete');
    Route::get('dashboard/modulos/ver/{id}', 'Modules@view');
    /*@ModuleSessions Controller */
    //CRUD sessions
    Route::get('dashboard/sesiones/{id}', 'ModuleSessions@index');
    Route::get('dashboard/sesiones/agregar/{id}', 'ModuleSessions@add');
    Route::post('dashboard/sesiones/save/{module_id}', 'ModuleSessions@save');
    Route::get('dashboard/sesiones/editar/{session_id}', 'ModuleSessions@edit');
    Route::post('dashboard/sesiones/update/{session_id}', 'ModuleSessions@update');
    Route::get('dashboard/sesiones/deshabilitar/{id}', 'ModuleSessions@delete');
    Route::get('dashboard/sesiones/ver/{id}', 'ModuleSessions@view');
    /*@Activities Controller */
    //CRUD activities
    Route::get('dashboard/sesiones/actividades/{id}', 'Activities@index');
    Route::get('dashboard/sesiones/actividades/agregar/{session_id}', 'Activities@add');
    Route::post('dashboard/sesiones/actividades/save/{session_id}', 'Activities@save');
    Route::get('dashboard/sesiones/actividades/editar/{id}', 'Activities@edit');
    Route::post('dashboard/sesiones/actividades/update/{id}', 'Activities@update');
    Route::get('dashboard/sesiones/actividades/deshabilitar/{id}', 'Activities@delete');
    Route::get('dashboard/sesiones/actividades/ver/{id}', 'Activities@view');
    /*@ActivityRequirements Controller */
    //CRUD activitiesRequirements
    Route::get('dashboard/sesiones/actividades/requerimientos/{id}', 'ActivityRequirements@index');
    Route::get('dashboard/sesiones/actividades/requerimientos/agregar/{activity_id}', 'ActivityRequirements@add');
    Route::post('dashboard/sesiones/actividades/requerimientos/save/{activity_id}', 'ActivityRequirements@save');
    Route::get('dashboard/sesiones/actividades/requerimientos/editar/{id}', 'ActivityRequirements@edit');
    Route::post('dashboard/sesiones/actividades/requerimientos/update/{id}', 'ActivityRequirements@update');
    Route::get('dashboard/sesiones/actividades/requerimientos/deshabilitar/{id}', 'ActivityRequirements@delete');
    Route::get('dashboard/sesiones/actividades/requerimientos/ver/{id}', 'ActivityRequirements@view');
  });



});
