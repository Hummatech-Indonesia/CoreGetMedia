<?php

namespace App\Contracts\Interfaces\Transaction;

interface TransactionInterface
{
    public function transaction(mixed $method, int $totalAmount, mixed $product): mixed;
}
