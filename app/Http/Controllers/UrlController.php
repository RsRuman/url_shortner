<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\Http\Requests\UrlInputRequest;
use App\Interfaces\UrlShortenerInterface;
use App\Traits\Shortener;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Contracts\View\View;

#[AllowDynamicProperties]
class UrlController extends Controller
{
    use Shortener;

    public function __construct(UrlShortenerInterface $urlShortenerRepository)
    {
        $this->urlShortenerRepository = $urlShortenerRepository;
    }

    public function index(): View
    {
        return view('home');
    }

    public function createShortUrl(UrlInputRequest $request): RedirectResponse
    {
        $data = $request->validated();

        # Store original url
        $url = $this->urlShortenerRepository->store($data);

        # Get unique string for short url
        $shortUrl = $this->base62_encode($url->id);

        # Update the original url with short url
        $updateUrl = $this->urlShortenerRepository->updateUrl($url, $shortUrl);

        if (!$updateUrl) {
            return redirect()->back()->with('error', 'Something goes wrong. Please try again later.')->setStatusCode(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        return redirect()->route('shortener.show', ['id' => $url->id])->with('success', 'URL shorted successfully.')->setStatusCode(HttpResponse::HTTP_CREATED);
    }

    public function show($id): View
    {
        $url = $this->urlShortenerRepository->getUrlById($id);

        return view('show', compact('url'));
    }
}
