<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginUserRequest;
use Throwable;

class AuthController extends Controller
{
    public function __construct(protected UserService $user)
    {
    }

    public function login(LoginUserRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            $token = Auth::attempt($credentials);

            if (!$token) return response()->json(['status'=>'error','code'=>401, 'message' => 'Wrong email or password'], 401);

            $user = Auth::user();
            return response()->auth($user, $token);
        } catch (Throwable $e) {
            return response()->error($e->getMessage(), 500);
        }
    }

    public function register(StoreUserRequest $request)
    {
        try {
            return response()->api($this->user->createUser($request), 201);
        } catch (Throwable $e) {
            return response()->error($e->getMessage(), 500);
        }
    }

    public function logout()
    {
        try {
            Auth::logout();
            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (Throwable $e) {
            return response()->error($e->getMessage(), 500);
        }
    }

    public function refresh()
    {
        try {
            return response()->auth(Auth::user(), Auth::refresh());
        } catch (Throwable $e) {
            return response()->error($e->getMessage(), 500);
        }
    }
}
