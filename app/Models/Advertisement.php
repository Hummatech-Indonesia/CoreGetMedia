<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'position_advertisement_id',
        'total_price',
        'feed',
        'status',
        'description'
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

    /**
     * Get the position that owns the Advertisement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function positionAdvertisement(): BelongsTo
    {
        return $this->belongsTo(PositionAdvertisement::class);
    }

    /**
     * Get all of the advertismentTransactions for the Advertisement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advertismentTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get all of the voucherUseds for the Advertisement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function voucherUseds(): HasMany
    {
        return $this->hasMany(VoucherUsed::class);
    }
}
