<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutGet extends Model
{
    use HasFactory;


    protected $fillable = [
        'image',
        'slogan',
        'email',
        'phone_number',
        'address',
        'header',
        'description',
        'url_facebook',
        'url_twitter',
        'url_instagram',
        'url_linkedin'
    ];

    protected $table = 'about_gets';
}
