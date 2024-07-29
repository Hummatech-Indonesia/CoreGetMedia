<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\PaginateInterface;
use App\Contracts\Interfaces\Eloquent\ShowInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;
use Illuminate\Http\Request;

interface TagInterface extends GetInterface, StoreInterface, UpdateInterface, ShowInterface, DeleteInterface
{
    public function showWithCount() : mixed;
    public function showWithSLug(string $slug): mixed;
    public function paginate(Request $request): mixed;

}
