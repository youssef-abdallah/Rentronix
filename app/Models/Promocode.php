<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    protected $table = 'promocodes' ;  // to connect the model with its corresponding table
    use HasFactory;
    protected $guarded = [];      // to allow mass assigning



}
