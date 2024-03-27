<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'address', 'age', 'phone', 'gender', 'nomor_identitas', 'foto_identitas', 'email', 'identitas_type', 'keterangan', 'limit_pinjaman',
    ];

    protected $table = 'customer';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
