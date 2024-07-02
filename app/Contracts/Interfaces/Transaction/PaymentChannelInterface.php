<?php

namespace App\Contracts\Interfaces\Transaction;

use Illuminate\Http\Request;

interface PaymentChannelInterface
{
    public function getPaymentChannel(): mixed;
}
