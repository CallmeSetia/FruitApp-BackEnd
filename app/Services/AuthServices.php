<?php

namespace App\Services;

use App\Http\Requests\Auth\LoginRequest;
use App\Repository\AuthRepository\AuthRepositoryInterface;

/**
 *
 */
class AuthServices
{

    /**
     * @var AuthRepositoryInterface
     */
    private $authRepo;

    public function __construct(AuthRepositoryInterface $AuthRepo) {
        $this->authRepo = $AuthRepo;
    }

    public function loginAdmin($request) {
        $login_admin = $this->authRepo->loginAdmin($request);
        return $login_admin;
    }

    public function loginLicenseUser($request) {
        $login_license_user = $this->authRepo->loginLicensedUser($request);
        return $login_license_user;
    }

    public function refreshAdmin($request) {
        $refresh_admin_token = $this->authRepo->refreshAdmin($request);
        return $refresh_admin_token;
    }

    public function refreshLicensedUser($request) {
        $refresh_licensed_user_token = $this->authRepo->refreshLicensedUser($request);
        return $refresh_licensed_user_token;
    }

     public function logoutAdmin() {
        $logout_admin = $this->authRepo->logoutAdmin();
        return $logout_admin;
    }

    public function logoutLicensedUser() {
        $logout_licensed_user = $this->authRepo->logoutLicensedUser();
        return $logout_licensed_user;
    }

    public function getAuthUser()
    {
        return $this->authRepo->getUserAuth();
    }

}
