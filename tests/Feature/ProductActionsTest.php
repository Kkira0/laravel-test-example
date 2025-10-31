<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductActionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_increase_and_decrease_quantity()
    {
        $product = Product::factory()->create(['quantity' => 5]);

        // Increase quantity
        $this->patch(route('products.increase', $product));
        $this->assertEquals(6, $product->fresh()->quantity);

        // Decrease quantity
        $this->patch(route('products.decrease', $product));
        $this->assertEquals(5, $product->fresh()->quantity);
    }

    public function test_delete_product()
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', $product));
        $response->assertRedirect(route('products.index'));

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_view_product_details()
    {
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'quantity' => 5
        ]);

        $response = $this->get(route('products.show', $product));
        $response->assertStatus(200);
        $response->assertSeeText('Test Product');
        $response->assertSeeText('Quantity: 5');
    }

    public function test_product_details_page()
{
    // Create a test product
    $product = Product::factory()->create([
        'name' => 'Test Product',
        'description' => 'Test Description',
        'quantity' => 10,
        'status' => 1,
        'expiration_date' => now()->addDays(5)->toDateString()
    ]);

    // Visit the product details page
    $response = $this->get(route('products.show', $product));

    // Check HTTP status
    $response->assertStatus(200);

    // Check that product details are visible
    $response->assertSeeText('Test Product');
    $response->assertSeeText('Test Description');
    $response->assertSeeText('Quantity: 10');
    $response->assertSeeText('Active');
    $response->assertSeeText($product->expiration_date);

    // Check that Increase/Decrease buttons are present
    $response->assertSee('Increase Quantity');
    $response->assertSee('Decrease Quantity');
}

}
