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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // Ej: Boda de Ana y Luis
            $table->string('event_type'); // Boda, 15 Años, Corporativo
            $table->integer('guest_count')->default(0); // <-- Nuevo campo para la cantidad de invitados
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('status')->default('pending'); // pending, confirmed, cancelled
            $table->json('custom_details')->nullable(); // Aquí guardaremos: recordatorios, invitaciones, tipo buffet, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};