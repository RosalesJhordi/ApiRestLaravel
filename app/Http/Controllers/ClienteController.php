<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clientes = User::all();
        $array = [];
        foreach ($clientes as $client){
            $array[] = [
                'id' => $client->id,
                'name' => $client->name,
                'apellidos' => $client->apellidos,
                'telefono' => $client->telefono,
                'email' => $client->email,
                'password' => $client->password,
                'servicios' => $client->servicios,
            ];
        }
        //return $clientes to json response
        return response()->json($array);
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
        $cliente = new User;
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
    public function show(User $cliente)
    {
        $data =[
            'message' => 'detalles de cliente',
            'cliente' => $cliente,
            'servicios' => $cliente->servicios
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $cliente)
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
    public function destroy(User $cliente)
    {
        //
        $cliente->delete();
        $data = [
            'message' => 'Cliente eliminado con exito',
            'cliente' => $cliente
        ];
        
        return response()->json($data);
    }

    public function attach(Request $request){
        $cliente = User::find($request->cliente_id);
        $cliente->servicios()->attach($request->servicio_id);
    
        $data = [
            'message' => 'Servicio adjuntado',
            'cliente' => $cliente
        ];
    
        return response()->json($data);
    }
    public function detach(Request $request){
        $cliente = User::find($request->cliente_id);
        $cliente->servicios()->detach($request->servicio_id);
    
        $data = [
            'message' => 'Servicio quitado',
            'cliente' => $cliente
        ];
    
        return response()->json($data);
    }
}
