<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;



class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';  // to connect the model with its corresponding table
    protected $guarded = [];      // to allow mass assigning
    use HasFactory;
    function subcategory() // identify the one to many relationship between category & subcategory
    {
        return $this->hasMany(Subcategory::class);
    }

    function products() // identify the one to many relationship between category & products
    {
        return $this->hasMany(Product::class);
    }


}
