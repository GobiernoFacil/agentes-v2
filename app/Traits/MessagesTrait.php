<?php

namespace App\Traits;

trait MessagesTrait{
  public function messages(){
      return [

        // USER
        'name.required'  => 'El nombre es requerido',
        'password.min'   => 'La contraseña debe tener por lo menos 8 caracteres',
        'password.required'   => 'La contraseña es requerida',
        'password-confirm.same'   => 'La confirmación debe ser igual a la contraseña',
        'password-confirm.required'   => 'La confirmación es requerida',
        'email.required' => 'El correo es requerido',
        'email.email'    => 'El correo debe ser válido',
        'email.max'      => 'El correo debe tener menos de 255 caracteres',
        'email.unique'   => 'El correo ya ha sido registrado',

        //Aspirante
        'surname.required'  => 'El apellido paterno es requerido',
        'lastname.required'  => 'El apellido materno es requerido',
        'city.required'  => 'La ciudad es requerida',
        'state.required'  => 'El estado es requerido',
        'degree.required'  => 'El grado de estudios es requerido',
        'email-confirm.same'   => 'Los correos no coinciden',
        'email-confirm.required'   => 'La confirmación es requerida',
        'origin.required' => 'El sector de procedencia es requerido',

        //Archivos
        'cv.required' => 'El Perfil Curricular es requerido',
        'cv.file'     => 'El archivo debe ser válido',
        'cv.mimes'    => 'El archivo debe ser del tipo requerido (Archivo Word o PDF)',
        'cv.max'      => 'El archivo no puede ser mayor a 2.5MB',
        'essay.required' => 'El ensayo es requerido',
        'essay.file'     => 'El archivo debe ser válido',
        'essay.mimes'    => 'El archivo debe ser del tipo requerido (Archivo Word o PDF)',
        'essay.max'      => 'El archivo no puede ser mayor a 2.5MB',
        'letter.required' => 'La carta membretada es requerida',
        'letter.file'     => 'El archivo debe ser válido',
        'letter.mimes'    => 'El archivo debe ser del tipo requerido',
        'letter.max'      => 'El archivo no puede ser mayor a 2.5MB',
        'proof.required' => 'El comprobante de domicilio es requerido',
        'proof.file'     => 'El archivo debe ser válido',
        'proof.mimes'    => 'El archivo debe ser del tipo requerido',
        'proof.max'      => 'El archivo no puede ser mayor a 2.5MB',
        'privacy.required' => 'El consentimiento es requerido',
        'privacy.file'     => 'El archivo debe ser válido',
        'privacy.mimes'    => 'El archivo debe ser del tipo requerido ',
        'privacy.max'      => 'El archivo no puede ser mayor a 2.5MB',
        'video.required' => 'El enlace a video es requerido',
        //evaluation
        'experience.required'=> 'Esta pregunta es obligatoria',
        'experience1.required'=> 'Esta pregunta es obligatoria',
        'experience2.required'=> 'Esta pregunta es obligatoria',
        'experience3.required'=> 'Esta pregunta es obligatoria',
        'experienceJ1.required'=> 'Esta pregunta es obligatoria',
        'experienceJ2.required'=> 'Esta pregunta es obligatoria',
        'institution.required'=> 'Este campo es obligatorio',
        'evaluator.required'=> 'Esta pregunta es obligatoria',
        'essay.required'=> 'Esta pregunta es obligatoria',
        'essay1.required'=> 'Esta pregunta es obligatoria',
        'essay2.required'=> 'Esta pregunta es obligatoria',
        'essay3.required'=> 'Esta pregunta es obligatoria',
        'essay4.required'=> 'Esta pregunta es obligatoria',
        'video.required'=> 'Esta pregunta es obligatoria',
        'video1.required'=> 'Esta pregunta es obligatoria',
        'video2.required'=> 'Esta pregunta es obligatoria',
        'video3.required'=> 'Esta pregunta es obligatoria',
        'video4.required'=> 'Esta pregunta es obligatoria',
        //files evaluation
        'hasVideo.required'=> 'Esta pregunta es obligatoria',
        'hasEssay.required'=> 'Esta pregunta es obligatoria',
        'hasLetter.required'=> 'Esta pregunta es obligatoria',
        'hasPrivacy.required'=> 'Esta pregunta es obligatoria',
        'hasProof.required'=> 'Esta pregunta es obligatoria',
        'hasCv.required'=> 'Esta pregunta es obligatoria',

         //Modules
         'title.required' => 'El nombre es requerido',
         'title.unique' => 'El nombre debe de ser único',
         'number_sessions.required'=> 'El número de sesiones es requerido',
         'number_sessions.numeric' => 'Escribe un número',
         'number_hours.numeric' => 'Escribe un número',
         'number_hours.required'=> 'El total de horas es requerido',
         'modality.required'=> 'La modalidad es requerida',
         'teaching_situation.required'=> 'La situación académica es requerida',
         'objective.required'=> 'El objetivo es requerido',
         'product_developed.required'=> 'El producto a desarrollar es requerido',
         'start.required'=> 'La fecha inicio es requerida',
         'end.required'=> 'La fecha final es requerida',
         'public.required'=> 'Este campo es requerido',
         //sesiones
         'name.unique' => 'El nombre debe de ser único',
         'order.required' => 'Este campo es requerido',
         'order.numeric' => 'Escribe un número',
         'order.integer' => 'Este campo debe ser un número entero',
         'hours.numeric' => 'Escribe un número',
         'hours.required'=> 'El total de horas es requerido',
         //Actividades
         'duration.required' => 'Este campo es requerido',
         'duration.numeric' => 'Escribe un número',
         'description.required' => 'La descripción es requerida',
         'facilitator_role.required' => 'Este campo es requerido',
         'competitor_role.required' => 'Este campo es requerido',
         'material_link.url' =>"Escribe un URL válido",
         'files.required' => 'Este campo es requerido',
         'evaluation.required' => 'Este campo es requerido',
         'type.required' => 'Este campo es requerido',
         'link.required' => 'Este campo es requerido',
         'link_video.required' => 'Este campo es requerido',
         'time.required' => 'Este campo es requerido',
         'hasforum.required' => 'Este campo es requerido',
         //Monitoreo
         'knowledge.required' => 'Este campo es requerido',
         'attitude.required' => 'Este campo es requerido',
         'competitions.required' => 'Este campo es requerido',
         //Monitoreo
         'message.required' => 'Este campo es requerido',
         //images
         'image.mimes' => 'El archivo debe ser del tipo requerido (Archivo JPG o PNG)',
         'image.max' =>'El archivo no puede ser mayor a 2.5MB',
         //activity file
         'file.required' => 'Este campo es requerido',
         'file.mimes' => 'Debe ser un archivo de tipo doc,docx o pdf',
         'file.max' => 'Debe pesar 2.5 MB como máximo.',
         'parent_id.required' => 'Este campo es requerido',
         //file fellow
         'file_e.required' => 'Este campo es requerido',
         'file_e.mimes' => 'Debe ser un archivo de tipo doc,docx o pdf',
         'file_e.max' => 'Debe pesar 10 MB como máximo.',
         //forum
         'topic.required' => 'Este campo es requerido',
         'topic.max' => 'Este campo debe contener 256 caracteres como máximo',
         'topic.unique' => 'Este elemento ya está en uso. Selecciona uno diferente',
         'session_id.different'=>"Selecciona una sesión o actividad",
         'activity_id.different'=>"Selecciona una sesión o actividad",

         //news
         'brief.required' => 'Este campo es requerido',
         'score.required' => 'Este campo es requerido',
         'score.numeric' => 'Escribe un número',
         'url.required' => 'Este campo es requerido',
         'content.required' => 'Este campo es requerido',
         'answer_1.required'=>"Contesta esta pregunta",
         'answer_2.required'=>"Contesta esta pregunta",
         'answer_3.required'=>"Contesta esta pregunta",
         'answer_4.required'=>"Contesta esta pregunta",
         'answer_5.required'=>"Contesta esta pregunta",

         //diagnosticeva
         'question_1.required'=>"Contesta esta pregunta",
         'question_2.required'=>"Contesta esta pregunta",
         'question_3.required'=>"Contesta esta pregunta",
         'question_4.required'=>"Contesta esta pregunta",
         'question_5.required'=>"Contesta esta pregunta",
         'question_6.required'=>"Contesta esta pregunta",
         'question_7.required'=>"Contesta esta pregunta",
         'question_8.required'=>"Contesta esta pregunta",
         'question_9.required'=>"Contesta esta pregunta",
         'question_10.required'=>"Contesta esta pregunta",
         'question_11.required'=>"Contesta esta pregunta",
         'question_12.required'=>"Contesta esta pregunta",
         'question_13.required'=>"Contesta esta pregunta",
         'question_14.required'=>"Contesta esta pregunta",
         'question_15.required'=>"Contesta esta pregunta",
         'answer_q1_1.required'=>"Contesta esta pregunta",
         'answer_q1_2.required'=>"Contesta esta pregunta",
         'answer_q1_3.required'=>"Contesta esta pregunta",
         'answer_q1_j.required'=>"Contesta esta pregunta",
         'answer_q2_1.required'=>"Contesta esta pregunta",
         'answer_q2_2.required'=>"Contesta esta pregunta",
         'answer_q2_j.required'=>"Contesta esta pregunta",
         'answer_q3_1.required'=>"Contesta esta pregunta",
         'answer_q3_2.required'=>"Contesta esta pregunta",
         'answer_q3_3.required'=>"Contesta esta pregunta",
         'answer_q3_4.required'=>"Contesta esta pregunta",
         'answer_q3_j.required'=>"Contesta esta pregunta",
         'answer_q4_1.required'=>"Contesta esta pregunta",
         'answer_q4_2.required'=>"Contesta esta pregunta",
         'answer_q4_j.required'=>"Contesta esta pregunta",
         'answer_q5_1.required'=>"Contesta esta pregunta",
         'answer_q5_2.required'=>"Contesta esta pregunta",
         'answer_q5_3.required'=>"Contesta esta pregunta",
         'answer_q5_j.required'=>"Contesta esta pregunta",
         //evaluation
         'answer_q1.required'=>"Contesta esta pregunta",
         'answer_q2.required'=>"Contesta esta pregunta",
         'answer_q3.required'=>"Contesta esta pregunta",
         'answer_q4.required'=>"Contesta esta pregunta",
         'answer_q5.required'=>"Contesta esta pregunta",
         'answer_q6.required'=>"Contesta esta pregunta",
         'answer_q7.required'=>"Contesta esta pregunta",
         'answer_q8.required'=>"Contesta esta pregunta",
         'answer_q9.required'=>"Contesta esta pregunta",
         'answer_q10.required'=>"Contesta esta pregunta",
         'answer_q11.required'=>"Contesta esta pregunta",
         'answer_q12.required'=>"Contesta esta pregunta",
         'answer_q13.required'=>"Contesta esta pregunta",
         'answer_q14.required'=>"Contesta esta pregunta",
         'answer_q15.required'=>"Contesta esta pregunta",
         'answer_q16.required'=>"Contesta esta pregunta",
         'answer_q17.required'=>"Contesta esta pregunta",
         'answer_q18.required'=>"Contesta esta pregunta",
         'answer_q19.required'=>"Contesta esta pregunta",
         'answer_q20.required'=>"Contesta esta pregunta",
         'answer_q21.required'=>"Contesta esta pregunta",
         'answer_q22.required'=>"Contesta esta pregunta",
         'answer_q23.required'=>"Contesta esta pregunta",
         'answer_q24.required'=>"Contesta esta pregunta",
         'answer_q25.required'=>"Contesta esta pregunta",
         'answer_q26.required'=>"Contesta esta pregunta",
         'answer_q27.required'=>"Contesta esta pregunta",
         'answer_q28.required'=>"Contesta esta pregunta",
         'answer_q29.required'=>"Contesta esta pregunta",
         'answer_q30.required'=>"Contesta esta pregunta",
         'answer_q31.required'=>"Contesta esta pregunta",

         'answer_q1.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q2.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q3.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q4.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q5.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q6.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q7.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q8.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q9.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q10.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q11.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q12.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q13.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q14.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q15.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q16.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q17.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q18.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q19.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q20.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q21.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q22.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q23.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q24.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q25.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q26.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q27.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q28.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q29.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q30.between'=>"El número de respuestas seleccionadas no es el indicado",
         'answer_q31.between'=>"El número de respuestas seleccionadas no es el indicado",
         'fellow_id.required' =>"Selecciona un fellow",
         'score.between'=>"Este campo debe tener un valor entre 0 y 10",
         //surveys'user_id.required'=>"Contesta esta pregunta",
         'sur_1.required'=>"Contesta esta pregunta",
         'sur_j1.required'=>"Contesta esta pregunta",
         'sur_2.required'=>"Contesta esta pregunta",
         'sur_j2.required'=>"Contesta esta pregunta",
         'sur_3_1.required'=>"Contesta esta pregunta",
         'sur_3_2.required'=>"Contesta esta pregunta",
         'sur_3_3.required'=>"Contesta esta pregunta",
         'sur_3_4.required'=>"Contesta esta pregunta",
         'sur_3_5.required'=>"Contesta esta pregunta",
         'sur_4.required'=>"Contesta esta pregunta",
         'sur_5_1.required'=>"Contesta esta pregunta",
         'sur_5_2.required'=>"Contesta esta pregunta",
         'sur_5_3.required'=>"Contesta esta pregunta",
         'sur_5_4.required'=>"Contesta esta pregunta",
         'sur_6_1.required'=>"Contesta esta pregunta",
         'sur_6_2.required'=>"Contesta esta pregunta",
         'sur_6_3.required'=>"Contesta esta pregunta",
         'sur_7_1.required'=>"Contesta esta pregunta",
         'sur_7_2.required'=>"Contesta esta pregunta",
         'sur_7_3.required'=>"Contesta esta pregunta",
         'sur_8.required'=>"Contesta esta pregunta",
         'sur_j8.required'=>"Contesta esta pregunta",
         'sur_9.required'=>"Contesta esta pregunta",
         'sur_j9.required'=>"Contesta esta pregunta",
         'sur_10.required'=>"Contesta esta pregunta",
         'sur_j10.required'=>"Contesta esta pregunta",
         'sur_11.required'=>"Contesta esta pregunta",
         'sur_j12.required'=>"Contesta esta pregunta",
         'sur_13_1.required'=>"Contesta esta pregunta",
         'sur_13_2.required'=>"Contesta esta pregunta",
         'sur_13_3.required'=>"Contesta esta pregunta",
         'sur_13_4.required'=>"Contesta esta pregunta",
         'sur_13_5.required'=>"Contesta esta pregunta",
         'sur_14_1.required'=>"Contesta esta pregunta",
         'sur_14_2.required'=>"Contesta esta pregunta",
         'sur_14_3.required'=>"Contesta esta pregunta",
         'sur_14_4.required'=>"Contesta esta pregunta",
         'sur_14_5.required'=>"Contesta esta pregunta",
         'sur_15_1.required'=>"Contesta esta pregunta",
         'sur_15_2.required'=>"Contesta esta pregunta",
         'sur_15_3.required'=>"Contesta esta pregunta",
         'sur_15_4.required'=>"Contesta esta pregunta",
         'sur_15_5.required'=>"Contesta esta pregunta",
         'sur_16_1.required'=>"Contesta esta pregunta",
         'sur_16_2.required'=>"Contesta esta pregunta",
         'sur_16_3.required'=>"Contesta esta pregunta",
         'sur_16_4.required'=>"Contesta esta pregunta",
         'sur_16_5.required'=>"Contesta esta pregunta",
         'fa_1.required'=>'Contesta esta pregunta',
         'fa_2.required'=>'Contesta esta pregunta',
         'fa_3.required'=>'Contesta esta pregunta',
         'fa_4.required'=>'Contesta esta pregunta',
         'fa_5.required'=>'Contesta esta pregunta',
         'fa_6.required'=>'Contesta esta pregunta',
         'fa_7.required'=>'Contesta esta pregunta',
         'fa_8.required'=>'Contesta esta pregunta',
         'fa_9.required'=>'Contesta esta pregunta',
         'web.url'      => 'El formato no corresponde con el de una URL válida',
         'linkedin.url'      => 'El formato no corresponde con el de una URL válida',
         'facebook.url'      => 'El formato no corresponde con el de una URL válida',
         'other.url'      => 'El formato no corresponde con el de una URL válida',
         //notice
         'hasfiles.required' => 'Este campo es requerido',
         'modality_results.required' => 'Este campo es requerido',
         'term_process.required' => 'Este campo es requerido',
         'unforeseen_cases.required' => 'Este campo es requerido',
         'contact.required' => 'Este campo es requerido',
         'profile.required' => 'Este campo es requerido',
         'profile_eligibility_general.required' => 'Este campo es requerido',
         'profile_eligibility_description.required' => 'Este campo es requerido',
         'profile_eligibility_particular.required' => 'Este campo es requerido',
         'public.required' =>'Este campo es requerido',
         'comments.required' =>'Este campo es requerido',
         'filesDataR.required' =>'Este campo es requerido',
         'filesData.*.mimes' =>'Selecciona un archivo valido (DOC, DOCX o PDF)',
         'filesData.*.max' =>'El tamaño es de 2.5MB',
         'limitNumber.required'=>'Solo se permiten dos archivos como máximo',
         'notice_id.between'   => 'Este campo es requerido',
         'measure.required'   => 'Este campo es requerido',

      ];
    }
}
