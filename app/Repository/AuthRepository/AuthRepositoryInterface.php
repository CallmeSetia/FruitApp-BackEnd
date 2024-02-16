<?php

namespace App\Repository\AuthRepository;

interface AuthRepositoryInterface
{
    public function loginAdmin($request);
    public function logoutAdmin();
    public function getUserAuth();
    public function checkIsLoginAdmin();
    public function refreshAdmin($request);

}
