<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoucherUsed extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'voucherr_id'
    ];

    protected $table = 'voucher_useds';

    /**
     * Get the user that owns the VoucherUsed
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the voucherr that owns the VoucherUsed
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function voucherr(): BelongsTo
    {
        return $this->belongsTo(Voucherr::class);
    }
}
