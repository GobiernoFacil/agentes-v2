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
Route::get('convocatoria/resultados-2017', 'NoticeFront@resultado17');
Route::get('convocatoria/metodologia-2017', 'NoticeFront@metodo17');
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
    /// fellows
    Route::get('dashboard/fellows', 'FellowsAdmin@index');
    Route::get('dashboard/fellows/ver/{id}', 'FellowsAdmin@view');
    Route::get('dashboard/fellows/calificaciones/ver/{id}', 'FellowsAdmin@viewSheet');
    Route::get('dashboard/fellows/participaciones/ver/{id}', 'FellowsAdmin@participationSheet');
    Route::post('dashboard/fellows/buscar', 'FellowsAdmin@search');
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
    Route::get('dashboard/sesiones-asignadas/', 'ModuleSessions@viewAssign');
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
    Route::get('dashboard/foros/ver/{id}', 'AdminForums@index');
    Route::get('dashboard/foros/agregar', 'AdminForums@add');
    Route::post('dashboard/foros/save', 'AdminForums@save');
    Route::get('dashboard/pregunta/foros/agregar/{id}', 'AdminForums@addQuestion');
    Route::post('dashboard/pregunta/foros/save/{id}', 'AdminForums@saveQuestion');
    Route::get('dashboard/foros/pregunta/ver/{id}', 'AdminForums@viewQuestion');
    Route::get('dashboard/foros/pregunta/mensajes/agregar/{id}', 'AdminForums@addMessage');
    Route::post('dashboard/foros/pregunta/mensajes/save/{id}', 'AdminForums@saveMessage');
    Route::get('dashboard/foros/eliminar/{id}', 'AdminForums@delete');
    Route::get('dashboard/foros/session', 'AdminForums@session');
    /*@AdminEvaluations Controller */
    // Rutas evaluation
    Route::get('dashboard/evaluacion/diagnostico', 'AdminEvaluations@all');
    Route::get('dashboard/evaluacion', 'AdminEvaluations@index');
    Route::get('dashboard/evaluacion/actividad/ver/{activity_id}', 'AdminEvaluations@indexActivity');
    Route::get('dashboard/evaluacion/actividad/archivo/get/{file_id}', 'AdminEvaluations@download');
    Route::get('dashboard/evaluacion/actividad/archivo-corregido/get/{file_id}', 'AdminEvaluations@downloadEv');
    Route::get('dashboard/evaluacion/actividad/archivo/evaluar/{file_id}/{eva}', 'AdminEvaluations@fileEvaluation');
    Route::post('dashboard/evaluacion/actividad/archivo/evaluar/save/{file_id}/{eva}', 'AdminEvaluations@saveFileEvaluation');
    Route::get('dashboard/evaluacion/actividad/archivo/agregar/{activity_id}', 'AdminEvaluations@addSingle');
    Route::post('dashboard/evaluacion/actividad/archivo/save/{activity_id}', 'AdminEvaluations@saveSingle');
    Route::get('dashboard/evaluacion/actividad/archivo/evaluados/{activity_id}', 'AdminEvaluations@viewEvaluations');
    Route::get('dashboard/evaluacion/actividad/resultados/ver/{quiz_id}', 'AdminEvaluations@viewEvaluation');
    Route::get('dashboard/evaluacion/actividad/archivos/resultados/ver/{file_score_id}', 'AdminEvaluations@viewFileEvaluation');
    Route::get('dashboard/evaluacion/diagnostico/ver/{answers_id}', 'AdminEvaluations@view');
    Route::get('dashboard/evaluacion/diagnostico/evaluar/1/{answers_id}', 'AdminEvaluations@evaluateDiagnostic_1');
    Route::post('dashboard/evaluacion/diagnostico/evaluar/1/{evaluation_id}/save', 'AdminEvaluations@saveDiagnostic_1');
    Route::get('dashboard/evaluacion/diagnostico/evaluar/2/{answers_id}/{evaluation_id}', 'AdminEvaluations@evaluateDiagnostic_2');
    Route::post('dashboard/evaluacion/diagnostico/evaluar/2/{evaluation_id}/save', 'AdminEvaluations@saveDiagnostic_2');
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
    Route::get('dashboard/mensajes', 'AdminMessages@index');
    Route::get('dashboard/mensajes-archivados', 'AdminMessages@indexStorage');
    Route::get('dashboard/mensajes/agregar', 'AdminMessages@add');
    Route::get('dashboard/mensajes/conversacion/agregar/{conversation_id}', 'AdminMessages@addSingle');
    Route::post('dashboard/mensajes/conversacion/save/{conversation_id}', 'AdminMessages@saveSingle');
    Route::post('dashboard/mensajes/save', 'AdminMessages@save');
    Route::get('dashboard/mensajes/ver/{conversation_id}', 'AdminMessages@view');
    Route::get('dashboard/mensajes/conversacion/storage/{conversation_id}', 'AdminMessages@storage');
    Route::get('dashboard/horario', 'Admin@time');
    /*@AdminIndicators Controller */
    // Rutas de indicadores
    Route::get('dashboard/indicadores', 'AdminIndicators@index');
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
    Route::get('tablero/perfil/archivos', 'Fellows@viewFiles');
    Route::get('tablero/perfil/archivos/descargar/{file_id}', 'Fellows@download');
    /*@ModulesFellow Controller */
    // Rutas módulos
    Route::get('tablero/aprendizaje', 'ModulesFellow@index');
    Route::get('tablero/aprendizaje/{slug}', 'ModulesFellow@view');
    /*@SessionFellow Controller */
    // Rutas módulos
    Route::get('tablero/aprendizaje/{module_slug}/{slug}', 'SessionFellow@view');
    Route::get('tablero/aprendizaje/{module_slug}/{slug}/ver/facilitador/{id}', 'SessionFellow@viewFacilitator');
    // Rutas actividades
    Route::get('tablero/aprendizaje/{module_slug}/{slug}/{id}', 'SessionFellow@activity');
    // Rutas diagnostico
    Route::get('tablero/aprendizaje/examen-diagnostico/examen-diagnostico/examen/evaluar', 'SessionFellow@diagnostic');
    Route::post('tablero/aprendizaje/examen-diagnostico/examen-diagnostico/examen/evaluar/save', 'SessionFellow@saveDiagnostic');
    /*@FellowFiles */
    //Rutas archivos
    Route::get('tablero/archivos/{activity_slug}/agregar', 'FellowFiles@add');
    Route::post('tablero/archivos/{activity_slug}/save', 'FellowFiles@save');
	//Descargar archivo en actividades
    Route::get('tablero/aprendizaje/actividades/archivos/descargar/{id}', 'ActivitiesFiles@download');
    /*@Messages Controller */
    // Rutas mensajes
    Route::get('tablero/mensajes', 'Messages@index');
    Route::get('tablero/mensajes-archivados', 'Messages@indexStorage');
    Route::get('tablero/mensajes/agregar', 'Messages@add');
    Route::get('tablero/mensajes/conversacion/agregar/{conversation_id}', 'Messages@addSingle');
    Route::post('tablero/mensajes/conversacion/save/{conversation_id}', 'Messages@saveSingle');
    Route::post('tablero/mensajes/save', 'Messages@save');
    Route::get('tablero/mensajes/ver/{conversation_id}', 'Messages@view');
    Route::get('tablero/mensajes/conversacion/storage/{conversation_id}', 'Messages@storage');
    /*@Forums Controller */
    // Rutas foros
    Route::get('tablero/foros', 'Forums@all');
    Route::get('tablero/foros/{session_slug}/{forum_slug}', 'Forums@index');
  //  Route::get('tablero/foros/{module_slug}/{session_slug}/crear', 'Forums@add');
  //  Route::post('tablero/foros/{module_slug}/{session_slug}/save', 'Forums@save');
    Route::get('tablero/foros/{state_name}/{question_slug}/ver', 'Forums@viewQuestion');
    Route::get('tablero/foros/{session_slug}/pregunta/crear', 'Forums@addQuestion');
    Route::get('tablero/foros/pregunta/estado/{state_name}/crear', 'Forums@addStateQuestion');
    Route::post('tablero/foros/{session_slug}/pregunta/save', 'Forums@saveQuestion');
    Route::get('tablero/foros/pregunta/{session_slug}/{question_slug}/ver', 'Forums@viewQuestion');
    Route::get('tablero/foros/pregunta/{question_slug}/mensajes/agregar', 'Forums@addMessage');
    Route::post('tablero/foros/pregunta/{question_slug}/mensajes/save/single', 'Forums@saveMessage');
    Route::get('tablero/foros/{state_name}', 'Forums@stateForum');
    Route::get('tablero/foros/perfil/ver/{name}/{surname}/{lastname}', 'Forums@profileUser');
    Route::get('tablero/foros/perfil/ver/{name}/{type}', 'Forums@profileAdminUser');
    Route::get('tablero/participaciones', 'Forums@participations');
    /*@FellowEvaluations*/
    // Rutas calificaciones y evaluaciones
    Route::get('tablero/calificaciones', 'FellowEvaluations@index');
    Route::get('tablero/calificaciones/ver/{activity_slug}', 'FellowEvaluations@get');
    Route::get('tablero/calificaciones/archivos/ver/{activity_slug}', 'FellowEvaluations@getFile');
    Route::get('tablero/calificaciones/archivo/get/{score_id}', 'FellowEvaluations@download');
    Route::get('tablero/calificaciones/metodologia', 'FellowEvaluations@methodology');
    Route::get('tablero/evaluacion/{activity_slug}', 'FellowEvaluations@add');
    Route::post('tablero/evaluacion/{activity_slug}/save', 'FellowEvaluations@save');
    Route::get('tablero/evaluaciones', 'FellowEvaluations@indexEvaluations');
    /*@FellowSurveys*/
    // Rutas encuestas
    Route::get('tablero/encuestas', 'FellowSurveys@index');
    Route::get('tablero/encuestas/encuesta-satisfaccion', 'FellowSurveys@welcome');
    Route::get('tablero/encuestas/encuesta-satisfaccion/1', 'FellowSurveys@addSurvey');
    Route::post('tablero/encuestas/encuesta-satisfaccion', 'FellowSurveys@saveSurvey');
    Route::get('tablero/encuestas/facilitadores-modulos', 'FellowSurveys@indexModules');
    Route::get('tablero/encuestas/facilitadores/{module_slug}/sesiones', 'FellowSurveys@indexSessions');
    Route::get('tablero/encuestas/facilitadores-sesiones/{session_slug}', 'FellowSurveys@indexFacilitator');
    Route::get('tablero/encuestas/facilitadores-sesiones/{session_slug}/{name}', 'FellowSurveys@surveyFacilitator');
    Route::post('tablero/encuestas/facilitadores-sesiones/{session_slug}/{name}', 'FellowSurveys@saveFacilitatorSurvey');
    Route::get('tablero/encuestas/facilitadores-sesiones/{session_slug}/w/{name}', 'FellowSurveys@welcomeFacilitator');
    Route::get('tablero/encuestas/gracias', 'FellowSurveys@thanks');
    Route::get('tablero/encuestas/facilitadores-sesiones/{session_slug}/{name}/gracias', 'FellowSurveys@thanksFacilitator');
    //// noticias
    Route::get('tablero/noticias', 'NewsEventsFellow@index');
    Route::get('tablero/noticias/ver/{news_slug}', 'NewsEventsFellow@view');
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
    Route::get('tablero-facilitador/actividades/sesion/{id}', 'FacilitatorActivities@sessions');
    Route::get('tablero-facilitador/actividades/ver/{id}', 'FacilitatorActivities@activities_view');
    Route::get('tablero-facilitador/actividades/archivos/descargar/{id}', 'ActivitiesFiles@download');
    // Mensajes Facilitador
    Route::get('tablero-facilitador/mensajes', 'FacilitatorMessages@messages');
    Route::get('tablero-facilitador/mensajes-archivados', 'FacilitatorMessages@indexStorage');
    Route::get('tablero-facilitador/mensajes/ver/{id}', 'FacilitatorMessages@viewMessage');
    Route::get('tablero-facilitador/mensajes/agregar', 'FacilitatorMessages@add');
    Route::post('tablero-facilitador/mensajes/save', 'FacilitatorMessages@save');
    Route::get('tablero-facilitador/mensajes/ver/{conversation_id}', 'FacilitatorMessages@view');
    Route::get('tablero-facilitador/mensajes/conversacion/agregar/{id}', 'FacilitatorMessages@addSingle');
    Route::post('tablero-facilitador/mensajes/conversacion/save/{id}', 'FacilitatorMessages@saveSingle');
    Route::get('tablero-facilitador/mensajes/conversacion/storage/{conversation_id}', 'FacilitatorMessages@storage');
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

  });
});
