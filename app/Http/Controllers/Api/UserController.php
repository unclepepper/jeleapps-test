<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        try
        {
            $validated = $request->validate([
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'gender' => 'required|in:male,female,undefined',
            ]);

            $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'gender' => $validated['gender'],
            ]);

            return response()->json(['message' => 'User registered', 'user' => $user], 201);
        }
        catch(ValidationException $e)
        {
            return response()->json([
                'error' => 'Invalid input',
                'messages' => $e->errors()
            ], 422);

        }
        catch(\Exception $e)
        {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }

    }

    public function profile(Request $request): JsonResponse
    {
        $user = User::where('email', $request->query('email'))->first();

        if(!$user)
        {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user);
    }
}
