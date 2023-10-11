<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicios = Servicios::all();
        $array = [];
        foreach ($servicios as $servicio){
            $array[] = [
                'id' => $servicio->id,
                'nombre' => $servicio->nombre,
                'ubicacion' => $servicio->ubicacion,
                'clima' => $servicio->clima,
                'descripcion' => $servicio->descripcion,
                'horario' => $servicio->horario,
                'imagen' => $servicio->imagen,
                'costo' => $servicio->costo,
                'descuento' => $servicio->descuento,
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
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'ubicacion' => 'required|max:20',
            'clima' => 'required',
            'descripcion' => 'required',
            'horario' => 'required',
            'imagen' => 'required',
            'costo' => 'required',
            'descuento' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Error de validación', 'errors' => $validator->errors()], 422);
        }

        $cliente = Servicios::create([
            'nombre' => $request->input('nombre'),
            'ubicacion' => $request->input('ubicacion'),
            'clima' => $request->input('clima'),
            'descripcion' => $request->input('descripcion'),
            'horario' => $request->input('horario'),
            'imagen' => $request->input('imagen'),
            'costo' => $request->input('costo'),
            'descuento' => $request->input('descuento'),
        ]);     

        return response()->json([
            'message' => 'Lugar registrado con éxito',
            'data' => $cliente,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $servicio = Servicios::find($id);

        if (!$servicio) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }
        return response()->json($servicio);
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
    public function update($id)
    {
        $servicio = Servicios::find($id);
        if (!$servicio) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }
        $servicio->descripcion = request('descripcion');
        $servicio->descuento = request('descuento');

        $servicio->save();
    
        return response()->json(['message' => 'Servicio actualizado con éxito', 'servicio' => $servicio]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $servicio = Servicios::find($id);

        if (!$servicio) {
            return response()->json(['message' => 'El servicio no se encontró'], 404);
        }
        $servicio->delete();
        return response()->json(['message' => 'El servicio se eliminó con éxito']);
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
    public function pivot(Request $request){
        $user = $request->input('user');
        $lugar = $request->input('lugar');

        
        return response()->json(['message' => 'Datos recibidos y procesados correctamente en la API']);
    }
}
