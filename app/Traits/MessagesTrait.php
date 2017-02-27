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
        'cv.required' => 'El CV es requerido',
        'cv.file'     => 'El archivo debe ser válido',
        'cv.mimes'    => 'El archivo debe ser del tipo requerido (Archivo Word o PDF)',
        'cv.max'      => 'El archivo no puede ser mayor a 2MB',
        'essay.required' => 'El ensayo es requerido',
        'essay.file'     => 'El archivo debe ser válido',
        'essay.mimes'    => 'El archivo debe ser del tipo requerido (Archivo Word o PDF)',
        'essay.max'      => 'El archivo no puede ser mayor a 2MB',
        'video.required' => 'El enlace es requerido'
      ];
    }
}
