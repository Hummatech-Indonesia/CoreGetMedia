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
    case ALLNEWS = 'allnews';

    //type
    case PHOTO = 'photo';
    case VIDEO = 'video';


    public function label(): string
    {
        return match ($this) {
            self::RIGHT => 'Kanan',
            self::LEFT => 'Kiri',
            self::TOP => 'Atas',
            self::UNDER => 'Bawah',
            self::MID => 'Tengah',
        };
    }


}
