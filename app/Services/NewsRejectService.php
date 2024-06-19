<?php

namespace App\Services;

use App\Http\Requests\StoreNewsRejectRequest;
use App\Models\News;

class NewsRejectService
{

    /**
     * Handle store data event to models.
     *
     * @param StoreRequest $request
     *
     * @return array|bool
     */
    public function store(StoreNewsRejectRequest $request, News $news)
    {
        $data = $request->validated();

        return [
            'user_id' => auth()->user()->id,
            'news_id' => $news->id,
            'description' => $data['description'],
        ];
    }
}
