<?php

namespace App\Services;

class ImageContentService
{
    private $imageTag;

    public function __construct()
    {
        $this->imageTag = '<img src="' . asset('CONTOHIKLAN.png') . '" alt="Image" style="display:block; margin:40px auto;">';
    }

    public function insertImagesInContent(string $content, int $wordInterval = 100): string
    {
        $words = explode(' ', strip_tags($content));
        $wordCount = count($words);

        if ($wordCount == 0) {
            return $content;
        }

        $middleIndex = floor($wordCount / 2);
        array_splice($words, $middleIndex, 0, $this->imageTag);

        return implode(' ', $words);
    }
}
