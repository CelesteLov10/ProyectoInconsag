<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'El  :attribute debe ser aceptado.',
    'accepted_if' => 'El :attribute debe aceptarse cuando :other es :value.',
    'active_url' => 'El  :attribute no es una URL válida.',
    'after' => 'El  :attribute debe ser una fecha posterior a :date.',
    'after_or_equal'       => 'El  :attribute debe ser una fecha posterior o igual a :date.',
    'alpha'                => 'El  :attribute solo puede contener letras.',
    'alpha_dash'           => 'El  :attribute solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num'            => 'El  :attribute solo puede contener letras y números.',
    'array'                => 'El  :attribute debe ser un array.',
    'before'               => 'El  :attribute debe ser una fecha anterior a :date.',
    'before_or_equal'      => 'El  :attribute debe ser una fecha anterior o igual a :date.',
    'between'              => [
        'numeric' => 'El  :attribute debe ser un valor entre :min y :max.',
        'file'    => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
        'string'  => 'El  :attribute debe contener entre :min y :max caracteres.',
        'array'   => 'El  :attribute debe contener entre :min y :max elementos.',
    ],
    'boolean' => 'El  :attribute debe ser verdadero o falso.',
    'confirmed' => 'El  confirmación de :attribute no coincide.',
    'current_password' => 'La contraseña es incorrecta.',
    'date'  => 'La  :attribute no corresponde con una fecha válida.',
    'date_equals' => 'La  :attribute debe ser una fecha igual a :date.',
    'date_format' => 'La  :attribute no corresponde con el formato de fecha :format.',
    'declined' => 'El :attribute debe rechazarse.',
    'declined_if' => 'El :attribute debe rechazarse cuando :other es :value.',
    'different' => 'Los s :attribute y :other deben ser diferentes.',
    'digits'  => 'La  :attribute debe ser número de :digits dígitos.',
    'digits_between' => 'El  :attribute debe contener entre :min y :max dígitos.',
    'dimensions' => 'El  :attribute tiene dimensiones de imagen inválidas.',
    'distinct' => 'El  :attribute tiene un valor duplicado.',
    'doesnt_end_with' => 'El :attribute no puede terminar con uno de los following: :values.',
    'doesnt_start_with' => 'El :attribute no puede comenzar con uno de los following: :values.',
    'email'                => [
        'required'=> 'El :attribute es obligatorio.',
        'El  :attribute debe ser una dirección de correo válida.'],
    'ends_with'            => 'El  :attribute debe finalizar con alguno de los siguientes valores: :values',
    'exists'               => 'El  :attribute seleccionado no existe.',
    'file'                 => 'El  :attribute debe ser un archivo.',
    'filled'               => 'El  :attribute debe tener un valor.',
    'gt'                   => [
        'numeric' => 'El  :attribute debe ser mayor a :value.',
        'file'    => 'El archivo :attribute debe pesar más de :value kilobytes.',
        'string'  => 'El  :attribute debe contener más de :value caracteres.',
        'array'   => 'El  :attribute debe contener más de :value elementos.',
    ],
    'gte'                  => [
        'numeric' => 'El  :attribute debe ser mayor o igual a :value.',
        'file'    => 'El archivo :attribute debe pesar :value o más kilobytes.',
        'string'  => 'El  :attribute debe contener :value o más caracteres.',
        'array'   => 'El  :attribute debe contener :value o más elementos.',
    ],
    'image' => 'El  :attribute debe ser una imagen.',
    'in'  => 'En el :attribute solo se permite: activo o inactivo.', //este es para el estado de actualizacion en empleado
    'in_array' => 'El  :attribute no existe en :other.',
    'integer' => 'El  :attribute debe ser un número entero.',
    'ip' => 'El  :attribute debe ser una dirección IP válida.',
    'ipv4' => 'El  :attribute debe ser una dirección IPv4 válida.',
    'ipv6'=> 'El  :attribute debe ser una dirección IPv6 válida.',
    'json' => 'El  :attribute debe ser una cadena de texto JSON válida.',
    'lt'  => [
        'numeric' => 'El  :attribute debe ser menor a :value.',
        'file'    => 'El archivo :attribute debe pesar menos de :value kilobytes.',
        'string'  => 'El  :attribute debe contener menos de :value caracteres.',
        'array'   => 'El  :attribute debe contener menos de :value elementos.',
    ],
    'lte'                  => [
        'numeric' => 'El  :attribute debe ser menor o igual a :value.',
        'file'    => 'El archivo :attribute debe pesar :value o menos kilobytes.',
        'string'  => 'El  :attribute debe contener :value o menos caracteres.',
        'array'   => 'El  :attribute debe contener :value o menos elementos.',
    ],
    'mac_address' => 'El :attribute debe ser una dirección MAC válida.',
    'max'                  => [
        'numeric' => 'El  :attribute no debe ser mayor a :max.',
        'file'    => 'El archivo :attribute no debe pesar más de :max kilobytes.',
        'string'  => 'El  :attribute no debe contener más de :max caracteres.',
        'array'   => 'El  :attribute no debe contener más de :max elementos.',
    ],
    'max_digits' => 'El :attribute no debe tener más de :max digits.',
    'mimes' => 'El  :attribute debe ser un archivo de tipo: :values.',
    'mimetypes' => 'El  :attribute debe ser un archivo de tipo: :values.',
    'min'   => [
        'numeric' => 'El  :attribute debe ser al menos :min.',
        'file'    => 'El archivo :attribute debe pesar al menos :min kilobytes.',
        'string'  => 'El  :attribute debe contener al menos :min caracteres.',
        'array'   => 'El  :attribute debe contener al menos :min elementos.',
    ],
    'min_digits' => 'El :attribute debe tener al menos dígitos :min.',
    'multiple_of' => 'El :attribute debe ser un múltiplo de :value.',
    'not_in'  => 'El  :attribute seleccionado es inválido.',
    'not_regex' => 'El formato del  :attribute es inválido.',
    'numeric' => 'La  :attribute debe contener solo números .',
    'password' => [
        'letters' => 'El :attribute debe contener al menos una letra.',
        'mixed' => 'El :attribute debe contener al menos una letra mayúscula y una minúscula.',
        'numbers' => 'El :attribute debe contener al menos un número.',
        'symbols' => 'El :attribute debe contener al menos un símbolo.',
        'uncompromised' => 'El :attribute dado ha aparecido en una fuga de datos. Elija un :attribute diferente.',
    ],
    'present' => 'El  :attribute debe estar presente.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex'                => 'El formato del  :attribute es inválido.',
    'required'             => ' :attribute es obligatorio.',
    'required_array_keys' => 'El  :attribute debe contener entradas for: :values.',
    'required_if'          => 'El  :attribute es obligatorio cuando el  :other es :value.',
    'required_unless'      => 'El  :attribute es requerido a menos que :other se encuentre en :values.',
    'required_with'        => 'El  :attribute es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El  :attribute es obligatorio cuando :values están presentes.',
    'required_without'     => 'El  :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El  :attribute es obligatorio cuando ninguno de los s :values están presentes.',
    'same'                 => 'Los s :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El  :attribute debe ser :size.',
        'file'    => 'El archivo :attribute debe pesar :size kilobytes.',
        'string'  => 'El  :attribute debe contener :size caracteres.',
        'array'   => 'El  :attribute debe contener :size elementos.',
    ],
    'starts_with'          => 'La  :attribute debe comenzar con uno de los siguientes valores: :values',
    'string'               => 'El  :attribute debe ser una cadena de caracteres.',
    'timezone'             => 'El  :attribute debe ser una zona horaria válida.',
    'unique'               => 'El valor del  :attribute ya está en uso.',
    'uploaded'             => 'El  :attribute no se pudo subir.',
    'url'                  => 'El formato del  :attribute es inválido.',
    'uuid'                 => 'El  :attribute debe ser un UUID válido.',


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'descripcion' => 'descripción',
        'telefono' => 'teléfono',
        'direccion' => 'dirección',
        'puesto_id' => 'nombre cargo', 
        'email' => 'El correo electrónico', 
        'password'=>'La contraseña'

        
    ],

];
