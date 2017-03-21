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

        //Archivos
        'cv.required' => 'El Perfil Curricular es requerido',
        'cv.file'     => 'El archivo debe ser válido',
        'cv.mimes'    => 'El archivo debe ser del tipo requerido (Archivo Word o PDF)',
        'cv.max'      => 'El archivo no puede ser mayor a 2MB',
        'essay.required' => 'El ensayo es requerido',
        'essay.file'     => 'El archivo debe ser válido',
        'essay.mimes'    => 'El archivo debe ser del tipo requerido (Archivo Word o PDF)',
        'essay.max'      => 'El archivo no puede ser mayor a 2MB',
        'letter.required' => 'La carta membretada es requerida',
        'letter.file'     => 'El archivo debe ser válido',
        'letter.mimes'    => 'El archivo debe ser del tipo requerido (Archivo Word o PDF)',
        'letter.max'      => 'El archivo no puede ser mayor a 2MB',
        'proof.required' => 'El comprobante de domicilio es requerido',
        'proof.file'     => 'El archivo debe ser válido',
        'proof.mimes'    => 'El archivo debe ser del tipo requerido (Archivo Word o PDF)',
        'proof.max'      => 'El archivo no puede ser mayor a 2MB',
        'privacy.required' => 'El comprobante de domicilio es requerido',
        'privacy.file'     => 'El archivo debe ser válido',
        'privacy.mimes'    => 'El archivo debe ser del tipo requerido (Archivo Word o PDF)',
        'privacy.max'      => 'El archivo no puede ser mayor a 2MB',
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
      ];
    }
}
