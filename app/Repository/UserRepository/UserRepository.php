<?php

namespace App\Repository\UserRepository;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function get($request)
    {
        $user_admin = User::query();

        $onlyColumn = [
            'id',
            'name',
            'username',
            'email',
            'password',
            'remember_token',
            'created_at',
            'updated_at',
        ];

        if (!$request->filled('role')) { // Only Column
            $user_admin = $user_admin->where($request->only($onlyColumn));
        }
        if ($request->role == 'admin' || $request->role == 'superuser') {
            $user_admin = $user_admin->whereHasRole(['admin', 'superuser']);
        }
        if ($request->role == 'customer') {
            $user_admin = $user_admin->whereHasRole(['customer']);
        }
        if ($request->include) {
            $relation = array_filter(explode(',', str_replace(" ", "", $request->include)));
            $user_admin = $user_admin->with($relation);
        }

        $user_admin = $user_admin->get();
        $user_admin->each(function ($user) {
            $user->role = $user->roles->first()->name;
        });
        return $user_admin;
    }

    public function create($request)
    {
        $onlyColumn = [
//            'id', // Kolom id Auto Increment
            'name',
            'username',
            'email',
            'password'
        ];
        $data = $request->only($onlyColumn);
        $data['password'] = Hash::make($data['password']); // Hash the password

        $createdAdmin = User::create($data);
        $createdAdmin->addRole($request->role);

        return $createdAdmin;
    }

    public function update($request)
    {
        $userAdmin = User::findOrFail($request->id);
        $onlyColumn = [
            'name',
            'username',
            'email',
            'password',
        ];

        $roleNew = $request->has('role') ? $request->role : null;
        $data = $request->only($onlyColumn);

        // Check if a new password is provided
        if ($request->has('password')) {
            $data['password'] = Hash::make($data['password']); // Hash the new password
        }

        if (!empty($userRoles = $userAdmin->getRoles())) {
            $role = $userRoles[0];
            if ($roleNew && $roleNew !== $role) {
                $userAdmin->removeRole($role);
                $userAdmin->addRoles([$roleNew]);
            }
        }
        $userAdmin->update($data);

        return $userAdmin;
    }


    public function delete($request)
    {
        $userAdmin = User::findOrFail($request->id);
        $userAdmin->delete();

        return $userAdmin;
    }
}
