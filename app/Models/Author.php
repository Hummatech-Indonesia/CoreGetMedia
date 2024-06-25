<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'cv',
        'user_id',
        'description',
        'status',
        'reject_description'
    ];

    protected $primaryKey = 'id';
    protected $table = 'authors';

    public $incrementing = false;
    public $keyType = 'char';

    /**
     * Get the user that owns the Author
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the followers for the Author
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function followers(): HasMany
    {
        return $this->hasMany(Follower::class);
    }
}
