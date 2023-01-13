<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SaleReturn extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Interact with the user's sale return num.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function saleReturnNum(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => "SR".$value,
        );
    }

    public function saleReturnDetails(): HasMany
    {
        return $this->hasMany(SaleReturnDetail::class);
    }
}
