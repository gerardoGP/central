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
        Schema::create('authorized_systems', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identifier')->unique(); // Para uso interno
            $table->boolean('is_active')->default(true);
            $table->json('allowed_ips')->nullable(); // Lista de IPs permitidas
            $table->integer('rate_limit')->default(60); // Peticiones por minuto
            $table->softDeletes(); // Para mantener historial aunque se "borre"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authorized_systems');
    }
};
