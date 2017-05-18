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
         'parent_id.required' => 'Este campo es requerido',
         //forum
         'topic.required' => 'Este campo es requerido',
         'topic.max' => 'Este campo debe contener 256 caracteres como máximo',
         'topic.unique' => 'Este elemento ya está en uso. Selecciona uno diferente',
         //news
         'content.required' => 'Este campo es requerido',
      ];
    }
}
