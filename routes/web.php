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


use Illuminate\Http\Request;
Auth::routes();

/******** Páginas estáticas y de consulta***************/
/*@front Controller */
/*********  INICIO ******** */
Route::get('/', 'Front@index');
Route::get('programa-gobierno-abierto', 'Front@descripcion');
Route::get('programa-gobierno-abierto/descarga/{type}', 'Front@download');
Route::get('contacto', 'Front@contacto');
Route::get('aviso-privacidad', 'Front@politicas');
Route::get('redes-sociales', 'Front@redes');
/*@NoticeFront Controller */
/*********  Enlaces convocatoria ******** */
Route::get('convocatoria', 'NoticeFront@convocatoria');
Route::get('convocatoria/preguntas-frecuentes', 'NoticeFront@faqs');

///////convocatorias cerradas
Route::get('convocatoria/cerrada/{notice_slug}', 'NoticeFront@closed');
/////// convocatoria 2017
Route::get('convocatoria/2017', 'NoticeFront@convoca17');
Route::get('convocatoria/resultados-2017', function(){
    return Redirect::to('convocatoria/2017/resultados', 301);
});
Route::get('convocatoria/metodologia-2017', function(){
    return Redirect::to('convocatoria/2017/metodologia', 301);
});
Route::get('convocatoria/2017/resultados', 'NoticeFront@resultado17');
Route::get('convocatoria/2017/metodologia', 'NoticeFront@metodo17');
//////////////////////


Route::get('convocatoria/archivos/{name}', 'NoticeFront@download');
//Route::get('convocatoria/proceso-de-seleccion', 'NoticeFront@bases'); oculto por acuerdo del equipo

/** se acabó la convocatoria***/
Route::get('convocatoria/aplicar/{notice_slug}', 'NoticeFront@aplicar');
Route::post('convocatoria/aplicar/{notice_slug}', 'NoticeFront@saveAspirant');

Route::get('convocatoria/aplicar/registro', 'NoticeFront@aspirantFiles');
Route::post('convocatoria/aplicar/registro', 'NoticeFront@saveFiles');
Route::get('convocatoria/registro/fin', 'NoticeFront@end');
Route::get('convocatoria/aplicar/{notice_slug}/{token}/confirmacion', 'NoticeFront@aspirantActivation');
Route::get('convocatoria/{notice_slug}/resultados', 'NoticeFront@results');
Route::get('convocatoria/{notice_slug}/metodologia', 'NoticeFront@methodology');

//Route::get('convocatoria/resultados', 'NoticeFront@resultados');
Route::get('cities', 'NoticeFront@cities');
/*@RangeFront Controller */
/*********  Enlaces programa ******** */
/*********  programa 2017 ******** */
Route::get('programa-gobierno-abierto/2017', 'Front@pro17');
Route::get('programa-gobierno-abierto/2017/testimonios', 'Front@testimony17');
/*********  programa 2018 ******** */
Route::get('programa-gobierno-abierto/2018', 'Front@pro18');
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
Route::get('gobierno-abierto/recursos/modelo-gobierno-abierto', 'GovernmentFront@model');

