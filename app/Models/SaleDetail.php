<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class SaleDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function stock(): MorphOne
    {
        return $this->morphOne(Stock::class,'stocksable');
    }

    public function sale(): HasOne
    {
        return $this->hasOne(Sale::class,'id','sale_id');
    }

    public function product(): HasOne
    {
        return $this->hasOne(Product::class,'id','product_id');
    }
}
