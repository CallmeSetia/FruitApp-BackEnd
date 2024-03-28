<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Admin\CreateAdminRequest;
use App\Http\Requests\User\Admin\UpdateAdminRequest;
use App\Http\Requests\User\Customer\CreateCustomerRequest;
use App\Http\Requests\User\Customer\UpdateCustomerRequest;
use App\Services\UserServices;
use App\Util\Messages;
use Exception;
use Illuminate\Http\Request;

class UserCustomerApiController extends Controller
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
            $user = $this->userService->getUserCustomer($request);

            return (!$user)
                ? $this->sendError($user, Messages::USER_CUSTOMER_READ_FAILURE)
                : $this->sendResponse($user, Messages::USER_CUSTOMER_READ_SUCCESS);

        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }
    public function indexSelf(Request $request) {
        try {
            $user = $this->userService->getUserCustomerSelf($request);

            return (!$user)
                ? $this->sendError($user, Messages::USER_CUSTOMER_READ_FAILURE)
                : $this->sendResponse($user, Messages::USER_CUSTOMER_READ_SUCCESS);

        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }
    public function createCustomer(CreateCustomerRequest $request) {
        try {
            $user = $this->userService->createCustomer($request);

            return (!$user)
                ? $this->sendError($user, Messages::USER_CUSTOMER_CREATE_FAILURE)
                : $this->sendResponse($user, Messages::USER_CUSTOMER_CREATE_SUCCESS);

        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }

    public function updateCustomer(UpdateCustomerRequest $request) {
        try {
            $user = $this->userService->updateCustomer($request);

            return (!$user)
                ? $this->sendError($user, Messages::USER_CUSTOMER_UPDATE_FAILURE)
                : $this->sendResponse($user, Messages::USER_CUSTOMER_UPDATE_SUCCESS);

        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }

    public function deleteCustomer(Request $request) {
        try {
            $user = $this->userService->deleteCustomer($request);

            return (!$user)
                ? $this->sendError($user, Messages::USER_CUSTOMER_DELETE_FAILURE)
                : $this->sendResponse($user, Messages::USER_CUSTOMER_DELETE_SUCCESS);

        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }

}
