<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContributorProduct extends Model
{
    use HasFactory;


    protected $table = 'contributor';

    protected $fillable = [
        'product_id',
        'contributor',
        'date_released',
        'version'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
