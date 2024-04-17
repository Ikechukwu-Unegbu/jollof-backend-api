<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\V1\BusinessTypeService;

class BusinessTypeController extends Controller
{

    protected $businessTypeService; 

    public function __construct(BusinessTYpeService $businessTypeService)
    {
        $this->businessTypeService = $businessTypeService;
    }
    public function index()
    {
        return response()->json($this->businessTypeService->fetchAllBusinessTypes());
    }

    
}
