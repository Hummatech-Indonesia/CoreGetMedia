<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\ShowInterface;
use App\Contracts\Interfaces\Eloquent\ShowWithSlugInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;

interface NewsInterface extends GetInterface, StoreInterface, UpdateInterface, ShowInterface, DeleteInterface, ShowWithSlugInterface
{
    public function where($data) : mixed;
    public function whereSubCategory($id, $query) : mixed;
    public function whereCategory($id, $query) : mixed;
    public function categoryLatest($category_id) : mixed;
    public function news_pin() : mixed;
    public function news_pin_categories() : mixed;
    public function news_by_category($category) : mixed;
    public function latest() : mixed;
    public function allPin() : mixed;
    public function whereUser($id);
    public function whereUserLike($user_id, $ipAddress) : mixed;
    public function whereTag($tags, $query) : mixed;
}
