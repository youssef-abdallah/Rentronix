<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';  // to connect the model with its corresponding table
    use HasFactory;
    protected $guarded = [];      // to allow mass assigning

    function subcategory()  // identify the one to many relationship between subcategory & product
    {
        return $this->belongsTo(subcategories::class,'subcategory_id');
    }

    function owner()  // identify the one to many relationship between subcategory & product
    {
        return $this->belongsTo(User::class,'owner_id');
    }

    function favouriteList()
    {
        return $this->hasMany(FavouriteList::class);
    }

    function comments()
    {
        return $this->hasMany(Comment::class);
    }



}
