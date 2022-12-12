<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PurchaseDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function purchase(): HasOne
    {
        return $this->hasOne(Purchase::class,'id','purchase_id');
    }
}
