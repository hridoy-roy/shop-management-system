<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SaleDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sale(): HasOne
    {
        return $this->hasOne(Sale::class,'id','sale_id');
    }
    public function product(): HasOne
    {
        return $this->hasOne(Product::class,'id','product_id');
    }
}
