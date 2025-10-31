<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        // Use faker for realistic product details
        $productNames = [
            'Organic Apple Juice', 'Wireless Mouse', 'Bluetooth Speaker', 'Running Shoes', 'LED Desk Lamp',
            'Smartphone Charger', 'Reusable Water Bottle', 'Noise Cancelling Headphones', 'Coffee Beans 1kg',
            'Yoga Mat', 'USB-C Cable', 'Travel Backpack', 'Desk Organizer', 'Cotton T-Shirt',
            'Gaming Keyboard', 'Electric Toothbrush', 'Cooking Pan', 'Perfume 100ml', 'Wireless Router', 'Notebook A5'
        ];

        return [
            'name' => fake()->randomElement($productNames),
            'quantity' => fake()->numberBetween(1, 200),
            'description' => fake()->sentence(12),
            'expiration_date' => fake()->boolean(50)
                ? fake()->dateTimeBetween('now', '+1 year')->format('Y-m-d')
                : null,
            'status' => fake()->boolean(80), // 80% active
        ];
    }
}
