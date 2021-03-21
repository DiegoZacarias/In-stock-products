<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // relation methods
    public function stockCollection()
    {
        return $this->hasMany(Stock::class);
    }
    // instance methods

    public function inStock()
    {
        return $this->stockCollection()->where('in_stock', true)->exists();
    }

    public function track()
    {
        return $this->stockCollection->each->track();
    }
}
