<?php

namespace App\Services;

use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\UniqueVisitorInterface;
use Carbon\Carbon;
use App\Contracts\Interfaces\VisitorDetectionInterface;

class AuthorChartService
{
    private NewsInterface $news;
    public function __construct(NewsInterface $news)
    {
        $this->news = $news;
    }

    // public function chart(): array
    // {
    //     $currentYear = Carbon::now()->year;
    //     $currentMonth = Carbon::now()->month;

    //     $topThreeNews = $this->news->chart($currentYear, $currentMonth);
    //     $grafikDataCollection = [];

    //     foreach ($topThreeNews as $news) {
    //         $grafikDataCollection[] = [
    //             'title' => $news->title,
    //             'views' => $news->news_views_count
    //         ];
    //     }

    //     return $grafikDataCollection;
    // }

    public function Chart(NewsInterface $news)
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $topThreeNews = $this->news->chart($currentYear, $currentMonth);
        $grafikDataCollection = [];

        foreach ($topThreeNews as $news) {
            $monthlyViews = $this->news->monthlyViews($news, $currentYear);
            $title = strlen($news->name) > 20 ? substr($news->name, 0, 15) . '...' : $news->name;
            $grafikDataCollection[] = [
                'title' => $title,
                'views' => $monthlyViews
            ];
        }

        return $grafikDataCollection;
    }
}
