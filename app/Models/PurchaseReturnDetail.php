<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PurchaseReturnDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function purchaseReturn(): HasOne
    {
        return $this->hasOne(PurchaseReturn::class,'id','purchase_return_id');
    }
    public function product(): HasOne
    {
        return $this->hasOne(Product::class,'id','product_id');
    }
}
