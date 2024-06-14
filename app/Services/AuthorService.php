<?php

namespace App\Services;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthorService
{

    /**
     * Handle store data event to models.
     *
     * @param StoreRequest $request
     *
     * @return array|bool
     */
    public function store(StoreAuthorRequest $request)
    {
        $data = $request->validated();

        return [
            'user_id' => auth()->user()->id,
            'cv' => $data['cv'],
        ];
    }
}
