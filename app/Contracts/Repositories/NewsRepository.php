<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\FaqInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Models\Faq;
use App\Enums\NewsEnum;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function showWithTrash(mixed $id, Request $request): mixed
    {
        return $this->model->query()
            ->withTrashed()
            ->where('user_id', $id)
            ->latest()
            ->when($request->name, function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' .  $request->name . '%');
            })
            ->get();
    }

    public function showWithSLug(string $slug): mixed
    {
        return $this->model->query()
            ->withTrashed()
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

    public function where($data, $paginate, Request $request): mixed
    {
        return $this->model->query()
            ->where('status', $data)
            ->orderByDesc('pin', '1')
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' .  $request->search . '%');
            })
            ->when($request->opsilatest, function ($query) use($request) {
                $query->orderBy('created_at', $request->opsilatest == 'terlama' ? 'asc' : 'desc');
            })
            ->paginate($paginate);
    }

    public function news_pin(): mixed
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
            ->where('status', NewsEnum::ACCEPTED->value)
            ->whereRelation('newsSubCategories', 'sub_category_id', $id)
            ->withCount('newsViews')
            ->orderByDesc('news_views_count')
            ->when($query == 'top', function ($q) {
                $q->take(1);
            })
            ->when($query == 'notop', function ($q) {
                $q->take(4);
            })
            ->where('status', NewsEnum::ACCEPTED->value)
            ->latest()
            ->get();
    }

    public function whereAllSubCategory($id): mixed
    {
        return $this->model->query()
            ->where('status', NewsEnum::ACCEPTED->value)
            ->whereRelation('newsSubCategories', 'sub_category_id', $id)
            ->withCount('newsViews')
            ->orderByDesc('news_views_count')
            ->latest()
            ->paginate(10);
    }

    public function whereCategory($id, $query): mixed
    {
        return $this->model->query()
            ->where('status', NewsEnum::ACCEPTED->value)
            ->whereRelation('newsCategories', 'category_id', $id)
            ->withCount('newsViews')
            ->orderByDesc('news_views_count')
            ->when($query == 'top', function ($q) {
                $q->take(1);
            })
            ->latest()
            ->get();
    }

    public function whereAllCategory($id): mixed
    {
        return $this->model->query()
            ->where('status', NewsEnum::ACCEPTED->value)
            ->whereRelation('newsCategories', 'category_id', $id)
            ->withCount('newsViews')
            ->orderByDesc('news_views_count')
            ->latest()
            ->paginate(10);
    }

    public function whereTag($tags, $query): mixed
    {
        return $this->model->query()
            ->where('status', NewsEnum::ACCEPTED->value)
            ->whereRelation('newsTags', 'tags_id', $tags)
            ->withCount('newsViews')
            ->orderByDesc('news_views_count')
            ->take(1)
            ->get();
    }

    public function newsPopular(): mixed
    {
        return $this->model->query()
            ->where('status', NewsEnum::ACCEPTED->value)
            ->withCount('newsViews')
            ->orderByDesc('news_views_count')
            ->take(3)
            ->get();
    }

    public function newsPopularAdmin(): mixed
    {
        return $this->model->query()
            ->where('status', NewsEnum::ACCEPTED->value)
            ->withCount('newsViews')
            ->orderByDesc('news_views_count')
            ->take(6)
            ->get();
    }

    public function whereUserLike($user_id, $ipAddress, Request $request): mixed
    {
        return $this->model->query()
            ->where('status', NewsEnum::ACCEPTED->value)
            ->whereRelation('newsLikes', 'ip_address', $ipAddress)
            ->orWhereRelation('newsLikes', 'user_id', $user_id)
            ->withCount('newsViews')
            ->when($request->filter === "terbaru", function($query) {
                $query->latest();
            })
            ->when($request->filter === "terlama", function($query) {
                $query->oldest();
            })
            ->get();
    }

    public function categoryLatest($category_id, $status): mixed
    {
        return $this->model->query()
            ->whereRelation('newsCategories', 'category_id', $category_id)
            ->where('status', NewsEnum::ACCEPTED->value)
            ->withCount('newsViews')
            ->when($status == '1', function ($q) {
                $q->first();
            })
            ->latest();
    }

    public function tagLatest($tag_id, $paginate, $id, $status): mixed
    {
        return $this->model->query()
            ->when($status == 'notall', function ($q) use ($id) {
                $q->whereNotIn('id', $id);
            })
            ->whereRelation('newsTags', 'tags_id', $tag_id)
            ->where('status', NewsEnum::ACCEPTED->value)
            ->withCount('newsViews')
            ->when($status == '1', function ($take) {
                $take->first();
            })
            ->latest();
    }

    public function subcategoryLatest($subcategory_id, $id, $status): mixed
    {
        return $this->model->query()
            ->whereNotIn('id', $id)
            ->whereRelation('newsSubCategories', 'sub_category_id', $subcategory_id)
            ->where('status', NewsEnum::ACCEPTED->value)
            ->withCount('newsViews')
            ->latest()
            ->when($status == '1', function ($q) {
                $q->first();
            });
    }

    public function latest(): mixed
    {
        return $this->model->query()
            ->where('status', NewsEnum::ACCEPTED->value)
            ->withCount('newsViews')
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
            ->withTrashed()
            ->findOrFail($id)
            ->update($data);
    }

    public function news_pin_categories(): mixed
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

    public function news_by_category($categoryName): mixed
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

    public function allPin(): mixed
    {
        return $this->model->query()
            ->where('status', NewsEnum::ACCEPTED->value)
            ->where('pin', '1')
            ->withCount('newsViews')
            ->latest()
            ->paginate(10);
    }

    public function whereUser($id)
    {
        return $this->model->query()
            ->where('user_id', $id)
            ->withCount('newsViews')
            ->withCount('newsLikes')
            ->where('status', NewsEnum::ACCEPTED->value)
            ->get();
    }

    public function whereDetailAuthor($id): mixed
    {
        return $this->model->query()
            ->where('user_id', $id)
            ->withCount('newsViews')
            ->withCount('newsLikes')
            ->where('status', NewsEnum::ACCEPTED->value)
            ->paginate(10);
    }

    public function countByUserAndStatus($id, $status)
    {
        return $this->model->query()
            ->where('user_id', $id)
            ->where('status', $status)
            ->count();
    }

    public function newsStatus($user_id, $status): mixed
    {
        return $this->model->query()
            ->where('user_id', $user_id)
            ->where('status', $status)
            ->count();
    }

    public function userStatus($user_id, $status, Request $request                          ): mixed
    {
        return $this->model->query()
            ->where('user_id', $user_id)
            ->where('status', $status)
            ->when($request->name, function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' .  $request->name . '%');
            })
            ->get();
    }

    public function Chart(mixed $year, mixed $month): mixed
    {
        return $this->model
            ->where('user_id', auth()->id())
            ->where('status', NewsEnum::ACCEPTED->value)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->withCount('newsViews')
            ->orderBy('news_views_count', 'desc')
            ->take(3)
            ->get();
    }

    public function monthlyViews($news, int $year): array
    {
        $monthlyViews = [];
        for ($month = 1; $month <= 12; $month++) {
            $viewsCount = $news->newsViews()
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();
            $monthlyViews[] = $viewsCount;
        }
        return $monthlyViews;
    }

    public function draft()
    {
        return $this->model->query()->onlyTrashed()->where('user_id', auth()->user()->id)->get();
    }

    public function findDraft(mixed $id)
    {
        return $this->model->query()->withTrashed()->findOrFail($id);
    }

    public function accepted()
    {
        return $this->model->query()->where('status', NewsEnum::ACCEPTED->value)->get();
    }

    public function NewsChart(mixed $year, mixed $month): mixed
    {
        return $this->model
            ->where('status', NewsEnum::ACCEPTED->value)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->count();
    }
}
