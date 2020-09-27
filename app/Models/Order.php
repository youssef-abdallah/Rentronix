<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';  

    protected $guarded = [];
    
    public function customer()
    {
        return $this->belongsTo(User::class , 'id' , 'customer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class , 'id' , 'seller_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function orderFeedback()
    {
        return $this->hasOne(OrderFeedback::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function updateStatus($state)
    {
        $this->shipping_status = $state;
        $this->save();
    }

}
