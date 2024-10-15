<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movimiento_inventarios', function (Blueprint $table) {
            $table->id();  
            $table->foreignId('producto_id')  
                ->constrained('productos')  
                ->onDelete('cascade')  
                ->onUpdate('cascade');  
            $table->integer('cantidad');  
            $table->enum('tipo', ['entrada', 'salida']);  
            $table->text('motivo')->nullable();  
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimiento_inventarios');
    }
};