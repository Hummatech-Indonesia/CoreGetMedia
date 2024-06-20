<?php

namespace Database\Seeders;

use App\Enums\AuthorEnum;
use App\Enums\UserStatusEnum;
use App\Models\Author;
use App\Models\User;
use Faker\Provider\Uuid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua user yang memiliki role 'author'
        $authorRole = Role::where('name', 'author')->first();
    
        if ($authorRole) {
            $users = User::role($authorRole->name)->get();
            
            foreach ($users as $user) {
                Author::create([
                    'id' => Uuid::uuid(),
                    'user_id' => $user->id,
                    'cv' => 'null dari seeder',
                    'status' => AuthorEnum::ACCEPTED->value,
                    'description' => '-'
                ]);
            }
        }
    }
}
