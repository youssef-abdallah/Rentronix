<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategories';  // to connect the model with its corresponding table

    protected $guarded = [];      // to allow mass assigning

    function category() // identify the one to many relationship between category & subcategory
    {
        return $this->belongsTo(categories::class, category_id);
    }




}
