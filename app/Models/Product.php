<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'product_category_id',
        'name',
        'price',
        'image'
    ];

    // The detailed data that will be hidden
    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    // This table has a relation with another table (Category) by product id as a foreign key.
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'product_category_id');
    }
    public function getPicturePathAttribute()
    {
        return url('') . Storage::url($this->attributes['image']);
    }
}