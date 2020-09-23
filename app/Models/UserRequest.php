<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;
    protected $table = 'user_requests';

    protected $fillable = ['user_id', 'product_name',
        'description', 'quantity', 'type',
        'price', 'price_per_hour', 'subcategory_title',
        'category_title', 'subcategory_description'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
