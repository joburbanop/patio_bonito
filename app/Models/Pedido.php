<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'mesa_id',
        'estado',
        'producto_id',
        'cantidad',
        'precio',
    ];

    protected $primaryKey = 'id';

    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }

    public function productos()
    {
        return $this->belongsTo(Productos::class, 'producto_id');
    }
    
}
