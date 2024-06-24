<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Models\News;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;
use App\Enums\UploadDiskEnum;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\Article\UpdateRequest;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Http\Requests\StorePositionAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\Advertisement;
use App\Models\NewsCategory;
use App\Models\NewsSubCategory;
use App\Models\NewsTag;
use App\Models\PositionAdvertisement;
use App\Models\Tags;
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

        $new_photo = $this->upload(UploadDiskEnum::ADVERTISEMENT->value, $request->image);

        $priceData = PositionAdvertisement::where('page', $data['page'])
            ->where('position', $data['position'])
            ->first();

        return [
            'user_id' => auth()->user()->id,
            'image' => $new_photo,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'type' => $data['type'],
            'page' => $data['page'],
            'position' => $data['position'],
            'url' => $data['url'],
            'price' => $priceData->price
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

        $old_photo = $advertisement->image;
        $new_photo = "";

        if ($request->hasFile('image')) {

            if (file_exists(public_path($old_photo))) {
                unlink(public_path($old_photo));
            }

            $new_photo = $this->upload(UploadDiskEnum::ADVERTISEMENT->value, $request->image);

            $advertisement->image = $new_photo;
        }

        $priceData = PositionAdvertisement::where('page', $data['page'])
            ->where('position', $data['position'])
            ->first();

        return [
            'user_id' => auth()->user()->id,
            'image' => $new_photo ? $new_photo : $old_photo,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'type' => $data['type'],
            'page' => $data['page'],
            'position' => $data['position'],
            'url' => $data['url'],
            'price' => $priceData->price
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
}
