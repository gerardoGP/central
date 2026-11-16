<?php

namespace App\Jobs;

use App\Models\AuthorizedSystem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Sleep;

class NotificarCorreoBienvenida implements ShouldQueue
{
    use Queueable;
    protected $authorizeSystem;
    /**
     * Create a new job instance.
     */
    public function __construct(AuthorizedSystem $authorizeSystem)
    {
        $this->authorizeSystem = $authorizeSystem;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Iniciando generación de documentos para la matrícula ID: {$this->authorizeSystem->id}");

        // --- SIMULACIÓN DE RETRASO (30 segundos) ---
        sleep(30);
        // ------------------------------------------

        Log::info("¡PDFs generados y correo enviado con éxito!");
    }
}
