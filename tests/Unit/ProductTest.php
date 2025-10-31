<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_increase_quantity()
    {
        $product = Product::factory()->create(['quantity' => 5]);
        $product->increaseQuantity();
        $this->assertEquals(6, $product->quantity);
    }

    public function test_decrease_quantity()
    {
        $product = Product::factory()->create(['quantity' => 5]);
        $product->decreaseQuantity();
        $this->assertEquals(4, $product->quantity);
    }

    public function test_decrease_quantity_does_not_go_below_zero()
    {
        $product = Product::factory()->create(['quantity' => 0]);
        $product->decreaseQuantity();
        $this->assertEquals(0, $product->quantity);
    }
}
