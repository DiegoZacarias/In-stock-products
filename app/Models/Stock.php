<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Stock extends Model
{
    use HasFactory;
    
    protected $table = 'stock';
    protected $guarded = [];
    protected $casts = [
        'in_stock' => 'boolean'
    ];

    // relation methods
    public function retailerModel()
    {
        return $this->belongsTo(Retailer::class, 'retailer_id');
    }

    public function track()
    {
        if ($this->retailerModel->name === 'Best Buy') {
            # Consultamos el API endpoint de Best buy y buscamos los si el producto esta disponible
            $results = Http::get('http://foo.test')->json();

            # Acualizamos la DB con los datos de la API
            $this->update([
                'in_stock' => $results['available'],
                'price' => $results['price']
            ]);
        }
    }
}
