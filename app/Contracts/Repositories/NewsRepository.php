<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\FaqInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Models\Faq;
use App\Enums\NewsEnum;
use App\Models\News;

class NewsRepository extends BaseRepository implements NewsInterface
{
    public function __construct(News $news)
    {
        $this->model = $news;
    }

    /**
     * Handle show method and delete data instantly from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete(mixed $id): mixed
    {
        return $this->model->query()
        ->findOrFail($id)
        ->delete();
    }

    /**
     * Handle get the specified data by id from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show(mixed $id): mixed
    {
        return $this->model->query()
            ->where('user_id', $id)
            ->get();
    }

    public function showWithSLug(string $slug): mixed
    {
        return $this->model->query()
            ->where('slug', $slug)
            ->withCount('newsViews')
            ->withCount('comments')
            ->firstOrFail();
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

    public function where($data): mixed
    {
        return $this->model->query()
            ->where('status', $data)
            ->get();
    }

    public function news_pin() : mixed
    {
        return $this->model->query()
            ->where('status', NewsEnum::ACCEPTED->value)
            ->where('pin', '1')
            ->withCount('newsViews')
            ->orderByDesc('news_views_count')
            ->take(3)
            ->get();

    }

    public function whereSubCategory($id, $query): mixed
    {
        return $this->model->query()
            ->whereRelation('newsSubCategories', 'sub_category_id', $id)
            ->withCount('newsViews')
            ->orderByDesc('news_views_count')
            ->when($query == 'top', function($q){
                $q->take(1);
            })
            ->when($query == 'notop', function($q){
                $q->take(7);
            })
            ->where('status', NewsEnum::ACCEPTED->value)
            ->latest()
            ->get();
    }

    public function whereCategory($id, $query): mixed
    {
        return $this->model->query()
            ->whereRelation('newsCategories', 'category_id', $id)
            ->withCount('newsViews')
            ->orderByDesc('news_views_count')
            ->when($query == 'top', function($q){
                $q->take(1);
            })
            ->where('status', NewsEnum::ACCEPTED->value)
            ->latest()
            ->get();
    }

    public function whereUserLike($user_id, $ipAddress): mixed
    {
        return $this->model->query()
            ->whereRelation('newsLikes', 'user_id', $user_id)
            ->whereRelation('newsLikes', 'ip_address', $ipAddress)
            ->withCount('newsViews')
            ->get();
    }

    public function categoryLatest($category_id) : mixed
    {
        return $this->model->query()
        ->whereRelation('newsCategories', 'category_id', $category_id)
        ->where('status', NewsEnum::ACCEPTED->value)
        ->withCount('newsViews')
        ->latest()
        ->get();
    }

    public function latest() : mixed
    {
        return $this->model->query()
        ->latest()
        ->get();
    }


    /**
     * Handle store data event to models.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function store(array $data): mixed
    {
        return $this->model->query()
            ->create($data);
    }

    /**
     * Handle show method and update data instantly from models.
     *
     * @param mixed $id
     * @param array $data
     *
     * @return mixed
     */
    public function update(mixed $id, array $data): mixed
    {
        return $this->model->query()
            ->findOrFail($id)
            ->update($data);
    }

    // public function searchAll(Request $request): mixed
    // {
    //     return $this->model->query()

    //         ->where(function ($query) use ($request) {
    //             $query->where('name', 'LIKE', '%' . $request->search . '%')
    //                 ->orWhere('content', 'LIKE', '%' . $request->search . '%')
    //                 ->orWhereHas('user', function ($query) use ($request) {
    //                     $query->where('name', 'LIKE', '%' . $request->search . '%');
    //                 });
    //         })
    //         ->get();
    // }

     public function news_pin_categories() : mixed
    {
        return $this->model->query()
            ->select('categories.name')
            ->join('news_categories', 'news.id', '=', 'news_categories.news_id')
            ->join('categories', 'news_categories.category_id', '=', 'categories.id')
            ->where('news.status', NewsEnum::ACCEPTED->value)
            ->where('news.pin', '1')
            ->groupBy('categories.name')
            ->get();
    }

    public function news_by_category($categoryName) : mixed
    {
        return $this->model->query()
            ->join('news_categories', 'news.id', '=', 'news_categories.news_id')
            ->join('categories', 'news_categories.category_id', '=', 'categories.id')
            ->where('news.status', NewsEnum::ACCEPTED->value)
            ->where('news.pin', '1')
            ->where('categories.name', $categoryName)
            ->select('news.*')
            ->get();
    }

    public function allPin() : mixed
    {
        return $this->model->query()
            ->where('news.status', NewsEnum::ACCEPTED->value)
            ->where('news.pin', '1')
            ->latest()
            ->get();
    }
    
    public function whereUser($id)
    {
        return $this->model->query()
        ->where('user_id', $id)
        ->get();
    }
}
