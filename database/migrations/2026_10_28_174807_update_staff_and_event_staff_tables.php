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
        // 1. Agregar email a staff si no existe
        if (Schema::hasTable('staff') && !Schema::hasColumn('staff', 'email')) {
            Schema::table('staff', function (Blueprint $table) {
                $table->string('email')->nullable()->after('phone');
            });
        }

        // 2. Agregar columnas de confirmación y token a event_staff
        if (Schema::hasTable('event_staff')) {
            Schema::table('event_staff', function (Blueprint $table) {
                if (!Schema::hasColumn('event_staff', 'status')) {
                    $table->string('status')->default('pending')->after('staff_id'); // pending, confirmed, declined
                }
                if (!Schema::hasColumn('event_staff', 'confirmation_token')) {
                    $table->string('confirmation_token', 64)->nullable()->unique()->after('status');
                }
                if (!Schema::hasColumn('event_staff', 'confirmed_at')) {
                    $table->timestamp('confirmed_at')->nullable()->after('confirmation_token');
                }
                if (!Schema::hasColumn('event_staff', 'notes')) {
                    $table->text('notes')->nullable()->after('confirmed_at');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('staff') && Schema::hasColumn('staff', 'email')) {
            Schema::table('staff', function (Blueprint $table) {
                $table->dropColumn('email');
            });
        }

        if (Schema::hasTable('event_staff')) {
            Schema::table('event_staff', function (Blueprint $table) {
                $table->dropColumn(['status', 'confirmation_token', 'confirmed_at', 'notes']);
            });
        }
    }
};
