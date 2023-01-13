<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseReturn extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Interact with the user's purchase return num.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function purchaseReturnNum(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => "PR".$value,
        );
    }

    public function purchaseReturnDetails(): HasMany
    {
        return $this->hasMany(PurchaseReturnDetail::class);
    }
}
