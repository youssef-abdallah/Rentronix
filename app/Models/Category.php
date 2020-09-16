<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';  // to connect the model with its corresponding table

    protected $guarded = [];      // to allow mass assigning
}
