<?php

namespace App\Services;

use App\Enums\UploadDiskEnum;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateProfileImageRequest;
use App\Models\User;
use App\Traits\UploadTrait;

class UserService
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

    public function imageUpdate(UpdateProfileImageRequest $request, User $user)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $photo = $this->upload(UploadDiskEnum::IMAGE_USER->value, $request->file('image'));
        }

        return [
            'image' => $photo,
        ];
    }

    public function deleteRole(User $user)
    {
        $user->roles()->detach();
    }
}
