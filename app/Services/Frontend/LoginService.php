<?php

namespace App\Services\Frontend;

use Exception;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function login(
        array $data
    ) {
        $login = Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
            'status' => 1,
        ]);

        if (!$login) {
            throw new Exception(
                'Invalid email or password.'
            );
        }

        request()
            ->session()
            ->regenerate();

        return true;
    }
}