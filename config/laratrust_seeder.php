<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superuser' => [
            'user-superuser' => 'c,r,u,d',
            'user-admin' => 'c,r,u,d',
            'user-license' => 'c,r,u,d',
            'license-manager' => 'c,r,u,d',
            'product' => 'c,r,u,d',
        ],
        'admin' => [
            'user-superuser' => 'r,u',
            'user-admin' => 'c,r,u,d',
            'user-license' => 'c,r,u,d',
            'license-manager' => 'c,r,u',
            'product' => 'r,u',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
