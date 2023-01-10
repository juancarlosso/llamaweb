<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;

class ClienteController extends Controller
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
        $clientes = Cliente::orderBy('nombre')
                    ->paginate(config('constantes.itemsPorPagina'));
        return view('clientes.index')->with('clientes',$clientes);
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
        return view('clientes.create');
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function store(ClienteRequest $request)
    {
        $cliente = Cliente::create($request->all());
        return redirect()->route('clientes.index')->with('success','El cliente ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit')->with('cliente',$cliente);
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function update(ClienteRequest $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());
        return redirect()->route('clientes.index')->with('success','El cliente ha sido actualizado');
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')
                ->with('success','El cliente ha sido eliminado');
    }
}
