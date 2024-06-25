<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'image',
        'url',
        'start_date',
        'end_date',
        'type',
        'page',
        'position',
        'price',
        'feed',
        'status',
        'description',
        'deleted_at'
    ];

    protected $primaryKey = 'id';
    protected $table = 'advertisements';

    public $incrementing = false;
    public $keyType = 'char';

    /**
     * Get the user that owns the Advertisement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
