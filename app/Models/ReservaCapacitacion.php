<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservaCapacitacion extends Model
{
    use HasFactory;
    public $fillable = ['idCapacitacion', 'nombre', 'apellido1', 'apellido2', 'celular', 'email'];
}
