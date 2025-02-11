<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name'
    ];

    // The detailed data that will be hidden
    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}