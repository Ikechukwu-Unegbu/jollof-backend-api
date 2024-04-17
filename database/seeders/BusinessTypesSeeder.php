<?php

namespace Database\Seeders;
use  App\Models\Api\V1\System\BusinessType;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $business_types = ['Sole Proprietorship', 'Partnership', 'Private Limited Company (Ltd)', 'Public Limited Company (PLC)', 'Limited Liability Partnership (LLP)', 'Cooperative', ];

        foreach($business_types as $bizTypeName){
            $existingBizType = VendorCategory::where('name', $bizTypeName)->first();

            if (!$existingCategory) {
                VendorCategory::create(['name' => $bizTypeName]);
            }
        }
    }
}
