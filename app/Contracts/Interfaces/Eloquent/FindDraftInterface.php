<?php

namespace App\Contracts\Interfaces\Eloquent;

interface FindDraftInterface
{
    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     */

     public function findDraft(mixed $id);
}
