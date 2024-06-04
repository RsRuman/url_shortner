<?php

namespace App\Interfaces;

use App\Models\Url;
use Illuminate\Database\Eloquent\Model;

interface UrlShortenerInterface
{
    public function store(array $data): mixed;

    public function getUrlById(int $id): Model|null;

    public function updateUrl(Url $url, string $shortUrl): bool;

    public function findUrlByShort(string $url): Model|null;
}
