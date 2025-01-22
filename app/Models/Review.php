<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'name',
        'review',
    ];

    /**
     * Relationship: A review belongs to a product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
