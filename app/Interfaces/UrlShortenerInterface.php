<?php

namespace App\Interfaces;

interface UrlShortenerInterface
{
    public function store(array $data);

    public function getUrl(string $url);
}
