<?php

namespace App\Enums;

enum UploadDiskEnum: string
{
    case NEWS = "news";
    case DESCRIPTION = "description";
    case CV = 'cv';

    case IMAGE_USER = 'image';
}
