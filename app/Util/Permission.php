<?php

namespace App\Util;

class Permission
{
    const DEFINE_PERMISSIONS = [
        'superuser' => [
            'user-superuser' => 'c,r,u,d',
            'user-admin' => 'c,r,u,d',
            'user-customer' => 'c,r,u,d',
            'product' => 'c,r,u,d',
            'transaction' => 'c,r,u,d',
            'stock' => 'c,r,u, d',
            'kas-kecil' => 'c,r,u,d',
            'kas-besar' => 'c,r,u,d'
        ],
        'admin' => [
            'user-admin' => 'c,r,u,d',
            'user-customer' => 'c,r,u,d',
            'transaction' => 'c,r,u,d',
            'product' => 'r,u',
            'stock' => 'r,u',
            'kas-kecil' => 'c,r,u,d',
//            'kas-besar' => ''
//            'user-superuser' =>
        ],

        'customer' => [],
    ];

    public function getLaratrustPermissions() {
        return self::DEFINE_PERMISSIONS;
    }

}
