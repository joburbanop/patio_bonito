<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoInventario extends Model
{
    use HasFactory;

    protected $fillable = ['producto_id', 'cantidad', 'tipo', 'motivo'];

    
    
 
    public function getTipoMovimientoAttribute()
    {
        return $this->tipo === 'entrada' ? 'Entrada' : 'Salida';
    }

    public function productos()
    {
        return $this->belongsTo(Productos::class, 'producto_id');
    }

    protected static function booted()
    {
        static::saving(function ($movimiento) {
            $producto = $movimiento->productos;

            if ($movimiento->tipo === 'entrada') {
                
                $producto->cantidad += abs($movimiento->cantidad);
            } elseif ($movimiento->tipo === 'salida') {
               
                $producto->cantidad -= abs($movimiento->cantidad);
            }

         
            $producto->save();
        });
    }


}
