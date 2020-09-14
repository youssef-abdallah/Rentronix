<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function customer()
    {
        return $this->belongsTo(User::class , 'id' , 'customer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class , 'id' , 'seller_id');
    }

    public function orderDetails()
    {
        return $this->belongsToMany(Model::class);
    }

    public function orderFeedback()
    {
        return $this->hasOne(OrderFeedback::class);
    }




}
