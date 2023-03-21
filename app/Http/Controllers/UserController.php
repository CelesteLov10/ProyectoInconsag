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
    $this->validate($request,[
        'name' => ['required','regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ0-9]+\s{0,1})+$/u',],
        'email' => ['required','email', 'unique:users,email,'.$id.'id'],
    ],[
        'name.required' => 'El nombre del usuario es obligatorio, no puede estar vacío.',
        'name.regex' => 'El nombre del usuario no permite ni símbolos.',

        'email.required' => 'El correo electrónico es obligatorio, no puede estar vacío.',
        'email.unique' => 'El correo electrónico ya está en uso.',
    ]);

    $user = User::findOrFail($id);
    $user->update([
        'name' => $request->name,
        'email' => $request->email
    ]);

    $user->syncRoles([$request->rol]);
    return redirect()->route('user.index')->with('mensajeW', 'Usuario actualizado con éxito');
}
}
