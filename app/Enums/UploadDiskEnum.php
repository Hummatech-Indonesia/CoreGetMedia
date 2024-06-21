<?php

namespace App\Enums;

enum UploadDiskEnum: string
{
    //berita
    case NEWS = 'news';
    case DESCRIPTION = 'description';

    //cv untuk author
    case CV = 'cv';

    //avatar
    case IMAGE_USER = 'image';

    //iklan
    case ADVERTISEMENT = 'advertisement';
    case POSITION = 'position';

    //logo
    case LOGO = 'logo';
}
