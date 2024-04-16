<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class RegisterUserController extends Controller
{

    /**
 * @OA\Post(
 *     path="/api/v1/register",
 *     summary="Register a new user",
 *     tags={"Authentication"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="phone", type="string", example="1234567890"),
 *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="password123", minLength=8),
 *             @OA\Property(property="password_confirmation", type="string", format="password", example="password123", minLength=8),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="User successfully registered",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="user", ref="#/components/schemas/User"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(property="errors", type="object", example={"name": {"The name field is required."}, "phone": {"The phone field is required."}, "email": {"The email field is required."}, "password": {"The password field is required."}}),
 *         ),
 *     ),
 * ) 
     */
    public function register(Request $request, CreateNewUser $createNewUser)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone'=>'required|string|max:20', 
            'email' => 'required|string|email|max:255|unique:users',
            // 'confirm_password'=>'required|string',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = $createNewUser->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone'=>$request->phone, 
            'password' => $request->password,
        ]);

        return response()->json([
            'status'=>'success',
            'user' => $user
        ], 201);
    }
}
