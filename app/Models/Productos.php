<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $table = 'productos'; // Especifica el nombre de la tabla.

    protected $fillable = ['nombre', 'descripcion', 'precio', 'cantidad']; // Campos que pueden ser llenados de manera masiva.
}
