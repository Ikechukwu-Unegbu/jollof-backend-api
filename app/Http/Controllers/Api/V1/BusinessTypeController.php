<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\V1\BusinessTypeService;
use OpenApi\Annotations as OA;

class BusinessTypeController extends Controller
{

    protected $businessTypeService; 

    public function __construct(BusinessTYpeService $businessTypeService)
    {
        $this->businessTypeService = $businessTypeService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/business-types",
     *     summary="Get all business types",
     *     tags={"Business Types"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", description="The ID of the business type"),
     *                 @OA\Property(property="name", type="string", description="The name of the business type"),
     *                 @OA\Property(property="description", type="string", description="The description of the business type")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Business types not found"
     *     )
     * )
     */

    public function index()
    {
        return response()->json($this->businessTypeService->fetchAllBusinessTypes());
    }

    
}
