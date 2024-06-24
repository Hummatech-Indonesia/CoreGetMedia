<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\AdvertisementInterface;
use App\Enums\StatusEnum;
use App\Enums\AdvertisementEnum;
use App\Models\Advertisement;

class AdvertisementRepository extends BaseRepository implements AdvertisementInterface
{
    public function __construct(Advertisement $advertisement)
    {
        $this->model = $advertisement;
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
            ->where('id', $id)
            ->get()
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
        ->where('status', AdvertisementEnum::ACCEPTED->value)
        ->where('feed', AdvertisementEnum::PAID)
            ->get();
    }

    public function wherePosition($advertisement,$query): mixed
    {
        return $this->model->query()
        ->where('status', AdvertisementEnum::PUBLISHED->value)
        ->where('feed', AdvertisementEnum::PAID)
        ->whereDate('start_date', '<=', now())
        ->whereDate('end_date', '>=', now())
        ->when($query == 'right', function($q){
            $q
            ->where('position', AdvertisementEnum::RIGHT->value)
            ->inRandomOrder()
            ->take(1);
        })
        ->when($query == 'left', function($q){
            $q
            ->where('position', AdvertisementEnum::LEFT->value)
            ->inRandomOrder()
            ->take(1);
        })
        ->when($query == 'top', function($q){
            $q
            ->where('position', AdvertisementEnum::TOP->value)
            ->inRandomOrder()
            ->take(1);
        })
        ->when($query == 'under', function($q){
            $q
            ->where('position', AdvertisementEnum::UNDER->value)
            ->inRandomOrder()
            ->take(1);
        })
        ->when($query == 'mid', function($q){
            $q
            ->where('position', AdvertisementEnum::MID->value)
            ->inRandomOrder()
            ->take(1);
        })
        ->first();
    }

    public function where($user_id, $status): mixed
    {
        return $this->model->query()
            ->where('status', $status)
            ->when($user_id != null, function($q) use ($user_id) {
                $q->where('user_id', $user_id);
            })
            ->get();
    }

    public function whereAccepted(): mixed
    {
        return $this->model->query()
            ->whereNotIn('status', [StatusEnum::CANCELED->value, StatusEnum::PENDING->value, StatusEnum::REJECT->value])
            ->get();
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
