<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Http\Requests\StoreAdminRequest;
use App\Models\User;
use Illuminate\Support\Str;

class AdminService
{

    /**
     * Handle store data event to models.
     *
     * @param StoreRequest $request
     *
     * @return array|bool
     */
    public function storeOrUpdate(StoreAdminRequest $request)
    {
        // $data = $request->validated();
        // $data->assignRole(RoleEnum::ADMIN->value);
        // return [
        //     'name' => $data['name'],
        //     'slug' => Str::slug($data['name']),
        //     'email' => $data['email'],
        //     'password' => $data['password'],
        // ];

        $data = $request->validated();

        // Check if user exists (for update) or create a new one
        $user = User::updateOrCreate(
            ['email' => $data['email']],
            [
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'password' => bcrypt($data['password']),
            ]
        );
    
        $user->assignRole(RoleEnum::ADMIN->value);
    
        return [
            'name' => $user->name,
            'slug' => $user->slug,
            'email' => $user->email,
            'password' => $user->password,
        ];

        
    }
}
