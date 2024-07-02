<?php

namespace App\Contracts\Interfaces\Transaction;

use Illuminate\Http\Request;

interface CallBackInterface
{
    public function callback(Request $request): mixed;
}
