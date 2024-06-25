<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\VisitorInterface;
use App\Models\Visitor;

class VisitorRepository extends BaseRepository implements VisitorInterface
{
    public function __construct(Visitor $visitor)
    {
        $this->model = $visitor;
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->model->query()
            ->get();
    }

    public function Chart(mixed $year, mixed $month): mixed
    {
        return $this->model
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();
    }
}
