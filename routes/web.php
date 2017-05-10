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

/** se acabó la convocatoria
//Route::get('convocatoria/aplicar', 'NoticeFront@aplicar');
//Route::post('convocatoria/aplicar', 'NoticeFront@saveAspirant');
***/
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
    Route::get('dashboard/aspirantes/verificados', 'Aspirants@verify');
    Route::get('dashboard/aspirantes/sin-verificar', 'Aspirants@NoVerify');
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
    Route::get('dashboard/sesiones/eliminar/{id}', 'ModuleSessions@delete');
    Route::get('dashboard/sesiones/ver/{id}', 'ModuleSessions@view');
    Route::get('dashboard/sesiones/facilitadores/asignar/{session_id}', 'ModuleSessions@assign');
    Route::post('dashboard/sesiones/facilitadores/buscar', 'ModuleSessions@searchFacilitator');
    Route::post('dashboard/sesiones/facilitadores/save/{session_id}', 'ModuleSessions@saveAssign');
    /*@Activities Controller */
    //CRUD activities
    Route::get('dashboard/sesiones/actividades/{id}', 'Activities@index');
    Route::get('dashboard/sesiones/actividades/agregar/{session_id}', 'Activities@add');
    Route::post('dashboard/sesiones/actividades/save/{session_id}', 'Activities@save');
    Route::get('dashboard/sesiones/actividades/editar/{id}', 'Activities@edit');
    Route::post('dashboard/sesiones/actividades/update/{id}', 'Activities@update');
    Route::get('dashboard/sesiones/actividades/deshabilitar/{id}', 'Activities@delete');
    Route::get('dashboard/sesiones/actividades/ver/{id}', 'Activities@view');
    Route::get('dashboard/sesiones/actividades/eliminar/{id}', 'Activities@delete');
    /*@ActivitiesFiles Controller */
    //CRUD files in activity
    Route::get('dashboard/sesiones/actividades/archivos/agregar/{activity_id}', 'ActivitiesFiles@add');
    Route::post('dashboard/sesiones/actividades/archivos/crear/{activity_id}', 'ActivitiesFiles@save');
    Route::get('dashboard/sesiones/actividades/archivos/ver/{id}', 'ActivitiesFiles@view');
    Route::get('dashboard/sesiones/actividades/archivos/editar/{file_id}', 'ActivitiesFiles@edit');
    Route::get('dashboard/sesiones/actividades/archivos/descargar/{id}', 'ActivitiesFiles@download');
    Route::post('dashboard/sesiones/actividades/archivos/update/{file_id}', 'ActivitiesFiles@update');
    /*@ActivityRequirements Controller */
    //CRUD activitiesRequirements
    Route::get('dashboard/sesiones/actividades/requerimientos/{id}', 'ActivityRequirements@index');
    Route::get('dashboard/sesiones/actividades/requerimientos/agregar/{activity_id}', 'ActivityRequirements@add');
    Route::post('dashboard/sesiones/actividades/requerimientos/save/{activity_id}', 'ActivityRequirements@save');
    Route::get('dashboard/sesiones/actividades/requerimientos/editar/{id}', 'ActivityRequirements@edit');
    Route::post('dashboard/sesiones/actividades/requerimientos/update/{id}', 'ActivityRequirements@update');
    Route::get('dashboard/sesiones/actividades/requerimientos/deshabilitar/{id}', 'ActivityRequirements@delete');
    Route::get('dashboard/sesiones/actividades/requerimientos/ver/{id}', 'ActivityRequirements@view');
    /*@Quiz Controller */
    //CRUD Quiz
    Route::get('dashboard/sesiones/actividades/evaluacion/agregar/{activity_id}', 'Quiz@add');
    /*@Topics Controller */
    //CRUD Topics
    Route::get('dashboard/sesiones/tematicas/{id}', 'Topics@index');
    Route::get('dashboard/sesiones/tematicas/agregar/{session_id}', 'Topics@add');
    Route::post('dashboard/sesiones/tematicas/save/{session_id}', 'Topics@save');
    Route::get('dashboard/sesiones/tematicas/editar/{id}', 'Topics@edit');
    Route::post('dashboard/sesiones/tematicas/update/{id}', 'Topics@update');
    Route::get('dashboard/sesiones/tematicas/deshabilitar/{id}', 'Topics@delete');
    Route::get('dashboard/sesiones/tematicas/ver/{id}', 'Topics@view');
    /*@Monitorings Controller */
    //CRUD Monitoring
    Route::get('dashboard/sesiones/mecanismos-monitoreo/{id}', 'Monitorings@index');
    Route::get('dashboard/sesiones/mecanismos-monitoreo/agregar/{session_id}', 'Monitorings@add');
    Route::post('dashboard/sesiones/mecanismos-monitoreo/save/{session_id}', 'Monitorings@save');
    Route::get('dashboard/sesiones/mecanismos-monitoreo/editar/{id}', 'Monitorings@edit');
    Route::post('dashboard/sesiones/mecanismos-monitoreo/update/{id}', 'Monitorings@update');
    Route::get('dashboard/sesiones/mecanismos-monitoreo/deshabilitar/{id}', 'Monitorings@delete');
    Route::get('dashboard/sesiones/mecanismos-monitoreo/ver/{id}', 'Monitorings@view');
    /*@SessionRequirements Controller */
    //CRUD SessionRequirements
    Route::get('dashboard/sesiones/requisitos/{id}', 'SessionRequirements@index');
    Route::get('dashboard/sesiones/requisitos/agregar/{session_id}', 'SessionRequirements@add');
    Route::post('dashboard/sesiones/requisitoso/save/{session_id}', 'SessionRequirements@save');
    Route::get('dashboard/sesiones/requisitos/editar/{id}', 'SessionRequirements@edit');
    Route::post('dashboard/sesiones/requisitos/update/{id}', 'SessionRequirements@update');
    Route::get('dashboard/sesiones/requisitos/deshabilitar/{id}', 'SessionRequirements@delete');
    Route::get('dashboard/sesiones/requisitos/ver/{id}', 'SessionRequirements@view');
    /*@Facilitator Controller */
    // Rutas CRUD Facilitator
    Route::get('dashboard/facilitadores', 'Facilitator@index');
    Route::get('dashboard/facilitadores/agregar', 'Facilitator@add');
    Route::post('dashboard/facilitadores/crear', 'Facilitator@save');
    Route::get('dashboard/facilitadores/editar/{id}', 'Facilitator@edit');
    Route::post('dashboard/facilitadores/editar/{id}', 'Facilitator@update');
    Route::get('dashboard/facilitadores/deshabilitar/{id}', 'Facilitator@delete');
    Route::get('dashboard/facilitadores/ver/{id}', 'Facilitator@view');
  });

  /* R U T A S  UNICAS DEL Fellow
  --------------------------------------------------------------------------------*/
  Route::group(['middleware' => 'type:fellow' ], function(){
    /*@Fellows Controller */
    //Dashboard
    Route::get('tablero', 'Fellows@dashboard');
    // Perfil fellow
    Route::get('tablero/perfil', 'Fellows@viewProfile');
    Route::get('tablero/perfil/editar', 'Fellows@editProfile');
    Route::post('tablero/perfil/save', 'Fellows@saveProfile');
    /*@ModulesFellow Controller */
    // Rutas módulos
    Route::get('tablero/aprendizaje', 'ModulesFellow@index');
    Route::get('tablero/aprendizaje/{slug}', 'ModulesFellow@view');
    /*@SessionFellow Controller */
    // Rutas módulos
    Route::get('tablero/aprendizaje/{module_slug}/{slug}', 'SessionFellow@view');
    /*@Messages Controller */
    // Rutas mensajes
    Route::get('tablero/mensajes', 'Messages@index');
    Route::get('tablero/mensajes/agregar', 'Messages@add');
    Route::get('tablero/mensajes/conversacion/agregar/{conversation_id}', 'Messages@addSingle');
    Route::post('tablero/mensajes/conversacion/save/{conversation_id}', 'Messages@saveSingle');
    Route::post('tablero/mensajes/save', 'Messages@save');
    Route::get('tablero/mensajes/ver/{conversation_id}', 'Messages@view');
  });

  /* R U T A S  UNICAS DEL Facilitador
  --------------------------------------------------------------------------------*/
  Route::group(['middleware' => 'type:facilitator' ], function(){
    /*@Facilitator Controller */
    //Dashboard
    Route::get('tablero-facilitador', 'Facilitator@dashboard');
    // Perfil  Facilitador
    Route::get('tablero-facilitador/perfil', 'Facilitator@viewProfile');
    Route::get('tablero-facilitador/perfil/editar', 'Facilitator@editProfile');
    Route::post('tablero-facilitador/perfil/save', 'Facilitator@saveProfile');
    // Actividades Facilitador
    Route::get('tablero-facilitador/actividades', 'FacilitatorActivities@activities');
    // Mensajes Facilitador
    Route::get('tablero-facilitador/mensajes', 'FacilitatorMessages@messages');
  });
});
