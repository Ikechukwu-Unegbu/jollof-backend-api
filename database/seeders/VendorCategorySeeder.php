<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Api\V1\System\VendorCategory;

class VendorCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorCategories = ['Cuisine', 'Fashion', 'Scholar', 'Gift Portal', 'Business', 'Lifestyle'];

        foreach($vendorCategories as $categoryName){
            $existingCategory = VendorCategory::where('name', $categoryName)->first();

            if (!$existingCategory) {
                VendorCategory::create(['name' => $categoryName]);
            }
        }

    }
}
