<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SaleReturnDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function saleReturns(): HasOne
    {
        return $this->hasOne(SaleReturn::class,'id','sale_return_id');
    }
    public function product(): HasOne
    {
        return $this->hasOne(Product::class,'id','product_id');
    }
}
