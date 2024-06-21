<?php

namespace App\Contracts\Interfaces\Eloquent;


interface ChartInterface
{
    /**
     * Handle paginate data event from models.
     *
     * @param Request $request
     * @param int $pagination
     *
     * @return LengthAwarePaginator
     */

    public function chart(mixed $year, mixed $month) : mixed;
}
