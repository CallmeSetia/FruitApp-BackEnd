<?php

namespace App\Services;

use App\Models\User;
use App\Repository\AuthRepository\AuthRepositoryInterface;
use App\Repository\UserRepository\UserRepositoryInterface;
use App\Util\Messages;
use Exception;

class UserServices
{
    protected AuthServices $authServices;
    protected UserRepositoryInterface $userRepo;

    /**
     *
     */
    public function __construct(AuthServices $authServices,
                                UserRepositoryInterface $UserRepo)
    {
        $this->authServices = $authServices;
        $this->userRepo = $UserRepo;
    }

    /**
     * @throws Exception
     */
    public function getUserAdmin($request)
    {
        $user = $this->authServices->getAuthUser();

        $roles = [
            $this->getRolesUser($user)
        ];

        $permissions = [
            'user-superuser-read',
            'user-admin-read',
            'user-license-read'
        ];

        $options = [
            'validate_all' => true, //Default: false
            'return_type' => 'boolean' //Default: 'boolean'. You can also set it as 'both'
        ];


        return $user->ability($roles, $permissions, $options)
            ? $this->userRepo->get($request)
            : throw new Exception(Messages::PERMISSION_ERROR);
    }


    public function getRolesUser($user)
    {
        return $user->roles->first()->name;
    }

    /**
     * @throws Exception
     */
    public function getUserAdminSelf($request)
    {
        $user = $this->authServices->getAuthUser();
        // GET USER BY IDE SELF (LOGGED IN USER)
        $request->merge(['id' => $user->id]);

        $roles = [
            $this->getRolesUser($user)
        ];

        $permissions = [
            'user-superuser-read',
            'user-admin-read',
            'user-license-read'
        ];

        $options = [
            'validate_all' => true, //Default: false
            'return_type' => 'boolean' //Default: 'boolean'. You can also set it as 'both'
        ];


        return $user->ability($roles, $permissions, $options)
            ? $this->userRepo->get($request)
            : throw new Exception(Messages::PERMISSION_ERROR);
    }

    /**
     * @throws Exception
     */
    public function createAdmin($request)
    {
        $user = $this->authServices->getAuthUser();
        $cekCreatedUserRole = $request->role;

        $roles = [
            $this->getRolesUser($user)
        ];

        $permissions = [
            'superuser' => 'user-superuser-create',
            'admin' => 'user-admin-create',
            'license' => 'user-license-create'
        ];

        $options = [
            'validate_all' => true,
            'return_type' => 'boolean'
        ];

        $requiredPermission = $permissions[$cekCreatedUserRole] ?? null;

        if ($requiredPermission) {
            return $user->ability($roles, $requiredPermission, $options)
                ? $this->userRepo->create($request)
                : throw new Exception(Messages::PERMISSION_ERROR);
        }

        // Handle case where the provided role is not recognized
        throw new Exception(Messages::INVALID_ROLE);
    }

    /**
     * @throws Exception
     */
    public function updateAdmin($request)
    {
        $user = $this->authServices->getAuthUser();
        $cekUpdatedUserRole = $request->role;

        $roles = [
            $this->getRolesUser($user)
        ];

        $permissions = [
            'superuser' => 'user-superuser-update',
            'admin' => 'user-admin-update',
            'license' => 'user-license-update'
        ];

        $options = [
            'validate_all' => true,
            'return_type' => 'boolean'
        ];

        $requiredPermission = $permissions[$cekUpdatedUserRole] ?? null;

        if ($requiredPermission) {
            return $user->ability($roles, $requiredPermission, $options)
                ? $this->userRepo->update($request)
                : throw new Exception(Messages::PERMISSION_ERROR);
        }

        // Handle case where the provided role is not recognized
        throw new Exception(Messages::INVALID_ROLE);

    }

    public function deleteAdmin($request)
    {
        $user = $this->authServices->getAuthUser();

        // Assuming $request->id contains the ID of the user to be deleted
        $userToDelete = User::findOrFail($request->id);
        $cekDeletedUserRole = $this->getRolesUser($userToDelete);

        $roles = [
            $this->getRolesUser($user)
        ];

        $permissions = [
            'superuser' => 'user-superuser-delete',
            'admin' => 'user-admin-delete',
            'license' => 'user-license-delete'
        ];

        $options = [
            'validate_all' => true,
            'return_type' => 'boolean'
        ];

        $requiredPermission = $permissions[$cekDeletedUserRole] ?? null;

        if ($requiredPermission) {
            return $user->ability($roles, $requiredPermission, $options)
                ? $this->userRepo->delete($request)
                : throw new Exception(Messages::PERMISSION_ERROR);
        }

        // Handle case where the provided role is not recognized
        throw new Exception(Messages::INVALID_ROLE);
    }
}
