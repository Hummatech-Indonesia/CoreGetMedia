<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\PopularInterface;
use App\Enums\NewsEnum;
use App\Models\News;

class PopularRepository extends BaseRepository implements PopularInterface
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
            ->firstOrFail();
    }   

    public function getpopular(): mixed
    {
        return $this->model->query()
            ->where('status', NewsEnum::ACCEPTED->value)
            ->withCount('newsViews')
            ->orderByDesc('news_views_count')
            ->get();
    }

    public function getlatest(): mixed
    {
        return $this->model->query()
            ->where('status', NewsEnum::ACCEPTED->value)
            ->withCount('newsViews')
            ->latest()->take(5)
            ->get();
    }

    public function getbycategory($category_id): mixed
    {   
        return $this->model->query()
            ->where('status', NewsEnum::ACCEPTED->value)
            ->whereRelation('newsCategories', 'category_id', $category_id->id)
            ->withCount('newsViews')
            // ->orderByDesc('news_views_count')
            ->get();
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
}
