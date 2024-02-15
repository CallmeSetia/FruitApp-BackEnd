<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $fillable = [
        'kode',
        'nama_produk',
        'description',
        'satuan',
        'harga',
        'created_at',
        'updated_at',
    ];

    public function stock()
    {
        return $this->hasOne(Stock::class, 'product_id');
    }

    public function transaction_detail() {
        return $this->hasMany(TransactionDetail::class, 'product_id');
    }
}
