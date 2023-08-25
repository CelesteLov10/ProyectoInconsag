<?php
        /*
        |--------------------------------------------------------------------------
        |  Elaboradas por Sucelinda Valladares Flores
        |--------------------------------------------------------------------------
        */
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;


class RegisterControllerTest extends TestCase
{
        /*
        |--------------------------------------------------------------------------
        |  Pruebas para Register
        |--------------------------------------------------------------------------
        */

        // Validación de la ruta create con el metodo get de register
        public function test_Validar_ruta_register()
        {
            $response = $this->get('/register');
            $response->assertStatus(200);
        }

        // Validación de la ruta create con el metodo get de register invalido
        public function test_Validar_ruta_register_invalida(){
            $response = $this->get('/register/555555');
            $response->assertStatus(404);
        }

        // validar que se agregue un nuevo usuario
        public function test_Validar_registro_nuevo_usuario(){
            $response = $this->post('/register',
            [
                'name' => 'Dasha',
                'email' => 'dasha2@gmail.com',
                'password' => 'Dary1234@',
                'password_confirmation' => 'Dary1234@',
                'profile_image' => 'A.png'
            ]
            );
            // Traerme la resercacion que supuestamente se registro
            $user = User::where('name','=','Dasha')->get();
            // comprueba si me trajo la resercacion, con la funcion count cuenta los registros si es 1 esque si lo registro
            $this->assertTrue(  count($user) == 1 );
        }

        // validar que no se agregue un nuevo usuario con los datos vacios 
        public function test_Validar_registro_nuevo_usuario_datos_vacios(){
            $response = $this->post('/register',[
                'name' => '',
                'email' => '',
                'password' => '',
                'password_confirmation' => '',
                'profile_image' => '',
            ]);
            $response->assertSessionHasErrors(['name']); // Verifica que haya error de validación
            $response->assertSessionHasErrors(['email']); // Verifica que haya error de validación
            $response->assertSessionHasErrors(['password']); // Verifica que haya error de validación
            $response->assertSessionHasErrors(['profile_image']); // Verifica que haya error de validación
        }

        // validar que no se agregue un nuevo usuario con en el name vacio 
        public function testRegistroUsuarioConNameVacio(){
                $response = $this->post('/register',[
                    'name' => '',
                    'email' => 'jesus@gmail.com',
                    'password' => 'Jesus@12',
                    'password_confirmation' => 'Jesus@12',
                    'profile_image' => 'FTP_cable.jpg',
                ]);
                $response->assertSessionHasErrors(['name']); // Verifica que haya error de validación
        }

        // validar que no se agregue un nuevo usuario con en el email vacio 
        public function testRegistroUsuarioConEmailVacio(){
            $response = $this->post('/register',[
                'name' => 'Rocio Cruz',
                'email' => '',
                'password' => 'Jesus@12',
                'password_confirmation' => 'Jesus@12',
                'profile_image' => 'FTP_cable.jpg',
            ]);
            $response->assertSessionHasErrors(['email']); // Verifica que haya error de validación
        }

        // validar que no se agregue un nuevo usuario con en el email vacio 
        public function testRegistroUsuarioConPasswordVacio(){
            $response = $this->post('/register',[
                'name' => 'Rocio Cruz',
                'email' => 'rocio@gmail.com',
                'password' => '',
                'password_confirmation' => 'Jesus@12',
                'profile_image' => 'FTP_cable.jpg',
            ]);
            $response->assertSessionHasErrors(['password']); // Verifica que haya error de validación
        }

        // validar que no se agregue un nuevo usuario con en el password_confirmation vacio 
        public function testRegistroUsuarioConPasswordConfirmationVacio(){
            $response = $this->post('/register',[
                'name' => 'Rocio Cruz',
                'email' => 'rocio@gmail.com',
                'password' => 'Jesus@12',
                'password_confirmation' => '',
                'profile_image' => 'FTP_cable.jpg',
            ]);
            $response->assertStatus(302);
        }

        // validar que no se agregue un nuevo usuario con en el profile_image vacio 
        public function testRegistroUsuarioConProfileImageVacio(){
            $response = $this->post('/register',[
                'name' => 'Rocio Cruz',
                'email' => 'rocio@gmail.com',
                'password' => 'Jesus@12',
                'password_confirmation' => 'Jesus@12',
                'profile_image' => '',
            ]);
            $response->assertSessionHasErrors(['profile_image']); // Verifica que haya error de validación
        }

