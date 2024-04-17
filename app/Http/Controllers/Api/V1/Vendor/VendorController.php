<?php

namespace App\Http\Controllers\Api\V1\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\V1\Vendor\VendorService;
use App\Http\Requests\V1\Vendor\VendorCreationRequest;
use App\Http\Requests\V1\Vendor\UpdateVendorRequest;



class VendorController extends Controller
{

    protected $vendorService; 

    public function __construct(VendorService $vendorService)
    {
        $this->vendorService = $vendorService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/vendors",
     *     summary="Get all vendors",
     *     tags={"Vendors"},
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         required=false,
     *         description="Number of vendors per page",
     *         @OA\Schema(
     *             type="integer",
     *             default=15
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="current_page", type="integer", description="The current page number"),
     *             @OA\Property(property="data", type="array", description="Array of vendors", @OA\Items(ref="#/components/schemas/Vendor")),
     *             @OA\Property(property="first_page_url", type="string", description="URL of the first page"),
     *             @OA\Property(property="from", type="integer", description="Index of the first vendor in the current page"),
     *             @OA\Property(property="last_page", type="integer", description="The last page number"),
     *             @OA\Property(property="last_page_url", type="string", description="URL of the last page"),
     *             @OA\Property(property="next_page_url", type="string", description="URL of the next page"),
     *             @OA\Property(property="path", type="string", description="URL path of the current page"),
     *             @OA\Property(property="per_page", type="integer", description="Number of vendors per page"),
     *             @OA\Property(property="prev_page_url", type="string", description="URL of the previous page"),
     *             @OA\Property(property="to", type="integer", description="Index of the last vendor in the current page"),
     *             @OA\Property(property="total", type="integer", description="Total number of vendors"),
     *         )
     *     )
     * )
     */


    public function index()
    {
        $vendors = $this->vendorService->allVendors(request()->input('per_page'));
        return response()->json($vendors);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/vendors",
     *     summary="Create a new vendor",
     *     tags={"Vendors"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Vendor data",
     *         @OA\JsonContent(
     *             required={"name", "email", "business_type_id", "description", "phone", "address", "city", "state", "country", "user"},
     *             @OA\Property(property="name", type="string", maxLength=255, description="The name of the vendor"),
     *             @OA\Property(property="email", type="string", format="email", maxLength=255, description="The email address of the vendor"),
     *             @OA\Property(property="business_type_id", type="integer", description="The ID of the business type for the vendor"),
     *             @OA\Property(property="description", type="string", maxLength=1000, description="The description of the vendor"),
     *             @OA\Property(property="phone", type="string", maxLength=255, description="The phone number of the vendor"),
     *             @OA\Property(property="address", type="string", maxLength=1000, description="The address of the vendor"),
     *             @OA\Property(property="city", type="string", maxLength=255, description="The city of the vendor"),
     *             @OA\Property(property="state", type="string", maxLength=255, description="The state of the vendor"),
     *             @OA\Property(property="country", type="string", maxLength=255, description="The country of the vendor"),
     *             @OA\Property(property="user", type="object", description="The user details associated with the vendor"),
     *             @OA\Property(property="coupon_status", type="string", description="The status of the coupon associated with the vendor")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Vendor created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */

    public function store(VendorCreationRequest $request)
    {
        var_dump($request->validated());
        $vendor =  $this->vendorService->createVendor($request->validated());
        return response()->json($vendor);
    }


    /**
     * @OA\Get(
     *     path="/api/v1/vendors/{id}",
     *     summary="Get a single vendor",
     *     tags={"Vendors"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the vendor to retrieve",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", description="The ID of the vendor"),
     *             @OA\Property(property="name", type="string", description="The name of the vendor"),
     *             @OA\Property(property="email", type="string", description="The email address of the vendor"),
     *             @OA\Property(property="business_type_id", type="integer", description="The ID of the business type for the vendor"),
     *             @OA\Property(property="description", type="string", description="The description of the vendor"),
     *             @OA\Property(property="phone", type="string", description="The phone number of the vendor"),
     *             @OA\Property(property="address", type="string", description="The address of the vendor"),
     *             @OA\Property(property="city", type="string", description="The city of the vendor"),
     *             @OA\Property(property="state", type="string", description="The state of the vendor"),
     *             @OA\Property(property="country", type="string", description="The country of the vendor")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Vendor not found"
     *     )
     * )
     */


    public function show(int $vendor)
    {
        return response()->json($this->vendorService->fetchVendor($vendor));
    }
    /**
     * @OA\Put(
     *     path="/api/v1/vendors/{id}",
     *     summary="Update an existing vendor",
     *     tags={"Vendors"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the vendor to update",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Vendor data",
     *         @OA\JsonContent(
     *             @OA\Property(property="logo", type="string", description="The logo image of the vendor"),
     *             @OA\Property(property="cover_image", type="string", description="The cover image of the vendor"),
     *             @OA\Property(property="latitude", type="number", description="The latitude of the vendor location"),
     *             @OA\Property(property="longitude", type="number", description="The longitude of the vendor location"),
     *             @OA\Property(property="address", type="string", description="The address of the vendor"),
     *             @OA\Property(property="city", type="string", description="The city of the vendor"),
     *             @OA\Property(property="state", type="string", description="The state of the vendor"),
     *             @OA\Property(property="country", type="string", description="The country of the vendor"),
     *             @OA\Property(property="min_order", type="string", description="The minimum order amount for the vendor"),
     *             @OA\Property(property="low_boundary", type="string", description="The low boundary value for the vendor"),
     *             @OA\Property(property="upper_boundary", type="string", description="The upper boundary value for the vendor"),
     *             @OA\Property(property="coupon_status", type="string", description="The status of the coupon associated with the vendor")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Vendor updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Vendor not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */


    public function update(UpdateVendorRequest $request, int $vendor_id)
    {
        return response()->json($this->vendorService->updateVendor($request->validated(), $vendorId));
    }

    
}
