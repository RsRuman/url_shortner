<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\Http\Requests\UrlInputRequest;
use App\Interfaces\UrlShortenerInterface;
use App\Traits\Shortener;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Contracts\View\View;
use Random\RandomException;

#[AllowDynamicProperties]
class UrlController extends Controller
{
    use Shortener;

    public function __construct(UrlShortenerInterface $urlShortenerRepository)
    {
        $this->urlShortenerRepository = $urlShortenerRepository;
    }

    /**
     * Home or Landing page
     * @return View
     */
    public function index(): View
    {
        return view('home');
    }

    /**
     * Create short url and store in database
     * @param UrlInputRequest $request
     * @return RedirectResponse
     * @throws RandomException
     */
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

    /**
     * Showing short url result
     * @param Request $request
     * @return View
     */
    public function show(Request $request): View
    {
        if ($request->has('id')) {
            $url = $this->urlShortenerRepository->getUrlById($request->has('id'));

            return view('show', compact('url'));
        }

        return view('home');
    }

    /**
     * Redirect to original url when browse short url
     * @param $shortUrl
     * @return RedirectResponse
     */
    public function redirect($shortUrl): RedirectResponse
    {
        $url = $this->urlShortenerRepository->findUrlByShort($shortUrl);

        if (!$url) {
            return abort(404);
        }

        return redirect($url->original_url);
    }
}
