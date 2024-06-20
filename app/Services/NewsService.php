<?php

namespace App\Services;

use Exception;
use App\Models\News;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;
use App\Enums\UploadDiskEnum;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\Article\UpdateRequest;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\NewsCategory;
use App\Models\NewsSubCategory;
use App\Models\NewsTag;
use App\Models\Tags;

class NewsService
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
    public function store(StoreNewsRequest $request)
    {
        $data = $request->validated();

        if ($request->has('tag')) {
            $newTags = [];
            foreach ($request->input('tag') as $tagName) {
                $tag = Tags::updateOrCreate(
                    ['name' => $tagName],
                    ['slug' => Str::slug($tagName)]
                );
                $newTags[] = $tag->id;
            }
            $data['tag'] = $newTags;
        }

        $slug = Str::slug($data['name']);
        $compressedImage = $this->compressImage($slug, $request->image);
        $new_photo = $this->upload(UploadDiskEnum::NEWS->value, $compressedImage);

        $domQuestion = new \DOMDocument();
        libxml_use_internal_errors(true);
        $domQuestion->loadHTML($data['description'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        $this->processImages($domQuestion);

        libxml_clear_errors();

        return [
            'user_id' => auth()->user()->id,
            'name' => $data['name'],
            'image' => $new_photo,
            'description' => $data['description'],
            'slug' => $slug,
            'date' => $data['date'],
            'category' => $data['category'],
            'sub_category' => $data['sub_category'],
            'tag' => $data['tag']
        ];
    }

    public function storeRelation($newsId, array $categories, array $subcategories, array $tags)
    {
        foreach ($categories as $data) {
            NewsCategory::create([
                'news_id' => $newsId,
                'category_id' => $data,
            ]);
        }

        foreach ($subcategories as $data) {
            NewsSubCategory::create([
                'news_id' => $newsId,
                'sub_category_id' => $data,
            ]);
        }

        foreach ($tags as $data) {
            NewsTag::create([
                'news_id' => $newsId,
                'tags_id' => $data,
            ]);
        }
    }

    public function updateRelation($newsId, array $categories, array $subcategories, array $tags)
    {
        NewsCategory::where('news_id', $newsId)->delete();
        foreach ($categories as $data) {
            NewsCategory::create([
                'news_id' => $newsId,
                'category_id' => $data,
            ]);
        }

        NewsSubCategory::where('news_id', $newsId)->delete();
        foreach ($subcategories as $data) {
            NewsSubCategory::create([
                'news_id' => $newsId,
                'sub_category_id' => $data,
            ]);
        }

        NewsTag::where('news_id', $newsId)->delete();
        foreach ($tags as $data) {
            NewsTag::create([
                'news_id' => $newsId,
                'tags_id' => $data,
            ]);
        }
    }


        /**
     * Handle update data event to models.
     *
     * @param UpdateRequest $request
     * @param Article $article
     * @return array|bool
     */

    public function update(UpdateNewsRequest $request, News $news): array|bool
    {
        $data = $request->validated();

        if ($request->has('tag')) {
            $newTags = [];
            foreach ($request->input('tag') as $tagName) {
                $tag = Tags::updateOrCreate(
                    ['name' => $tagName],
                    ['slug' => Str::slug($tagName)]
                );
                $newTags[] = $tag->id;
            }

            $data['tag'] = $newTags;
        }

        $slug = Str::slug($data['name']);
        $old_photo = $news->image;
        $new_photo = "";

        if ($request->hasFile('image')) {

            if (file_exists(public_path($old_photo))) {
                unlink(public_path($old_photo));
            }

            $compressedImage = $this->compressImage($slug, $request->image);
            $new_photo = $this->upload(UploadDiskEnum::NEWS->value, $compressedImage);

            $news->image = $new_photo;
        }

        $domQuestion = new \DOMDocument();
        libxml_use_internal_errors(true);
        $content = $data['description'] ?? '-';
        if (!$content) {
            $domQuestion->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
            $this->processImages($domQuestion);
        }
        libxml_clear_errors();

        return [
            'user_id' => auth()->user()->id,
            'name' => $data['name'],
            'slug' => $slug,
            'image' => $new_photo ? $new_photo : $old_photo,
            'description' => $data['description'],
            'date' => $data['date'],
            'category' => $data['category'],
            'sub_category' => $data['sub_category'],
            'tag' => $data['tag']
        ];
    }

    /**
     * Method processImages
     *
     * @param \DOMDocument $dom
     *
     * @return void
     */

    private function processImages(\DOMDocument $dom)
    {
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('#data:image/#', $src)) {
                preg_match('#data:image/(?<mime>.*?)\;#', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                $filepath = $fileNameContentRand . '.' . $mimetype;

                $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $src));

                Storage::put(UploadDiskEnum::DESCRIPTION->value . '/' . $filepath, $imageData);

                $new_src = Storage::url(UploadDiskEnum::DESCRIPTION->value . '/' . $filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }
    }
}
