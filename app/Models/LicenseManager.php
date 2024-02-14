<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class LicenseManager extends Model
{
    use HasFactory;

    protected $table = 'license_manager';

    protected $fillable = [
        'created_by',
        'product_id',
        'sn',
        'note',
    ];

    protected $with = ['createdBy', 'product', 'licenseStatuses'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function licenseStatuses()
    {
        return $this->hasMany(LicenseStatus::class, 'license_manager_id');
    }
    public function licensedUsers()
    {
        return $this->hasMany(LicensedUser::class, 'license_manager');
    }

    public function getSnAttribute($value)
    {
        try {
            // Decrypt the 'sn' attribute
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption errors, e.g., invalid encryption
            return null;
        }
    }
}
