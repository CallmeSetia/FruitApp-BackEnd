<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
      'nama',
      'kode_product',
      'created_by'
    ];

    protected $with = ['user'];

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function contributor() {
        return $this->hasOne(ContributorProduct::class);
    }

    public function parameter() {
        return $this->hasOne(ParameterProduct::class);
    }

    public function license() {
        return  $this->hasMany(LicenseManager::class);
    }
}
