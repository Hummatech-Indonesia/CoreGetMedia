<?php

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
            $table->date('start_date');
            $table->date('end_date');
            $table->string('price')->nullable();
            $table->enum('feed', [StatusEnum::PENDING->value, StatusEnum::NOTPAID->value, StatusEnum::PAID->value])->default(StatusEnum::PENDING->value);
            $table->enum('status', [StatusEnum::PENDING->value, StatusEnum::REJECT->value, StatusEnum::ACCEPTED->value, StatusEnum::PUBLISHED->value])->default(StatusEnum::PENDING->value);
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
