<?php

namespace App\Http\Controllers\Api\V1\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\V1\Vendor\VendorService;


class VendorController extends Controller
{

    protected $vendorService; 

    public function __construct(VendorService $vendorService)
    {
        $this->vendorService = $vendorService;
    }

    public function index()
    {
        $vendors = $this->vendorService->allVendors(request()->input('per_page'));
        return response()->json($vendors);
    }

    public function store(VendorCreationRequest $request)
    {
        $vendor =  $this->vendorService->createVendor($request->validated());
        return response()->json($vendor);
    }

    public function show(int $vendor)
    {
        return response()->json($this->vendorService->fetchVendor($vendor));
    }

    public function update(VendorUpdateRequest $request, int $vendor_id)
    {
        return response()->json($this->vendorService->updateVendor($request->validated(), $vendorId));
    }

  
}
