<?php

namespace App\Console\Commands;

use App\Contracts\Interfaces\NewsInterface;
use App\Models\News;
use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;

class GenerateSitemap extends Command
{
    private NewsInterface $news ;

    public function __construct(NewsInterface $news)
    {
        $this->news = $news;
    }
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate sitemap';

    public function handle()
    {
        // Manually create sitemap
        $sitemap = Sitemap::create();
        $newss = $this->news->get();
        foreach ($newss as $news) {
            $sitemap->add("/news/{$news->slug}");
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
