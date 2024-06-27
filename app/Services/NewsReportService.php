<?php

namespace App\Services;

use App\Enums\UploadDiskEnum;
use App\Http\Requests\StoreNewsReportRequest;
use App\Models\News;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;

class NewsReportService
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
    public function store(StoreNewsReportRequest $request, News $news, $ip)
    {
        $data = $request->validated();

        $user_id = null;
        if (Auth::check()) {
            $user_id = auth()->user()->id;
        }

        $new_photo = $this->upload(UploadDiskEnum::PROOF->value, $request->proof);

        return [
            'ip_address' => $ip,
            'user_id' => $user_id,
            'news_id' => $news->id,
            'proof' => $new_photo,
            'description' => $data['description']
        ];
    }
}
