<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $table = 'products';  // to connect the model with its corresponding table

    protected $guarded = [];      // to allow mass assigning

    function subcategory()  // identify the one to many relationship between subcategory & product
    {
        return $this->belongsTo(subcategories::class,'subcategory_id');
    }

    ///function should be done for the user 'manufacture'

}
