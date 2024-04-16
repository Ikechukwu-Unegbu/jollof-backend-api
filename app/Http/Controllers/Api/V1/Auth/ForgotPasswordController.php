<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
   
    /**
     * @OA\Post(
     *     path="/api/forgot-password",
     *     tags={"Authentication"},
     *     summary="Forgot password",
     *     description="Send a password reset link to the provided email address",
     *     operationId="forgotPassword",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Email address",
     *         @OA\JsonContent(
     *             required={"email"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password reset link sent",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Password reset link sent"),
     *              @OA\Property(property="status", type="string", example="success")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Unable to send password reset link",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Unable to send password reset link"),
     *             @OA\Property(property="status", type="string", example="failed")
     *         )
     *     )
     * )
     */
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => 'Password reset link sent', 
                'status'=>'success'
            ], 200);
        } else {
            return response()->json(
                [   'status'=>'failed',
                    'error' => 'Unable to send password reset link'], 500);
        }
    }

    
}
