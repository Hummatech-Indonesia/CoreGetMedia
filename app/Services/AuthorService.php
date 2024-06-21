<?php

namespace App\Services;

use App\Enums\AuthorEnum;
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
    public function store(StoreAuthorRequest $request, $user_id)
    {
        $data = $request->validated();
        $cv = $this->upload(UploadDiskEnum::CV->value, $request->cv);

        $user = "";
        $status = "";
        if (auth()->user()->roles->pluck('name')[0] == "admin") {
            $user = $user_id;
            $status = AuthorEnum::ACCEPTED->value;
        } else {
            $user = auth()->user()->id;
            $status = AuthorEnum::PENDING->value;
        }

        return [
            'user_id' => $user,
            'cv' => $cv,
            'status' => $status
        ];
    }

    public function storeUser(Request $request)
    {
        $password = bcrypt($request->input('password'));

        return [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'email' => $request->input('email'),
            'password' => $password,
        ];
    }
}
