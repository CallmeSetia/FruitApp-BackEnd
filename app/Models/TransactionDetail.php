<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'transaction_details';
    protected $fillable = [
        'transaction_id',
        'product_id',
        'user_id',
        'quantity',
    ];
    protected $with = ['product', 'user'];

    public  function transaction() {
        return $this->belongsTo(Transaction::class);
    }

    public  function product() {
        return $this->belongsTo(Product::class);
    }

    public  function user() {
        return $this->belongsTo(User::class);
    }


}
