<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\V1\VendorCategoryService;


class VendorCagtegoryController extends Controller
{

    protected $vendorCateService;

    public function __construct(VendorCategoryService $vendorCateService)
    {
        $this->vendorCateService = $vendorCateService;
    }

    public function index()
    {   
        return response()->json($this->vendorCateService->fetchAllVendorCategory());
    }

    
}
