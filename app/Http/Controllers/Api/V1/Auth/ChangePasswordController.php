<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OpenApi\Annotations  as OA;
use App\Models\User;

class ChangePasswordController extends Controller
{
    

    /**
     * @OA\Post(
     *     path="/api/v1/change-password/{userid}",
     *     tags={"User Management"},
     *     summary="Change user password",
     *     description="Change the password for a user identified by the provided user ID",
     *     operationId="changePassword",
     *     security={{ "bearerAuth":{} }},
     *     @OA\Parameter(
     *         name="userid",
     *         in="path",
     *         required=true,
     *         description="ID of the user whose password will be changed",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="New password information",
     *         @OA\JsonContent(
     *             required={"current_password", "new_password", "new_password_confirmation"},
     *             @OA\Property(property="current_password", type="string", example="oldpassword123"),
     *             @OA\Property(property="new_password", type="string", example="newpassword456"),
     *             @OA\Property(property="new_password_confirmation", type="string", example="newpassword456")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password changed successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Password changed successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Current password is incorrect")
     *         )
     *     )
     * )
     */

    public function changePassword(Request $request, int $userid)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8',
            'new_password_confirmation' => 'required|string|same:new_password',
        ]);

        $user = User::find($userid);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Current password is incorrect'], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }

    
}
