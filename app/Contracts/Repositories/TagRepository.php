<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\TagInterface;
use App\Enums\NewsEnum;
use App\Models\Tags;
use Illuminate\Http\Request;

class TagRepository extends BaseRepository implements TagInterface
{
    public function __construct(Tags $tag)
    {
        $this->model = $tag;
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

    public function showWithCount(): mixed
    {
        return $this->model->query()
            ->withCount('newsTags')
            ->orderByDesc('news_tags_count')
            ->take(7)
            ->get();
    }

    public function showWithSLug(string $slug): mixed
    {
        return $this->model->query()
            ->where('slug', $slug)
            ->firstOrFail();
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
     * Handle the Get all data event from models.
     *
     * @return mixed
     */
    public function paginate(Request $request): mixed
    {
        return $this->model->query()
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' .  $request->search . '%');
            })
            ->latest()
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

    public function getByPopular(): mixed
    {
        return $this->model->query()
            ->whereRelation('newsTags.news', 'status', NewsEnum::ACCEPTED->value)
            ->withCount('newsTags')
            ->take(12)
            ->get();
    }
}
