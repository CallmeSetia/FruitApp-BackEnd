<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';
    protected $with = ['transaction_detail'];

    protected $fillable = [
        'date'
    ];

    public function transaction_detail()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }
}
