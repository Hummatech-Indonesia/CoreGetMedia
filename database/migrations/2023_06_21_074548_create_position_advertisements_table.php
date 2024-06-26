<?php

use App\Enums\AdvertisementEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('position_advertisements', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->enum('page', [AdvertisementEnum::HOME->value, AdvertisementEnum::SINGLEPOST->value, AdvertisementEnum::CATEGORY->value, AdvertisementEnum::SUBCATEGORY->value, AdvertisementEnum::ALLNEWS->value, AdvertisementEnum::TAG->value, AdvertisementEnum::DETAIL_AUTHOR->value]);
            $table->enum('position', [AdvertisementEnum::TOP->value, AdvertisementEnum::UNDER->value, AdvertisementEnum::MID->value, AdvertisementEnum::RIGHT->value, AdvertisementEnum::LEFT->value]);
            $table->string('price');
            $table->string('date_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('position_advertisements');
    }
};
