<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Retailer;
use App\Models\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class TrackCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_tracks_product_stock()
    {
        $switch = Product::factory()->create(['name' => 'Nintendo Switch']);

        $bestBuy = Retailer::factory()->create(['name' => 'Best Buy']);

        $this->assertFalse($switch->inStock());
        
        $stock = new Stock([
            'price' => 10000,
            'url' => 'http://foo.com',
            'sku' => '12345',
            'in_stock' => false,
        ]);
            
        $bestBuy->addStock($switch, $stock);
            
        $this->assertFalse($stock->fresh()->in_stock);

        Http::fake( function(){
            return [
                'available' => true,
                'price' => 500000
            ];
        });

        $this->artisan('track');
        
        $this->assertTrue($stock->fresh()->in_stock);

    }
}
