<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\AuthorInterface;
use App\Enums\AuthorEnum;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorRepository extends BaseRepository implements AuthorInterface
{
    public function __construct(Author $author)
    {
        $this->model = $author;
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
            ->first();
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     */
    public function get(Request $request): mixed
    {
        return $this->model->query()
            ->where('status', AuthorEnum::PENDING->value)
            ->when($request->name, function ($query) use ($request) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->name . '%');
                });
            })
            ->paginate(10);
    }

    public function where($data, Request $request): mixed
    {
        return $this->model->query()
            ->when($data == 'accepted', function ($query) {
                $query->where('status', AuthorEnum::ACCEPTED->value);
            })
            ->when($request->name, function ($query) use ($request) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->name . '%');
                });
            })
            ->paginate(10);
    }

    public function showWithSLug(string $slug): mixed
    {
        return $this->model->query()
            ->where('slug', $slug)
            ->firstOrFail();
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

    public function updateByUser($user, array $data): mixed
    {
        return $this->model->query()
            ->where('user_id', $user)
            ->update($data);
    }

    public function accepted()
    {
        return $this->model->query()
            ->where('status', AuthorEnum::ACCEPTED->value)
            ->get();
    }

    public function whereUserId()
    {
        return $this->model->query()
            ->where('user_id', auth()->user()->id)->first();
    }

    public function getAuthor($id): mixed
    {
        return $this->model->query()
            ->where('status', AuthorEnum::ACCEPTED->value)
            ->whereNot('user_id', $id)
            ->paginate(10);
    }
}
