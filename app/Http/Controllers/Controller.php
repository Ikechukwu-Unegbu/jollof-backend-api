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
    * )
     */

{
 
  //
    
}
