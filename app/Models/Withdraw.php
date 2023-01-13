<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Interact with the user's sale num.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function withdrawNum(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => "W".$value,
        );
    }
}
