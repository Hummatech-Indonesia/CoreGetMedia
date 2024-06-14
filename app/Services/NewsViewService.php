<?php

namespace App\Services;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\NewsView;
use Illuminate\Support\Str;

class NewsViewService
{

    /**
     * Handle store data event to models.
     *
     * @param StoreRequest $request
     *
     * @return array|bool
     */
    public function store($news_id, $ip_address)
    {
        $existingVisitor = NewsView::where('news_id', $news_id)
                                ->where('ip_address', $ip_address)
                                ->first();

        if (!$existingVisitor) {
            NewsView::create([
                'news_id' => $news_id,
                'ip_address' => $ip_address
            ]);
        }
    }
}
