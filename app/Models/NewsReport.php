<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_id',
        'news_id',
        'proof',
        'description',
    ];

    protected $table = 'news_reports';

    /**
     * Get the news that owns the NewsReport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }

    /**
     * Get the user that owns the NewsReport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
