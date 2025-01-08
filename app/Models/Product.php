<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory;
    use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => $value ? 'storage/' . $value : '/images/no-image.png'
        );
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
