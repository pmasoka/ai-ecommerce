<?php

namespace App\Services\Frontend;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    public function register(
        array $data
    ) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],

            'password' => Hash::make(
                $data['password']
            ),

            'status' => 1,
        ]);
    }
}