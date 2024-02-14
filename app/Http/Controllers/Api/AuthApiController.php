<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthServices;
use App\Util\Messages;
use Exception;

class AuthApiController extends Controller
{

    const USER_TYPE_LICENSE = 'license';
    const USER_TYPE_ADMIN = 'admin';

    private $authService;

    public function __construct(AuthServices $AuthServices)
    {
        $this->authService = $AuthServices;
    }

    public function login($type, LoginRequest $request)
    {
        try {
            $user = $type == self::USER_TYPE_LICENSE
                ? $this->authService->loginLicenseUser($request)
                : $this->authService->loginAdmin($request);

            return (!$user)
                ? $this->sendError($user, Messages::AUTH_LOGIN_FAILURE)
                : $this->sendResponse($user, Messages::AUTH_LOGIN_SUCCESS);


        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }

    public function logoutAdmin() {
        return $this->logout(self::USER_TYPE_ADMIN);
    }

    public function logoutLicense() {
        return $this->logout(self::USER_TYPE_LICENSE);
    }

    private function logout($type)
    {
        try {
            $user = $type == self::USER_TYPE_LICENSE
                ?  $this->authService->logoutLicensedUser()
                :  $this->authService->logoutAdmin() ;

            if (!$user)
                return $this->sendError($user, Messages::AUTH_LOGOUT_FAILURE);

            return $this->sendResponse($user, Messages::AUTH_LOGOUT_SUCCESS);
        } catch (Exception $e) {
            // Handle general exceptions
            return $this->sendError(null, $e->getMessage());
        }
    }
}
