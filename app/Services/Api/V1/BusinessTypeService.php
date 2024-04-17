<?php 

namespace App\Services\Api\V1;

use App\Models\Api\V1\BusinessTypes;

class BusinessTypeService{
    public function __construct()
    {

    }

    public function fetchAllBusinessTypes()
    {
        $business_types = BusinessTypes::all();
        return $business_types;
    }

}