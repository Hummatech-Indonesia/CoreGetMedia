<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'merchant_ref',
        'payment_method',
        'payment_name',
        'user_id',
        'advertisement_id',
        'package_id',
        'callback_url',
        'pay_code',
        'total_amount',
        'total_fee',
        'status'
    ];

    protected $table = 'transactions';

    /**
     * Get the user that owns the AdvertisementTransaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the advertisment that owns the AdvertisementTransaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advertisment(): BelongsTo
    {
        return $this->belongsTo(Advertisement::class);
    }
}
