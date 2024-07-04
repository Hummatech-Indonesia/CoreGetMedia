<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\SubCategoryInterface;
use App\Models\SubCategory;

class SubCategoryRepository extends BaseRepository implements SubCategoryInterface
{
    public function __construct(SubCategory $subCategory)
    {
        $this->model = $subCategory;
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

    public function where($category): mixed
    {
        return $this->model->query()
            ->when(is_array($category), function($query) use ($category){
                $query->whereIn('category_id', $category);
            })
            ->when(!is_array($category), function($query) use ($category){
                $query->where('category_id', $category);
            })
            ->get();
    }

    public function paginate($category) : mixed
    {
        return $this->model->query()
            ->when(is_array($category), function($query) use ($category){
                $query->whereIn('category_id', $category);
            })
            ->when(!is_array($category), function($query) use ($category){
                $query->where('category_id', $category);
            })
            ->withCount('newsSubCategories')
            ->orderBy('news_sub_categories_count')
            ->paginate(10);
    }

    public function showWithSLug(string $slug): mixed
    {
        return $this->model->query()
            ->where('slug', $slug)
            ->first();
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
