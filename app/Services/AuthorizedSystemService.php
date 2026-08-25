<?php
namespace App\Services;
use App\Models\AuthorizedSystem;

interface AuthorizedSystemService{
    public function createSystem(array $data): AuthorizedSystem;
}