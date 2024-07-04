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
        Schema::create('advertisement_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('merchant_ref');
            $table->string('payment_method');
            $table->string('payment_name');
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('advertisement_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('callback_url');
            $table->string('pay_code');
            $table->bigInteger('total_amount');
            $table->bigInteger('total_fee');
            $table->enum('status', [StatusEnum::NOTPAID->value, StatusEnum::PAID->value])->default(StatusEnum::NOTPAID->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisement_transactions');
    }
};