        // validar que se no agregue un nuevo usuario con en el name Excediendo el Maximo de Caracteres
        public function testRegistroUsuarioConNameExcediendoMaximoCaracteres(){
            $response = $this->post('/register',[
                'name' => str_repeat('J', 30), 
                'email' => 'rocio@gmail.com',
                'password' => 'Jesus@12',
                'password_confirmation' => 'Jesus@12',
                'profile_image' => 'suce.png',
            ]);
            $response->assertSessionHasErrors(['name']); // Verifica que haya error de validación
        }

        // validar que no se agregue un nuevo usuario con en el name no comienza con mayuscula
        public function testRegistroUsuarioConNameNoComenzandoConMayuscula(){
            $response = $this->post('/register', [
                'name' => 'alejandro murillo', // No comienza con mayúscula
                'email' => 'alejandro@example.com',
                'password' => 'Alejandro@12',
                'password_confirmation' => 'Alejandro@12',
            ]);
            $response->assertSessionHasErrors(['name']); // Verifica el error de validación en el campo 'name'
        }

        // validar que no se agregue un nuevo usuario con en el name no permita doble espacio
        public function testRegistroUsuarioConNameConDobleEspacio(){
            $response = $this->post('/register', [
                'name' => 'Alejandro  Murillo', // Contiene doble espacio
                'email' => 'alejandro@example.com',
                'password' => 'Alejandro@12',
                'password_confirmation' => 'Alejandro@12',
            ]);
            $response->assertSessionHasErrors(['name']); // Verifica el error de validación en el campo 'name'
        }

        // validar que no se agregue un nuevo usuario con en el email Excediendo el Maximo de Caracteres
        public function testRegistroUsuarioConEmailExcediendoMaximoCaracteres(){
            $response = $this->post('/register',[
                'name' => 'Alejandro Murillo', 
                'email' => str_repeat('rocio@gmail.com', 65),
                'password' => 'Jesus@12',
                'password_confirmation' => 'Jesus@12',
                'profile_image' => 'suce.png',
            ]);
            $response->assertSessionHasErrors(['email']); // Verifica que haya error de validación
        }

        // validar que no se agregue un nuevo usuario con en el email repetido
        public function testRegistroUsuarioConEmailRepetido(){
            // Crea un usuario en la base de datos directamente sin usar factory
            User::create([
                'name' => 'Dasha',
                'email' => 'valeria@gmail.com',
                'password' => bcrypt('Dary1234@'),
                'password_confirmation' => bcrypt('Dary1234@'),
                'profile_image' => 'A.png',
            ]);

            $response = $this->post('/register', [
                'name' => 'Valeria',
                'email' => 'valeria@gmail.com', // Correo repetido
                'password' => 'Valeria1234@',
                'password_confirmation' => 'Valeria1234@',
                'profile_image' => 'A.png',

            ]);
            $response->assertSessionHasErrors(['email']); // Verifica el error de validación en el campo 'email'
        }

        // validar que no se agregue un nuevo usuario con en el email invalido
        public function testRegistroUsuarioConCampoEmailValido(){
            $response = $this->post('/register', [
                'name' => 'Valeria',
                'email' => 'valery@', // Ingresa un correo inválido
                'password' => 'Valeria1234@',
                'password_confirmation' => 'Valeria1234@',
                'profile_image' => 'A.png',
            ]);
            $response->assertSessionHasErrors(['email']); // Verifica el error de validación en el campo 'email'
        }

        // validar que no se agregue un nuevo usuario con en el email 
        // que no cumple con el requisito mínimo de longitud
        public function testRegistroUsuarioConLongitudMinimaEnPassword(){
            $response = $this->post('/register', [
                'name' => 'Valeria',
                'email' => 'valery1@gmail.com', 
                'password' => 'abc123', // Contraseña que no cumple con el requisito mínimo de longitud
                'password_confirmation' => 'abc123',
                'profile_image' => 'A.png',
            ]);
            $response->assertSessionHasErrors(['password']); // Verifica el error de validación en el campo 'password'
        }

        // validar que no se agregue un nuevo usuario con en el password 
        // que no cumple con el requisito de complejidad
        public function testRegistroUsuarioConPasswordSimple(){
            $response = $this->post('/register', [
                'name' => 'Valeria',
                'email' => 'valery1@gmail.com', 
                'password' => '12345678vs', // Contraseña que no cumple con los requisitos de complejidad
                'password_confirmation' => '12345678vs',
                'profile_image' => 'A.png',
            ]);
            $response->assertSessionHasErrors(['password']); // Verifica el error de validación en el campo 'password'
        }
}
