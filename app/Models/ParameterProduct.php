<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterProduct extends Model
{
    use HasFactory;
    protected $table = 'parameter_product';

    protected $fillable = [
        'product_id',
        'format_license',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Add methods or relationships as needed based on your application's requirements

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Populate the fillable array dynamically using a loop
        for ($i = 1; $i <= 20; $i++) {
            $this->fillable[] = "custom_field_$i";
            $this->fillable[] = "type_field_$i";
            $this->fillable[] = "option_field_$i";
        }
    }
}
