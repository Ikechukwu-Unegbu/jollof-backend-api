<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\V1\VendorCategoryService;
use OpenApi\Annotations as OA;


class VendorCagtegoryController extends Controller
{

    protected $vendorCateService;

    public function __construct(VendorCategoryService $vendorCateService)
    {
        $this->vendorCateService = $vendorCateService;
    }
    /**
     * @OA\Get(
     *     path="/api/v1/vendor-categories",
     *     summary="Get all vendor categories",
     *     tags={"Vendor Categories"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="name", type="string", description="The name of the vendor category (required)"),
     *                 @OA\Property(property="description", type="string", description="The description of the vendor category"),
     *                 @OA\Property(property="img_url", type="string", description="The image URL of the vendor category")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */

    public function index()
    {   
        return response()->json($this->vendorCateService->fetchAllVendorCategory());
    }

    
}
