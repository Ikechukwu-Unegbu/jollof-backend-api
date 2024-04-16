<?php

namespace Database\Factories\Api\V1\Vendor;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Api\V1\Vendor\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'logo' => null, // Set to null or provide default logo path
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'business_type_id' => null, // Provide default business type ID if needed
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'country' => $this->faker->country,
            'phone' => $this->faker->phoneNumber,
            'lower_delivery' => $this->faker->randomNumber(2),
            'upper_delivery' => $this->faker->randomNumber(2),
            'cac_document' => null, // Set to null or provide default CAC document path
            'tin_document' => null, // Set to null or provide default TIN document path
            'personal_id_card' => null, // Set to null or provide default personal ID card path
            'coupon_running' => 0, // Default coupon running value
        ];
    }
}
