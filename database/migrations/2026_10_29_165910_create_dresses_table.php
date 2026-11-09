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
        Schema::create('dresses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('boda'); // 'boda', '15_anos', 'ambos'
            $table->string('silhouette')->nullable(); // princesa, sirena, linea_a, vanguardista, corte_a, imperio
            $table->string('color')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->json('images')->nullable();
            $table->text('description')->nullable();
            $table->json('sizes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dresses');
    }
};
