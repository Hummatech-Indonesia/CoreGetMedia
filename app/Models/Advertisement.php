<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'image',
        'start_date',
        'end_date',
        'type',
        'page', 
        'position',
        'price',
        'feed',
        'status',
        'description'
    ];

    protected $primaryKey = 'id';
    protected $table = 'advertisements';

    public $incrementing = false;
    public $keyType = 'char';
}
