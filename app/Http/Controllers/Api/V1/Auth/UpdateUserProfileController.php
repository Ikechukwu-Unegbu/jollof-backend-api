<?php 
namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UpdateUserProfileController extends Controller
{
    public function editUser(Request $request, $userid)
    {
      
        $user = User::findOrFail($userid);

       
        $request->validate([
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        
        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('profile_pics', 's3'); 
            $user->profile_pic = Storage::disk('s3')->url($path); 
        }

        // Update user profile with provided data
        $user->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
        ]);

        return response()->json(['message' => 'User profile updated successfully'], 200);
    }

}



