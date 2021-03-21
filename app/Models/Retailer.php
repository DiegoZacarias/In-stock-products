<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    use HasFactory;

    // relation methods
    public function stockCollection()
    {
        return $this->hasMany(Stock::class);
    }

    //instance methods
    public function addStock(Product $product, Stock $stock)
    {
        $stock->product_id = $product->id;
        $this->stockCollection()->save($stock);
    }
}
