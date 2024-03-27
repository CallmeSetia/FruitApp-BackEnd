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


    public function refreshAdmin($request) {
        $refresh_admin_token = $this->authRepo->refreshAdmin($request);
        return $refresh_admin_token;
    }

     public function logoutAdmin() {
        $logout_admin = $this->authRepo->logoutAdmin();
        return $logout_admin;
    }

    public function getAuthUser()
    {
        return $this->authRepo->getUserAuth();
    }

}
