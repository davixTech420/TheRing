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
       
 Schema::create('salons', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nombre del salón
        $table->text('description')->nullable(); // Descripción detallada
        $table->integer('capacity')->default(0); // Capacidad de personas
        $table->decimal('price', 10, 2)->default(0); // Precio base de alquiler
        $table->json('images')->nullable(); // Rutas de las fotos en galería
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salons');
    }
};
