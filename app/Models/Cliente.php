<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public function servicios(){
        return $this->belongsToMany(Servicios::class,'clientes_services', 'cliente_id', 'servicio_id');
    }
}
