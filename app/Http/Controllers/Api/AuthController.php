<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Register method for new users
    public function register(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422); // 422 is a proper status code for validation errors
        }

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate a personal access token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return user data along with access token
        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // Login method for authenticating users
    public function login(Request $request)
    {
        // Attempt to authenticate the user with the given credentials
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401); // 401 is the status code for unauthorized access
        }

        // Get the authenticated user
        $user = User::where('email', $request->email)->firstOrFail();

        // Generate a personal access token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return success message with access token
        return response()->json([
            'message' => 'Login success',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // Logout method to revoke user tokens
    public function logout()
    {
        // Revoke all tokens for the authenticated user
        Auth::user()->tokens()->delete();

        // Return a success message
        return response()->json([
            'message' => 'Logout success',
        ]);
    }
}
