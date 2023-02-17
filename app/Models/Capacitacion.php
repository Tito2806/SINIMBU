<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capacitacion extends Model
{
    use HasFactory;
    public $fillable = ['nombre', 'modalidad', 'horario', 'hora', 'tema'];
}
