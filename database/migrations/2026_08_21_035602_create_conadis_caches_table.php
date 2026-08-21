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
        Schema::create('conadis_caches', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 15)->unique(); // Un DNI = Una respuesta válida
            $table->json('payload'); // Respuesta completa de CONADIS
            $table->timestamp('expires_at')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conadis_caches');
    }
};
