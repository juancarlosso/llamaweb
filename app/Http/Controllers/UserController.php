<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function index()
    {
        $usuarios = User::orderBy('name')
                    ->paginate(config('constantes.itemsPorPagina'));
        return view('usuarios.index')->with('usuarios',$usuarios);
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function create()
    {
        return view('usuarios.create');
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function store(UserRequest $request)
    {        
        $usuario = User::create($request->all());
        $usuario->password = bcrypt($request->password);
        $usuario->save();
        return redirect()->route('usuarios.index')->with('success','El usuario ha sido creado');
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.edit')->with('usuario',$usuario);
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function update(UserRequest $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->update($request->all());
        return redirect()->route('usuarios.index')->with('success','El usuario ha sido actualizado');
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function destroy(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuarios.index')
                ->with('success','El usuario ha sido eliminado');
    }
}
