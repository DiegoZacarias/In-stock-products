<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
   /** @test */
   public function it_checks_stock_for_products_at_retailers()
   {
       $switch = Product::factory()->create(['name' => 'Nintendo Switch']);

       $bestBuy = Retailer::factory()->create(['name' => 'Best Buy']);

       $this->assertFalse($switch->inStock());
   }
}
