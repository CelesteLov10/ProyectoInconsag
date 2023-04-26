<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        $user = User::all();
        return view('user.index',compact('user'));
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('user.edit', compact('roles'))->with('user', $user);
    }

    public function update($id, Request $request)
    {
    $this->validate($request,[  //'regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ0-9]+\s{0,1})+$/u'
        'name' => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],
        'email' => ['required','email', 'regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,8}$#','unique:users,email,'.$id.'id'],
        'profile_image' => ['max:2048'],
    ],[
        'name.required' => 'El nombre del usuario es obligatorio, no puede estar vacío.',
        'name.regex' => 'El nombre debe iniciar con mayúscula y solo permite un espacio entre ellos.',

        'email.required' => 'El correo electrónico es obligatorio, no puede estar vacío.',
        'email.unique' => 'El correo electrónico ya está en uso.',
        'email.email' => 'Debe ingresar un correo electrónico válido.',
    ]);

    $user = User::findOrFail($id);

     // Verificar si se proporcionó una nueva imagen
        if ($request->hasFile('profile_image')) {
        // Eliminar la imagen anterior si existe 
        if ($user->profile_image && file_exists(public_path('storage/profile_images/' . $user->profile_image))) {
            unlink(public_path('storage/profile_images/' . $user->profile_image));
        }

        // Guardar la nueva imagen
        $image = $request->file('profile_image');
        $filename = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('storage/profile_images/'), $filename);

        // Actualizar la ruta de la imagen en la base de datos
        $user->profile_image = $filename;
    }

    $user->update([
        'name' => $request->name,
        'email' => $request->email
    ]);

    $user->syncRoles([$request->rol]);
    $user->save();

    return redirect()->route('user.index')->with('mensajeW', 'Usuario actualizado con éxito');
    }
}
