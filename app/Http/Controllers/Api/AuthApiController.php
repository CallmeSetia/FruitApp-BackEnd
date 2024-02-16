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
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login as admin",
     *     tags={"Authentication"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object", example={}),
     *             @OA\Property(property="message", type="string", example="Login successful")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Invalid credentials")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Internal Server Error")
     *         )
     *     )
     * )
     */

    public function login( LoginRequest $request)
    {
        try {
            $user = $this->authService->loginAdmin($request);

            return (!$user)
                ? $this->sendError($user, Messages::AUTH_LOGIN_FAILURE)
                : $this->sendResponse($user, Messages::AUTH_LOGIN_SUCCESS);


        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }
    /**
     * @OA\Post(
     *     path="/api/logout/admin",
     *     summary="Logout as admin",
     *     tags={"Authentication"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful logout",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object", example={}),
     *             @OA\Property(property="message", type="string", example="Logout successful")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Invalid token")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Internal Server Error")
     *         )
     *     )
     * )
     */
    public function logoutAdmin() {
        return $this->logout();
    }


    private function logout()
    {
        try {
            $user =  $this->authService->logoutAdmin() ;

            return (!$user)
               ? $this->sendError($user, Messages::AUTH_LOGOUT_FAILURE)
               : $this->sendResponse($user, Messages::AUTH_LOGOUT_SUCCESS);
        } catch (Exception $e) {
            // Handle general exceptions
            return $this->sendError(null, $e->getMessage());
        }
    }
}
