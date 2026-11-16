<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorizedSystem extends Model
{
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
