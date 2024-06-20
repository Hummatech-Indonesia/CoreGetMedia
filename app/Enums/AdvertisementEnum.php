<?php

namespace App\Enums;

enum AdvertisementEnum : string
{
    case RIGHT = 'right';
    case LEFT = 'left';
    case TOP = 'top';
    case UNDER = 'under';
    case MID = 'mid';

    case HOME = 'home';
    case SINGLEPOST = 'singlepost';
    
}
