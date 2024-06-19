<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\ShowInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;

interface AuthorInterface extends GetInterface, StoreInterface, UpdateInterface, ShowInterface, DeleteInterface
{
    public function where($data) :mixed;
    public function accepted();
    public function whereUserId($id);
    public function updateByUser($user, array $data) : mixed;
}
