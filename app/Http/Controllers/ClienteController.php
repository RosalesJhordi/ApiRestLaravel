<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clientes = Cliente::all();
        //return $clientes to json response
        return response()->json($clientes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $cliente = new Cliente;
        $cliente->name = $request->name;
        $cliente->apellidos = $request->apellidos;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->password = $request->password;
        $data = [
            'message' => 'Cliente creado con exito',
            'cliente' => $cliente
        ];
        $cliente->save();

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
        // $cliente = Cliente::find($cliente->id);
        // if(!$cliente){
        //     return response()->json([
        //         'message' => 'El cliente no existe'
        //     ]);
        // }
        return response()->json($cliente);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $cliente->name = $request->name;
        $cliente->apellidos = $request->apellidos;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->password = $request->password;
        $cliente->save();
        $data = [
            'message' => 'Cliente actualizado con exito',
            'cliente' => $cliente
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
        $cliente->delete();
        $data = [
            'message' => 'Cliente eliminado con exito',
            'cliente' => $cliente
        ];
        
        return response()->json($data);
    }
}
