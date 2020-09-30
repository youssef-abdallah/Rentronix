<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturerInfo extends Model
{
    protected $table = 'manufacturer_info' ;
    use HasFactory;

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function ManufacturerLocation(){
        return $this->hasMany(ManufacturerLocation::class);
    }
    public function products() {
        return $this->hasMany(Product::class);
    }
}
