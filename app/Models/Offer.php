<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'discount_percentage',
        'description',
        'start_date',
        'end_date',
        'active',
    ];

    /**
     * Get the products that have this offer.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}