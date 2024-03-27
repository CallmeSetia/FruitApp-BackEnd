<?php

namespace App\Repository\AuthRepository;

use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    public function loginAdmin($request)
    {
        $onlyColumn = [
            'username',
            'password',
        ];

        $credentials = $request->only($onlyColumn);
        $token = Auth::attempt($credentials);

        if (!$token) return false;
        $user = Auth::user();
        $user->token = $token;

        return $user;
    }


    public function logoutAdmin()
    {
        if (!$this->checkIsLoginAdmin()) return false;
        Auth::logout();
        return true;
    }


    public function refreshAdmin($request)
    {
        if (!$this->checkIsLoginAdmin()) return false;
        $user = Auth::refresh();
        return $user;
    }


    public function getUserAuth()
    {
        $user = Auth::user() ?? Auth::guard('licensed_users')->user();
        return $user;
    }

    public function checkIsLoginAdmin() {
        $user = Auth::check();
        if (!$user) return false;
        return true;
    }


}
