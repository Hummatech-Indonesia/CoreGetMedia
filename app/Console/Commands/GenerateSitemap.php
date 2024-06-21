<?php

namespace App\Console\Commands;

use App\Models\News;
use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate sitemap';

    public function handle()
    {
        // Manually create sitemap
        $sitemap = Sitemap::create();
        $newss = News::all();
        foreach ($newss as $news) {
            $sitemap->add("/news/{$news->slug}");
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
