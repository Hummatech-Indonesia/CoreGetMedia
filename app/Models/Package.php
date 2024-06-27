<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description'
    ];

    protected $table = 'packages';

    /**
     * Get all of the packageFeatures for the Package
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function packageFeatures(): HasMany
    {
        return $this->hasMany(PackageFeatures::class);
    }
}
