<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderFeedback extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $table = 'order_feedback';
=======
    protected $table = 'order_feedback';  
>>>>>>> origin/orders

    protected $guarded = [];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
