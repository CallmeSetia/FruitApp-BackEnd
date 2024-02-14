<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Admin\CreateAdminRequest;
use App\Http\Requests\User\Admin\UpdateAdminRequest;
use App\Services\UserServices;
use App\Util\Messages;
use Exception;
use Illuminate\Http\Request;

class UserAdminApiController extends Controller
{
    protected $userService;

    /**
     * @param $userService
     */
    public function __construct(UserServices $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request) {
        try {
            $user = $this->userService->getUserAdmin($request);

            return (!$user)
                ? $this->sendError($user, Messages::USER_ADMIN_READ_FAILURE)
                : $this->sendResponse($user, Messages::USER_ADMIN_READ_SUCCESS);

        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }
    public function indexSelf(Request $request) {
        try {
            $user = $this->userService->getUserAdminSelf($request);

            return (!$user)
                ? $this->sendError($user, Messages::USER_ADMIN_READ_FAILURE)
                : $this->sendResponse($user, Messages::USER_ADMIN_READ_SUCCESS);

        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }
    public function createAdmin(CreateAdminRequest $request) {
        try {
            $user = $this->userService->createAdmin($request);

            return (!$user)
                ? $this->sendError($user, Messages::USER_ADMIN_CREATE_FAILURE)
                : $this->sendResponse($user, Messages::USER_ADMIN_CREATE_SUCCESS);

        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }

    public function updateAdmin(UpdateAdminRequest $request) {
        try {
            $user = $this->userService->updateAdmin($request);

            return (!$user)
                ? $this->sendError($user, Messages::USER_ADMIN_UPDATE_FAILURE)
                : $this->sendResponse($user, Messages::USER_ADMIN_UPDATE_SUCCESS);

        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }

    public function deleteAdmin(Request $request) {
        try {
            $user = $this->userService->deleteAdmin($request);

            return (!$user)
                ? $this->sendError($user, Messages::USER_ADMIN_DELETE_FAILURE)
                : $this->sendResponse($user, Messages::USER_ADMIN_DELETE_SUCCESS);

        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }

}
