<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $servicios = new Servicios;
        $servicios->nombre = $request->nombre;
        $servicios->ubicacion = $request->ubicacion;
        $servicios->clima = $request->clima;
        $servicios->descripcion = $request->descripcion;
        $servicios->horario = $request->horario;
        $servicios->imagen = $request->imagen;
        $servicios->costo = $request->costo;
        $servicios->descuento = $request->descuento;
        $data = [
            'message' => 'Servicio creado con exito',
            'cliente' => $servicios
        ];
        $servicios->save();

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicios $servicios)
    {
        //
        return response()->json($servicios);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicios $servicios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servicios $servicios)
    {
        $servicios->nombre = $request->nombre;
        $servicios->ubicacion = $request->ubicacion;
        $servicios->clima = $request->clima;
        $servicios->descripcion = $request->descripcion;
        $servicios->horario = $request->horario;
        $servicios->imagen = $request->imagen;
        $servicios->costo = $request->costo;
        $servicios->descuento = $request->descuento;
        $data = [
            'message' => 'Servicio actualizado con exito',
            'cliente' => $servicios
        ];
        $servicios->save();

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicios $servicios)
    {
        $servicios->delete();
        $data = [
            'message' => 'Cliente eliminado con exito',
            'cliente' => $servicios
        ];
        
        return response()->json($data);
    }
    public function clientes(Request $request){
        $servi = Servicios::find($request->servicio_id);
        $clientes = $servi->clientes;
        $data = [
            'message' => 'Clientes',
            'clientes' => $clientes
        ];
        return response()->json($data);

    }
}
