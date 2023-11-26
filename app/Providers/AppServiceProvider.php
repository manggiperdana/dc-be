<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        Response::macro('api', function ($data = [], $status = 200) {
            return response()->json(['status' => 'success', 'code' => $status, 'data' => $data], $status);
        });

        Response::macro('auth', function ($user, $token, $status = 200) {
            return response()->json(['status' => 'success', 'code' => $status, 'user' => $user, 'token' => $token, 'type' => 'bearer'], $status);
        });

        Response::macro('error', function ($message, $status = 200) {
            return response()->json(['status' => 'error', 'message' => $message], $status);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
