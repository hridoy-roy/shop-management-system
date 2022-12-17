<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseReturn extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function purchaseReturnDetails(): HasMany
    {
        return $this->hasMany(PurchaseReturnDetail::class);
    }
}
