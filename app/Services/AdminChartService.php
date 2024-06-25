<?php

namespace App\Services;

use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\UniqueVisitorInterface;
use Carbon\Carbon;
use App\Contracts\Interfaces\VisitorDetectionInterface;

class AdminChartService
{
    private NewsInterface $news;
    public function __construct(NewsInterface $news)
    {
        $this->news = $news;
    }

    public function Chart(NewsInterface $newsInterface)
    {
        $Curentyear = Carbon::now()->year;
        $Curentmonth = Carbon::now()->month;

        $grafikDataCollection = [];

        for($month = 1; $month <= 12; $month++){
            $date = Carbon::createFromDate($Curentyear, $month, 1);
            $yearMonth = $date->isoFormat('MMMM');
            $news = $this->news->NewsChart($Curentyear, $month);

            $grafikDataCollection[] = [
             'year' => $Curentyear,
             'month' => $yearMonth,
             'news' => $news
            ];
        }
        $data  = array_values($grafikDataCollection);


        return $data;
    }
}
