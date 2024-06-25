<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Enums\UploadDiskEnum;
use App\Http\Requests\StoreAboutGetRequest;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAboutGetRequest;
use App\Http\Requests\UpdateAdminReqeust;
use App\Models\AboutGet;
use App\Models\User;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;

class AdminService
{
    use UploadTrait;

    /**
     * Handle store data event to models.
     *
     * @param StoreRequest $request
     *
     * @return array|bool
     */
    public function storeOrUpdate(StoreAdminRequest $request)
    {
        $data = $request->validated();

        // $user = User::updateOrCreate(
        //     ['email' => $data['email']],
        //     [
        //         'name' => $data['name'],
        //         'slug' => Str::slug($data['name']),
        //         'password' => bcrypt($data['password']),
        //     ]
        // );

        // $user->assignRole(RoleEnum::ADMIN->value);

        return [
            'email' => $data['email'],
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'password' => bcrypt($data['password']),
        ];
    }

    public function updateAdmin(UpdateAdminReqeust $request)
    {
        $data = $request->validated();

        return [
            'email' => $data['email'],
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
        ];
    }

    public function storeAbout(StoreAboutGetRequest $request)
    {
        $data = $request->validated();
        $new_photo = $this->upload(UploadDiskEnum::LOGO->value, $request->image);

        return [
            'image' => $new_photo,
            'slogan' => $data['slogan'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'header' => $data['header'],
            'description' => $data['description'],
            'url_facebook' => $data['url_facebook'],
            'url_twitter' => $data['url_twitter'],
            'url_instagram' => $data['url_instagram'],
            'url_linkedin' => $data['url_linkedin'],
        ];
    }

    public function updateAbout(UpdateAboutGetRequest $request, AboutGet $aboutGet)
    {
        $data = $request->validated();

        $old_photo = $aboutGet->image;
        $new_photo = "";

        if ($request->hasFile('image')) {

            if (file_exists(public_path($old_photo))) {
                unlink(public_path($old_photo));
            }

            $new_photo = $this->upload(UploadDiskEnum::NEWS->value, $request->image);

            $aboutGet->image = $new_photo;
        }

        return [
            'image' => $new_photo ? $new_photo : $old_photo,
            'slogan' => $data['slogan'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'header' => $data['header'],
            'description' => $data['description'],
            'url_facebook' => $data['url_facebook'],
            'url_twitter' => $data['url_twitter'],
            'url_instagram' => $data['url_instagram'],
            'url_linkedin' => $data['url_linkedin'],
        ];
    }
}
