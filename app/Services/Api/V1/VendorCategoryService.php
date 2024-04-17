<?php
namespace App\Services\Api\V1;

use App\Models\Api\V1\VendorCategory;

class VendorCategoryService{

    public function __construct()
    {

    }

    public function fetchAllVendorCategory()
    {
        $vendorCategories = VendorCategory::all();
        return $vendorCategories;
    }
}