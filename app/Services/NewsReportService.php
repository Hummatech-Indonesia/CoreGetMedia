<?php

namespace App\Services;

use App\Http\Requests\StoreNewsReportRequest;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsReportService
{

    /**
     * Handle store data event to models.
     *
     * @param StoreRequest $request
     *
     * @return array|bool
     */
    public function store(StoreNewsReportRequest $request, News $news, $ip)
    {
        $data = $request->validated();

        $user_id = null;
        if (Auth::check()) {
            $user_id = auth()->user()->id;
        }

        return [
            'ip_address' => $ip,
            'user_id' => $user_id,
            'news_id' => $news->id,
            'proof' => $data['proof'],
            'description' => $data['description']
        ];
    }
}
