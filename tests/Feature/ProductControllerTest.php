<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_products_index()
    {
        Product::factory()->count(5)->create();

        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertSeeText('Products');
        $response->assertSeeText(Product::first()->name);
    }

    /** @test */
    public function it_displays_create_form()
    {
        $response = $this->get(route('products.create'));

        $response->assertStatus(200);
        $response->assertSee('Add New Product');
    }

    /** @test */
    public function it_can_store_a_product()
    {
        $data = Product::factory()->make()->toArray();

        $response = $this->post(route('products.store'), $data);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', [
            'name' => $data['name'],
        ]);
    }

    /** @test */
    public function it_validates_required_fields_on_store()
    {
        $response = $this->post(route('products.store'), []);

        $response->assertSessionHasErrors(['name', 'quantity', 'status']);

    }

    /** @test */
    public function it_displays_edit_form()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.edit', $product));

        $response->assertStatus(200);
        $response->assertSee('Edit Product');
        $response->assertSee($product->name);
    }

    /** @test */
    public function it_can_update_a_product()
    {
        $product = Product::factory()->create();

        $data = [
            'name' => 'Updated Name',
            'description' => 'Updated desc',
            'quantity' => 10,
            'expiration_date' => now()->addDays(10)->format('Y-m-d'),
            'status' => 0,
        ];

        $response = $this->put(route('products.update', $product), $data);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Name',
        ]);
    }

    /** @test */
    public function it_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
