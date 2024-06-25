<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\GetInterface;

interface VisitorInterface extends GetInterface
{
    public function Chart(mixed $year, mixed $month): mixed;
}
