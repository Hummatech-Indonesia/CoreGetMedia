<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\CategoryInterface;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryInterface
{
    public function __construct(Category $category)
    {
        $this->model = $category;
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

    public function category_id_1(): mixed
    {
        return $this->model->query()
            ->withCount('newsCategories')
            ->orderByDesc('news_categories_count')
            ->firstOrfail();
    }

    public function category_id_2(): mixed
    {
        return $this->model->query()
            ->withCount('newsCategories')
            ->orderByDesc('news_categories_count')
            ->skip(1)
            ->firstOrfail();
    }

    public function showWithSLug(string $slug): mixed
    {
        return $this->model->query()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function showWithCount(): mixed
    {
        return $this->model->query()
            ->withCount('newsCategories')
            ->orderByDesc('news_categories_count')
            ->take(7)
            ->get();
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
        //
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

    public function paginate(): mixed
    {
        return $this->model->query()
            ->withCount('newsCategories')
            ->orderBy('news_categories_count')
            ->paginate(10);
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
