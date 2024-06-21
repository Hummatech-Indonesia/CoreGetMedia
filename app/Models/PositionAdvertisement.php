<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PositionAdvertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'page'
    ];

    protected $table = 'position_advertisements';

    /**
     * Get all of the comments for the PositionAdvertisement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advertisements(): HasMany
    {
        return $this->hasMany(Advertisement::class);
    }
}
