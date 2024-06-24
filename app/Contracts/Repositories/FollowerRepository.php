<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\FollowerInterface;
use App\Models\Follower;

class FollowerRepository extends BaseRepository implements FollowerInterface
{
    public function __construct(Follower $follower)
    {
        $this->model = $follower;
    }

    public function get(): mixed
    {
        return $this->model->query()->get();
    }

    public function store(array $data): mixed
    {
        return $this->model->query()->create($data);
    }

    public function delete($user_id, $author_id): mixed
    {
        return $this->model->query()
            ->where('user_id', $user_id)
            ->where('author_id', $author_id)
            ->delete();
    }
    public function update(mixed $id, array $data): mixed
    {
        return $this->model->query()->findOrFail($id)->update($data);
    }

    public function where($column, $value)
    {
        return $this->model->query()->where($column, $value)->get();
    }

    public function countWhere($column, $value)
    {
        return $this->model->query()->where($column, $value)->count();
    }
}
