<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:25','regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ0-9_.]+\s{0,1})+$/u'],
            'email' => ['required', 'string', 'email','regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,8}$#', 'max:60', 'unique:users',],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,50}$/'],
        ],[

            'name.required'=>'Debe ingresar el nombre, no debe ir vacío.',
            'name.string' => 'El número de identidad debe tener 13 dígitos. ',
            'name.max' => 'El número máximo de caracteres es de 25.',
            'name.regex' => 'El nombre de usuario solo puede contener guiones bajos y puntos.',

            'email.required' => 'El correo es obligatorio, no debe ir vacío.',
            'email.max' => 'El máximo de caracteres es de 60.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.regex' => 'Debe ingresar un correo electrónico válido.',

            'password.required' => 'La contraseña debe contener al menos 8 caracteres.',
            'password.min' => 'Las contraseñas debe contener minímo 8 caracteres.',
            'password.confirmed' => 'Las contraseñas deben de coincidir.',
            'password.regex' => 'La contraseña debe contener letras mayúsculas y minúsculas, números y caracteres especiales.',
            

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
