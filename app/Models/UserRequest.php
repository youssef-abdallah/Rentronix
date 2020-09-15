<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;
    protected $table = 'user_requests';

    protected $fillable = ['user_id', 'model_id', 'product_id',
        'description', 'quantity', 'approved', 'type',
        'price', 'price_per_hour', 'image', 'datasheet'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
