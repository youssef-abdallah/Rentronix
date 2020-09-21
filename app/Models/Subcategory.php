<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Subcategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';  // to connect the model with its corresponding table

    protected $guarded = [];      // to allow mass assigning
    use HasFactory;
    function category() // identify the one to many relationship between category & subcategory
    {
        return $this->belongsTo(Categories::class, category_id);
    }

    function products()
    {

        return $this->hasMany(Product::class);
    }




}
