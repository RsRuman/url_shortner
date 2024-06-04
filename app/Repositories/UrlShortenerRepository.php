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

    /**
     * Get url by id
     * @param int $id
     * @return Model|null
     */
    public function getUrlById(int $id): Model|null
    {
        return Url::query()->findOrFail($id);
    }

    /**
     * Update url (short url insert)
     * @param Url $url
     * @param string $shortUrl
     * @return bool
     */
    public function updateUrl(Url $url, string $shortUrl): bool
    {
        return $url->update([
            'short_url' => $shortUrl
        ]);
    }

    /**
     * Find url by short_url
     * @param string $url
     * @return Model|null
     */
    public function findUrlByShort(string $url): Model|null
    {
        return Url::query()->where('short_url', $url)->first();
    }
}
