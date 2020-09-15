<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class favourite_list extends Model
{
    protected $table = 'favourite_lists' ;  // to connect the model with its corresponding table

    protected $guarded = [];      // to allow mass assigning

    function product()  // identify the one to many relationship between favrouite list& product
    {
        return $this->belongsTo(products::class,'product_id');
    }

    ///function should be done for the user
}
