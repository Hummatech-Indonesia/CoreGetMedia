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

}
