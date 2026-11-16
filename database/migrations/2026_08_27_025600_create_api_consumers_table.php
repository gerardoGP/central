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
        Schema::create('api_consumers', function (Blueprint $table) {
           $table->id();
            // Relación con la tabla de Passport (ajusta el tipo si usas UUID en Passport)
            $table->uuid('client_id')->unique();
            $table->string('system_name');
            $table->string('ip_address')->nullable()->comment('Dejar null para permitir cualquier IP');
            $table->integer('rate_limit')->default(60)->comment('Consultas por minuto');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('oauth_clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_consumers');
    }
};
