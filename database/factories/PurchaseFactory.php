<?php

namespace Database\Factories;

use App\Models\Purchase;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid()->toString(),
            'vendor_id' => Vendor::inRandomOrder()->first('id'),
            'order_number' => 'PA-1 '. rand(1, 1000),
            'order_date' => Carbon::now(),
            'due_date' => Carbon::now()->addDay(),
            'branch' => 'cabang '. rand(1,10),
            'responsible_person' => $this->faker->name,
            'total_price' => rand(100.000, 200.000),
            'payment_status' => $this->faker->randomElement(['paid', 'waiting', 'missing']),
            'payment_type' => $this->faker->randomElement(['Kredit', 'Cash On Delivery']),
            'status' => $this->faker->randomElement([true, false])
        ];
    }
}
