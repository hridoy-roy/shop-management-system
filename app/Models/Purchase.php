<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Interact with the user's purchase num.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function purchaseNum(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => "P".$value,
        );
    }

    public function purchaseDetails(): HasMany
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
