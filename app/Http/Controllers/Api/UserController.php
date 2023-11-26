<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Throwable;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected UserService $user,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return list of users
        try {
            return response()->api($this->user->getUsers());
        } catch (Throwable $e) {
            return response()->error($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // unused in api
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // create user
        try {
            return response()->api($this->user->createUser($request), 201);
        } catch (Throwable $e) {
            return response()->error($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // show user
        try {
            return response()->api($this->user->showUser($id));
        } catch (Throwable $e) {
            return response()->error($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // unused in api
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        //update user
        try {
            return response()->api($this->user->updateUser($id, $request));
        } catch (Throwable $e) {
            return response()->error($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete user
        try {
            return response()->api($this->user->deleteUser($id));
        } catch (Throwable $e) {
            return response()->error($e->getMessage(), 500);
        }
    }
}
