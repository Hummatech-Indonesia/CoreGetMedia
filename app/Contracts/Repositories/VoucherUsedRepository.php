<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\VoucherUsedInterface;
use App\Models\Voucherr;
use App\Models\VoucherUsed;

class VoucherUsedRepository extends BaseRepository implements VoucherUsedInterface
{
    public function __construct(VoucherUsed $voucher)
    {
        $this->model = $voucher;
    }

    /**
     * Handle show method and delete data instantly from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete(mixed $id): mixed
    {
        return $this->model->query()
            ->findOrFail($id)
            ->delete();
    }

    /**
     * Handle get the specified data by id from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show(mixed $id): mixed
    {
        //
    }

    /**
     * Handle store data event to models.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function store(array $data): mixed
    {
        return $this->model->query()
            ->create($data);
    }
}
