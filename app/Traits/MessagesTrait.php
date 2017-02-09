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
        'email.unique'   => 'El correo debe ser único en el sistema',

      ];
    }
}
