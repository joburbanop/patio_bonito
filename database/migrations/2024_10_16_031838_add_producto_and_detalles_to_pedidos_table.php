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
        Schema::table('pedidos', function (Blueprint $table) {
            // Agregar columnas para producto, cantidad y precio
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');  
            $table->integer('cantidad');
            $table->decimal('precio', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn(['producto_id', 'cantidad', 'precio']);
        });
    }
};