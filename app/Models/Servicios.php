<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    use HasFactory;
    public function clientes(){
        return $this->belongsToMany(User::class,'clientes_services','servicio_id');
    }

    protected $fillable = [
        'nombre',
        'ubicacion',
        'clima',
        'descripcion',
        'horario',
        'imagen',
        'costo',
        'descuento'
    ];
}
