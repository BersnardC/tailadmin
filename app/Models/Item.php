<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'code',
        'name',
        'created_at',
        'start',
        'finish',
        'atention_time',
        'status',
        'tail_id'
    ];
}
