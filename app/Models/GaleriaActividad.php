<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriaActividad extends Model
{

    public $table = 'galeriaactividads';
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'titulo',
        'descripcion',
        'fecha',
        'categoriaImg',
        'imagen',
    ];

}
