<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Passport\Client;
class ApiConsumer extends Model
{
    protected $fillable = [
        'client_id',
        'system_name',
        'ip_address',
        'rate_limit',
    ];

    public function passportClient(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
