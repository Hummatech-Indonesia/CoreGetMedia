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
        Schema::create('about_gets', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->longText('slogan');
            $table->string('email');
            $table->string('phone_number');
            $table->string('address');
            $table->longText('header');
            $table->longText('description');
            $table->string('url_facebook');
            $table->string('url_twitter');
            $table->string('url_instagram');
            $table->string('url_linkedin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_gets');
    }
};
