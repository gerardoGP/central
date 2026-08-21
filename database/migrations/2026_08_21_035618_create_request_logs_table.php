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
        Schema::create('request_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('authorized_system_id')->constrained('authorized_systems')->onDelete('cascade');
            $table->string('dni_requested', 15)->index(); // Índice para búsquedas rápidas
            $table->string('ip_address', 45);
            $table->integer('status_code');
            $table->integer('response_time_ms');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_logs');
    }
};
