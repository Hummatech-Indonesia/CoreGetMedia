<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voucherr extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * Get all of the voucherUsers for the Voucherr
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function voucherUseds(): HasMany
    {
        return $this->hasMany(VoucherUsed::class);
    }
}
