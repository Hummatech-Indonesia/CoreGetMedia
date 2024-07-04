<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\VoucherInterface;
use App\Models\Voucherr;

class VoucherRepository extends BaseRepository implements VoucherInterface
{
    public function __construct(Voucherr $voucher)
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
        return $this->model->query()
            ->whereRelation('voucherUseds', 'advertisement_id', $id)
            ->first();
    }

    public function first($code): mixed
    {
        return $this->model->query()
            ->where('code', $code)
            ->first();
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->model->query()
            ->withCount('voucherUseds')
            ->get();
    }

    public function paginate(): mixed
    {
        return $this->model->query()
            ->withCount('voucherUseds')
            ->orderby('voucher_useds_count')
            ->paginate(10);
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

    /**
     * Handle show method and update data instantly from models.
     *
     * @param mixed $id
     * @param array $data
     *
     * @return mixed
     */
    public function update(mixed $id, array $data): mixed
    {
        return $this->model->query()
            ->findOrFail($id)
            ->update($data);
    }
}
