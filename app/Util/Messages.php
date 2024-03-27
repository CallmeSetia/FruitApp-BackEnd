<?php

namespace App\Util;

class Messages {
    // PERMISSIONS ERROR

    const PERMISSION_ERROR = 'Anda tidak memiliki izin untuk melakukan tindakan ini.';
    const INVALID_ROLE = 'Peran yang diberikan tidak valid.';


    // Auth Messages
    const AUTH_LOGIN_SUCCESS = 'Login berhasil.';
    const AUTH_LOGIN_FAILURE = 'Login gagal. Periksa kembali username dan password Anda.';
    const AUTH_LOGOUT_SUCCESS = 'Logout berhasil.';
    const AUTH_LOGOUT_FAILURE = 'Logout gagal.';
    const AUTH_REFRESH_SUCCESS = 'Token berhasil diperbarui.';

    // User Admin Messages
    const USER_ADMIN_CREATE_SUCCESS = 'Pengguna admin berhasil dibuat.';
    const USER_ADMIN_CREATE_FAILURE = 'Gagal membuat pengguna admin.';
    const USER_ADMIN_UPDATE_SUCCESS = 'Pengguna admin berhasil diperbarui.';
    const USER_ADMIN_UPDATE_FAILURE = 'Gagal memperbarui pengguna admin.';
    const USER_ADMIN_DELETE_SUCCESS = 'Pengguna admin berhasil dihapus.';
    const USER_ADMIN_DELETE_FAILURE = 'Gagal menghapus pengguna admin.';
    const USER_ADMIN_READ_SUCCESS = 'Berhasil mendapatkan data pengguna admin.';
    const USER_ADMIN_READ_FAILURE = 'Gagal mendapatkan data pengguna admin.';

    // Customer Messages
    const USER_CUSTOMER_CREATE_SUCCESS = 'Pelanggan berhasil dibuat.';
    const USER_CUSTOMER_CREATE_FAILURE = 'Gagal membuat pelanggan.';
    const USER_CUSTOMER_UPDATE_SUCCESS = 'Pelanggan berhasil diperbarui.';
    const USER_CUSTOMER_UPDATE_FAILURE = 'Gagal memperbarui pelanggan.';
    const USER_CUSTOMER_DELETE_SUCCESS = 'Pelanggan berhasil dihapus.';
    const USER_CUSTOMER_DELETE_FAILURE = 'Gagal menghapus pelanggan.';
    const USER_CUSTOMER_READ_SUCCESS = 'Berhasil mendapatkan data pelanggan.';
    const USER_CUSTOMER_READ_FAILURE = 'Gagal mendapatkan data pelanggan.';

}
