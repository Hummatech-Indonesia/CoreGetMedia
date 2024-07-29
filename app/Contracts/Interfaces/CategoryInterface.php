<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\PaginateInterface;
use App\Contracts\Interfaces\Eloquent\ShowInterface;
use App\Contracts\Interfaces\Eloquent\ShowWithSlugInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;
use Illuminate\Http\Request;

interface CategoryInterface extends GetInterface, StoreInterface, UpdateInterface, ShowInterface, DeleteInterface, ShowWithSlugInterface
{
    public function showWithCount() : mixed;
    public function category_id_1() : mixed;
    public function category_id_2() : mixed;
    public function paginate(Request $request): mixed;

}
