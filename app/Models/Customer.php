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


    // Mutator untuk foto_identitas
    public function setFotoIdentitasAttribute($value)
    {
        $this->attributes['foto_identitas'] = $value ? $value : null;
    }

    // Accessor untuk foto_identitas
    public function getFotoIdentitasAttribute($value)
    {
        return $value ? $value : null;
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
