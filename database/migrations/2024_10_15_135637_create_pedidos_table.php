<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mesa_id')->constrained('mesas')->onDelete('cascade');  
            $table->enum('estado', ['pendiente', 'preparando', 'listo', 'entregado'])->default('pendiente');  
            $table->timestamps();
        });
    }

  
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
