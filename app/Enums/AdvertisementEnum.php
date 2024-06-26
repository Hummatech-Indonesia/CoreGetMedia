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

    // enumnya belum ditambah
    case ALLNEWS_PINNED = 'allnewspinned';
    case ALLNEWS_POPULAR = 'allnewspopular';
    case TAG = 'tag';
    case DETAIL_AUTHOR = 'detail_author';
    case ALLCATEGORY = 'allcategory';
    case ALLSUBCATEGORY = 'allsubcategory';
    case ALLTAG = 'alltag';


    //type
    case PHOTO = 'photo';
    case VIDEO = 'video';

    // status
    case REJECT = 'reject';
    case ACCEPTED = 'accepted';
    case PENDING = 'pending';
    case PUBLISHED = 'published';
    case CANCELED = 'canceled';

    // feed
    case PAID = 'paid';
    case NOTPAID = 'notpaid';

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
