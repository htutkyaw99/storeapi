<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(string $email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        return response()->json(
            [
                'user' => $user,
            ]
        );
    }

    public function update(Request $request, int $id)
    {

        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|max:255|min:3',
            'email' => 'required|email',
            'password' => 'nullable|min:5|confirmed',
        ]);

        $user->name = $validated['name'];

        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        $token = $user->createToken('Profile Update')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function delete(int $id)
    {
        $user = User::findOrFail($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
