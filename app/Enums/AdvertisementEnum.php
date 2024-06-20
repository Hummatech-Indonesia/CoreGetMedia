<?php

namespace App\Enums;

enum AdvertisementEnum : string
{
    //position
    case RIGHT = 'right';
    case LEFT = 'left';
    case TOP = 'top';
    case UNDER = 'under';
    case MID = 'mid';

    //page
    case HOME = 'home';
    case SINGLEPOST = 'singlepost';
    case CATEGORY = 'category';
    case SUBCATEGORY = 'subcategory';

    //type
    case PHOTO = 'photo';
    case VIDEO = 'video';

}
