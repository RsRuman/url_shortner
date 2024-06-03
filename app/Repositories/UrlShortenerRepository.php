<?php

namespace App\Repositories;

use App\Interfaces\UrlShortenerInterface;
use App\Models\Url;
use Illuminate\Database\Eloquent\Model;

class UrlShortenerRepository implements UrlShortenerInterface
{
    /**
     * Store original url
     * @param array $data
     * @return mixed
     */
    public function store(array $data): mixed
    {
        return Url::create($data);
    }

    public function getUrlById(int $id): Model
    {
        return Url::query()->findOrFail($id);
    }

    public function updateUrl(Url $url, string $shortUrl): bool
    {
        return $url->update([
            'short_url' => $shortUrl
        ]);
    }
}
