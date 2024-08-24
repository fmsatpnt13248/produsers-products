<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'detail', 'producer_id', 'price', 'amount',
    ];

    public function producer()
    {
        return $this->belongsTo(Producer::class);
    }
}
