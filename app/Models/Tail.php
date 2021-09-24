<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tail extends Model
{
    use HasFactory;
    protected $fillable = [
        'agent',
        'duration',
        'average_time',
        'max_items',
        'status'
    ];

    /**
     * Get all items f tail.
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
