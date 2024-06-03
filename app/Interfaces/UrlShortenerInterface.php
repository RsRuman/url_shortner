<?php

namespace App\Interfaces;

use App\Models\Url;
use Illuminate\Database\Eloquent\Model;

interface UrlShortenerInterface
{
    public function store(array $data): mixed;

    public function getUrlById(int $id): Model;

    public function updateUrl(Url $url, string $shortUrl): bool;
}
