<?php

namespace App\Models;

use App\Enums\AdvertisementEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PositionAdvertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'image',
        'position',
    ];

    protected $casts = [
        'position' => AdvertisementEnum::class,
    ];

    protected $table = 'position_advertisements';
}
