<?php

namespace App\Interfaces;
interface UserInterface
{
    public function createUser($request);
    public function getUsers();
    public function showUser(int $userId);
    public function updateUser(int $userId, $request);
    public function deleteUser(int $userId);
}