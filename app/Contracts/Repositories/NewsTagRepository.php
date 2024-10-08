<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\NewsTagInterface;
use App\Models\NewsTag;
use App\Enums\NewsEnum;

class NewsTagRepository extends BaseRepository implements NewsTagInterface
{
    public function __construct(NewsTag $newsTag)
    {
        $this->model = $newsTag;
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
            ->where('news_id', $id)
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

    public function where($news, $query): mixed
    {
        return $this->model->query()
            ->where('tags_id', $news)
            ->whereRelation('news', 'status',  NewsEnum::ACCEPTED->value)
            ->when($query == 'top', function($q){
                $q->take(1);    
            })
            ->get();
    }

    public function wheretag($news) : mixed
    {
        return $this->model->query()
        ->where('news_id', $news)
        ->get();
    }


    public function latest($news, $query) : mixed
    {
        return $this->model->query()
        ->whereRelation('news', 'status',  NewsEnum::ACCEPTED->value)
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
}
