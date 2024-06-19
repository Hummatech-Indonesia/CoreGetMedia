<?php

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
        Schema::create('news_reports', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->foreignUuid('user_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('news_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('proof');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_reports');
    }
};
