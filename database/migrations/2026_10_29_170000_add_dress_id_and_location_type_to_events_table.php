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
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('dress_id')->nullable()->after('guest_count')->constrained('dresses')->nullOnDelete();
            $table->string('location_type')->default('the_ring'); // 'the_ring', 'external_the_ring', 'client_location'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['dress_id']);
            $table->dropColumn(['dress_id', 'location_type']);
        });
    }
};

