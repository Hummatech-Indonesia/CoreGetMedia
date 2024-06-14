<?php

namespace App\Services;

use App\Enums\UploadDiskEnum;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\User;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthorService
{
    use UploadTrait;

        /**
     * Handle custom upload validation.
     *
     * @param string $disk
     * @param object $file
     * @param string|null $old_file
     * @return string
     */
    public function validateAndUpload(string $disk, object $file, string $old_file = null): string
    {
        if ($old_file) $this->remove($old_file);

        return $this->upload($disk, $file);
    }

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
        $cv = $this->upload(UploadDiskEnum::CV->value, $request->cv);

        return [
            'user_id' => auth()->user()->id,
            'cv' => $cv,
        ];
    }
}
