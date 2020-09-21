<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteList extends Model
{
    protected $table = 'favourite_lists' ;  // to connect the model with its corresponding table
    use HasFactory;
    protected $guarded = [];      // to allow mass assigning

    function product()  // identify the one to many relationship between favrouite list& product
    {
        return $this->belongsTo(products::class,'product_id');
    }

    function user()  // identify the one to many relationship between subcategory & product
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
