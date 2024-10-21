<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $username = $request->username;
            if (!Auth::attempt(['username' => $username, 'password' => $request->password])) {
                return response_format('Invalid Credentials', null, false, 401);
            }
            $teacher = Teacher::where('username', $username)->first();
            if (!$teacher) {
                throw new Exception("Something went wrong", 1);
            }
            $token = $teacher->createToken('auth_token')->plainTextToken;

            $data = [
                'teacher' => $teacher,
                'access_token' => $token
            ];
            return response_format('Login Successful', $data, true, 200);

        } catch (\Throwable $th) {
            return response_format($th->getMessage(), null, false, 500);
        }
    }

    public function logout(Request $request) {
        try {
            $request->user()->currentAccessToken()->delete();
            return response_format('Logout Successful', null, true, 200);
        } catch (\Throwable $th) {
            return response_format($th->getMessage(), null, false, 500);
        }
    }
}
