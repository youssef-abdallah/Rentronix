<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'products_comments';  // to connect the model with its corresponding table

    protected $guarded = [];      // to allow mass assigning

    function product()  // identify the one to many relationship between product & product comments
    {
        return $this->belongsTo(products::class,'product_id');
    }

    ///function should be done for the user

}
