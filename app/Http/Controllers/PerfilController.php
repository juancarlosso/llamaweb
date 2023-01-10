<?php

namespace App\Http\Controllers;

use App\Models\User;

use Hash;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function show()
    {
        return view('perfil.show');
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function update(Request $request,$id)
    {
        $usuario = User::findOrFail($id);
        $usuario->name = $request->name;
        if($request->password){
            if(strlen(trim($request->password))<6){
               return back()->withInput()->with('error','El password debe tener al menos 6 caracteres') ;
            }
            if(trim($request->password)!=trim($request->password_confirmation)){
               return back()->withInput()->with('error','El password y la confirmación deben ser iguales') ;
            }
            $usuario->password = Hash::make(trim($request->password));
        }
        if($request->password_confirmation && !$request->password){
            return back()->withInput()->with('error','Te faltó capturar el password') ;
        }
        $usuario->save();
        return redirect()->route('perfil.show')->with('success','Tu perfil fue actualizado');
    }
}
