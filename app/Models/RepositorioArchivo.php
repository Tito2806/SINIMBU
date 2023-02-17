<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepositorioArchivo extends Model
{


    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'autor',
        'titulo',
        'descripcion',
        'TipodeArchivo',
        'documento',
        'fecha',
    ];

}
