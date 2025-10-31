<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'description', 'expiration_date', 'status'];

     public function increaseQuantity(int $amount = 1): void
    {
        $this->quantity += $amount;
        $this->save();
    }

    // Decrease quantity by 1 (or optional amount)
    public function decreaseQuantity(int $amount = 1): void
    {
        $this->quantity = max(0, $this->quantity - $amount); // don't go below 0
        $this->save();
    }
}
