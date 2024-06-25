<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\ChartInterface;
use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\DraftInterface;
use App\Contracts\Interfaces\Eloquent\FindDraftInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\ShowInterface;
use App\Contracts\Interfaces\Eloquent\ShowWithSlugInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;

interface NewsInterface extends GetInterface, StoreInterface, UpdateInterface, ShowInterface, DeleteInterface, ShowWithSlugInterface, ChartInterface, DraftInterface, FindDraftInterface
{
    public function where($data, $paginate) : mixed;
    public function whereSubCategory($id, $query) : mixed;
    public function subcategoryLatest($subcategory_id) : mixed;
    public function whereCategory($id, $query) : mixed;
    public function whereAllCategory($id) : mixed;
    public function whereAllSubCategory($id) : mixed;
    public function categoryLatest($category_id) : mixed;
    public function news_pin() : mixed;
    public function news_pin_categories() : mixed;
    public function news_by_category($category) : mixed;
    public function latest() : mixed;
    public function allPin() : mixed;
    public function whereUser($id);
    public function whereUserLike($user_id, $ipAddress) : mixed;
    public function countByUserAndStatus($id, $status);
    public function whereTag($tags, $query) : mixed;
    public function tagLatest($tag_id, $paginate) : mixed;
    public function newsPopular() : mixed;
    public function newsPopularAdmin(): mixed;
    public function newsStatus($user_id, $status) : mixed;
    public function userStatus($user_id, $status): mixed;
    public function monthlyViews($news, int $year): array;
    public function showWithTrash(mixed $id): mixed;
    public function accepted();
    public function NewsChart(mixed $year, mixed $month): mixed;
}