/*@NewsEventFront Controller */
/*********  Noticias y eventos ******** */
Route::get('noticias-eventos', 'NewsEventFront@index');
Route::get('noticias-eventos/{slug}', 'NewsEventFront@get');

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

    /******************** notice routes *******************************/
    /*@AdminNotice Controller */
    Route::get('dashboard/convocatorias', 'AdminNotice@index');
    Route::get('dashboard/convocatorias/agregar', 'AdminNotice@add');
    Route::post('dashboard/convocatorias/agregar', 'AdminNotice@save');
    Route::get('dashboard/convocatorias/editar/{notice_id}', 'AdminNotice@edit');
    Route::post('dashboard/convocatorias/editar/{notice_id}', 'AdminNotice@update');
    Route::get('dashboard/convocatorias/eliminar/{notice_id}', 'AdminNotice@deleteNotice');
    Route::get('dashboard/convocatorias/agregar-archivos/{notice_id}', 'AdminNotice@addFiles');
    Route::post('dashboard/convocatorias/agregar-archivos/{notice_id}', 'AdminNotice@saveFiles');
    Route::get('dashboard/convocatorias/ver/{notice_id}', 'AdminNotice@view');
    Route::get('dashboard/convocatorias/archivos/editar/{file_id}', 'AdminNotice@updateFile');
    Route::post('dashboard/convocatorias/archivos/editar/{file_id}', 'AdminNotice@saveFile');
    Route::get('dashboard/convocatorias/archivos/descargar/{file_id}', 'AdminNotice@download');
    Route::get('dashboard/convocatorias/archivos/eliminar/{file_id}', 'AdminNotice@delete');
    // @Aspirants Controller old controller
    // @AdminAspirants new aspirant controller

    //Route::get('dashboard/aspirantes', 'Aspirants@index'); old aspirant list
    Route::get('dashboard/aspirantes', 'AdminAspirants@index');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/ver', 'AdminAspirants@aspirantList');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/aspirantes-sin-archivos', 'AdminAspirants@aspirantWithOutProof');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/aspirantes-sin-archivos-validos', 'AdminAspirants@aspirantRejected');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/aspirantes-con-archivos-evaluados', 'AdminAspirants@aspirantAlreadyEvaluated');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/aspirantes-con-archivos-evaluados/{state}', 'AdminAspirants@aspirantAlreadyEvaluatedState');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/aspirantes-con-archivo-por-evaluar', 'AdminAspirants@aspirantToEvaluate');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/aspirantes-con-aplicacion-por-evaluar', 'AdminAspirants@aspirantAppToEvaluate');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/aspirantes-con-aplicacion-evaluada', 'AdminAspirants@aspirantAppAlreadyEvaluated');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/todos-los-aspirantes-con-aplicacion-evaluada', 'AdminAspirants@allAspirantAppAlreadyEvaluated');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/todos-los-aspirantes-con-aplicacion-evaluada/{state}', 'AdminAspirants@allAspirantAppAlreadyEvaluatedState');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/evaluar-aplicacion/{aspirant_id}', 'AdminAspirants@evaluateData');
    Route::post('dashboard/aspirantes/convocatoria/{notice_id}/evaluar-aplicacion/{aspirant_id}', 'AdminAspirants@saveEvaluateData');


    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/ver-aspirante/{aspirant_id}', 'AdminAspirants@viewAspirant');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/download/{aspirant_id}/{type}', 'AdminAspirants@downloadPdf');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/comprobante/{name}', 'AdminAspirants@download');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/evaluar-comprobante/{aspirant_id}', 'AdminAspirants@evaluate');
    Route::post('dashboard/aspirantes/convocatoria/{notice_id}/evaluar-comprobante/{aspirant_id}', 'AdminAspirants@saveEvaluate');

    // @AdminInterviews entrevistas
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/entrevistas', 'AdminInterviews@index');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/entrevistas/aspirantes-entrevistados', 'AdminInterviews@interviewed');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/entrevistas/todos-los-aspirantes-entrevistados/{state}', 'AdminInterviews@interviewedByState');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/entrevistas/todos-los-aspirantes-entrevistados', 'AdminInterviews@allInterviewed');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/entrevistas/evaluar-entrevista/{aspirant_id}', 'AdminInterviews@add');
    Route::post('dashboard/aspirantes/convocatoria/{notice_id}/entrevistas/evaluar-entrevista/{aspirant_id}', 'AdminInterviews@save');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/entrevistas/actualizar-entrevista/{aspirant_id}', 'AdminInterviews@edit');
    Route::get('dashboard/aspirantes/convocatoria/{notice_id}/entrevistas/ver-entrevista/{aspirant_id}', 'AdminInterviews@view');


    /// fellows
    Route::get('dashboard/fellows', 'FellowsAdmin@indexProgram');
    Route::get('dashboard/fellows/programa/{program_id}', 'FellowsAdmin@index');
    Route::get('dashboard/fellows/programa/{program_id}/ver-fellow/{fellow_id}', 'FellowsAdmin@view');
    Route::get('dashboard/fellows/programa/{program_id}/ver-calificaciones/{fellow_id}', 'FellowsAdmin@viewSheet');
    Route::get('dashboard/fellows/programa/{program_id}/ver-calificaciones/{module_id}/{fellow_id}', 'FellowsAdmin@viewModule');
    Route::get('dashboard/fellows/programa/{program_id}/ver-participaciones/{fellow_id}', 'FellowsAdmin@participationSheet');
    Route::post('dashboard/fellows/buscar', 'FellowsAdmin@search');
    // Perfil  administrador
    Route::get('dashboard/perfil', 'Admin@viewProfile');
    Route::get('dashboard/perfil/editar', 'Admin@editProfile');
    Route::post('dashboard/perfil/save', 'Admin@saveProfile');
    /******************** CMS routes *******************************/
    /*@Programs Controller */
    //CRUD Programs
    Route::get('dashboard/programas', 'Programs@index');
    Route::get('dashboard/programas/agregar', 'Programs@add');
    Route::post('dashboard/programas/save', 'Programs@save');
    Route::get('dashboard/programas/editar/{id}', 'Programs@edit');
    Route::post('dashboard/programas/update/{id}', 'Programs@update');
    Route::get('dashboard/programas/eliminar/{id}', 'Programs@delete');
    Route::get('dashboard/programas/ver/{id}', 'Programs@view');
    /*@Modules Controller */
    //CRUD Modules
    Route::get('dashboard/programas/{program_id}/modulos', 'Modules@index');
    Route::get('dashboard/programas/{program_id}/modulos/agregar', 'Modules@add');
    Route::post('dashboard/programas/{program_id}/modulos/save', 'Modules@save');
    Route::get('dashboard/programas/{program_id}/modulos/editar/{module_id}', 'Modules@edit');
    Route::post('dashboard/programas/{program_id}/modulos/update/{module_id}', 'Modules@update');
    Route::get('dashboard/programas/{program_id}/modulos/eliminar/{module_id}', 'Modules@delete');
    Route::get('dashboard/programas/{program_id}/modulos/ver/{module_id}', 'Modules@view');

    /*@ModuleSessions Controller */
    //CRUD sessions
    Route::get('dashboard/programas/{program_id}/modulos/{module_id}/sesiones', 'ModuleSessions@index');
    Route::get('dashboard/programas/{program_id}/modulos/{module_id}/sesiones/agregar', 'ModuleSessions@add');
    Route::post('dashboard/programas/{program_id}/modulos/{module_id}/sesiones/save', 'ModuleSessions@save');
    Route::get('dashboard/programas/{program_id}/modulos/{module_id}/sesiones/editar/{session_id}', 'ModuleSessions@edit');
    Route::post('dashboard/programas/{program_id}/modulos/{module_id}/sesiones/update/{session_id}', 'ModuleSessions@update');
    Route::get('dashboard/programas/{program_id}/modulos/{module_id}/sesiones/eliminar/{session_id}', 'ModuleSessions@delete');
    Route::get('dashboard/programas/{program_id}/modulos/{module_id}/sesiones/ver/{session_id}', 'ModuleSessions@view');
    Route::get('dashboard/programas/{program_id}/modulos/{module_id}/sesiones-facilitadores/asignar/{session_id}', 'ModuleSessions@assign');
    Route::get('dashboard/programas/{program_id}/modulos/{module_id}/sesiones-facilitadores/remover/{session_id}/{facilitator_id}', 'ModuleSessions@remove');
    Route::post('dashboard/programas/{program_id}/modulos/{module_id}/sesiones-facilitadores/buscar/{session_id}', 'ModuleSessions@searchFacilitator');
    Route::post('dashboard/programas/{program_id}/modulos/{module_id}/sesiones-facilitadores/save/{session_id}', 'ModuleSessions@saveAssign');
    /*@ModuleSessions Controller */
    //sesiones asignadas
    Route::get('dashboard/sesiones-asignadas/', 'ModuleSessions@assignedIndex');
    Route::get('dashboard/sesiones-asignadas/programa/{program_id}/', 'ModuleSessions@assignedView');


    /*@Activities Controller */
    //CRUD activities
    Route::get('dashboard/sesiones/actividades/ver/{id}', 'Activities@view');
    Route::get('dashboard/sesiones/actividades/{id}', 'Activities@view');
    Route::get('dashboard/sesiones/actividades/agregar/{session_id}', 'Activities@add');
    Route::post('dashboard/sesiones/actividades/save/{session_id}', 'Activities@save');
    Route::get('dashboard/sesiones/actividades/editar/{id}', 'Activities@edit');
    Route::post('dashboard/sesiones/actividades/update/{id}', 'Activities@update');
    Route::get('dashboard/sesiones/actividades/deshabilitar/{id}', 'Activities@delete');
    Route::get('dashboard/sesiones/actividades/eliminar/{id}', 'Activities@delete');

    Route::get('dashboard/sesiones/actividades/foro/pregunta/{id}', 'AdminForums@viewQuestion');
    /*@ActivitiesFiles Controller */
    //CRUD files in activity
    Route::get('dashboard/sesiones/actividades/archivos/agregar/{activity_id}', 'ActivitiesFiles@add');
    Route::get('dashboard/sesiones/actividades/archivos/agregar/nuevo/{activity_id}', 'ActivitiesFiles@addSingle');
    Route::post('dashboard/sesiones/actividades/archivos/crear/{activity_id}', 'ActivitiesFiles@save');
    Route::post('dashboard/sesiones/actividades/archivos/single/{activity_id}', 'ActivitiesFiles@saveSingle');
    Route::get('dashboard/sesiones/actividades/archivos/ver/{id}', 'ActivitiesFiles@view');
    Route::get('dashboard/sesiones/actividades/archivos/editar/{file_id}', 'ActivitiesFiles@edit');
    Route::get('dashboard/sesiones/actividades/archivos/descargar/{id}', 'ActivitiesFiles@download');
    Route::post('dashboard/sesiones/actividades/archivos/update/{file_id}', 'ActivitiesFiles@update');
    Route::get('dashboard/sesiones/actividades/archivos/eliminar/{file_id}', 'ActivitiesFiles@delete');
    //ver pdf
    Route::get('dashboard/sesiones/actividades/archivos/ver-pdf/{file_id}', 'ActivitiesFiles@watchPdf');




    /*@ActivityRequirements Controller */
    //CRUD activitiesRequirements
    Route::get('dashboard/sesiones/actividades/requerimientos/{id}', 'ActivityRequirements@index');
    Route::get('dashboard/sesiones/actividades/requerimientos/agregar/{activity_id}', 'ActivityRequirements@add');
    Route::post('dashboard/sesiones/actividades/requerimientos/save/{activity_id}', 'ActivityRequirements@save');
    Route::get('dashboard/sesiones/actividades/requerimientos/editar/{id}', 'ActivityRequirements@edit');
    Route::post('dashboard/sesiones/actividades/requerimientos/update/{id}', 'ActivityRequirements@update');
    Route::get('dashboard/sesiones/actividades/requerimientos/deshabilitar/{id}', 'ActivityRequirements@delete');
    Route::get('dashboard/sesiones/actividades/requerimientos/ver/{id}', 'ActivityRequirements@view');
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
    Route::get('dashboard/facilitadores/eliminar/{id}', 'Facilitator@delete');
    /*@NewsEvents Controller */
    // Rutas CRUD News Events
    Route::get('dashboard/noticias-eventos', 'NewsEvents@index');
    Route::get('dashboard/noticias-eventos/agregar', 'NewsEvents@add');
    Route::post('dashboard/noticias-eventos/save', 'NewsEvents@save');
    Route::get('dashboard/noticias-eventos/ver/{content_id}', 'NewsEvents@view');
    Route::get('dashboard/noticias-eventos/editar/{content_id}', 'NewsEvents@edit');
    Route::post('dashboard/noticias-eventos/update/{content_id}', 'NewsEvents@update');
    Route::post('noticias-eventos/update/image', 'NewsEvents@uploadImage');
    /*@AdminForums Controller */
    // Rutas CRUD forums
    Route::get('dashboard/foros', 'AdminForums@all');
    Route::get('dashboard/foros/programa/{program_id}/ver-foros', 'AdminForums@index');
    Route::get('dashboard/foros/programa/{program_id}/ver-foro/{forum_id}', 'AdminForums@view');
    Route::get('dashboard/foros/programa/{program_id}/agregar', 'AdminForums@add');
    Route::post('dashboard/foros/programa/{program_id}/save', 'AdminForums@save');
    Route::get('dashboard/foros/programa/{program_id}/pregunta/agregar/{forum_id}', 'AdminForums@addQuestion');
    Route::post('dashboard/foros/programa/{program_id}/pregunta/save/{forum_id}', 'AdminForums@saveQuestion');
    Route::get('dashboard/foros/programa/{program_id}/foro/{forum_id}/ver-pregunta/{question_id}', 'AdminForums@viewQuestion');
    Route::get('dashboard/foros/programa/{program_id}/pregunta/mensajes/agregar/{question_id}', 'AdminForums@addMessage');
    Route::post('dashboard/foros/programa/{program_id}/pregunta/mensajes/save/{question_id}', 'AdminForums@saveMessage');
    Route::get('dashboard/foros/eliminar/{id}', 'AdminForums@delete');
    Route::get('dashboard/foros/session', 'AdminForums@session');
    /*@AdminEvaluations Controller */
    // Rutas evaluation
    Route::get('dashboard/programas/{program_id}/ver-evaluaciones', 'AdminEvaluations@index');
    Route::get('dashboard/programas/{program_id}/ver-evaluacion/{activity_id}', 'AdminEvaluations@indexActivity');
    Route::get('dashboard/programas/{program_id}/ver-evaluacion/{activity_id}/resultados/{score_id}', 'AdminEvaluations@viewEvaluation');
    Route::get('dashboard/programas/{program_id}/ver-evaluacion/{activity_id}/archivos/archivos-evaluados', 'AdminEvaluations@viewEvaluations');
    Route::get('dashboard/programas/{program_id}/ver-evaluacion/{activity_id}/archivos/agregar-evaluacion', 'AdminEvaluations@addSingle');
    Route::post('dashboard/programas/{program_id}/ver-evaluacion/{activity_id}/archivos/agregar-evaluacion', 'AdminEvaluations@saveSingle');
    Route::get('dashboard/programas/{program_id}/ver-evaluacion/{activity_id}/archivos/get/{file_id}', 'AdminEvaluations@download');
    Route::get('dashboard/programas/{program_id}/ver-diagnostico/{activity_id}', 'AdminEvaluations@indexDiagnostic');
    Route::get('dashboard/programas/{program_id}/ver-diagnostico/{activity_id}/resultados/{user_id}', 'AdminEvaluations@viewDiagnostic');
    Route::get('dashboard/programas/{program_id}/ver-evaluacion/{activity_id}/archivos/agregar-evaluacion/{file_id}', 'AdminEvaluations@fileEvaluation');
    Route::post('dashboard/programas/{program_id}/ver-evaluacion/{activity_id}/archivos/save/{file_id}', 'AdminEvaluations@saveFileEvaluation');
    Route::get('dashboard/programas/{program_id}/ver-evaluacion/{activity_id}/resultados/{user_id}', 'AdminEvaluations@viewDiagnostic');
    Route::get('dashboard/programas/{program_id}/ver-evaluacion/{activity_id}/archivos/ver-resultado/{file_id}', 'AdminEvaluations@viewFileEvaluation');



  //  old diagnostic
  /*  Route::get('dashboard/evaluacion/diagnostico', 'AdminEvaluations@all');

    Route::get('dashboard/evaluacion/actividad/archivo-corregido/get/{file_id}', 'AdminEvaluations@downloadEv');

    Route::get('dashboard/evaluacion/diagnostico/ver/{answers_id}', 'AdminEvaluations@view');
    Route::get('dashboard/evaluacion/diagnostico/evaluar/1/{answers_id}', 'AdminEvaluations@evaluateDiagnostic_1');
    Route::post('dashboard/evaluacion/diagnostico/evaluar/1/{evaluation_id}/save', 'AdminEvaluations@saveDiagnostic_1');
    Route::get('dashboard/evaluacion/diagnostico/evaluar/2/{answers_id}/{evaluation_id}', 'AdminEvaluations@evaluateDiagnostic_2');
    Route::post('dashboard/evaluacion/diagnostico/evaluar/2/{evaluation_id}/save', 'AdminEvaluations@saveDiagnostic_2');*/
    /*@Quiz Controller */
    //CRUD Quiz
    Route::get('dashboard/sesiones/actividades/evaluacion/agregar/{activity_id}/1', 'Quiz@add');
    Route::post('dashboard/sesiones/actividades/evaluacion/save/{activity_id}/1', 'Quiz@save');
    Route::get('dashboard/sesiones/actividades/evaluacion/agregar/{activity_id}/2', 'Quiz@addQuestion');
    Route::get('dashboard/sesiones/actividades/evaluacion/checkAnswers/{quiz_id}/{activity_id}', 'Quiz@checkAnswers');
    Route::post('dashboard/sesiones/actividades/evaluacion/{activity_id}/save/question', 'Quiz@saveQuestion');
    Route::post('dashboard/sesiones/actividades/evaluacion/{activity_id}/remove/question', 'Quiz@removeQuestion');
    Route::post('dashboard/sesiones/actividades/evaluacion/{activity_id}/save/answer', 'Quiz@saveAnswer');
    Route::post('dashboard/sesiones/actividades/evaluacion/{activity_id}/remove/answer', 'Quiz@removeAnswer');
    Route::post('dashboard/sesiones/actividades/evaluacion/{activity_id}/switch/answer', 'Quiz@switchAnswer');
    Route::post('dashboard/sesiones/actividades/evaluacion/{activity_id}/get/questions', 'Quiz@getQuestions');
    Route::post('dashboard/sesiones/actividades/evaluacion/{activity_id}/update/questions', 'Quiz@updateQuestions');
    Route::post('dashboard/sesiones/actividades/evaluacion/{activity_id}/update/answer', 'Quiz@updateAnswer');
    /*@AdminMessages Controller */
    // Rutas mensajes

    Route::get('dashboard/mensajes', 'AdminMessages@all');
    Route::get('dashboard/mensajes/programa/{program_id}/ver-mensajes', 'AdminMessages@index');
    Route::get('dashboard/mensajes/programa/{program_id}/mensajes-archivados', 'AdminMessages@indexStoraged');
    Route::get('dashboard/mensajes/programa/{program_id}/agregar-mensaje', 'AdminMessages@add');
    Route::post('dashboard/mensajes/programa/{program_id}/save', 'AdminMessages@save');
    Route::get('dashboard/mensajes/programa/{program_id}/ver-mensajes/{conversation_id}', 'AdminMessages@view');
    Route::get('dashboard/mensajes/programa/{program_id}/conversacion/agregar-respuesta/{conversation_id}', 'AdminMessages@addSingle');
    Route::post('dashboard/mensajes/programa/{program_id}/conversacion/save/{conversation_id}', 'AdminMessages@saveSingle');
    Route::get('dashboard/mensajes/programa/{program_id}/conversacion/storage/{conversation_id}', 'AdminMessages@storage');
    Route::get('dashboard/horario/{task}', 'Admin@time');
    /*@AdminIndicators Controller */
    // Rutas de indicadores
    Route::get('dashboard/indicadores', 'AdminIndicators@index');
    Route::get('dashboard/indicadores/fellows/descargar', 'AdminIndicators@downloadFellows');
    Route::get('dashboard/indicadores/fellows/descargar/xlsx', 'AdminIndicators@downloadFellowsXLSX');
    Route::get('dashboard/indicadores/facilitadores-modulos', 'AdminIndicators@indexModules');
    Route::get('dashboard/indicadores/facilitadores/descargar/{session_id}/{facilitator_id}', 'AdminIndicators@downloadFacilitator');
    Route::get('dashboard/indicadores/facilitadores/descargar/xlsx/{session_id}/{facilitator_id}', 'AdminIndicators@downloadFacilitatorXLSX');
    Route::get('dashboard/indicadores/facilitadores-modulos/{session_id}/{facilitator_id}', 'AdminIndicators@surveyFacilitator');
    Route::get('dashboard/indicadores/satisfaccion', 'AdminIndicators@surveySatisfaction');
    Route::get('dashboard/indicadores/percepcion-positiva', 'AdminIndicators@perception');
    Route::get('dashboard/indicadores/agentes-aprobados', 'AdminIndicators@fellowsApproved');
    /*@AdminSurveys Controller */
    //Rutas de encuestas
    Route::get('dashboard/encuestas', 'AdminSurveys@index');
    Route::get('dashboard/encuestas/diagnostico/{survey_id}', 'AdminSurveys@customSurvey');
    Route::get('dashboard/encuestas/encuesta-satisfaccion/fellows', 'AdminSurveys@indexFellows');
    Route::get('dashboard/encuestas/encuesta-satisfaccion/fellows/{fellows_id}', 'AdminSurveys@surveyFellow');
    Route::get('dashboard/encuestas/facilitadores-modulos', 'AdminSurveys@indexModules');
    Route::get('dashboard/encuestas/facilitadores-modulos/{session_id}/{facilitator_id}', 'AdminSurveys@surveyFacilitator');
    Route::get('dashboard/encuestas/get_csv/{file_name}', 'AdminSurveys@getCsv');
    Route::get('dashboard/encuestas/get_csv/fellow/{file_name}', 'AdminSurveys@get_csv');
    Route::get('dashboard/encuestas/facilitadores-modulos/{session_id}/c/{facilitator_id}', 'AdminSurveys@customFacilitator');
     /*@AdminDiagnostic Controller */
     //Rutas de diagnostico
     Route::get('dashboard/diagnostico', 'AdminDiagnostic@index');
     Route::get('dashboard/diagnostico/{custom_id}', 'AdminDiagnostic@getCustom');
     Route::get('dashboard/diagnostico/descargar/{type}/{custom_id}', 'AdminDiagnostic@download');

     //add diagnostic quiz
     Route::get('dashboard/sesiones/actividades/diagnostico/agregar/{activity_id}/1', 'AdminDiagnostic@add');
     Route::post('dashboard/sesiones/actividades/diagnostico/save/{activity_id}/1', 'AdminDiagnostic@save');
     Route::get('dashboard/sesiones/actividades/diagnostico/agregar/{activity_id}/2', 'AdminDiagnostic@addQuestion');
     Route::get('dashboard/sesiones/actividades/diagnostico/checkAnswers/{quiz_id}/{activity_id}', 'AdminDiagnostic@checkAnswers');
     Route::post('dashboard/sesiones/actividades/diagnostico/{activity_id}/save/question', 'AdminDiagnostic@saveQuestion');
     Route::post('dashboard/sesiones/actividades/diagnostico/{activity_id}/remove/question', 'AdminDiagnostic@removeQuestion');
     Route::post('dashboard/sesiones/actividades/diagnostico/{activity_id}/save/answer', 'AdminDiagnostic@saveAnswer');
     Route::post('dashboard/sesiones/actividades/diagnostico/{activity_id}/remove/answer', 'AdminDiagnostic@removeAnswer');
     Route::post('dashboard/sesiones/actividades/diagnostico/{activity_id}/switch/answer', 'AdminDiagnostic@switchAnswer');
     Route::post('dashboard/sesiones/actividades/diagnostico/{activity_id}/switch/required', 'AdminDiagnostic@switchRequired');
     Route::post('dashboard/sesiones/actividades/diagnostico/{activity_id}/get/questions', 'AdminDiagnostic@getQuestions');
     Route::post('dashboard/sesiones/actividades/diagnostico/{activity_id}/update/questions', 'AdminDiagnostic@updateQuestions');
     Route::post('dashboard/sesiones/actividades/diagnostico/{activity_id}/update/answer', 'AdminDiagnostic@updateAnswer');

  });

  /* R U T A S  UNICAS DEL Fellow
  --------------------------------------------------------------------------------*/
  Route::group(['middleware' => 'type:fellow' ], function(){
    /*@Fellows Controller */
    //Dashboard
    Route::get('tablero', 'Fellows@dashboard');
    //Programa
	    Route::get('tablero/informacion', 'Fellows@viewInfo');
    // Perfil fellow
    Route::get('tablero/perfil', 'Fellows@viewProfile');
    Route::get('tablero/perfil/editar', 'Fellows@editProfile');
    Route::post('tablero/perfil/save', 'Fellows@saveProfile');
    Route::get('tablero/perfil/archivos', 'Fellows@viewFiles');
    Route::get('tablero/perfil/archivos/descargar/{file_id}', 'Fellows@download');
    Route::group(['middleware' => 'program'], function(){
          /*@ModulesFellow Controller */
          // Rutas módulos
          Route::get('tablero/{program_slug}/aprendizaje', 'ModulesFellow@index');
          Route::get('tablero/{program_slug}/aprendizaje/{module_slug}', 'ModulesFellow@view');
          /*@SessionFellow Controller */
          // Rutas módulos
          Route::get('tablero/{program_slug}/aprendizaje/{module_slug}/{session_slug}', 'SessionFellow@view');
          Route::get('tablero/{program_slug}/aprendizaje/{module_slug}/{session_slug}/ver/facilitador/{id}', 'SessionFellow@viewFacilitator');
          // Rutas actividades
          Route::get('tablero/{program_slug}/aprendizaje/{module_slug}/{session_slug}/{activity_slug}', 'SessionFellow@activity');
          // Rutas fin modulo
          Route::get('tablero/{program_slug}/aprendizaje/{module_slug}/{session_slug}/fin-modulo/ver', 'SessionFellow@end');
          // Rutas nuevo diagnostico
            //Route::get('tablero/{program_slug}/aprendizaje/examen-diagnostico/examen-diagnostico/examen/evaluar', 'SessionFellow@diagnostic');
            //Route::post('tablero/{program_slug}/aprendizaje/examen-diagnostico/examen-diagnostico/examen/evaluar/save', 'SessionFellow@saveDiagnostic');
            Route::get('tablero/{program_slug}/aprendizaje/diagnostico/{activity_slug}/examen/responder', 'FellowDiagnostic@add');
            Route::post('tablero/{program_slug}/aprendizaje/diagnostico/{activity_slug}/examen/responder', 'FellowDiagnostic@save');
          /*@FellowFiles */
          //Rutas archivos
          Route::get('tablero/{program_slug}/archivos/{activity_slug}/agregar', 'FellowFiles@add');
          Route::post('tablero/{program_slug}/archivos/{activity_slug}/save', 'FellowFiles@save');
      	//Descargar archivo en actividades
          Route::get('tablero/{program_slug}/aprendizaje/actividades/archivos/descargar/{id}', 'ActivitiesFiles@download');
          //ver pdf
          Route::get('tablero/{program_slug}/aprendizaje/actividades/archivos/ver-pdf/{id}', 'ActivitiesFiles@watchPdfFellow');
          /*@Messages Controller */
          // Rutas mensajes
          Route::get('tablero/{program_slug}/mensajes', 'Messages@index');
          Route::get('tablero/{program_slug}/mensajes-archivados', 'Messages@indexStoraged');
          Route::get('tablero/{program_slug}/mensajes/agregar', 'Messages@add');
          Route::get('tablero/{program_slug}/mensajes/conversacion/agregar/{conversation_id}', 'Messages@addSingle');
          Route::post('tablero/{program_slug}/mensajes/conversacion/save/{conversation_id}', 'Messages@saveSingle');
          Route::post('tablero/{program_slug}/mensajes/save', 'Messages@save');
          Route::get('tablero/{program_slug}/mensajes/ver/{conversation_id}', 'Messages@view');
          Route::get('tablero/{program_slug}/mensajes/conversacion/storage/{conversation_id}', 'Messages@storage');
          /*@Forums Controller */
          // Rutas foros
          Route::get('tablero/{program_slug}/foros', 'Forums@all');
          Route::get('tablero/{program_slug}/foros/actividades', 'Forums@allAc');
          Route::get('tablero/{program_slug}/foros/{forum_slug}', 'Forums@index');
          Route::get('tablero/{program_slug}/foros/{forum_slug}/agregar-pregunta', 'Forums@addQuestion');
          Route::post('tablero/{program_slug}/foros/{forum_slug}/save-question', 'Forums@saveQuestion');
          Route::get('tablero/{program_slug}/foros/{forum_slug}/ver-pregunta/{question_slug}', 'Forums@viewQuestion');
          Route::get('tablero/{program_slug}/foros/pregunta/{question_slug}/agregar-mensaje', 'Forums@addMessage');
          Route::post('tablero/{program_slug}/foros/pregunta/{question_slug}/mensajes/save/single', 'Forums@saveMessage');
          Route::get('tablero/{program_slug}/foros/perfil/ver/{name}/{surname}/{lastname}', 'Forums@profileUser');
          Route::get('tablero/{program_slug}/foros/perfil/ver/{name}', 'Forums@profileFUser');
          Route::get('tablero/{program_slug}/foros/perfil/ver/{name}/{type}', 'Forums@profileAdminUser');

          //fellow participaciones
          Route::get('tablero/{program_slug}/participaciones', 'Forums@participations');

          /*@FellowAverage*/
          // Rutas calificaciones y evaluaciones
          Route::get('tablero/{program_slug}/calificaciones', 'FellowAverage@index');
          Route::get('tablero/{program_slug}/calificaciones/{module_slug}', 'FellowAverage@moduleScores');
          Route::get('tablero/{program_slug}/calificaciones/ver/{activity_slug}', 'FellowAverage@get');



          Route::get('tablero/{program_slug}/calificaciones/archivos/ver/{activity_slug}', 'FellowEvaluations@getFile');
          Route::get('tablero/{program_slug}/calificaciones/archivo/get/{score_id}', 'FellowEvaluations@download');
          Route::get('tablero/{program_slug}/calificaciones/metodologia', 'FellowEvaluations@methodology');
          Route::get('tablero/{program_slug}/evaluacion/{activity_slug}', 'FellowEvaluations@add');
          Route::post('tablero/{program_slug}/evaluacion/{activity_slug}/save', 'FellowEvaluations@save');
          Route::post('tablero/{program_slug}/evaluacion/{activity_slug}/evaluar', 'FellowEvaluations@evaluate');
          Route::get('tablero/{program_slug}/evaluacion/{activity_slug}/finalizar', 'FellowEvaluations@putScore');
          Route::get('tablero/{program_slug}/evaluaciones', 'FellowEvaluations@indexEvaluations');
          /*@FellowSurveys*/
          // Rutas encuestas
          Route::get('tablero/{program_slug}/encuestas', 'FellowSurveys@index');
          Route::get('tablero/{program_slug}/encuestas/encuesta-satisfaccion', 'FellowSurveys@welcome');
          Route::get('tablero/{program_slug}/encuestas/encuesta-satisfaccion/1', 'FellowSurveys@addSurvey');
          Route::post('tablero/{program_slug}/encuestas/encuesta-satisfaccion', 'FellowSurveys@saveSurvey');
          Route::get('tablero/{program_slug}/encuestas/facilitadores-modulos', 'FellowSurveys@indexModules');
          Route::get('tablero/{program_slug}/encuestas/facilitadores/{module_slug}/sesiones', 'FellowSurveys@indexSessions');
          Route::get('tablero/{program_slug}/encuestas/facilitadores-sesiones/{session_slug}', 'FellowSurveys@indexFacilitator');
          Route::get('tablero/{program_slug}/encuestas/facilitadores-sesiones/{session_slug}/{name}', 'FellowSurveys@surveyFacilitator');
          Route::post('tablero/{program_slug}/encuestas/facilitadores-sesiones/{session_slug}/{name}', 'FellowSurveys@saveFacilitatorSurvey');
          Route::get('tablero/{program_slug}/encuestas/facilitadores-sesiones/{session_slug}/w/{name}', 'FellowSurveys@welcomeFacilitator');
          Route::get('tablero/{program_slug}/encuestas/gracias', 'FellowSurveys@thanks');
          Route::get('tablero/{program_slug}/encuestas/facilitadores-sesiones/{session_slug}/{name}/gracias', 'FellowSurveys@thanksFacilitator');
          Route::get('tablero/{program_slug}/encuestas/facilitadores-sesiones/{session_slug}/c/{name}', 'FellowSurveys@customFacilitator');
          Route::post('tablero/{program_slug}/encuestas/facilitadores-sesiones/{session_slug}/c/{name}', 'FellowSurveys@saveCustomFacilitator');
          });
      //// noticias
      Route::get('tablero/noticias', 'NewsEventsFellow@index');
      Route::get('tablero/noticias/ver/{news_slug}', 'NewsEventsFellow@view');
      /*@FellowDiagnostic*/
      //// diagnostico
    //  Route::get('tablero/diagnostico/{slug}', 'FellowDiagnostic@get_test');
  //    Route::post('tablero/diagnostico/{slug}', 'FellowDiagnostic@save_test');

  });

  /* R U T A S  UNICAS DEL Facilitador
  --------------------------------------------------------------------------------*/
  Route::group(['middleware' => 'type:facilitator' ], function(){
    /*@Facilitator Controller */
    //Dashboard
    Route::get('tablero-facilitador', 'Facilitator@dashboard');
    //Perfiles Facilitadores
    Route::get('tablero-facilitador/facilitadores/ver/{user_id}', 'Facilitator@viewFacilitator');
    // Perfil  Facilitador
    Route::get('tablero-facilitador/perfil', 'Facilitator@viewProfile');
    Route::get('tablero-facilitador/perfil/editar', 'Facilitator@editProfile');
    Route::post('tablero-facilitador/perfil/save', 'Facilitator@saveProfile');
    // Actividades Facilitador
    Route::get('tablero-facilitador/actividades', 'FacilitatorActivities@activities');
    Route::get('tablero-facilitador/actividades/sesion/{id}', 'FacilitatorActivities@sessions');
    Route::get('tablero-facilitador/actividades/ver/{id}', 'FacilitatorActivities@activities_view');
    Route::get('tablero-facilitador/actividades/archivos/descargar/{id}', 'ActivitiesFiles@download');
    // Mensajes Facilitador
    Route::get('tablero-facilitador/mensajes', 'FacilitatorMessages@all');
    Route::get('tablero-facilitador/mensajes/{program_slug}/ver-mensajes', 'FacilitatorMessages@messages');
    Route::get('tablero-facilitador/mensajes/{program_slug}/agregar-mensaje', 'FacilitatorMessages@add');
    Route::post('tablero-facilitador/mensajes/{program_slug}/agregar-mensaje', 'FacilitatorMessages@save');
    Route::get('tablero-facilitador/mensajes/{program_slug}/ver-conversacion/{conversation_id}', 'FacilitatorMessages@viewMessage');
    Route::get('tablero-facilitador/mensajes/{program_slug}/ver-conversacion/agregar-mensaje/{conversation_id}', 'FacilitatorMessages@addSingle');
    Route::post('tablero-facilitador/mensajes/{program_slug}/ver-conversacion/agregar-mensaje/{conversation_id}', 'FacilitatorMessages@saveSingle');
    Route::get('tablero-facilitador/mensajes/{program_slug}/conversacion/storage/{conversation_id}', 'FacilitatorMessages@storage');
    Route::get('tablero-facilitador/mensajes/{program_slug}/mensajes-archivados', 'FacilitatorMessages@indexStorage');

    /*@FacilitatorForums Controller */
    // Rutas foros
    Route::get('tablero-facilitador/foros', 'FacilitatorForums@all');
    Route::get('tablero-facilitador/foros/{id}', 'FacilitatorForums@index');
  //  Route::get('tablero-facilitador/foros/ver/{id}', 'FacilitatorForums@view');
    Route::get('tablero-facilitador/foros/pregunta/crear/{id}', 'FacilitatorForums@addQuestion');
    Route::post('tablero-facilitador/foros/pregunta/save/{id}', 'FacilitatorForums@saveQuestion');
    Route::get('tablero-facilitador/foros/pregunta/ver/{id}', 'FacilitatorForums@viewQuestion');
    Route::get('tablero-facilitador/foros/pregunta/mensajes/agregar/{id}', 'FacilitatorForums@addMessage');
    Route::post('tablero-facilitador/foros/pregunta/mensajes/save/{id}', 'FacilitatorForums@saveMessage');
    /*@FacilitatorEvaluations Controller */
    // Rutas evaluation
    Route::get('tablero-facilitador/evaluacion/diagnostico', 'FacilitatorEvaluations@all');
    Route::get('tablero-facilitador/evaluacion/diagnostico/ver/{id}', 'FacilitatorEvaluations@view');

    //// noticias
    Route::get('tablero-facilitador/noticias', 'NewsEventsFacilitator@index');
    Route::get('tablero-facilitador/noticias/ver/{news_slug}', 'NewsEventsFacilitator@view');

    //// diagnostico
    Route::get('tablero-facilitador/diagnostico', 'FacilitatorDiagnostic@index');
    Route::get('tablero-facilitador/diagnostico/{custom_id}', 'FacilitatorDiagnostic@getCustom');
    Route::get('tablero-facilitador/diagnostico/descargar/{type}/{custom_id}', 'FacilitatorDiagnostic@download');
  });



  /* R U T A S  UNICAS DEL ASPIRANTE
  --------------------------------------------------------------------------------*/
  Route::group(['middleware' => 'type:aspirant' ], function(){
    /*@AspirantDash Controller */
    //Dashboard
    Route::get('tablero-aspirante', 'AspirantDash@dashboard');
    // Perfil  aspirante
    Route::get('tablero-aspirante/perfil', 'AspirantDash@viewProfile');
    Route::get('tablero-aspirante/perfil/editar', 'AspirantDash@editProfile');
    Route::post('tablero-aspirante/perfil/save', 'AspirantDash@saveProfile');
    //aviso de privacidad
    Route::get('tablero-aspirante/aviso-de-privacidad', 'AspirantDash@privacyPolices');
    //convocatorias
    /*AspirantNotices*/
    Route::get('tablero-aspirante/convocatorias', 'AspirantNotices@index');
    Route::get('tablero-aspirante/convocatorias/{notice_slug}', 'AspirantNotices@view');
    Route::get('tablero-aspirante/convocatorias/{notice_slug}/aplicar', 'AspirantNotices@apply');
    Route::post('tablero-aspirante/convocatorias/{notice_slug}/aplicar', 'AspirantNotices@applyMotives');
    Route::get('tablero-aspirante/convocatorias/{notice_slug}/aplicar/agregar-perfil-curricular', 'AspirantNotices@applyCv');
    Route::post('tablero-aspirante/idioma/agregar', 'AspirantNotices@addLanguage');
    Route::post('tablero-aspirante/idioma/eliminar/{id}', 'AspirantNotices@removeLanguage');
    Route::post('tablero-aspirante/programa/agregar', 'AspirantNotices@addSoftware');
    Route::post('tablero-aspirante/programa/eliminar/{id}', 'AspirantNotices@removeSoftware');
    Route::post('tablero-aspirante/experiencia/agregar', 'AspirantNotices@addExperience');
    Route::post('tablero-aspirante/experiencia/eliminar/{id}', 'AspirantNotices@removeExperience');
    Route::post('tablero-aspirante/estudios/agregar', 'AspirantNotices@addStudy');
    Route::post('tablero-aspirante/estudios/eliminar/{id}', 'AspirantNotices@removeStudy');
    Route::post('tablero-aspirante/experiencia-abierta/agregar', 'AspirantNotices@addOpen');
    Route::post('tablero-aspirante/experiencia-abierta/eliminar/{id}', 'AspirantNotices@removeOpen');
    Route::post('tablero-aspirante/convocatorias/{notice_slug}/aplicar/agregar-perfil-curricular', 'AspirantNotices@saveCv');
    Route::get('tablero-aspirante/convocatorias/{notice_slug}/aplicar/agregar-video', 'AspirantNotices@applyVideo');
    Route::post('tablero-aspirante/convocatorias/{notice_slug}/aplicar/agregar-video', 'AspirantNotices@applySaveVideo');
    Route::get('tablero-aspirante/convocatorias/{notice_slug}/aplicar/agregar-comprobante-domicilio', 'AspirantNotices@applyProof');
    Route::post('tablero-aspirante/convocatorias/{notice_slug}/aplicar/agregar-comprobante-domicilio', 'AspirantNotices@applySaveProof');
    Route::get('tablero-aspirante/convocatorias/{notice_slug}/aplicar/agregar-aviso-privacidad', 'AspirantNotices@applyPrivacy');
    Route::post('tablero-aspirante/convocatorias/{notice_slug}/aplicar/agregar-aviso-privacidad', 'AspirantNotices@applySavePrivacy');
    Route::get('tablero-aspirante/convocatorias/{notice_slug}/gracias', 'AspirantNotices@thanks');


/*    Route::get('tablero-aspirante/convocatorias/{notice_slug}/ver-archivos', 'AspirantNotices@viewFiles');
    Route::get('tablero-aspirante/convocatorias/{notice_slug}/agregar-archivos', 'AspirantNotices@addFiles');
    Route::post('tablero-aspirante/convocatorias/{notice_slug}/agregar-archivos', 'AspirantNotices@saveFiles');
    Route::get('tablero-aspirante/convocatorias/{notice_slug}/actualizar-archivos', 'AspirantNotices@editFiles');
    Route::post('tablero-aspirante/convocatorias/{notice_slug}/actualizar-archivos', 'AspirantNotices@updateFiles');*/
    Route::get('tablero-aspirante/archivo/download/{name}/{type}', 'AspirantNotices@download');


  });
});
