<?php

namespace App\Http\Controllers;
use OpenApi\Annotations as OA;

abstract class Controller
     /**
     * @OA\Info(
     *    title="Jollof API Swagger Doc",
     *    description="An API for jollof.com",
     *    version="1.0.0",
     * ),
      * @OA\Schema(
    *     schema="User",
    *     title="User",
    *     description="User model",
    *     @OA\Property(property="id", type="integer", format="int64", example=1),
    *     @OA\Property(property="name", type="string", example="John Doe"),
    *     @OA\Property(property="email", type="string", format="email", example="john@example.com"),
    *     @OA\Property(property="created_at", type="string", format="date-time"),
    *     @OA\Property(property="updated_at", type="string", format="date-time"),
    * ),
    * @OA\Schema(
    *     schema="Vendor",
    *     title="Vendor",
    *     description="Vendor model",
    *     @OA\Property(property="id", type="integer", description="The ID of the vendor"),
    *     @OA\Property(property="name", type="string", description="The name of the vendor"),
    *     @OA\Property(property="email", type="string", description="The email address of the vendor"),
    *     @OA\Property(property="business_type_id", type="integer", description="The ID of the business type for the vendor"),
    *     @OA\Property(property="description", type="string", description="The description of the vendor"),
    *     @OA\Property(property="phone", type="string", description="The phone number of the vendor"),
    *     @OA\Property(property="address", type="string", description="The address of the vendor"),
    *     @OA\Property(property="city", type="string", description="The city of the vendor"),
    *     @OA\Property(property="state", type="string", description="The state of the vendor"),
    *     @OA\Property(property="country", type="string", description="The country of the vendor"),
    * )
    */


{
 
  //
    
}
