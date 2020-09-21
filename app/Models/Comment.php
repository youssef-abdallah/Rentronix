<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'products_comments';  // to connect the model with its corresponding table
    use HasFactory;
    protected $guarded = [];      // to allow mass assigning

    function product()  // identify the one to many relationship between product & product comments
    {
        return $this->belongsTo(products::class,'product_id');
    }

    function owner()  // identify the one to many relationship between subcategory & product
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
