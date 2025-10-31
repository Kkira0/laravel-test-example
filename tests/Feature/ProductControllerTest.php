<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function it_displays_products_index(): void
    {
        Product::factory()->count(5)->create();

        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertSeeText('Products');
        $response->assertSeeText(Product::first()->name);
    }

    public function it_displays_create_form(): void
    {
        $response = $this->get(route('products.create'));

        $response->assertStatus(200);
        $response->assertSee('Add New Product');
    }

    public function it_can_store_a_product(): void
    {
        $data = Product::factory()->make()->toArray();

        $response = $this->post(route('products.store'), $data);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', [
            'name' => $data['name'],
        ]);
    }

    public function it_validates_required_fields_on_store(): void
    {
        $response = $this->post(route('products.store'), []);

        $response->assertSessionHasErrors(['name', 'quantity', 'status']);
    }

    public function it_displays_edit_form(): void
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.edit', $product));

        $response->assertStatus(200);
        $response->assertSee('Edit Product');
        $response->assertSee($product->name);
    }

    public function it_can_delete_a_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function it_can_add_new_product(): void
    {
        $data = [
            'name' => 'Test Product',
            'description' => 'Description',
            'quantity' => 5,
            'expiration_date' => now()->addDays(10)->toDateString(),
            'status' => 1
        ];

        $response = $this->post(route('products.store'), $data);
        $response->assertRedirect(route('products.index'));

        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->put(route('products.update', $product), [
            'name' => 'Updated Name',
            'quantity' => 10,
            'description' => 'Updated',
            'expiration_date' => now()->toDateString(),
            'status' => 1
        ]);


        $response->assertRedirect(route('products.index'));
        $this->assertEquals('Updated Name', $product->fresh()->name);
    }


   public function test_can_increase_quantity_via_controller()
{
    $product = Product::factory()->create(['quantity' => 5]);

    $response = $this->patch(route('products.increase', $product));
    $response->assertRedirect(route('products.show', $product));

    $this->assertEquals(6, $product->fresh()->quantity);
}

public function test_can_decrease_quantity_via_controller()
{
    $product = Product::factory()->create(['quantity' => 5]);

    $response = $this->patch(route('products.decrease', $product));
    $response->assertRedirect(route('products.show', $product));

    $this->assertEquals(4, $product->fresh()->quantity);
}


}
