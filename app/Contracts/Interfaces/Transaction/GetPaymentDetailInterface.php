<?php

namespace App\Contracts\Interfaces\Transaction;

interface GetPaymentDetailInterface
{
    public function getPaymentDetail(string $id): mixed;
}
