<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsteriskRequest;
use App\Models\Asterisk;
use Illuminate\Http\Request;

class AsteriskController extends Controller
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
        $servidores = Asterisk::orderBy('descripcion')
                    ->paginate(config('constantes.itemsPorPagina'));
        return view('asterisk.index')->with('servidores',$servidores);
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
        return view('asterisk.create');
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function store(AsteriskRequest $request)
    {
        $asterisk = Asterisk::create($request->all());
        return redirect()->route('asterisk.index')->with('success','El Servidor Asterisk ha sido creado');
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function edit(Asterisk $asterisk)
    {
        return view('asterisk.edit')->with('asterisk',$asterisk);
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function update(AsteriskRequest $request, Asterisk $asterisk)
    {
        $asterisk->update($request->all());
        return redirect()->route('asterisk.index')->with('success','El Servidor Asterisk ha sido actualizado');
    }

   /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function destroy(Asterisk $asterisk)
    {
        $asterisk->delete();
        return redirect()->route('asterisk.index')
                ->with('success','El Servidor Asterisk ha sido eliminado');
    }
}
