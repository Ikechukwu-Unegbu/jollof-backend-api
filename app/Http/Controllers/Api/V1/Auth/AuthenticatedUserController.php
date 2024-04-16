<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

class AuthenticatedUserController extends Controller
{
    
    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     tags={"Authentication"},
     *     summary="User login",
     *     description="Authenticate a user and generate an API token",
     *     operationId="login",
     *     @OA\RequestBody(
     *         required=true,
     *         description="User credentials",
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."),
     *             @OA\Property(property="user", type="object", ref="#/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Unauthorized")
     *         )
     *     )
     * )
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|string'
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;
            return response()->json([
                'token' => $token,
                'user'=>$user
            ], 200);
        } else {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"Authentication"},
     *     summary="User logout",
     *     description="Revoke the current access token to logout the user",
     *     operationId="logout",
     *     security={{ "bearerAuth":{} }},
     *     @OA\Response(
     *         response=200,
     *         description="Successfully logged out",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Successfully logged out")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    
}
