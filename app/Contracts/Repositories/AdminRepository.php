<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\AdminInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class AdminRepository extends BaseRepository implements AdminInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
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

    public function AccountAdmin()
    {
        return $this->model->query()
        ->whereRelation('roles', 'name', 'admin')
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
        return $this->model->query()
            ->findOrFail($id);
    }

    public function showWithSlug(string $slug): mixed
    {
        return $this->model->query()
        ->where('slug', $slug)
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

    public function search(Request $request): mixed
    {
        return $this->model->query()
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%');
            })->when($request->status, function ($query) use ($request) {
                $query->where('status', 'LIKE', '%' . $request->status . '%');
            })->when($request->sub_category_id, function ($query) use ($request) {
                $query->where('sub_category_id', $request->sub_category_id);
            })->get();
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

    public function showWhithCount(): mixed
    {
        return DB::table('user')
            ->join('author', 'user.id', '=', 'author.user_id')
            ->join('news', 'author.id', '=', 'news.author_id')
            ->select('user.id', 'user.name', 'user.photo', DB::raw('SUM(1) as total'))
            ->groupBy('user.id', 'user.name', 'user.photo')
            ->orderBy('total', 'desc')
            ->take(6)
            ->get();
    }
}
