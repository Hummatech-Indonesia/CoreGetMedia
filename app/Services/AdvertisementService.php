<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Traits\UploadTrait;
use App\Enums\UploadDiskEnum;
use App\Http\Requests\Dashboard\Article\UpdateRequest;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;
use App\Http\Requests\UpdatePositionAdvertisementRequest;
use App\Models\Advertisement;
use App\Models\PositionAdvertisement;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdvertisementService
{
    use UploadTrait;

    /**
     * Handle custom upload validation.
     *
     * @param string $disk
     * @param object $file
     * @param string|null $old_file
     * @return string
     */
    public function validateAndUpload(string $disk, object $file, string $old_file = null): string
    {
        if ($old_file) $this->remove($old_file);

        return $this->upload($disk, $file);
    }

    /**
     * Handle store data event to models.
     *
     * @param StoreRequest $request
     *
     * @return array|bool
     */
    public function store(StoreAdvertisementRequest $request)
    {
        $data = $request->validated();

        $position = PositionAdvertisement::where('id', $data['position_advertisement_id'])->first();

        $new_photo = $this->upload(UploadDiskEnum::ADVERTISEMENT->value, $request->image);

        $startDate = Carbon::parse($data['start_date']);
        $endDate = Carbon::parse($data['end_date']);
        $daysDifference = $startDate->diffInDays($endDate);

        $datePrice = $position->date_price * $daysDifference;
        $totalPrice = $position->price + $datePrice;

        return [
            'user_id' => auth()->user()->id,
            'image' => $new_photo,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'type' => $data['type'],
            'position_advertisement_id' => $data['position_advertisement_id'],
            'url' => $data['url'],
            'total_price' => $totalPrice,
        ];
    }

        /**
     * Handle update data event to models.
     *
     * @param UpdateRequest $request
     * @param Article $article
     * @return array|bool
     */

    public function update(UpdateAdvertisementRequest $request, Advertisement $advertisement): array|bool
    {
        $data = $request->validated();

        $position = PositionAdvertisement::where('id', $data['position_advertisement_id'])->first();

        $startDate = Carbon::parse($data['start_date']);
        $endDate = Carbon::parse($data['end_date']);
        $daysDifference = $startDate->diffInDays($endDate);

        $datePrice = $position->date_price * $daysDifference;
        $totalPrice = $position->price + $datePrice;

        $old_photo = $advertisement->image;
        $new_photo = "";

        if ($request->hasFile('image')) {

            if (file_exists(public_path($old_photo))) {
                unlink(public_path($old_photo));
            }

            $new_photo = $this->upload(UploadDiskEnum::ADVERTISEMENT->value, $request->image);

            $advertisement->image = $new_photo;
        }

        return [
            'user_id' => auth()->user()->id,
            'image' => $new_photo ? $new_photo : $old_photo,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'type' => $data['type'],
            'position_advertisement_id' => $data['position_advertisement_id'],
            'url' => $data['url'],
            'total_price' => $totalPrice,
        ];
    }

    public function reject(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required',
        ]);

        return [
            'status' => StatusEnum::REJECT->value,
            'feed' => StatusEnum::NOTPAID->value,
            'description' => $validatedData['description']
        ];
    }

    public function positionUpdate(UpdatePositionAdvertisementRequest $request)
    {

    }
}
