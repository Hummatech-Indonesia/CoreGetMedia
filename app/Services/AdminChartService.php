<?php

namespace App\Services;

use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\UniqueVisitorInterface;
use Carbon\Carbon;
use App\Contracts\Interfaces\VisitorDetectionInterface;
use App\Contracts\Interfaces\VisitorInterface;

class AdminChartService
{
    private NewsInterface $news;
    private VisitorInterface $visitor;
    public function __construct(NewsInterface $news, VisitorInterface $visitor)
    {
        $this->news = $news;
        $this->visitor = $visitor;
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

    public function ChartVisitor(VisitorInterface $visitorInterface)
    {
        $Curentyear = Carbon::now()->year;
        $Curentmonth = Carbon::now()->month;

        $grafikDataCollection = [];

        for($month = 1; $month <= 12; $month++){
            $date = Carbon::createFromDate($Curentyear, $month, 1);
            $yearMonth = $date->isoFormat('MMMM');
            $visitor = $this->visitor->Chart($Curentyear, $month);

            $grafikDataCollection[] = [
             'year' => $Curentyear,
             'month' => $yearMonth,
             'visitor' => $visitor
            ];
        }
        $data  = array_values($grafikDataCollection);


        return $data;
    }
}
