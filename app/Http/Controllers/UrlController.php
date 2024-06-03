<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\Interfaces\UrlShortenerInterface;
use App\Traits\Shortener;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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

    public function createShortUrl(Request $request)
    {
        dd($request->all());
    }
}
