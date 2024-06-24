<?php

namespace Database\Seeders;

use App\Enums\AdvertisementEnum;
use App\Models\PositionAdvertisement;
use App\Models\User;
use Faker\Provider\Uuid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PositionAdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        PositionAdvertisement::create([
            'id' => 1,
            'position' => AdvertisementEnum::TOP->value,
            'price' => '100000',
            'page' => AdvertisementEnum::HOME->value,
        ]);
        PositionAdvertisement::create([
            'id' => 2,
            'position' => AdvertisementEnum::RIGHT->value,
            'price' => '100000',
            'page' => AdvertisementEnum::HOME->value,
        ]);
        PositionAdvertisement::create([
            'id' => 3,
            'position' => AdvertisementEnum::UNDER->value,
            'price' => '100000',
            'page' => AdvertisementEnum::HOME->value,
        ]);
        PositionAdvertisement::create([
            'id' => 4,
            'position' => AdvertisementEnum::LEFT->value,
            'price' => '100000',
            'page' => AdvertisementEnum::HOME->value,
        ]);


        PositionAdvertisement::create([
            'id' => 5,
            'position' => AdvertisementEnum::TOP->value,
            'price' => '100000',
            'page' => AdvertisementEnum::SINGLEPOST->value,
        ]);
        PositionAdvertisement::create([
            'id' => 6,
            'position' => AdvertisementEnum::RIGHT->value,
            'price' => '100000',
            'page' => AdvertisementEnum::SINGLEPOST->value,
        ]);
        PositionAdvertisement::create([
            'id' => 7,
            'position' => AdvertisementEnum::UNDER->value,
            'price' => '100000',
            'page' => AdvertisementEnum::SINGLEPOST->value,
        ]);
        PositionAdvertisement::create([
            'id' => 8,
            'position' => AdvertisementEnum::LEFT->value,
            'price' => '100000',
            'page' => AdvertisementEnum::SINGLEPOST->value,
        ]);


        PositionAdvertisement::create([
            'id' => 9,
            'position' => AdvertisementEnum::TOP->value,
            'price' => '100000',
            'page' => AdvertisementEnum::CATEGORY->value,
        ]);
        PositionAdvertisement::create([
            'id' => 10,
            'position' => AdvertisementEnum::RIGHT->value,
            'price' => '100000',
            'page' => AdvertisementEnum::CATEGORY->value,
        ]);
        PositionAdvertisement::create([
            'id' => 11,
            'position' => AdvertisementEnum::UNDER->value,
            'price' => '100000',
            'page' => AdvertisementEnum::CATEGORY->value,
        ]);
        PositionAdvertisement::create([
            'id' => 12,
            'position' => AdvertisementEnum::LEFT->value,
            'price' => '100000',
            'page' => AdvertisementEnum::CATEGORY->value,
        ]);


        PositionAdvertisement::create([
            'id' => 13,
            'position' => AdvertisementEnum::TOP->value,
            'price' => '100000',
            'page' => AdvertisementEnum::SUBCATEGORY->value,
        ]);
        PositionAdvertisement::create([
            'id' => 14,
            'position' => AdvertisementEnum::RIGHT->value,
            'price' => '100000',
            'page' => AdvertisementEnum::SUBCATEGORY->value,
        ]);
        PositionAdvertisement::create([
            'id' => 15,
            'position' => AdvertisementEnum::UNDER->value,
            'price' => '100000',
            'page' => AdvertisementEnum::SUBCATEGORY->value,
        ]);
        PositionAdvertisement::create([
            'id' => 16,
            'position' => AdvertisementEnum::LEFT->value,
            'price' => '100000',
            'page' => AdvertisementEnum::SUBCATEGORY->value,
        ]);
    }
}
