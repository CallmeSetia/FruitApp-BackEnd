<?php

namespace App\Repository\UserRepository;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            $user_admin = $user_admin->whereHasRole(['admin', 'superuser'])->orWhere($request->only($onlyColumn));
        }
        if ($request->role == 'customer') {
            $user_admin = $user_admin->whereHasRole(['customer'])->orWhere($request->only($onlyColumn));
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
            'avatar',
            'name',
            'username',
            'email',
            'password'
        ];
        $data = $request->only($onlyColumn);
        $data['password'] = Hash::make($data['password']); // Hash the password
        $data['is_customer'] = $request->role == 'customer' ?  1 : 0;
        $data['avatar'] = $request->filled('avatar') ? $request->avatar : 'https://via.placeholder.com/200x200.png';

        $createdUser = User::create($data);
        $createdUser->addRole($request->role);

        if ($request->role == 'customer') {
            $columnCustomer = [
                'address',
                'age',
                'phone',
                'gender',
                'nomor_identitas',
                'foto_identitas',
                'email',
                'identitas_type',
                'keterangan',
                'limit_pinjaman',
            ];
            $dataInputCustomer = $request->only($columnCustomer);
            $dataInputCustomer['limit_pinjaman'] = 0; // default 0
            if ($dataInputCustomer->has('foto_identitas')) {
                $file = $dataInputCustomer->file('foto_identitas');
                $fileName = time() . '_' . trim($file->getClientOriginalName());
                $dataInputCustomer['foto_identitas'] = $file->storeAs('user/customer/foto_identitas/', $fileName, 'public');
            }

            $createdUser->customer()->create($dataInputCustomer);
        }

        return $createdUser;
    }

    public function update($request)
    {
        $userUser = User::findOrFail($request->id);
        $onlyColumn = [
            'avatar',
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

        if (!empty($userRoles = $userUser->getRoles())) {
            $role = $userRoles[0];
            if ($roleNew && $roleNew !== $role) {
                $userUser->removeRole($role);
                $userUser->addRoles([$roleNew]);
            }
        }

        // if role request is customer
        if ($request->role == 'customer') {
            $columnCustomer = [
                'address',
                'age',
                'phone',
                'gender',
                'nomor_identitas',
                'foto_identitas',
                'email',
                'identitas_type',
                'keterangan',
                'limit_pinjaman',
            ];
            $dataInputCustomer = $request->only($columnCustomer);
            $customer = $userUser->customer;

            if ($request->has('foto_identitas')) {
                if ($customer && $customer->foto_identitas && Storage::exists('public/' . $customer->foto_identitas)) {
                    // Hapus foto_identitas yang ada dari storage sebelum menyimpan yang baru
                    Storage::delete('public/' . $customer->foto_identitas);
                }
                // simpan
                $file = $request->file('foto_identitas');
                $fileName = time() . '_' . trim($file->getClientOriginalName());
                $dataInputCustomer['foto_identitas'] = $file->storeAs('user/customer/foto_identitas/', $fileName, 'public');
            }

            $userUser->customer()->update($dataInputCustomer);
        }

        $userUser->update($data);
        return $userUser;
    }


    public function delete($request)
    {
        $userAdmin = User::findOrFail($request->id);
        $userAdmin->delete();

        // Hapus foto_identitas pelanggan jika ada
        if ($userAdmin->is_customer) {
            $customer = $userAdmin->customer;
            if ($customer && $customer->foto_identitas && Storage::exists('public/' . $customer->foto_identitas)) {
                Storage::delete('public/' . $customer->foto_identitas);
            }
        }

        return $userAdmin;
    }
}
