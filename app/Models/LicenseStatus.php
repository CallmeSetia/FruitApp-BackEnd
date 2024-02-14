<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_manager_id',
        'status',
    ];


    protected $table = 'license_status';
    protected $with = ['licenseManager'];
    public function licenseManager()
    {
        return $this->belongsTo(LicenseManager::class, 'license_manager_id');
    }
}
