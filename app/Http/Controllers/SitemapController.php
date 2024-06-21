<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\ServiceInterface;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    private NewsInterface $news;

    public function __construct(NewsInterface $news)
    {
        $this->news = $news;
    }

    /**
     * Sitemap Generator (/sitemap.xml)
     *
     * @package hummatech
     * @see https://github.com/spatie/laravel-sitemap
     */
    public function __invoke()
    {
        $newsData = $this->news->get();

        return response()->view('sitemap', compact('newsData'))->header('Content-Type', 'text/xml');
    }
}
