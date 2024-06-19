<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\ShowInterface;
use App\Contracts\Interfaces\Eloquent\ShowWithSlugInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;

interface NewsLikeInterface extends StoreInterface, UpdateInterface, ShowInterface
{
    public function delete($user_id, $ip, $news) : mixed;
    public function get($news_id) : mixed;
    public function where($news_id, $ipAddress) : mixed;
    public function count($user_id);
}
