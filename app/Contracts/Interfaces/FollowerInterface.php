<?php
namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;

interface FollowerInterface extends GetInterface , StoreInterface , UpdateInterface
{
    public function where($column, $value);
    public function countWhere($column, $value);
    public function delete($user_id, $author_id);
}

