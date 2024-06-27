<?php

namespace App\Enums;

enum NewsEnum : string
{
    case REJECT = 'reject';
    case ACCEPTED = 'accepted';
    case PENDING = 'pending';
    case BANNED = 'banned';
}
