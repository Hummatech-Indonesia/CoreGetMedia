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
        'image',
        'page',
        'position',
        'price',
        'date_price',
    ];

    protected $casts = [
        'position' => AdvertisementEnum::class,
    ];

    protected $table = 'position_advertisements';

    /**
     * Get all of the  for the PositionAdvertisement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advertisements(): HasMany
    {
        return $this->hasMany(Advertisement::class);
    }
}
