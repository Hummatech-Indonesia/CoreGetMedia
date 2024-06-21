<?php

namespace App\Console\Commands;

use App\Contracts\Interfaces\NewsInterface;
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
        //
        // Manually create sitemap
        // $sitemap = Sitemap::create();
        // // Dynamic pages
        // $users = News::all();
        // foreach ($users as $user) {
        //     $sitemap->add("/news/{$user->slug}");
        // }

        // $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
