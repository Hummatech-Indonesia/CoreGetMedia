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
            'image' => 'assets/iklan.png',
            'position' => AdvertisementEnum::TOP->value,
            'price' => '100000',
            'page' => AdvertisementEnum::HOME->value,
        ]);
        PositionAdvertisement::create([
            'id' => 2,
            'image' => 'assets/iklan.png',
            'position' => AdvertisementEnum::RIGHT->value,
            'price' => '100000',
            'page' => AdvertisementEnum::HOME->value,
        ]);
        PositionAdvertisement::create([
            'id' => 3,
            'image' => 'assets/iklan.png',
            'position' => AdvertisementEnum::UNDER->value,
            'price' => '100000',
            'page' => AdvertisementEnum::HOME->value,
        ]);
        PositionAdvertisement::create([
            'id' => 4,
            'image' => 'assets/iklan.png',
            'position' => AdvertisementEnum::LEFT->value,
            'price' => '100000',
            'page' => AdvertisementEnum::HOME->value,
        ]);


        PositionAdvertisement::create([
            'id' => 5,
            'image' => 'assets/iklan.png',
            'position' => AdvertisementEnum::TOP->value,
            'price' => '100000',
            'page' => AdvertisementEnum::SINGLEPOST->value,
        ]);
        PositionAdvertisement::create([
            'id' => 6,
            'image' => 'assets/iklan.png',
            'position' => AdvertisementEnum::RIGHT->value,
            'price' => '100000',
            'page' => AdvertisementEnum::SINGLEPOST->value,
        ]);
        PositionAdvertisement::create([
            'id' => 7,
            'image' => 'assets/iklan.png',

            'position' => AdvertisementEnum::UNDER->value,
            'price' => '100000',
            'page' => AdvertisementEnum::SINGLEPOST->value,
        ]);
        PositionAdvertisement::create([
            'id' => 8,
            'image' => 'assets/iklan.png',
            'position' => AdvertisementEnum::LEFT->value,
            'price' => '100000',
            'page' => AdvertisementEnum::SINGLEPOST->value,
        ]);


        PositionAdvertisement::create([
            'id' => 9,
            'image' => 'assets/iklan.png',

            'position' => AdvertisementEnum::TOP->value,
            'price' => '100000',
            'page' => AdvertisementEnum::CATEGORY->value,
        ]);
        PositionAdvertisement::create([
            'id' => 10,
            'image' => 'assets/iklan.png',

            'position' => AdvertisementEnum::RIGHT->value,
            'price' => '100000',
            'page' => AdvertisementEnum::CATEGORY->value,
        ]);
        PositionAdvertisement::create([
            'id' => 11,
            'image' => 'assets/iklan.png',

            'position' => AdvertisementEnum::UNDER->value,
            'price' => '100000',
            'page' => AdvertisementEnum::CATEGORY->value,
        ]);
        PositionAdvertisement::create([
            'id' => 12,
            'image' => 'assets/iklan.png',

            'position' => AdvertisementEnum::LEFT->value,
            'price' => '100000',
            'page' => AdvertisementEnum::CATEGORY->value,
        ]);


        PositionAdvertisement::create([
            'id' => 13,
            'image' => 'assets/iklan.png',

            'position' => AdvertisementEnum::TOP->value,
            'price' => '100000',
            'page' => AdvertisementEnum::SUBCATEGORY->value,
        ]);
        PositionAdvertisement::create([
            'id' => 14,
            'image' => 'assets/iklan.png',

            'position' => AdvertisementEnum::RIGHT->value,
            'price' => '100000',
            'page' => AdvertisementEnum::SUBCATEGORY->value,
        ]);
        PositionAdvertisement::create([
            'id' => 15,
            'image' => 'assets/iklan.png',

            'position' => AdvertisementEnum::UNDER->value,
            'price' => '100000',
            'page' => AdvertisementEnum::SUBCATEGORY->value,
        ]);
        PositionAdvertisement::create([
            'id' => 16,
            'image' => 'assets/iklan.png',

            'position' => AdvertisementEnum::LEFT->value,
            'price' => '100000',
            'page' => AdvertisementEnum::SUBCATEGORY->value,
        ]);
    }
}
