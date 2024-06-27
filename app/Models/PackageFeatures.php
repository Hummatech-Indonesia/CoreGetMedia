<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageFeatures extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'name',
    ];

    protected $table = 'package_features';

    /**
     * Get the pa that owns the PackageFeatures
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
