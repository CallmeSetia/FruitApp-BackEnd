<?php

namespace App\Repository\AuthRepository;

interface AuthRepositoryInterface
{
    public function loginAdmin($request);
    public function loginLicensedUser($request);
    public function logoutAdmin();
    public function logoutLicensedUser();

    public function getUserAuth();
    public function checkIsLoginAdmin();
    public function checkIsLoginLicensedUser();
    public function refreshAdmin($request);
    public function refreshLicensedUser($request);

}
