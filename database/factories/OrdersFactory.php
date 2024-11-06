<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Kossa\AlgerianCities\Wilaya;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,                  // Create a related user or use null for optional
            'order_number' => strtoupper(Str::random(10)), // Random unique order number
            'name' => $this->faker->name,                  // Fake name
            'state' => $this->faker->numberBetween(0, 2),  // Random state (e.g., 0, 1, or 2)
            'address' => $this->faker->address,            // Fake address
            'phone' => $this->faker->phoneNumber,          // Fake phone number
            'email' => $this->faker->unique()->safeEmail,  // Unique fake email
            'total_price' => $this->faker->randomFloat(2, 100, 1000),      // Random total price
            'sub_total_price' => $this->faker->randomFloat(2, 80, 900),    // Random subtotal
            'shipping_price' => $this->faker->optional()->randomFloat(2, 5, 50), // Optional shipping price
            'discount' => $this->faker->optional()->randomFloat(2, 0, 100),      // Optional discount
            'wilaya_id' => wilaya(random_int(1, 58))->id,
            'commune_id' =>  random_int(1,10), // Related commune
            'delivery_state' => $this->faker->numberBetween(0, 2), // Random delivery state (e.g., 0, 1, or 2)
            'payment_method' => $this->faker->numberBetween(0, 3), // Random payment method
            'payment_state' => $this->faker->numberBetween(0, 1),  // Random payment state (e.g., 0 or 1)
        ];
    }
}
