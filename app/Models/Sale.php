<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Interact with the user's sale num.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function saleNum(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => "S".$value,
        );
    }


    public function saleDetails(): HasMany
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
