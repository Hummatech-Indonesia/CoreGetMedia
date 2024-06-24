<?php

use App\Enums\AdvertisementEnum;
use App\Enums\StatusEnum;
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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete()->cascadeOnDelete();
            $table->text('image');
            $table->text('url');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('type', [AdvertisementEnum::PHOTO->value, AdvertisementEnum::VIDEO->value]);
            $table->enum('page', [AdvertisementEnum::HOME->value, AdvertisementEnum::SINGLEPOST->value, AdvertisementEnum::CATEGORY->value, AdvertisementEnum::SUBCATEGORY->value, AdvertisementEnum::ALLNEWS->value]);
            $table->enum('position', [AdvertisementEnum::TOP->value, AdvertisementEnum::UNDER->value, AdvertisementEnum::MID->value, AdvertisementEnum::RIGHT->value, AdvertisementEnum::LEFT->value]);
            $table->string('price')->nullable();
            $table->enum('feed', [StatusEnum::PENDING->value, StatusEnum::NOTPAID->value, StatusEnum::PAID->value, StatusEnum::CANCELED->value])->default(StatusEnum::PENDING->value);
            $table->enum('status', [StatusEnum::PENDING->value, StatusEnum::REJECT->value, StatusEnum::ACCEPTED->value, StatusEnum::PUBLISHED->value, StatusEnum::CANCELED->value])->default(StatusEnum::PENDING->value);
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
