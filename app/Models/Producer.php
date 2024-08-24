<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Producer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'contact',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
